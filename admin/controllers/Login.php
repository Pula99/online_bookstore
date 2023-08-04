<?php

class Login{
    public function __construct() {
        if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
            header('Location: /online_bookstore?page=Dashboard');
        }
    }
//-----------------------------------------------------------
// login page
    public function index() {
        include('admin/views/admin_login.php');
    }
//-----------------------------------------------------------
//to login to system
    public function auth() 
    {
        include('models/Login_m.php');
        $login = new Login_m();
        $re = $login->auth();
        echo json_encode($re);
    }
//-----------------------------------------------------------
}

?>