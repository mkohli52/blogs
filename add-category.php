<?php
$conn =  require "db_connection.php";

$cate_name = $_POST["cate_name"];
$sub_cate_id = $_POST["sub_cate_id"];

$sql = "INSERT INTO `categories` (`sub_cate_id`, `cate_name`) VALUES (".$sub_cate_id.", '".$cate_name."');";

if($conn->query($sql)){
    header("Location: show-categories.php");
}

