<?php require "../layouts/header.php";
    require "../database/db_connection.php";
?>

<?php
    $sql = "SELECT * FROM blogs Where id=".$_GET["post"].";";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        $data = $result->fetch_assoc();
        
    }



?>
<div class="row p-2">
    <div class="col-md-6 d-flex justify-content-start">
        <a href="create-post.php?id=<?= $data["id"]?>" class="btn btn-outline-warning">Edit</a>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <a href="delete-post.php?id=<?= $data["id"]?>" class="btn btn-outline-danger" onclick="return alertDelete(this)">Delete</a>
    </div>
</div>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
        <h1><?= $data["title"]?></h1>
    </div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-5">
        <h2>Description:</h2>
        <p><?=$data["description"]?></p>
        <h2>Content:</h2>
            <?=$data["content"]?>
        </div>
  </div>


<?php require "../layouts/footer.php"?>