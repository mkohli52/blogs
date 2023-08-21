<?php require "../layouts/header.php";?>
<?php require "../database/db_connection.php"; ?>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <h1>Categories</h1>
    </div>
  </div>
<?php
    function ShowCategories($id){
        $sql = "SELECT * FROM categories WHERE sub_cate_id=".$id;
        $result = $GLOBALS["conn"]->query($sql);
        $output = "<div class='accordion' id='accordionPanelsStayOpenExample'> \n";
        
            while($data = $result->fetch_assoc()) {
                $sql2 = "SELECT b.id AS blog_id, b.title AS blog_title, c.id AS category_id, c.cate_name AS category_name FROM blogs b JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE c.id=".$data["id"].";";

                $output.="<div class='accordion-item'><h2 class='accordion-header border border-2' id='panelsStayOpen-heading".$data["id"]."'><button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#panelsStayOpen-collapse".$data["id"]."' aria-expanded='true' aria-controls='panelsStayOpen-collapse".$data["id"]."'>".$data["cate_name"]."</button></h2></div><div id='panelsStayOpen-collapse".$data["id"]."' class='accordion-collapse collapse show' aria-labelledby='panelsStayOpen-heading".$data["id"]."'><div class='accordion-body'>";
                $result2 = $GLOBALS["conn"]->query($sql2);
                if($result2->num_rows>0){
                    while($data2 = $result2->fetch_assoc()){
                        $output.="<a href = '../posts/show-post.php?post=".$data2["blog_id"]."' class='link-opacity-75-hover' style='text-decoration:none;' >".$data2["blog_title"]."</a></br>";
                    }
                }

                
                $output.= ShowCategories($data["id"]);
                $output.="</div></div>";
            }
        $output.="</div>";
        return $output;
    }
    
?>
<?=ShowCategories(0)?>        
<?php require "../layouts/footer.php"?>