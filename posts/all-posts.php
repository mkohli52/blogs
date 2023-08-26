<?php require '../layouts/header.php'; ?>
<?php
require '../database/db_connection.php';
require '../pagination/pagination.php';
//SQL FOR PAGINATION
$sql =
    'SELECT b.id, b.title, b.description, b.content, u.id AS user_id, u.name AS user_name, GROUP_CONCAT(DISTINCT c.cate_name ORDER BY c.id) AS category_names, GROUP_CONCAT(DISTINCT c.id ORDER BY c.id) AS category_ids FROM blogs b JOIN users u ON b.user_id = u.id JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE b.deleted_at IS NULL GROUP BY b.id, b.title, b.description, b.content, u.id, u.name';
$result = $conn->query($sql)->num_rows;
$number_of_page = ceil($result / $results_per_page);

//SQL FOR PAGINATION
?>
<?php
$sql =
    'SELECT b.id, b.title, b.description, b.content, u.id AS user_id, u.name AS user_name, GROUP_CONCAT(DISTINCT c.cate_name ORDER BY c.id) AS category_names, GROUP_CONCAT(DISTINCT c.id ORDER BY c.id) AS category_ids FROM blogs b JOIN users u ON b.user_id = u.id JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id WHERE b.deleted_at IS NULL GROUP BY b.id, b.title, b.description, b.content, u.id, u.name LIMIT ' .
    $page_first_result .
    ',' .
    $results_per_page;
$result = $conn->query($sql);
?>
<form action="" method="GET" id="search-form">
            <div class="input-group mb-3 p-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Search by &nbsp
                <select class="custom-select custom-select-sm" name=by>
                    <option value="1">Users</option>
                    <option value="2">Categories</option>
                </select>
                </span>
            </div>
            <input type="text" class="form-control" aria-label="Default" name="query" style="height: auto;" aria-describedby="inputGroup-sizing-default">
            </div>
        </form> 
    <?php require '../pagination/pagination-layout.php'; ?>
   <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
            <h1 class="text-center">All Posts</h1>
        </div>  
    </div>
   <?php if ($result->num_rows > 0): ?>
    <?php while ($data = $result->fetch_assoc()): ?>
           
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
            <h1 class="text-start"><a href="show-post.php?post=<?= $data[
                'id'
            ] ?>"><?= $data['title'] ?></a></h1>
        </div>
        <div class="col-md-6 text-start ">
            Category:
            <?php
            $sqlCategory =
                'SELECT b.id,c.cate_name,c.id as category_id FROM blogs b JOIN blog_category bc ON b.id = bc.blog_id JOIN categories c ON bc.category_id = c.id JOIN users u ON b.user_id = u.id WHERE b.id = ' .
                $data['id'] .
                ' AND b.deleted_at IS NULL';
            $resultCategory = $conn->query($sqlCategory);
            ?>
            <?php if ($resultCategory->num_rows > 0): ?>
                <?php while ($dataCategory = $resultCategory->fetch_assoc()): ?>
            <a href="../categories/show-category-posts.php?id=<?= $dataCategory[
                'category_id'
            ] ?>" class="text-end"><?= $dataCategory['cate_name'] ?></a>,
                 <?php endwhile; ?>
            <?php endif; ?>        
        </div>
        <div class="col-md-6 text-end ">
        Author:<a href="../posts/user-all-posts.php?id=<?= $data[
            'user_id'
        ] ?>" class="text-end"> <?= $data['user_name'] ?></a>
        </div>
    </div>
    
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-5">
            <h2>Description:</h2>
            <p><?= $data['description'] ?></p>
        </div>
    </div>
    <?php endwhile; ?>

<?php endif; ?>


<?php require '../layouts/footer.php'; ?>
