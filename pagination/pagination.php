<?php if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}
$prevPage = $page-1;
$nextPage = $page+1;
$results_per_page = 3;  
$page_first_result = ($page-1) * $results_per_page;

?>