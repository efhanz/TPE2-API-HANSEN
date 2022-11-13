<?php

require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";

class LoginController
{

    private $model;
    private $view;

   public function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView();
    }

    public function login()
    {
        $this->view->showLogin();
    }

    public function verifyLogin()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Obtengo el usuario de la base de datos
            $user = $this->model->getUser($email);
           
            // Si el usuario existe y las contraseñas coinciden
            if ($user && password_verify($password, $user->password)) {

                session_start();
                $_SESSION['user_ID'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['IS_LOGGED'] = true;

                $this->view->showHome();
            } else {
                $this->view->showLogin("Access Denied - Please check");
            }
        } else {
            $this->view->showLogin("Please complete all fields");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->view->showLogin("You Logged out");
    }
}
