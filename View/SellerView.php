<?php

require_once "./libs/smarty-4.2.1/libs/Smarty.class.php";

class SellerView{

    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showHomev() {
        $this->smarty->assign('titulo', 'BUSINESS INTELLIGENCE');
        $this->smarty->display('templates/home.tpl');

    }
    function showSellers($sellers) {
        $this->smarty->assign('titulo1', '.Load a seller');
        $this->smarty->assign('titulo2', 'Info Sellers');
        $this->smarty->assign('sellers', $sellers);
        $this->smarty->display('templates/sellersList.tpl');

    }
    function showSellerLocation(){
        header("Location: ".BASE_URL."showSeller"); 
    }

    function showSellerDetail($seller){
        $this->smarty->assign('titulo', 'Seller Detail');
        $this->smarty->assign('seller', $seller);
        $this->smarty->display('templates/sellerDetail.tpl');
    }
  
}

