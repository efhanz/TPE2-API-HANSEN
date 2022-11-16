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
    $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_OBJ);
    return $user;
}
}

