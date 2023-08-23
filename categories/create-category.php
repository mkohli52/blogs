<?php
session_start(); 
require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<?php 
    if(isset($_GET["id"])){
        $sql =  "SELECT * FROM categories WHERE id =".$_GET["id"].";"; 
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        
    }

        $sql2 = "SELECT * FROM categories;";
        $result = $conn->query($sql2);
        
    
    
    if(isset($_SESSION["errors"])){
        $errors =  $_SESSION["errors"];
        unset($_SESSION["errors"]);
    }    
?>

  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-light p-2 mt-2 mb-2 text-center">
        <h1><?= isset($_GET["id"]) ? "Edit Category" : "Create Category" ?></h1>
    </div>
  </div>
  <div class="row justify-content-center p-3 ">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-light p-5">
        
        <h2><?= isset($_GET["id"]) ? "Edit Category" : "Add Category" ?></h2>
            <form action="add-category.php" id="create-category" method="post">
            <?php if( isset( $_GET["id"] ) ): ?>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id:</label>
                            <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" value='<?=$data[ "id" ]?>' readonly>
                        </div>
                        <?php endif; ?>   
                
                <div class="form-group">
                    <label for="cate_name">Category Name:</label>
                    <input type="text" class="form-control border border-3 rounded" placeholder="Category Name" id="cate_name" name="cate_name" value='<?= isset($data["cate_name"]) ? $data["cate_name"] : "" ?>' onkeyup="validateCategoryName(this)" >
                </div>
                    <p class="error-category text-danger mt-0" id="error-category" style="display:<?= isset($errors["category"]) ? "block" : "none" ?>"><?= isset($errors["category"]) ? $errors["category"] : "Please Enter a Category" ?></p>
                Sub Category
                <div class="form-group">   
                <select class="form-select" aria-label="Default select example" name="sub_cate_id">
                <option value="0">None</option>
                <?php if($result->num_rows>0):?>
                        <?php while( $category = $result->fetch_assoc()):?>
                            <?php if(isset($_GET["id"])):?>
                                <?php if($_GET["id"] !=$category["id"] ):?>
                                    <option value="<?=$category["id"] ?>"><?=$category["cate_name"] ?></option>
                                <?php endif;?>
                            <?php else:?>
                                <option value="<?=$category["id"] ?>"><?=$category["cate_name"] ?></option>    
                            <?php endif;?>
                            
                        <?php endwhile;?>
                <?php endif;?>
                </select>
                        
                </div>
                <?php if(isset($errors["sub-category"])):?>
                    <p class="error-category text-danger" id="error-sub-category"><?= $errors["sub-category"]?></p>
                <?php endif;?> 
                
                <button type="submit" class="btn btn-primary mt-3"><?= isset($_GET["id"]) ? "Edit Category" : "Add Category" ?></button>
            </form>
        </div>
  </div>
<?php require "../layouts/footer.php"?>