<?php

class SellerModel
{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;charset=utf8', 'root', '');
    }

    function getSellers()
    {

        $sentencia = $this->db->prepare("SELECT * FROM sellers"); //prepare($sqlQuery) - permite la creación de una sentencia para su posterior uso:
        $sentencia->execute();  //execute($array) ejecuta la sentencia que tenemos preparada:
        $sellers = $sentencia->fetchAll(PDO::FETCH_OBJ); //fetch() //Itera sobre las tuplas(ROWs) seleccionadas y nos trae al php la tabla      //fetchall trae toda la tabla en un objeto
        return $sellers;  //Procesamos los datos para generar el HTML //foreach($tareas as $tarea)
    }

    function getSellerFromDB($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM sellers WHERE Seller_ID=?");
        $sentencia->execute(array($id));
        $seller = $sentencia->fetch(PDO::FETCH_OBJ);
        return $seller;
    }

    function getSellerFromDBv1($id)
    {
        $sentencia = $this->db->prepare("SELECT Seller FROM sellers WHERE Seller_ID=?");
        $sentencia->execute(array($id));
        $sellers = $sentencia->fetch(PDO::FETCH_OBJ);
        return $sellers;
    }

    function insertSeller($seller, $sales_area, $sales_commission)
    {
        $sentencia = $this->db->prepare("INSERT INTO sellers(Seller, Sales_Area, Sales_Commission) VALUES(?, ?, ?)");
        $sentencia->execute(array($seller, $sales_area, $sales_commission));
    }




    function deleteSellerFromDB($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM sellers WHERE Seller_ID=?");
        $sentencia->execute(array($id));
    }

    function updateSellerFromDB($seller, $sales_area, $sales_commission, $id)
    {
        $sentencia = $this->db->prepare("UPDATE sellers SET Seller=?, Sales_Area=?, Sales_Commission=? WHERE Seller_ID=?");
        $sentencia->execute(array($seller, $sales_area, $sales_commission, $id));
        $sellerupdated = $sentencia->fetch(PDO::FETCH_OBJ);
        return $sellerupdated;
    }
}
