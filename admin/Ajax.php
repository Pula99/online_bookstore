<?php 
//-----------------------------------------------------------
if(isset($_GET['ajax'])){
//-----------------------------------------------------------
    if($_GET['ajax'] == "register"){
        require_once 'controllers/Register.php';
        $register = new Register();
        $register->register_user();
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "login"){
        require_once 'controllers/Login.php';
        $login = new Login();
        $login->auth();
    }

    if($_GET['ajax'] == "x"){
        require_once 'controllers/Login.php';
        $login = new Login();
        $login->auth();
    }
//-----------------------------------------------------------
}else{
    echo json_encode(array("status" => "error", "msg" => "Function undeclared."));
}
//-----------------------------------------------------------


?>