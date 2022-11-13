<?php
require_once "./Model/SellerModel.php";
require_once "./View/SellerView.php";
require_once "./Helpers/AuthHelper.php";

class SellerController
{
    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new SellerModel();
        $this->view = new SellerView();
        $this->authHelper = new AuthHelper();
    }

    function showHome()
    {
        session_start();
        $this->view->showHomev();
    }

    function showSellers()
    {
        session_start();
        $sellers = $this->model->getSellers();
        $this->view->showSellers($sellers);
    }

    function getSeller($id)
    {
        session_start();
        $seller =  $this->model->getSellerFromDB($id);
        $this->view->showSellerDetail($seller);
    }


    function createSeller()
    {
        $this->authHelper->checkLoggedIn(); 
        $this->model->insertSeller($_POST['seller'], $_POST['sales_area'], $_POST['sales_commission']);
        $this->view->showSellerLocation();
    }

    function deleteSeller($id)
    {
        $this->authHelper->checkLoggedIn(); 
        $this->model->deleteSellerFromDB($id);
        $this->view->showSellerLocation();
    }


    function updateSeller($id)
    {
        $this->authHelper->checkLoggedIn(); 

        $id = $id;
        $seller = $_POST['seller'];
        $sales_area = $_POST['sales_area'];
        $sales_commission = $_POST['sales_commission'];

        if (
            !empty($id) &&
            !empty($seller) &&
            !empty($sales_area) &&
            !empty($sales_commission)

        ) {
            $this->model->updateSellerFromDB($seller, $sales_area, $sales_commission, $id);
            header("Location: ".BASE_URL."sellerDetail/".$id); 
        }
    }
}
