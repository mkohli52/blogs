<?php require "db_connection.php"; ?>
<?php
    $conn = require "db_connection.php";
    $sql = "SELECT * FROM `categories`";
    $result = $conn->query( $sql );
?>
<?php include("header.php")?>
<body>
<form action="add-category.php" method="post">
    <label for="cate_name">Category Name:</label><input type="text" name="cate_name" id="cate_name">
    <label for="sub_cate_id">Sub Category Name:</label><select name="sub_cate_id" id="sub_cate_id">
        <option value="0">None</option>
        <?php if($result->num_rows > 0): ?>
            <?php while($data = $result->fetch_assoc()): ?>
                <option value="<?= $data["id"] ?>"><?= $data["cate_name"] ?></option>
            <?php endwhile;?>
        <?php endif;?>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
<?php include("footer.php"); ?>




