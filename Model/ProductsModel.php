<?php

class ProductsModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;charset=utf8', 'root', '');
    }

    public function getProducts()
    {
        $sentencia = $this->db->prepare("SELECT * FROM products_list"); //prepare($sqlQuery) - permite la creación de una sentencia para su posterior uso:
        $sentencia->execute();  //execute($array) ejecuta la sentencia que tenemos preparada:
        $products = $sentencia->fetchAll(PDO::FETCH_OBJ); //fetch() //Itera sobre las tuplas(ROWs) seleccionadas y nos trae al php la tabla      //fetchall trae toda la tabla en un objeto
        return $products;  //Procesamos los datos para generar el HTML //foreach($tareas as $tarea)
    }

    
    public function getProduct($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM products_list WHERE Product_ID=?");
        $sentencia->execute(array($id));
        $product = $sentencia->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    function deleteProduct($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM products_list WHERE Product_ID=?");
        $sentencia->execute(array($id));
    }

    public function insertProduct($product, $class, $quantity, $discount, $unitprice)
    {
        $sentencia = $this->db->prepare("INSERT INTO products_list(Product, Class, Quantity, Discount, Unit_Price) VALUES(?, ?, ?, ?, ?)");
        $sentencia->execute(array($product, $class, $quantity, $discount, $unitprice));
        return $this->db->lastInsertId();
    }

    function updateProduct($id, $product, $class, $quantity, $discount, $unitprice)
    {
        $sentencia = $this->db->prepare("UPDATE products_list SET Product=?, Class=?, Quantity=?, Discount=?, Unit_Price=? WHERE Product_ID=?");
        $sentencia->execute(array($product, $class, $quantity, $discount, $unitprice, $id)); //los parametros van en el mismo orden de la preparacion
        return $sentencia->fetch(PDO::FETCH_OBJ);
        
    }
     /*  
    function getSellerSaleFromDB($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM products_list WHERE Seller=?");
        $sentencia->execute(array($id));
        $sales = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $sales;
    }
    */
}
