<?php
    require "../database/db_connection.php";
    $cate_name = $_POST[ 'cate_name' ]; 
    $sub_id = $_POST[ 'sub_cate_id' ];
    $errors = array();
    
    if(empty($cate_name)){
        $errors["category"] = "Category Name Can't be empty";
    }
    if($sub_id<0){
        $errors["sub-category"] = "Either Select a Sub Category or keep it to none";
    }

    if(count($errors) == 0){
        $sql = "INSERT INTO `categories` (`sub_cate_id`, `cate_name`) VALUES (".$sub_id.", '".$cate_name."');";
        if ( $conn->query( $sql ) === TRUE ) {
            
            header("Location: show-categories.php");
        }
        
    }else{
            session_start();
            $_SESSION["errors"] = $errors;
            header("Location: create-category.php");
    }
    

    
    
    
    
?>


 

