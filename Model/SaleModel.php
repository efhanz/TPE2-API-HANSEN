<?php

class SaleModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;charset=utf8', 'root', '');
    }

    public function getSales()
    {
        $query = $this->db->prepare("SELECT * FROM products_sales"); //prepare($sqlQuery) - permite la creación de una query para su posterior uso:
        $query->execute();  //execute($array) ejecuta la query que tenemos preparada:
        $sales = $query->fetchAll(PDO::FETCH_OBJ); //fetch() //Itera sobre las tuplas(ROWs) seleccionadas y nos trae al php la tabla      //fetchall trae toda la tabla en un objeto
        return $sales;  //Procesamos los datos para generar el HTML //foreach($tareas as $tarea)
    }

    public function getSaleFromDB($id)
    {
        $query = $this->db->prepare("SELECT * FROM products_sales WHERE Transaction_ID=?");
        $query->execute(array($id));
        $sale = $query->fetch(PDO::FETCH_OBJ);
        return $sale;
    }

    public function insertSale($customer, $invoice, $dates, $seller, $product, $quantity, $unitprice, $amount)
    {
        $query = $this->db->prepare("INSERT INTO products_sales(Customer, Invoice, Date, Seller, Product, Quantity, Unit_Price, Amount) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute(array($customer, $invoice, $dates, $seller, $product, $quantity, $unitprice, $amount));
    }




    function deleteSaleFromDB($id)
    {
        $query = $this->db->prepare("DELETE FROM products_sales WHERE Transaction_ID=?");
        $query->execute(array($id));
    }

    function updateSaleFromDB($customer, $invoice, $dates, $seller, $product, $quantity, $unitprice, $amount, $id)
    {
        $query = $this->db->prepare("UPDATE products_sales SET Customer=?, Invoice=?, Date=?, Seller=?, Product=?, Quantity=?, Unit_Price=?, Amount=? WHERE Transaction_ID=?");
        $query->execute(array($customer, $invoice, $dates, $seller, $product, $quantity, $unitprice, $amount, $id));
        return $query->fetch(PDO::FETCH_OBJ);
        
    }
    function getSellerSaleFromDB($id)
    {
        $query = $this->db->prepare("SELECT * FROM products_sales WHERE Seller=?");
        $query->execute(array($id));
        $sales = $query->fetchAll(PDO::FETCH_OBJ);
        return $sales;
    }
}
