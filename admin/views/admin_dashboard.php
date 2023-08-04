<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007B73;
            padding: 10px;
            color: #fff;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-left: 20px;
        }

        .greeting {
            font-size: 20px;
            margin-right: 20px;
        }

        .main-container {
            display: flex;
            justify-content: center;
            padding: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .category {
            width: 240px;
            height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .category:hover {
            transform: scale(1.05);
        }

        .category i {
            font-size: 36px;
            margin-bottom: 10px;
            color: #007B73;
        }

        footer {
            display: flex;
            justify-content: flex-end;
            background-color: #007B73;
            padding: 10px;
            color: #fff;
            margin-top: auto;
        }

        .logout-btn {
            background-color: #fff;
            color: #007B73;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #007B73;
            color: #fff;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="path_to_your_logo.png" alt="Logo">
        </div>
        <div class="greeting">
            Hi, [Name] <!-- Replace [Name] with the user's name -->
        </div>
    </header>
    <div class="main-container">
        <div class="category">
            <i class="fas fa-plus-circle"></i>
            <p>Add Books</p>
        </div>
        <div class="category">
            <i class="fas fa-book-open"></i>
            <p>View Books</p>
        </div>
        <div class="category">
            <i class="fas fa-envelope-open-text"></i>
            <p>View Inquiries</p>
        </div>
    </div>
    <footer>
        <button class="logout-btn">Logout</button>
    </footer>
</body>
</html>
