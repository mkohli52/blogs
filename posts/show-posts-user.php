<?php require "../layouts/header.php"; ?>
<?php require "../database/db_connection.php";?>
<?php

$sql =
        'SELECT * FROM blogs WHERE user_id=' .
        $auth->id().
        ' AND deleted_at IS NULL;';
$result = $conn->query($sql);

?>
<div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
            <h1 class="text-center">My Posts</h1>
        </div>
    </div>
<?php if($result->num_rows>0 ):?>
    <?php while($data = $result->fetch_assoc()):?>
        
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
            <h1 class="text-start"><a href="show-post.php?post=<?= $data["id"]?>"><?= $data['title'] ?></a></h1>
        </div>
    </div>
    <div class="row justify-content-center p-3">
        <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-5">
            <h2>Description:</h2>
            <p><?= $data['description'] ?></p>
        </div>
    </div>
    <?php endwhile;?>

<?php endif;?>





<?php require "../layouts/footer.php"; ?>