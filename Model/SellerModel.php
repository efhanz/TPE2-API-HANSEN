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

        $query = $this->db->prepare("SELECT * FROM sellers"); //prepare($sqlQuery) - permite la creación de una query para su posterior uso:
        $query->execute();  //execute($array) ejecuta la query que tenemos preparada:
        $sellers = $query->fetchAll(PDO::FETCH_OBJ); //fetch() //Itera sobre las tuplas(ROWs) seleccionadas y nos trae al php la tabla      //fetchall trae toda la tabla en un objeto
        return $sellers;  //Procesamos los datos para generar el HTML //foreach($tareas as $tarea)
    }

    function getSellerFromDB($id)
    {
        $query = $this->db->prepare("SELECT * FROM sellers WHERE Seller_ID=?");
        $query->execute(array($id));
        $seller = $query->fetch(PDO::FETCH_OBJ);
        return $seller;
    }

    function getSellerFromDBv1($id)
    {
        $query = $this->db->prepare("SELECT Seller FROM sellers WHERE Seller_ID=?");
        $query->execute(array($id));
        $sellers = $query->fetch(PDO::FETCH_OBJ);
        return $sellers;
    }

    function insertSeller($seller, $sales_area, $sales_commission)
    {
        $query = $this->db->prepare("INSERT INTO sellers(Seller, Sales_Area, Sales_Commission) VALUES(?, ?, ?)");
        $query->execute(array($seller, $sales_area, $sales_commission));
    }




    function deleteSellerFromDB($id)
    {
        $query = $this->db->prepare("DELETE FROM sellers WHERE Seller_ID=?");
        $query->execute(array($id));
    }

    function updateSellerFromDB($seller, $sales_area, $sales_commission, $id)
    {
        $query = $this->db->prepare("UPDATE sellers SET Seller=?, Sales_Area=?, Sales_Commission=? WHERE Seller_ID=?");
        $query->execute(array($seller, $sales_area, $sales_commission, $id));
        $sellerupdated = $query->fetch(PDO::FETCH_OBJ);
        return $sellerupdated;
    }
}
