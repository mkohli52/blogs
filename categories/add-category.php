<?php
    require "../database/db_connection.php";
    $cate_name = $_POST[ 'cate_name' ]; 
    $sub_id = $_POST[ 'sub_cate_id' ];
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    $errors = array();
    
    if(empty($cate_name)){
        $errors["category"] = "Category Name Can't be empty";
    }
    if($sub_id<0){
        $errors["sub-category"] = "Either Select a Sub Category or keep it to none";
    }

    if(count($errors) == 0){
        if(isset($_POST["id"])){
            $sql = "UPDATE `categories` SET `cate_name` = '".$cate_name."', `sub_cate_id` = '".$sub_id."' WHERE `categories`.`id` = ".$id.";";
            
            if ( $conn->query( $sql ) === TRUE ) {
                
                header("Location: show-categories.php");
            }
        }else{

            $sql = "INSERT INTO `categories` (`sub_cate_id`, `cate_name`) VALUES (".$sub_id.", '".$cate_name."');";
            if ( $conn->query( $sql ) === TRUE ) {
                header("Location: show-categories.php?success=true");
            }
        }
        
    }else{
            
            session_start();
            $_SESSION["errors"] = $errors;
            if(isset($id)){
                header("Location: create-category.php?id=".$id);
            }else{

                header("Location: create-category.php");
            }
    }
    

    
    
    
    
?>


 

