<?php

require_once "./libs/smarty-4.2.1/libs/Smarty.class.php";

class LoginView{

    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showLogin($error = null)
    {
        $this->smarty->assign('titulo', 'Log In');
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/login.tpl');
    }

    function showHome(){
        header("Location: ".BASE_URL."home"); 
    }

}