<?php
require_once "Controller/SaleController.php";
require_once "Controller/SellerController.php";
require_once "Controller/LoginController.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (isset($_GET['action']) && !empty($_GET['action'])) {  //si viene definina la reemplazamos
    $action = $_GET['action'];
}
else {
    $action = 'home'; //accion por defecto si no seleccionan nada
}

// parsea la accion Ej: dev/juan --> ['dev', juan]
$params = explode ('/', $action);





// determina que camino seguir según la acción
switch ($params[0]) {
    case 'login':
        $loginController = new LoginController();
        $loginController->login();
        break;
    case 'logout':
        $loginController = new LoginController();
        $loginController->logout();
        break;
    case 'verify':
        $loginController = new LoginController();
        $loginController->verifyLogin();
        break;
    case 'home':
        $saleController = new SaleController();
        $saleController->showHome();
        break;
    case 'showSales':
        $saleController = new SaleController();
        $saleController->showSales();
        break;
    case 'saleDetail':
        $saleController = new SaleController();
        $saleController->getSale($params[1]);
        break;
    case 'createSale':
        $saleController = new SaleController();
        $saleController->createSale();
        break;
    case 'deleteSale':
        $saleController = new SaleController();
        $saleController->deleteSale($params[1]);
        break;
    case 'updateSale':
        $saleController = new SaleController();
        $saleController->updateSale($params[1]);
        break;
    case 'sellerfilter':
        $saleController = new SaleController();
        $saleController->sellerfilter($params[1]);
        break;  
    case 'showSeller':
        $sellerController = new SellerController();
        $sellerController->showSellers();
        break;
    case 'createSeller':
        $sellerController = new SellerController();
        $sellerController->createSeller();
        break;
    case 'sellerDetail':
        $sellerController = new SellerController();
        $sellerController->getSeller($params[1]);
        break;
    case 'deleteSeller':
        $sellerController = new SellerController();
        $sellerController->deleteSeller($params[1]);
        break;
    case 'updateSeller':
        $sellerController = new SellerController();
        $sellerController->updateSeller($params[1]);
        break;
 
    default:
        echo ('404 Page not found');
        break;
}





