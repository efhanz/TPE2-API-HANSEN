<?php
require_once "./Model/ProductsModel.php";
require_once "./View/ApiView.php";

class ApiProductsController
{
    private $model;
    private $view;


    public function __construct()
    {
        $this->model = new ProductsModel();
        $this->view = new ApiView();
    }

    function getProducts()
    {
        $products = $this->model->getProducts();
        return $this->view->response($products, 200);
    }

    //trae un solo producto
    function getProduct($params = [])
    {
        $idProduct = $params[":ID"];
        $product = $this->model->getProduct($idProduct);
        if ($product) {
            return $this->view->response($product, 200);
        } else {
            return $this->view->response("The ID $idProduct Product doesn't exist", 404);
        }
    }

    function deleteProduct($params = [])
    {
        $idProduct = $params[":ID"];
        $product = $this->model->getProduct($idProduct);

        if ($product) {
            $this->model->deleteProduct($idProduct);
            return $this->view->response("The ID $idProduct Product was deleted", 200);
        } else {
            return $this->view->response("The ID $idProduct Product doesn't exist", 404);
        }
    }

    function createProduct($params = null)
    { //no es necesario poner params pq lo voy a crear
        // obtengo el body del request (json)
        $body = $this->getBody();

        if (
            empty($body->Product) &&
            empty($body->Class) &&
            empty($body->Quantity) &&
            empty($body->Discount) &&
            empty($body->Unit_Price)
        ) {
            $this->view->response("BAD REQUEST - Please, complete all the fields", 400);  //VALIDACIONES -> 400 (BAD REQUEST) validay si falta alguno   
        } else {
            $id = $this->model->insertProduct($body->Product, $body->Class, $body->Quantity, $body->Discount, $body->Unit_Price);

            if ($id != 0) {
                $this->view->response("the product was inserted correctly with number ID $id", 201);
            } else {
                $this->view->response("the product didn't inserted", 500);
            }
        }
    }

    // Devuelve el body del request
    private function getBody()
    {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

    function updateProduct($params = null)
    {
        $idProduct = $params[':ID'];
        $body = $this->getBody();
        //VALIDACIONES -> 400 (BAD REQUEST) validay si falta alguno 
        if (
            empty($body->Product) &&
            empty($body->Class) &&
            empty($body->Quantity) &&
            empty($body->Discount) &&
            empty($body->Unit_Price)
        ) {
            $this->view->response("BAD REQUEST - Please, review all the fields", 400);
        } else {
            $product = $this->model->getProduct($idProduct);

            if ($product) {
                if (
                    !empty($body->Product) &&
                    !empty($body->Class) &&
                    !empty($body->Quantity) &&
                    !empty($body->Discount) &&
                    !empty($body->Unit_Price)
                ) {
                    $this->model->updateProduct($idProduct, $body->Product, $body->Class, $body->Quantity, $body->Discount, $body->Unit_Price);
                    return $this->view->response("The ID $idProduct Product was updated", 200);
                } else {
                    return $this->view->response("BAD REQUEST - Please, review all the fields of ID $idProduct Product", 400);
                }
            } else {
                return $this->view->response("The ID $idProduct Product doesn't exist", 404);
            }
        }
    }
}
