<?php require "../layouts/header.php";?>
<?php require "../database/db_connection.php";?>
<?php
require "../pagination/pagination.php";
$byTitle = "`b`.`title`";
$byCategory = "`category_names`";
$byAuthor = "`user_name`";
$byDescription = "`description`";
$by = (isset($_GET["by"]) ? $_GET["by"] : "");

if(isset($_GET["search"])){
    $search = $_GET["search"];
}
if(!isset($_GET["sortTitle"])){
    $sortTitle = "ASC";
}else{
    if($_GET["sortTitle"] == "ASC"){
        $sortTitle = "DESC";
    }else{
        $sortTitle = "ASC";
    }
}
if(!isset($_GET["sortCategory"])){
    $sortCategory = "ASC";
}else{
    if($_GET["sortCategory"] == "ASC"){
        $sortCategory = "DESC";
    }else{
        $sortCategory = "ASC";
    }
}
if(!isset($_GET["sortAuthor"])){
    $sortAuthor = "ASC";
}else{
    if($_GET["sortAuthor"] == "ASC"){
        $sortAuthor = "DESC";
    }else{
        $sortAuthor = "ASC";
    }
}
if(!isset($_GET["sortDescription"])){
    $sortDescription = "ASC";
}else{
    if($_GET["sortDescription"] == "ASC"){
        $sortDescription = "DESC";
    }else{
        $sortDescription = "ASC";
    }
}


// For Num_rows
$sql = 'SELECT 
            b.id, b.title, b.description, b.content, u.id AS user_id,
            u.name AS user_name, 
            GROUP_CONCAT(DISTINCT c.cate_name ORDER BY c.id) AS category_names,
            GROUP_CONCAT(DISTINCT c.id ORDER BY c.id) AS category_ids 
        FROM 
            blogs b 
        JOIN 
            users u ON b.user_id = u.id 
        JOIN 
            blog_category bc ON b.id = bc.blog_id 
        JOIN 
            categories c ON bc.category_id = c.id 
        WHERE 
            b.deleted_at IS NULL ';
if (isset($_GET["search"])) {
    $sql .= "AND (b.title LIKE '%" . $_GET["search"] . "%' OR b.description LIKE '%" . $_GET["search"] . "%' OR b.content LIKE '%" . $_GET["search"] . "%' OR u.name LIKE '%" . $_GET["search"] . "%' OR c.cate_name LIKE '%" . $_GET["search"] . "%' )";
}
$sql .= ' GROUP BY b.id, b.title, b.description, b.content, u.id, u.name 
        ORDER BY ';
if (isset($_GET["sortTitle"])) {
    $sql .= isset($byTitle) ? $byTitle : 'b.title';
} elseif (isset($_GET["sortCategory"])) {
    $sql .= isset($byCategory) ? $byCategory : 'category_names';
} elseif (isset($_GET["sortAuthor"])) {
    $sql .= isset($byAuthor) ? $byAuthor : 'user_name';
} elseif (isset($_GET["sortDescription"])) {
    $sql .= isset($byDescription) ? $byDescription : 'b.description';
} else {
    $sql .= isset($byTitle) ? $byTitle : 'b.title';
}
$sql .= ' ';
if (isset($_GET["sortTitle"])) {
    $sql .= isset($sortTitle) ? $sortTitle : 'ASC';
} elseif (isset($_GET["sortCategory"])) {
    $sql .= isset($sortCategory) ? $sortCategory : 'ASC';
} elseif (isset($_GET["sortAuthor"])) {
    $sql .= isset($sortAuthor) ? $sortAuthor : 'ASC';
} elseif (isset($_GET["sortDescription"])) {
    $sql .= isset($sortDescription) ? $sortDescription : 'ASC';
} else {
    $sql .= isset($sortTitle) ? $sortTitle : 'ASC';
}
//end of // For Num_rows

//main query for fetching data
//1 =  Title
$title = 1;
//2 = Category
$category = 2;
//3 = Author
$author = 3;
//4 = Description
$description = 4;

