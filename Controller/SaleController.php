<?php
require_once "./Model/SaleModel.php";
require_once "./View/SaleView.php";
require_once "./Model/SellerModel.php";
require_once "./Helpers/AuthHelper.php";

class SaleController
{
    private $model;
    private $view;
    private $model_seller;
    private $authHelper;
    
    public function __construct()
    {
        
        $this->model = new SaleModel();
        $this->view = new SaleView();
        $this->model_seller = new SellerModel();
        $this->authHelper = new AuthHelper();
       
    }

    public function showHome()
    { 
        session_start();
        $this->view->showHomev();
    }

    public function showSales()
    {
        
        session_start();
        $seller = $this->model_seller->getSellers();
        $sales = $this->model->getSales();
        $this->view->showSales($sales, $seller);
    }

    public function getSale($id) {
       
        session_start();
        $sale =  $this->model->getSaleFromDB($id);
        $sellers = $this->model_seller->getSellers();
        $this->view->showSaleDetail($sale, $sellers);
    }

    public function sellerfilter($id)
    {
       
        session_start();
        $id = $_POST['seller'];
      
        if (
            !empty($id) 
        ) {
        $sellers = $this->model_seller->getSellerFromDBv1($id);
        $sales = $this->model->getSellerSaleFromDB($id);
        $this->view->showSalesFilter($sales, $sellers);
    } }
    
    function createSale(){  
        $this->authHelper->checkLoggedIn(); 

        $this->model->insertSale($_POST['customer'], $_POST['invoice'], $_POST['dates'], $_POST['seller'], $_POST['product'], $_POST['quantity'], $_POST['unitprice'], $_POST['amount']);
        header("Location: ".BASE_URL."showSales"); 
    }

    function deleteSale($id){
        $this->authHelper->checkLoggedIn();  
        
        $this->model->deleteSaleFromDB($id); 
        $this->view->showHomeLocation();
    }

    function updateSale($id) {
        $this->authHelper->checkLoggedIn(); 

       
        $id = $id;
        $customer = $_POST['customer'];
        $invoice = $_POST['invoice'];
        $dates = $_POST['dates'];
        $seller = $_POST['seller'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $unitprice = $_POST['unitprice'];
        $amount = $_POST['amount'];
       
        if (
            !empty($id) &&
            !empty($customer) &&
            !empty($invoice) &&
            !empty($dates) &&
            !empty($seller) &&
            !empty($product) &&
            !empty($quantity) &&
            !empty($unitprice) &&
            !empty($amount)
        ) {
           
            $this->model->updateSaleFromDB($customer, $invoice, $dates, $seller, $product, $quantity, $unitprice, $amount, $id);
            header("Location: ".BASE_URL."saleDetail/".$id); 
    }}

    
   
}
