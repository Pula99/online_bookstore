<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="admin/assets/css/dash.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" style="width: 100%; object-fit: cover; object-position: center; border-radius: 50%;" alt="Logo">
        </div>
        <div class="greeting">
            Hi, <?=$_SESSION["first_name"]?>
        </div>
    </header>
    <div class="main-container">
        <div class="category" onclick="window.location.href='/online_bookstore?page=Add_books'">
            <i class="fas fa-plus-circle"></i>
            <p>Add Books</p>
        </div>
        <div class="category" onclick="window.location.href='/online_bookstore?page=View_books'">
            <i class="fas fa-book-open"></i>
            <p>View Books</p>
        </div>
        <div class="category" onclick="window.location.href='/online_bookstore?page=View_inquiries'">
            <i class="fas fa-envelope-open-text"></i>
            <p>View Inquiries</p>
        </div>
    </div>
    <footer>
        <button class="logout-btn" onclick="window.location.href = '/online_bookstore?page=Logout'">Logout</button>
    </footer>
</body>
</html>
