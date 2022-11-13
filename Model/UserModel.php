<?php

class UserModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=tpe;charset=utf8', 'root', '');
    }

    public function getUser($email)
    {
    //Obtengo el usuario de la base de datos
    $sentencia = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $sentencia->execute([$email]);
    $user = $sentencia->fetch(PDO::FETCH_OBJ);
    return $user;
}
}

