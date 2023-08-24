<?php require "../layouts/header.php" ?>
<?php require "../database/db_connection.php" ?>
<?php $sql = "SELECT cate_name FROM categories WHERE id =".$_GET["id"].";";
    $result = $conn->query($sql);
    $category_data = $result->fetch_assoc();
    $sql = "SELECT blog_id FROM blog_category WHERE category_id=".$_GET["id"].";";
    $result = $conn->query($sql);
?>
<div class="row p-2">
    <div class="col-md-6 d-flex justify-content-start">
        <a href="show-categories.php" class="btn btn-outline-info">All categories</a>
    </div>
</div>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
        <h5>Category</h5>
        <h1><?= $category_data["cate_name"]?></h1>
    </div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-3">
        <h1 class="text-center">Posts</h1>
        <?php if($result->num_rows == 0): ?>
            <h2>No Posts Available!</h2>
            <h2>Available Sub categories:</h2>
            <?php 
                
                function ShowCategories($cate_id) {
                    
                    $sql = "SELECT * FROM categories WHERE sub_cate_id=" . $cate_id;
                    $cate_result = $GLOBALS["conn"]->query($sql);
                    $output = "<ul class='list-group'>";
                    
                    while ($data = $cate_result->fetch_assoc()) {
                        $sql2 = "SELECT b.id AS blog_id, b.title AS blog_title, c.id AS category_id, c.cate_name AS category_name FROM blogs b JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE c.id=" . $data["id"] . ";";
                
                        $output .= "<li class='list-group-item'>
                                        <div class='row'>
                                        <a href='#category-" . $data["id"] . "' class='collapsed btn btn-secondary d-flex align-items-end ' style='text-decoration:none;' data-bs-toggle='collapse'>
                                            " . $data["cate_name"] . "
                                        </a>
                                        <a href='show-category-posts.php?id=".$data["id"]."' class='d-flex justify-content-end'>Go to ".$data["cate_name"]." Category<a/>
                                        
                                        <div class='row d-flex justify-content-end me-2'>
                                        
                                        <a href='delete-category.php?id=".$data["id"]."' id='category-delete' class=' mt-2 category-delete  btn  btn-outline-danger align-items-end' style='width:max-content; display:none' onClick='return alertDelete(this)'><i class='fa fa-trash'></i>Delete Category</a>
                                        
                                        
                                        <a href='create-category.php?id=".$data["id"]."' id='category-delete' class=' ms-2 mt-2 category-edit  btn  btn-outline-info align-items-end' style='width:max-content; display:none'><i class='fa fa-pen'></i>Edit Category</a>
                                        
                                        </div>
                                        
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
                <?=ShowCategories($_GET["id"]);?>
        <?php endif;?>    
  <?php while($blog_id = $result->fetch_assoc()):?>
    <?php $sql = "SELECT * FROM blogs WHERE id=".$blog_id["blog_id"].";";
        $blogs_result = $conn->query($sql);
        $blogs_data = $blogs_result->fetch_assoc();
    ?>
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
            <h1 class="text-start"><?= $blogs_data['title']?></h1>
        </div>
    </div>
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-5">
            <h2>Description:</h2>
            <p><?=$blogs_data["description"]?></p>
            <h2>Content:</h2>
            <?=$blogs_data["content"]?>
        </div>
    </div>
    <?php endwhile;?>
  </div>

<?php require "../layouts/footer.php" ?>