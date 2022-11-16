<?php
require_once "./Model/ProductsModel.php";
require_once "./View/ApiView.php";

class ApiProductsController
{
    private $model;
    private $view;

    private $data;

    public function __construct()
    {
        $this->model = new ProductsModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    function getProducts($params = [])
    {

        $sort = $_GET['sort'] ?? "Class"; //Orden por Clase
        $order = $_GET['order'] ?? "asc"; //Orden Ascendente
        $page = (int)($_GET['page'] ?? 1); //Paginado
        $limit = (int)($_GET['limit'] ?? 10); //Paginado
        $filterBy = $_GET['filterBy'] ?? null; //Filtrado por clase
        $filterValue = $_GET['filterValue'] ?? null; //Elección de la clase para filtrar

        $columns = $this->getColumns(); //Traigo los nombres de las columnas

        // in_array — Checks if a value exists in an array
        // strtolower - Devuelve el string en minúsculas
        if (($sort == 'Class' || in_array(strtolower($sort), $columns)) && (strtolower($order == "asc") || strtolower($order == "desc"))) {

            //Asigna un valor $sort para pasar al modelo en funcion del campo por el que se quiere ordenar
            if ($sort == 'Class') {
                $sort = 'product_classes.Class';
            } else {
                $sort = 'products_list.' . $sort;
            }
            
            if ((is_numeric($page) && $page > 0) && (is_numeric($limit) && $limit > 0)) { //validacion de paginado

                $offset = ($page * $limit) - $limit;  //Las cláusulas "limit" y "offset" se usan para restringir los registros que se retornan en una consulta "select". La cláusula limit recibe un argumento numérico positivo que indica el número máximo de registros a retornar; la cláusula offset indica el número del primer registro a retornar.
                
                if ($filterBy != null && $filterValue != null) { // Verifica si existen los parámetros de filtrado

                   
                    if ($filterBy == 'Class' || in_array(strtolower($filterBy), $columns)) {

                        $filter = 'product_classes.Class';
                       
                        $result = $this->model->getProductsFilter($sort, $order, $limit, $offset, $filter, $filterValue);

                        // Verifica si la consulta se realizó correctamente y si esta vacia
                        if (isset($result)) {

                            if (empty($result)) {
                                $this->view->response("The search performed returned no results", 204);
                            } else {
                                $this->view->response($result, 200);
                            }
                        } else {
                            $result = $this->view->response("The query couldn't be performed", 500);
                        }
                    } else {
                        $result = $this->view->response("Bad Request - Invalid filter parameter", 400);
                    }
                } else {
                    //Obtiene todos los productos del modelo y pasa los parametros de ordenamiento y paginado.
                    $result = $this->model->getProducts($sort, $order, $limit, $offset);
                    $this->view->response($result, 200);
                }
            } else {
                $result = $this->view->response("Bad Request - Invalid filter parameter", 400);
            }
        } else {
            $result = $this->view->response("Bad Request - Invalid filter parameter", 400);
        }
    }


    function getColumns($params = null)
    {
        $columns = []; //arreglo vacío para almacenar los nombres de las columnas
        $resultcolumns = $this->model->getColumns();
        
        foreach ($resultcolumns as $column) {
            array_push($resultcolumns, $column->Field); //Recorre el arreglo y trae el nombre del campo de la columna.
        }
        return $columns; //devuelve un arreglo con los nombres de las columnas
    }


    function getProduct($params = [])
    {
        $idProduct = $params[":ID"];
        if (is_numeric($idProduct) && ($idProduct) > 0) {
            $product = $this->model->getProduct($idProduct);
            if ($product) {
                return $this->view->response($product, 200);
            } else {
                return $this->view->response("The ID $idProduct Product doesn't exist", 404);
            }
        } else {
            return $this->view->response("The ID $idProduct Product doesn't have a valid parameter", 400);
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
        $body = $this->getData();

        //VALIDACIONES -> 400 (BAD REQUEST) valida si falta alguno o no cumple requisitos
        if (
            !empty($body->Product) &&
            !empty($body->Class) && is_numeric($body->Class) &&
            !empty($body->Quantity) && is_numeric($body->Quantity) &&
            !empty($body->Discount) && is_numeric($body->Discount) &&
            !empty($body->Unit_Price) && is_numeric($body->Unit_Price)
        ) {
            $id = $this->model->insertProduct($body->Product, $body->Class, $body->Quantity, $body->Discount, $body->Unit_Price);

            if ($id != 0) {
                $this->view->response("the product was inserted correctly with number ID $id", 201);
                // muestro el último ID creado para corroborarlo
                $product = $this->model->getProduct($id);
                return $this->view->response($product, 201);
            } else {
                $this->view->response("the product didn't inserted", 500);
            }
        } else {
            $this->view->response("BAD REQUEST - Please, complete all the fields correctly", 400);
        }
    }



    function updateProduct($params = null)
    {
        $idProduct = $params[':ID'];
        $body = $this->getData();
        //VALIDACIONES -> 400 (BAD REQUEST) valida si falta alguno 
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
                !empty($body->Class) && is_numeric($body->Class) &&
                !empty($body->Quantity) && is_numeric($body->Quantity) &&
                !empty($body->Discount) && is_numeric($body->Discount) &&
                !empty($body->Unit_Price) && is_numeric($body->Unit_Price)
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