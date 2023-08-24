<?php 
    header("Content-Type: application/json");
    require "../database/db_connection.php";
    $email = $_POST["email"];
    $password = $_POST["password"];
    $response = array();
    $sql = "SELECT * FROM users  WHERE email ='".$email."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $verify = password_verify($password, $data["password"]);
        if($verify){
            $response["status"] = true;
            $response["message"] = "User Logged In Succesfully";
            session_start();
            $_SESSION["login"] = true;
        }else{
            
            $response["status"] = false;
            $response["message"] = "Wrong email id or password";
        }
    }else{
        $response["status"] = false;
        $response["message"] = "Wrong email id or password";
    }
    
    
    
    
    echo(json_encode($response));
 
    

    
?>