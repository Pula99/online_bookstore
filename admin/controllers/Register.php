<?php

class Register{
    public function __construct() {
        if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
            header('Location: /online_bookstore?page=Dashboard');
        }
    }
//-----------------------------------------------------------
// register page
    public function index() {
        include('admin/views/admin_register.php');
    }
//-----------------------------------------------------------
// for registration
    public function register_user(){
        include('models/Register_m.php');
        $register = new Register_m();
        $re = $register->register_user();
        echo json_encode($re);
    }
//-----------------------------------------------------------
}

?>