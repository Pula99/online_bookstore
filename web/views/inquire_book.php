<?php
    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = "";
    $fname = $lname = $email = $bookname = $comment = "";

	if(isset($_POST['submit'])){
        if (empty($_POST["fname"])) {
            $fnameErr = "First name is required!!";
        } else {
            $fname = test_input($_POST["fname"]);
        }
        
        if (empty($_POST["lname"])) {
            $lnameErr = "Last name is required!!";
        } else {
            $lname = test_input($_POST["lname"]);
        }  
        
        if (empty($_POST["email"])) {
            $emailErr = "Email is required!!";
        } else {
            $email = test_input($_POST["email"]);
        }
        
        if (empty($_POST["bookname"])) {
            $bookname = "";
        } else {
            $bookname = test_input($_POST["bookname"]);
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if($fnameErr != "" || $lnameErr != "" || $emailErr != ""){
            //there are errors
        }else{
            require('web/config/db_config.php');
            
            $sql = "INSERT INTO inquiry(fname,lname,email,bookname,comment) values('$fname', '$lname', '$email', '$bookname', '$comment')";
            $insert_result = mysqli_query($con,$sql);
            if($insert_result){
                echo "<script>
                        alert('Inquiry sent successfully!!');
                        window.location.href = '?page=Home';
                    </script>";
            }else{
                echo "<script>
                        alert('Something went wrong!!');
                    </script>";
            }

        }
	}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Store</title>

    <style>
        .error { 
            color: #FF0000;
        }
        
        form {
            border: 3px solid #f1f1f1;
            min-width: 500px;
            padding: 20px;
        }
        
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        input[type=text], input[type=email], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        
        input[type=submit] {
            width: 100%;	
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        input[type=submit]:hover {
            background-color: #45a049;
        }
        
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 10px;
        }
        
        .column {
            float: left;
            width: 50%;
            margin-top: 6px;
            padding: 20px;
        }
        
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        
        @media screen and (max-width: 600px) {
            .column, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }

        .wrapper{
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        a{
            color: #00AA91;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 align="center">Inquire Books</h2>
        <form method="post" action="?page=InquireBook">
            <h4>First Name:</h4> 
            <input type="text" name="fname" required>
            <span class="error"><?php echo $fnameErr;?></span>
            <br><br>
            
            <h4>Last Name:</h4> 
            <input type="text" name="lname" required>
            <span class="error"><?php echo $lnameErr;?></span>
            <br><br>

            <h4>E-mail:</h4> 
            <input type="email" name="email" required>
            <span class="error"><?php echo $emailErr;?></span>
            <br><br>

            <h4>Book Name:</h4> 
            <input type="text" name="bookname">
            <br><br>

            <h4>Comment:</h4>
            <textarea name="comment" rows="5" cols="40"></textarea>
            <br><br>
            <input type="submit" name="submit" value="Submit">  
            <br><br>
            <p style="text-align: center;"><a href="?page=Home">Go to the homepage</a></p>
        </form>
    </div>

</body>
</html>