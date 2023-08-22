
<?php 
require "../database/db_connection.php";
    $id = array();
    $id[] = $_GET["id"];
    deleteCategory($id);
    function deleteCategory($cateid) {
        foreach ($cateid as $newid) {
            $sql = "DELETE FROM categories WHERE id=" . $newid;
            $GLOBALS["conn"]->query($sql);
    
            $sqlSubCategories = "SELECT id FROM categories WHERE sub_cate_id=" . $newid;
            $result = $GLOBALS["conn"]->query($sqlSubCategories);
    
            if ($result->num_rows > 0) {
                $subCategoryIds = [];
                while ($data = $result->fetch_assoc()) {
                    $subCategoryIds[] = $data["id"];
                    
                }
                deleteCategory($subCategoryIds);
            }

        }

    }
    
    header("Location: show-categories.php");




    
?>
