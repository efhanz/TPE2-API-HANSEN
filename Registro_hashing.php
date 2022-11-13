<?php

function renderForm(){
    echo '
        <h2>Registro</h2>
        <form method="POST">
            <input type="text" name="email" placeholder="Ingrese su email..."/>
            <input type="password" name="password" placeholder="Ingrese su password..."/>
            <button>Crear cuenta</button>
        </form>
    ';
}

//Imprimir el formulario
renderForm();


if(!empty($_POST['email'])&& !empty($_POST['password'])){
    $userEmail=$_POST['email'];
    $userPassword=password_hash($_POST['password'], PASSWORD_BCRYPT);

    //Guardo el nuevo usuario en la base de datos
    $db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8', 'root', '');
    $query = $db->prepare('INSERT INTO users (email, password) VALUES (? , ?)');
    $query->execute([$userEmail,$userPassword]);
}