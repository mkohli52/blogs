<?php
require '../database/db_connection.php';
require_once "../auth/auth.php";
$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$auth = new Auth($_COOKIE["email"]);

$cateid;
if (isset($_POST['cate_id'])) {
    $cate_id = $_POST['cate_id'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

$errors = [];
if (empty($title)) {
    $errors['title'] = "Title Can't be Empty";
}
if (empty($description) || strlen($description) > 500) {
    $errors['description'] =
        "Description Can't be Empty and Length max 500 character allowed";
}

if (empty($content)) {
    $errors['content'] = "Content Can't be Empty";
}

if (empty($cate_id) && !isset($_POST['id'])) {
    $errors['category'] = 'Please select a category';
}
if (count($errors) == 0) {
    if (isset($_POST['id'])) {
        $stmt = $conn->prepare(
            'UPDATE `blogs` SET `description` = ? ,`title` = ? ,`content` = ? WHERE `blogs`.`id` = ?;'
        );
        $stmt->bind_param('sssi', $description, $title, $content, $id);
        if ($stmt->execute()) {
            header(
                'Location: ../posts/show-post.php?post=' .
                    $_POST['id'] .
                    '&success=true'
            );
        } else {
            echo 'Not Updated';
        }
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO blogs (title, description, content,user_id) VALUES (?,?,?,?)'
        );
        $stmt->bind_param('sssi', $title, $description, $content,$auth->id());
        $sql2 = 'SELECT * FROM blogs ORDER BY id DESC LIMIT 1';

        if ($stmt->execute()) {
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                $data2 = $result2->fetch_assoc();
                $blogId = $data2['id'];
                foreach ($cate_id as $id) {
                    $sql3 =
                        "INSERT INTO `blog_category` (`id`, `blog_id`, `category_id`) VALUES (NULL, '" .
                        $blogId .
                        "', '" .
                        $id .
                        "');";
                    if ($conn->query($sql3) == true) {
                        header(
                            'Location: ../categories/show-categories.php?success=true'
                        );
                    }
                }
            }
        } else {
            echo $conn->error;
        }
    }
} else {
    session_start();
    $_SESSION['errors'] = $errors;
    if (isset($_POST['id'])) {
        header('Location: create-post.php?id=' . $_POST['id']);
    } else {
        header('Location: create-post.php');
    }
}

?>
