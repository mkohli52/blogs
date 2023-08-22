<?php require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<div class="row justify-content-center p-3">
    <div class="col-md-10 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <h1>Categories</h1>
    </div>
    <div class="col-md-2 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-3 mb-3 text-center">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="delete-check" onclick="isDeleteChecked(this);">
        <label class="form-check-label" for="delete-check">
            delete categories?
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="delete-check" onclick="isEditChecked(this);">
        <label class="form-check-label" for="delete-check">
            edit categories?
        </label>
        </div>
    </div>
  </div>
<?php
    function ShowCategories($id) {
        $sql = "SELECT * FROM categories WHERE sub_cate_id=" . $id;
        $result = $GLOBALS["conn"]->query($sql);
        $output = "<ul class='list-group'>";
        
        while ($data = $result->fetch_assoc()) {
            $sql2 = "SELECT b.id AS blog_id, b.title AS blog_title, c.id AS category_id, c.cate_name AS category_name FROM blogs b JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE c.id=" . $data["id"] . ";";
    
            $output .= "<li class='list-group-item'>
                            <div class='row'>
                            <a href='#category-" . $data["id"] . "' class='collapsed btn btn-secondary d-flex align-items-end ' style='text-decoration:none;' data-bs-toggle='collapse'>
                                " . $data["cate_name"] . "
                            </a>
                            <a href='delete-category.php?id=".$data["id"]."' id='category-delete' class=' category-delete  btn  btn-danger align-items-end' style='display:none'><i class='fa fa-trash'></i></a>
                            <a href='create-category.php?id=".$data["id"]."' id='category-delete' class=' category-edit  btn  btn-info align-items-end' style='display:none'><i class='fa fa-pen'></i></a>
                            </div>
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