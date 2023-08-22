<?php require "../layouts/header.php";?>
<?php require "../database/db_connection.php"
?>    

<?php $sql =  "SELECT * FROM categories WHERE id =".$_GET["id"].";"; 
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    print_r($data);
?>
<?php require "../layouts/footer.php";?>