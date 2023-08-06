<?php 

if(!isset($_SERVER['HTTP_X_AJAX_REQUEST'])){
    // If the request is not an AJAX request, return an error or do whatever is necessary
    echo "<script>window.location.href = '/online_bookstore/forbidden.html'</script>";
    exit();
}

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
//-----------------------------------------------------------
    if($_GET['ajax'] == "get_categories"){
        require_once 'controllers/Books.php';
        $books = new Books();
        $books->get_categories();
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "add_category"){
        require_once 'controllers/Books.php';
        $books = new Books();
        $books->add_category();
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "add_book"){
        require_once 'controllers/Books.php';
        $books = new Books();
        $books->add_book();
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "delete_book"){
        require_once 'controllers/Books.php';
        $books = new Books();
        $books->delete_books($_GET["book_id"]);
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "get_book_by_id"){
        require_once 'controllers/Books.php';
        $books = new Books();
        $books->get_book_by_id($_GET["book_id"]);
    }
//-----------------------------------------------------------
    if($_GET['ajax'] == "view_inq"){
        require_once 'controllers/Inquiries.php';
        $inq = new Inquiries();
        $inq->get_inquiries();
    }
//-----------------------------------------------------------
}else{
    echo json_encode(array("status" => "error", "msg" => "Function undeclared."));
}
//-----------------------------------------------------------


?>