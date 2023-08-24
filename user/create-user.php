<?php 
    header("Content-Type: application/json");
    require "../database/db_connection.php";
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    
    $sql = "SELECT * FROM users  WHERE email ='".$email."'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".$name."', '".$email."', '".$hashed_password."');";
        $response = array();
        if($conn->query($sql)){
        $response["status"] = true;
        $response["message"] = "User Added Succesfully";
        }else{
        $response["status"] = false;
        $response["message"] = "User Not Created";
        }
    }else{
        $response["status"] = false;
        $response["message"] = "User Already Exists";
    }

    

    echo(json_encode($response));
 
    

    
?>