<?php 
header('Content-Type: application/json');
require '../database/db_connection.php';
$response = array();
$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
if(isset($_POST["role"])){
    $role = $_POST["role"];
    $sql = "UPDATE `users` SET `roles` = '".$role."',`name` = '".$name."',`email` = '".$email."'  WHERE `users`.`id`=".$id.";";
}else{
    $sql = "UPDATE `users` SET `name` = '".$name."',`email` = '".$email."'  WHERE `users`.`id`=".$id.";";
}


if($conn->query($sql)){
    $response["status"] = true;
    $response["message"] = "User Updated";
}else{  
    $response["status"] = false;
    $response["message"] = $conn->error;
}

echo(json_encode($response));


?>