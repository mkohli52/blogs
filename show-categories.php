<?php include("header.php")?>
<?php
    $conn = require "db_connection.php";
    function ShowCategories($id){
        $sql = "SELECT * FROM categories WHERE sub_cate_id=".$id;
        $result = $GLOBALS["conn"]->query($sql);
        $output = "<div class='accordion' id='accordionPanelsStayOpenExample'> \n";

            while($data = $result->fetch_assoc()) {
                $output.="<div class='accordion-item'><h2 class='accordion-header border border-2' id='panelsStayOpen-heading".$data["id"]."'><button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#panelsStayOpen-collapse".$data["id"]."' aria-expanded='true' aria-controls='panelsStayOpen-collapse".$data["id"]."'>".$data["cate_name"]."</button></h2></div><div id='panelsStayOpen-collapse".$data["id"]."' class='accordion-collapse collapse show' aria-labelledby='panelsStayOpen-heading".$data["id"]."'>
            <div class='accordion-body'>";
                $output.= ShowCategories($data["id"]);
                $output.="</div></div>";
            }
        $output.="</div>";
        return $output;
    }

?>

    <?=ShowCategories(0)?>
<?php include ("footer.php")?>


