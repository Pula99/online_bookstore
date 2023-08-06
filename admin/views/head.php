<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="admin/assets/css/menu.css">
    <link rel="stylesheet" href="admin/assets/css/booksect.css">
</head>
<body>
    <header id="myHeader">
        <div style="display: flex; align-items: center; flex-direction: row;">
            <div class="logo">
                <img src="images/logo.png" style="width: 100%; object-fit: cover; object-position: center; border-radius: 50%;" alt="Logo">
            </div>
            <p style="font-weight: bold; letter-spacing: 3px; font-size: 20px; margin-left: 20px;">BOOKSTORE</p>
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="greeting">
            Hi, <?=$_SESSION["first_name"]?>
        </div>
    </header>
    <div class="sidebar-container">
        <div class="sidebar-links">
            <!-- Links for the sidebar -->
            <a href="/online_bookstore?page=Dashboard" class="<?=(strtolower($_GET['page']) == "dashboard") ? 'link-active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/online_bookstore?page=Add_books" class="<?=(strtolower($_GET['page']) == "add_books") ? 'link-active' : '' ?>">
                <i class="fas fa-plus-circle"></i>
                <span>Add Books</span>
            </a>
            <a href="/online_bookstore?page=View_books" class="<?=(strtolower($_GET['page']) == "view_books") ? 'link-active' : '' ?>">
                <i class="fas fa-book-open"></i>
                <span>View Books</span>
            </a>
            <a href="/online_bookstore?page=View_inquiries" class="<?=(strtolower($_GET['page']) == "view_inquiries") ? 'link-active' : '' ?>">
                <i class="fas fa-envelope-open-text"></i>
                <span>View Inquiries</span>
            </a>
            <a href="/online_bookstore?page=Logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>