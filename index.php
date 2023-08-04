<?php

session_start();

include('admin/views/preloader.php');

//array of pages that should login before access them
$restricted = array("Dashboard");

if(isset($_GET['page'])){
//-----------------------------------------------------------------------------------------
//check login restrictions
    if(!isset($_SESSION["login"])){
        if(in_array($_GET['page'], $restricted)){
            header('Location: /online_bookstore?page=Login');
        }
    }
//-----------------------------------------------------------------------------------------
    if($_GET['page'] == "Register"){// when get request send to register page
        require_once 'admin/controllers/Register.php';
        $register = new Register();
        $register->index();
    }else if($_GET['page'] == "Login"){// when get request send to login page
        require_once 'admin/controllers/Login.php';
        $login = new Login();
        $login->index();
    }else if($_GET['page'] == "Dashboard"){// when get request send to Dashboard page
        require_once 'admin/controllers/Dashboard.php';
        $dash = new Dashboard();
        $dash->index();
    }else if($_GET['page'] == "Logout"){// To log out
        $_SESSION = array();
        session_destroy();
        header('Location: /online_bookstore?page=Login');
    }else{
        header('Location: 404.html');
    } 
//-----------------------------------------------------------------------------------------
}else{
    header('Location: 404.html');
}

?>


<script>
    //for change the url
    //var newURL = window.location.origin + window.location.pathname;
    //newURL += '<?=$_GET["page"]?>';
    //history.pushState(null, null, newURL);
</script>