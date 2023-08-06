<?php

session_start();

include('admin/views/preloader.php');

//array of pages that should login before access them
$restricted = array("Dashboard", "Add_books", "View_books", "Update_books");

if(isset($_GET['page'])){
//-----------------------------------------------------------------------------------------
//check login restrictions
    if(!isset($_SESSION["login"])){
        if(in_array($_GET['page'], $restricted)){
            header('Location: /online_bookstore?page=Login');
        }
    }else{
        if($_SESSION["user_type"] != "admin"){
            if(in_array($_GET['page'], $restricted)){
                header('Location: /online_bookstore?page=Home');
            }
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
    }else if($_GET['page'] == "Add_books"){// To add books
        require_once 'admin/controllers/Books.php';
        $books = new Books();
        $books->add_books();
    }else if($_GET['page'] == "Update_books"){// To add books
        require_once 'admin/controllers/Books.php';
        $books = new Books();
        $books->update_books($_GET["book_id"]);
    }else if($_GET['page'] == "View_books"){// To view books
        require_once 'admin/controllers/Books.php';
        $books = new Books();
        $books->view_books();
    }else if($_GET['page'] == "View_inquiries"){// To view inquiries
        require_once 'admin/controllers/Inquiries.php';
        $books = new Inquiries();
        $books->index();
    }else if($_GET['page'] == "Home"){ // when get request send to Home page
        require_once 'web/controllers/Home.php';
        $home = new Home();
        $home->index();
    }else if($_GET['page'] == "BookDeals"){ // when get request send to Book Deals page
        require_once 'web/controllers/Book_Deals.php';
        $bookdeals = new Bookdeals();
        $bookdeals->index();
    }else if($_GET['page'] == "BookCatalogue"){ // when get request send to Book catelogue page
        require_once 'web/controllers/Book_Catalogue.php';
        $book_catelogue = new Book_catalogue();
        $book_catelogue->index();
    }else if($_GET['page'] == "ContactUs"){ // when get request send to contact us page
        require_once 'web/controllers/Contact_Us.php';
        $contact_us = new Contact_us();
        $contact_us->index();
    }else if($_GET['page'] == "NewArrivals"){ // when get request send to contact us page
        require_once 'web/controllers/New_arrivals.php';
        $new_arrivals = new New_arrivals();
        $new_arrivals->index();
    }else if($_GET['page'] == "InquireBook"){ // when get request send to inquire book page
        require_once 'web/controllers/Inquire_book.php';
        $inquire = new Inquire_book();
        $inquire->index();
    }else if($_GET['page'] == "SearchBook"){ // when get request send to search books page
        require_once 'web/controllers/Search_books.php';
        $search = new Search_books();
        $search->index();
    }else if($_GET['page'] == "View_book"){ // when get request send to search books page
        require_once 'web/controllers/Book_details.php';
        $search = new Book_details();
        $search->index();
    }else if($_GET['page'] == "FloorMap"){ // when get request send to search books page
        include('web/views/floor_map.php');
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