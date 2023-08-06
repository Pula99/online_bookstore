<?php

class Register_m{
//-----------------------------------------------------------
// for registration
    public function register_user(){
        //databae connection
        require('config/db_config.php');

        //validations
        $errors = "";
        if(empty($_POST['first_name'])){
            $errors .= "First name is required.\n";
        }

        if(empty($_POST['last_name'])){
            $errors .= "Last name is required.\n";
        }

        if(empty($_POST['email'])){
            $errors .= "Email is required.\n";
        }

        if(empty($_POST['password1']) || empty($_POST['password2'])){
            $errors .= "Password is required.\n";
        }

        if($_POST['password1'] !== $_POST['password2']){
            $errors .= "Passwords do not match.\n";
        }

        $email = $con->real_escape_string($_POST['email']);
        $check_email_query = "SELECT COUNT(*) AS count FROM bookstore_user WHERE email = '$email'";
        $result = $con->query($check_email_query);
        $row = $result->fetch_assoc();
        if($row["count"] > 0){
            $errors .= "Email already exits.\n";
        }

        //when error occurs
        if(!empty($errors)){
            return array("status" => "error", "msg" => $errors);
        }else{
            //insert
            $first_name = $con->real_escape_string($_POST['first_name']);
            $last_name = $con->real_escape_string($_POST['last_name']);
            $address = $con->real_escape_string($_POST['address']);
            $email = $con->real_escape_string($_POST['email']);
            $password = $con->real_escape_string($_POST['password1']);
            $user_type = "customer";

            $sql = "INSERT INTO bookstore_user (first_name, last_name, address, email, password, user_type) 
                    VALUES ('$first_name', '$last_name', '$address', '$email', '$password', '$user_type')";

            if($con->query($sql) === TRUE){
                return array("status" => "success", "msg" => "Registered successfully.");
            }else{
                return array("status" => "error", "msg" => "Registration failed.");
            }

            $con->close();
        }
    }
//-----------------------------------------------------------
}

?>