$sql .= ' ;';
$result = $conn->query($sql);
$number_of_page = ceil($result->num_rows / $results_per_page);
$sql = 'SELECT 
        b.id, b.title, b.description, b.content, u.id AS user_id, u.name AS user_name,
        GROUP_CONCAT(DISTINCT c.cate_name ORDER BY c.id) AS category_names,
        GROUP_CONCAT(DISTINCT c.id ORDER BY c.id) AS category_ids
    FROM blogs b 
    JOIN users u ON b.user_id = u.id 
    JOIN blog_category bc ON b.id = bc.blog_id 
    JOIN categories c ON bc.category_id = c.id 
    WHERE b.deleted_at IS NULL ';
    if (isset($_GET["search"]) && empty($by)) {
        $sql .= "AND (b.title LIKE '%" . $_GET["search"] . "%' OR b.description LIKE '%" . $_GET["search"] . "%' OR b.content LIKE '%" . $_GET["search"] . "%' OR u.name LIKE '%" . $_GET["search"] . "%' OR c.cate_name LIKE '%" . $_GET["search"] . "%' )";
    } else {
        if ($by == $title) {
            $sql .= "AND b.title LIKE '%" . $_GET["search"] . "%'";
        } elseif ($by == $category) {
            $sql .= "AND c.cate_name LIKE '%" . $_GET["search"] . "%'";
        } elseif ($by == $author) {
            $sql .= "AND u.name LIKE '%" . $_GET["search"] . "%'";
        } elseif ($by == $description) {
            $sql .= "AND b.description LIKE '%" . $_GET["search"] . "%'";
        }
    }
    $sql .= ' GROUP BY b.id, b.title, b.description, b.content, u.id, u.name 
            ORDER BY ';
    if (isset($_GET["sortTitle"])) {
        $sql .= $byTitle . ' ' . $sortTitle;
    } elseif (isset($_GET["sortCategory"])) {
        $sql .= $byCategory . ' ' . $sortCategory;
    } elseif (isset($_GET["sortAuthor"])) {
        $sql .= $byAuthor . ' ' . $sortAuthor;
    } elseif (isset($_GET["sortDescription"])) {
        $sql .= $byDescription . ' ' . $sortDescription;
    } else {
        $sql .= $byTitle;
    }
    $sql .= ' LIMIT ' . $page_first_result . ',' . $results_per_page . ' ;';
