<?php session_start();
require '../layouts/header.php';
?>
<?php require '../database/db_connection.php'; ?>
<?php
if (isset($_GET['id'])) {
    $sql = 'SELECT * FROM blogs WHERE id=' . $_GET['id'];
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
} else {
    $sql = 'SELECT * FROM categories WHERE deleted_at IS NULL;';
    $result = $conn->query($sql);
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?>
<div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 border-light rounded rounded-3 shadow shadow-3  p-1 mt-2 mb-2 text-center">
        <h1><?= isset($_GET['id']) ? 'Edit Post' : 'Create Post' ?></h1>
    </div>
  </div>
  <div class="row justify-content-center p-3">
    <div class="col-md-12 bg-white border border-2 rounded rounded-3 shadow shadow-3 border-light p-5">
        <h2><?= isset($_GET['id']) ? 'Edit Post' : 'Add Post' ?></h2>
            <form action="add-post.php" method="post" id="create-post" <?= isset(
                $_GET['id']
            )
                ? " onSubmit='return confirmEdit()'"
                : '' ?>  >
            <?php if (isset($_GET['id'])): ?>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id:</label>
                            <input type="number" class="form-control" id="id" name="id" aria-describedby="emailHelp" value='<?= $data[
                                'id'
                            ] ?>' readonly>
                        </div>
                        <?php endif; ?>
            <div class="form-floating mb-2">
                <input type="text" class="form-control border border-3 <?= isset(
                    $errors['title']
                )
                    ? 'border-danger'
                    : '' ?>" id="title" name="title" placeholder="Enter Post title" onkeyup="validateTitle(this)" value="<?= isset(
    $_GET['id']
)
    ? $data['title']
    : '' ?>">
                <label for="title">Title</label>
                <p class="error-title text-danger" id="error-title" style="display:<?= isset(
                    $errors['title']
                )
                    ? 'block'
                    : 'none' ?>;">Title can't be empty!</p>
            </div>
            <div class="form-floating mb-2">
                <textarea class="form-control border border-3 <?= isset(
                    $errors['description']
                )
                    ? 'border-danger'
                    : '' ?> " placeholder="Enter Description" id="description" name="description" style="height: 100px" onkeyup="validateDescription(this)" ><?= isset(
     $_GET['id']
 )
     ? $data['description']
     : '' ?></textarea>
                <label for="description">Description</label>
                <p class="error-description text-danger" id="error-description" style="display:<?= isset(
                    $errors['description']
                )
                    ? 'block'
                    : 'none' ?>;">Description can't be empty! and max 500 characters allowed </p>
            </div>
            <label for="content">Content:</label>
            <div class="form-floating mb-2 border border-3 rounded <?= isset(
                $errors['content']
            )
                ? 'border-danger'
                : '' ?>" id="editor-div">
                <textarea class="form-control border border-3" id="editor" name="content"  style="height: 300px" oninput="validateContent(this)"><?= isset(
                    $_GET['id']
                )
                    ? $data['content']
                    : '' ?></textarea>
            </div>
                <p class="error-content text-danger" id="error-content" style="display:<?= isset(
                    $errors['content']
                )
                    ? 'block'
                    : 'none' ?>">Content can't be empty!</p>
            <?php if (!isset($_GET['id'])): ?>

                <label >Select Category:</label>

                    <div class="form-group p-4 border border-3 rounded <?= isset(
                        $errors['category']
                    )
                        ? 'border-danger'
                        : '' ?>" id="category-div">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($data = $result->fetch_assoc()): ?>
                                <input class="form-check-input " type="checkbox" name="cate_id[]" value="<?= $data[
                                    'id'
                                ] ?>">
                                <label class="form-check-label me-5" for="cate_id[]"><?= $data[
                                    'cate_name'
                                ] ?></label>
                        <?php endwhile; ?>
                    <?php endif; ?> 
                    <a href="../categories/create-category.php"  style="text-decoration:none;">+Add Category</a>               
                        </div>
                            <?php if (isset($errors['category'])): ?>
                                <p class="error-category text-danger" id="error-category"><?= $errors[
                                    'category'
                                ] ?></p>
                            <?php endif; ?>
            <?php endif; ?>                    
                <button type="submit" class="btn btn-primary mt-3"><?= isset(
                    $_GET['id']
                )
                    ? 'Edit Post'
                    : 'Add Post' ?></button>
            </form>
        </div>
  </div>
<?php require '../layouts/footer.php'; ?>

