<?php

require '../database/db_connection.php';

$sql = 'UPDATE `blogs` SET `deleted_at` = CURRENT_TIMESTAMP WHERE `id` ='.$_GET["id"].'';
if ($conn->query($sql)) {
    header('Location: ../categories/show-categories.php');
} else {
    echo 'Wrong Query';
}

?>
