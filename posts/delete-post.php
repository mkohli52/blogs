<?php 

   require "../database/db_connection.php";

   $sql = "DELETE FROM `blogs` WHERE `blogs`.`id` =".$_GET["id"].";";
   if($conn->query($sql)){
    header("Location: ../categories/show-category.php");
   }else{
    echo "Wrong Query";
   }




?>