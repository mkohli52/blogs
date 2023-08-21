<?php
session_start(); 
require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<?php 
    
    $sql = "SELECT * FROM categories;";
    $result = $conn->query($sql);
    
    if(isset($_SESSION["errors"])){
        $errors =  $_SESSION["errors"];
        unset($_SESSION["errors"]);
    }    
?>

  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-dark p-2 mt-2 mb-2 text-center">
        <h1>Create Category</h1>
    </div>
  </div>
  <div class="row justify-content-center p-3 ">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-dark p-5">
        <h2>Add Category</h2>
            <form action="add-category.php" method="post">
                <div class="form-group">
                    <label for="cate_name">Category Name:</label>
                    <input type="text" class="form-control" id="cate_name" name="cate_name" >
                </div>
                <?php if(isset($errors["category"])):?>
                    <p class="error-category text-danger" id="error-category"><?= $errors["category"]?></p>
                <?php endif;?> 
                Sub Category
                <div class="form-group">   
                <select class="form-select" aria-label="Default select example" name="sub_cate_id">
                <option value="0">None</option>
                <?php if($result->num_rows>0):?>
                        <?php while( $category = $result->fetch_assoc()):?>
                            <option value="<?=$category["id"] ?>"><?=$category["cate_name"] ?></option>
                        <?php endwhile;?>
                <?php endif;?>
                </select>        
                </div>
                <?php if(isset($errors["sub-category"])):?>
                    <p class="error-category text-danger" id="error-sub-category"><?= $errors["sub-category"]?></p>
                <?php endif;?> 
                
                <button type="submit" class="btn btn-primary mt-3">Add Category</button>
            </form>
        </div>
  </div>
<?php require "../layouts/footer.php"?>