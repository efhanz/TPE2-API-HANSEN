<?php

class ProductsModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;charset=utf8', 'root', '');
    }


    public function getProducts($sort, $order, $limit, $offset)
    { 
        $query = $this->db->prepare("SELECT products_list.*, product_classes.Class  
                                    FROM products_list INNER JOIN product_classes 
                                    ON products_list.Class = product_classes.Class_ID 
                                    ORDER BY $sort $order
                                    LIMIT $limit 
                                    OFFSET $offset");
        $query->execute(); 
        $products = $query->fetchAll(PDO::FETCH_OBJ); 
        return $products;  
    }

    function getProductsFilter($sort, $order, $limit, $offset, $filterBy, $filterValue){
        $query = $this->db->prepare("SELECT products_list.*, product_classes.Class 
                                     FROM products_list
                                     JOIN product_classes
                                     ON products_list.Class = product_classes.Class_ID 
                                     WHERE $filterBy = ?
                                     ORDER BY $sort $order
                                     LIMIT $limit OFFSET $offset");
        $query->execute([$filterValue]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getColumns(){
        $query = $this->db->prepare('DESCRIBE products_list'); //proporciona información sobre las columnas de una tabla
        $query->execute();
        $resultcolumns = $query->fetchAll(PDO::FETCH_OBJ);
        return $resultcolumns;
    }

    public function getProduct($id)
    {
        $query = $this->db->prepare("SELECT products_list.*, product_classes.Class  FROM products_list INNER JOIN product_classes ON products_list.Class = product_classes.Class_ID WHERE Product_ID=?");
        $query->execute(array($id));
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    function deleteProduct($id)
    {
        $query = $this->db->prepare("DELETE FROM products_list WHERE Product_ID=?");
        $query->execute(array($id));
    }

    public function insertProduct($product, $class, $quantity, $discount, $unitprice)
    {
        $query = $this->db->prepare("INSERT INTO products_list(Product, Class, Quantity, Discount, Unit_Price) VALUES(?, ?, ?, ?, ?)");
        $query->execute(array($product, $class, $quantity, $discount, $unitprice));
        return $this->db->lastInsertId();
    }

    function updateProduct($id, $product, $class, $quantity, $discount, $unitprice)
    {
        $query = $this->db->prepare("UPDATE products_list SET Product=?, Class=?, Quantity=?, Discount=?, Unit_Price=? WHERE Product_ID=?");
        $query->execute(array($product, $class, $quantity, $discount, $unitprice, $id)); //los parametros van en el mismo orden de la preparacion
        return $query->fetch(PDO::FETCH_OBJ);
        
    }

}