$result = $conn->query($sql);
//end of // main query for fetching data
?>

    
    <table class="table">
        <form action="" method="get" id = "sortSearch">
            <div class="input-group-prepend ">
            <span class="input-group-text" id="inputGroup-sizing-default">Search by &nbsp
                <select class="custom-select custom-select-sm" name=by>
                <option ></option>
                <option value="1" <?=isset($_GET["by"]) ? ($_GET["by"] == $title ? "selected" : "") : ""?>>Title</option>
                <option value="2" <?=isset($_GET["by"]) ? ($_GET["by"] == $category ? "selected" : "") : ""?>>Category</option>
                <option value="3" <?=isset($_GET["by"]) ? ($_GET["by"] == $author ? "selected" : "") : ""?>>Author</option>
                <option value="4" <?=isset($_GET["by"]) ? ($_GET["by"] == $description ? "selected" : "") : ""?>>Description</option>
                </select>
            </span>
            <input class="form-control me-2" type="search" placeholder="Search" name="search" style="height: auto;" aria-label="Search" value=<?= isset($search) ? $search : "" ?>>
        </form>
    <thead>
        <tr>
            <th scope="col" class="text-center">
                <a class="btn btn-light d-flex justify-content-center <?= isset($_GET["sortTitle"]) ? "border border-2" : "" ?>" href="?sortTitle=<?=$sortTitle?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($page) ? "&page=".$page."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>" >Title </br><?= !isset($_GET["sortTitle"])  ? "↓↑" : ($_GET["sortTitle"] == "DESC" ? "↓" : "↑") ?> </a>
            </th>
            <th scope="col" class="text-center">
                <a class="btn btn-light d-flex justify-content-center <?= isset($_GET["sortCategory"]) ? "border border-2" : "" ?>" href="?sortCategory=<?=$sortCategory?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($page) ? "&page=".$page."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>">Category </br><?= !isset($_GET["sortCategory"])  ? "↓↑" : ($_GET["sortCategory"] == "DESC" ? "↓" : "↑") ?> </a>
            </th>
            <th scope="col" class="text-center">
                <a class="btn btn-light d-flex justify-content-center <?= isset($_GET["sortAuthor"]) ? "border border-2" : "" ?>" href="?sortAuthor=<?=$sortAuthor?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($page) ? "&page=".$page."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>">Author</br><?= !isset($_GET["sortAuthor"])  ? "↓↑" : ($_GET["sortAuthor"] == "DESC" ? "↓" : "↑") ?> </a>
            </th>
            <th scope="col" class="text-center">
                <a class="btn btn-light d-flex justify-content-center <?= isset($_GET["sortDescription"]) ? "border border-2" : "" ?>" href="?sortDescription=<?=$sortDescription?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($page) ? "&page=".$page."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>">Description </br><?= !isset($_GET["sortDescription"])  ? "↓↑" : ($_GET["sortDescription"] == "DESC" ? "↓" : "↑") ?></a></th>
            <th scope="col" class="text-center" ><a  class="btn btn-light d-flex justify-content-center">Action</br>&nbsp</a></th>
        </tr>
    </thead>
    <tbody>
        <?php if($result->num_rows>0):?>
            <?php while($data = $result->fetch_assoc()):?>
                <tr>
                    <th class ="<?=isset($_GET["sortTitle"]) ? "bg-light" : ""?>"><?=$data["title"]?></th>
                    <td class ="<?=isset($_GET["sortCategory"]) ? "bg-light" : ""?>"><?=$data["category_names"]?></td>
                    <td class ="<?=isset($_GET["sortAuthor"]) ? "bg-light" : ""?>"><?=$data["user_name"]?></td>
                    <td class ="<?=isset($_GET["sortDescription"]) ? "bg-light" : ""?>"><?= substr($data["description"],0,150)."....."?></td>
                    <td class="d-flex justify-content-center ">
                        <a href="show-post.php?post=<?= $data['id'] ?>" class="btn btn-outline-info me-2">View</a>
                        <a href="create-post.php?id=<?= $data['id'] ?>" class="btn btn-outline-primary me-2">Edit</a>
                        <a href="delete-post.php?id=<?= $data['id'] ?>" class="btn btn-outline-danger" onclick="return alertDelete(this)">Delete</a></td>
                </tr>
            <?php endwhile;?>
        <?php endif;?>
    </tbody>
</table>
<div class="col-md-12 text-center">
    <?php if($prevPage>0 && $number_of_page>2):?>
        <a href="?page=1<?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>" class="shadow shadow-3 m-2 btn btn-outline-dark"><<</a>
        <a href="?page=<?=$prevPage?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>" class="shadow shadow-3 m-2 btn btn-outline-dark"><</a>
    <?php endif;?>
    
    <?php for($i = $page-2 ;$i<=$page+2;$i++):?>
        <?php if($i == -1 || $i == 0){
            continue;
        }?>
        <a class="shadow shadow-3 m-2 btn <?= $page == $i ? "btn-dark" : "btn-outline-dark" ?>" href="?page=<?=$i?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>"><?=$i?></a>
        <?php if($i == $number_of_page){
            break;
        }?>
    <?php endfor;?>
        
        <?php if($nextPage<=$number_of_page && $number_of_page>2):?>   
            <a href="?page=<?=$nextPage?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>" class="shadow shadow-3 m-2 btn btn-outline-dark">></a>
            <a href="?page=<?=$number_of_page?><?= isset($search) ? "&search=".$search."" : ""  ?><?= isset($_GET["by"]) ? "&by=".$_GET["by"]."" : ""  ?>" class="shadow shadow-3 m-2 btn btn-outline-dark">>></a>
        <?php endif;?>
    </div>
</div>
<?php require "../layouts/footer.php";?>