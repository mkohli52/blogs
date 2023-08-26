<?php require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<div class="row justify-content-center p-3">
    <div class="col-md-10 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <h1>Categories</h1>
    </div>
    <div class="col-md-2 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="delete-check" onclick="isDeleteChecked(this);">
        <label class="form-check-label" for="delete-check">
            Delete Categories?
        </label>
        </div>
        <input class="form-check-input" type="checkbox" value="" id="edit-check" onclick="isEditChecked(this);">
        <label class="form-check-label" for="edit-check">
            Edit Categories?
        </label>
        
    </div>
    <a href="create-category.php" style="text-decoration:underline;">+ Add Category</a>
  </div>
<?php
    function ShowCategories($id) {
        $sql = "SELECT * FROM categories WHERE sub_cate_id=" . $id." AND deleted_at IS NULL";
        $result = $GLOBALS["conn"]->query($sql);
        $output = "<ul class='list-group'>";
        
        while ($data = $result->fetch_assoc()) {
            $sql2 = "SELECT b.id AS blog_id, b.title AS blog_title, c.id AS category_id, c.cate_name AS category_name, c.user_id AS user_id FROM blogs b  JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE c.id=" . $data["id"] . " AND b.deleted_at IS NULL ;";
    
            $output .= "<li class='list-group-item'>
                            <div class='row'>
                            <a href='#category-" . $data["id"] . "' class='collapsed btn btn-secondary d-flex align-items-end ' style='text-decoration:none;' data-bs-toggle='collapse'>
                                " . $data["cate_name"] . "
                            </a>
                            <a href='show-category-posts.php?id=".$data["id"]."' class='text-start'>Go to ".$data["cate_name"]." Category<a/>";
            if($GLOBALS['auth']->role() !=1 || $GLOBALS['auth']->id() == $data["user_id"]){
                            $output.= "<div class='row d-flex justify-content-end me-2'>
                            
                            <a href='delete-category.php?id=".$data["id"]."' id='category-delete' class=' mt-2 category-delete  btn  btn-outline-danger align-items-end' style='width:max-content; display:none' onClick='return alertDelete(this)'><i class='fa fa-trash'></i>Delete Category</a>
                            
                            
                            <a href='create-category.php?id=".$data["id"]."' id='category-delete' class=' ms-2 mt-2 category-edit  btn  btn-outline-info align-items-end' style='width:max-content; display:none'><i class='fa fa-pen'></i>Edit Category</a>
                            
                            </div>";
            }               
            $output.= "</div>
                            <div id='category-" . $data["id"] . "' class='collapse'>
                                <ul class='list-group'>";
    
            $result2 = $GLOBALS["conn"]->query($sql2);
            while ($data2 = $result2->fetch_assoc()) {
                $output .= "<li class='list-group-item'>
                                <a href='../posts/show-post.php?post=" . $data2["blog_id"] . "'>
                                    " . $data2["blog_title"] . "
                                </a>
                            </li>";
            }
    
            // Recursive call for sub-categories
            $output .= ShowCategories($data["id"]) . "</ul>
                      </div>
                  </li>";
        }
    
        $output .= "</ul>";
        return $output;
    }
    
    
    
    
    
    
?>
<?=ShowCategories(0)?>        
<?php require "../layouts/footer.php"?>