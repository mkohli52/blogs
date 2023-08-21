<?php session_start();
 require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<?php 
    $sql = "SELECT * FROM categories;";
    $result  = $conn->query($sql);
    
     if(isset($_SESSION['errors'])){
         $errors = $_SESSION['errors'];
         unset($_SESSION['errors']);
     }
?>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <h1>Create Post</h1>
    </div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-light p-5">
        <h2>Add Post</h2>
            <form action="add-post.php" method="post" onsubmit="return validateForm()" >
            <div class="form-floating mb-2">
                <input type="text" class="form-control border border-3 <?= isset($errors["title"]) ? "border-danger" : "" ?>" id="title" name="title" placeholder="Enter Post title" onkeyup="validateTitle(this)">
                <label for="title">Title</label>
                <p class="error-title text-danger" id="error-title" style="display:<?= isset($errors["title"]) ? "block" : "none" ?>;">Title can't be empty!</p>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control border border-3 <?= isset($errors["description"]) ? "border-danger" : "" ?> " placeholder="Enter Description" id="description" name="description" style="height: 100px" onkeyup="validateDescription(this)"></textarea>
                <label for="description">Description</label>
                <p class="error-description text-danger" id="error-description" style="display:<?= isset($errors["description"]) ? "block" : "none" ?>;">Description can't be empty!</p>
            </div>
            <label for="content">Content:</label>
            <div class="form-floating mb-2 border border-3 rounded <?= isset($errors["content"]) ? "border-danger" : "" ?>" id="editor-div">
                <textarea class="form-control border border-3" id="editor" name="content" style="height: 300px" onkeyup="validateContent(this)"></textarea>
            </div>
            <?php if(isset($errors["content"])):?>
                <p class="error-content text-danger" id="error-content" style="display:block;"><?= $errors["content"]?></p>
            <?php endif;?>    
            
                Select Category:
                <div class="form-group p-4 border border-3 rounded <?= isset($errors["category"]) ? "border-danger" : "" ?>" id="category-div">
                <?php if($result->num_rows>0):?>
                    <?php while($data = $result->fetch_assoc()):?>
                            <input class="form-check-input " type="checkbox" name="cate_id[]" value="<?= $data["id"]?>">
                            <label class="form-check-label me-5" for="cate_id[]"><?=$data["cate_name"]?></label>
                    <?php endwhile;?>
                <?php endif;?>                
                    </div>
                        <?php if(isset($errors["category"])):?>
                            <p class="error-category text-danger" id="error-category"><?= $errors["category"]?></p>
                        <?php endif;?>    
                <button type="submit" class="btn btn-primary mt-3">Add Post</button>
            </form>
        </div>
  </div>
<?php require "../layouts/footer.php"?>

