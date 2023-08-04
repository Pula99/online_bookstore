<?php

class Login_m{
//-----------------------------------------------------------
// for registration
    public function auth(){
        //databae connection
        require('config/db_config.php');

        //validations
        $errors = "";
        if(empty($_POST['email'])){
            $errors .= "Email is required.\n";
        }

        if(empty($_POST['password'])){
            $errors .= "Password is required.\n";
        }

        //when error occurs
        if(!empty($errors)){
            return array("status" => "error", "msg" => $errors);
        }else{
            //insert
            $email = $con->real_escape_string($_POST['email']);
            $password = $con->real_escape_string($_POST['password']);

            $sql = "SELECT * FROM bookstore_user WHERE email = '$email' AND password = '$password'";
            $result = $con->query($sql);

            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $row["first_name"];
                $_SESSION['last_name'] = $row["last_name"];
                $_SESSION['user_id'] = $row["user_id"];

                return array("status" => "success", "msg" => "Login success.");
            }else{
                return array("status" => "error", "msg" => "Invalid login credentials. Please try again.");
            }

            $con->close();
        }
    }
//-----------------------------------------------------------
}

?>