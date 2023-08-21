<?php
    require "../database/db_connection.php";
    $title = $_POST["title"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $cateid;
    if(isset($_POST["cate_id"])){
        $cate_id = $_POST["cate_id"];
    };

    $errors = array();
    if(empty($title)){
        $errors["title"] = "Title Can't be Empty";
    }
    if(empty($description)){
        $errors["description"] = "Description Can't be Empty";
    }

    if(empty($content)){
        $errors["content"] = "Content Can't be Empty";
    }

    if(empty($cate_id)){
        $errors["category"] = "Please select a category";
    }
    if(count($errors)==0){
        $stmt = $conn->prepare("INSERT INTO blogs (title, description, content) VALUES (?,?,?)");
        $stmt->bind_param("sss", $title, $description, $content);
        $sql2 = "SELECT * FROM blogs ORDER BY id DESC LIMIT 1";
        
        if($stmt->execute()){
            $result2 = $conn->query($sql2);
            if($result2->num_rows>0){
                $data2 = $result2->fetch_assoc();
                $blogId = $data2["id"];
                foreach($cate_id as $id){
                    $sql3 = "INSERT INTO `blog_category` (`id`, `blog_id`, `category_id`) VALUES (NULL, '".$blogId."', '".$id."');";
                    if($conn->query($sql3) == TRUE){
                        header("Location: ../categories/show-categories.php");
                    }
                    
                }
            }    
               
        }else{
            echo($conn->error); 
        }
        
    }else{
        session_start();
        $_SESSION['errors'] = $errors;

        header("Location: create-post.php");
    }

    

        
    
    
    
    
?>