<?php require '../layouts/header.php';
require '../database/db_connection.php';
?>

<?php
$sql = 'SELECT * FROM blogs Where id=' . $_GET['post'] . ' AND  deleted_at IS NULL';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
}else{
    echo '<script>window.location.href = "../categories/show-categories.php?pnf=true";</script>';
}
?>
<?php if($auth->role()!= 1 || $auth->id() == $data["user_id"]): ?>
<div class="row p-2">
    <div class="col-md-6 d-flex justify-content-start">
        <a href="create-post.php?id=<?= $data[
            'id'
        ] ?>" class="btn btn-outline-warning">Edit</a>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <a href="delete-post.php?id=<?= $data[
            'id'
        ] ?>" class="btn btn-outline-danger" onclick="return alertDelete(this)">Delete</a>
    </div>
</div>
<?php endif; ?>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-1 mt-3 mb-2 text-center">
        <h1><?= isset($data['title']) ? $data["title"] : "Blog Not Found!" ?></h1>
    </div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-secondary p-5">
        <h2>Description:</h2>
        <p><?= isset($data['description']) ? $data["description"] : "Blog Not Found!" ?></p>
        <h2>Content:</h2>
            <?= isset($data['content']) ? $data["content"] : "Blog Not Found!" ?>
        </div>
  </div>


<?php require '../layouts/footer.php'; ?>
