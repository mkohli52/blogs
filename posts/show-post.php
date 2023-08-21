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
<div class="row justify-content-center">
    <div class="col-md-6 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-dark p-1 mt-2 mb-2 text-center">
        <h1><?= $data["title"]?></h1>
    </div>
  </div>
  <div class="row justify-content-center ">
    <div class="col-md-6 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-dark p-5">
        <h2>Description:</h2>
        <p><?=$data["description"]?></p>
        <h2>Content:</h2>
            <?=$data["content"]?>
        </div>
  </div>


<?php require "../layouts/footer.php"?>