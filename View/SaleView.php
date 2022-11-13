<?php

require_once "./libs/smarty-4.2.1/libs/Smarty.class.php";


class SaleView{

    private $smarty;
   
   public function __construct()
    {
        $this->smarty = new Smarty();
        
    }

    function showHomev() { 
        $this->smarty->assign('titulo', 'BUSINESS INTELLIGENCE');
        $this->smarty->display('templates/home.tpl');

    }
    function showSales($sales, $seller) {
        $this->smarty->assign('titulo1', '....');
        $this->smarty->assign('titulo2', 'Daily Sales');
        $this->smarty->assign('sales', $sales);
        $this->smarty->assign('sellers', $seller);
        $this->smarty->display('templates/salesList.tpl');
    }

    function showSalesFilter($sales, $sellers) {
        $this->smarty->assign('titulo1', '....');
        $this->smarty->assign('titulo2', 'Daily Sales');
        $this->smarty->assign('sales', $sales);
        $this->smarty->assign('sellers', $sellers);
        $this->smarty->display('templates/salesListfilter.tpl');
    }

    function showHomeLocation(){
        header("Location: ".BASE_URL."showSales"); 
    }

    function showSaleDetail($sale, $sellers){
        $this->smarty->assign('titulo', 'Sale Detail');
        $this->smarty->assign('sale', $sale);
        $this->smarty->assign('sellers', $sellers);
        $this->smarty->display('templates/saleDetail.tpl');
    }
  
   
}

