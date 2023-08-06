<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    } 
?>

<nav>
    <div class="logo">
        <img src="images/logo.png">
    </div>
    <ul>
        <li><a href="?page=Home">Home</a></li>
        <li><a href="?page=BookDeals">Book Deals</a></li>
        <li><a href="?page=BookCatalogue">Book Catalogue</a></li>
        <li><a href="?page=InquireBook">Inquire Book</a></li>
        <li><a href="?page=SearchBook">Search Books</a></li>
        <li><a href="?page=ContactUs">Contact Us</a></li>
        <?php if(!isset($_SESSION["user_id"])){ ?>
            <li><a href="?page=Register">Register</a></li>
        <?php }else{ ?>
            <li><a href="?page=Logout">Logout</a></li>
        <?php } ?>
    </ul>
</nav>