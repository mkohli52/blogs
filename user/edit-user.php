<?php require '../layouts/header.php'; ?>
<?php require '../database/db_connection.php'; ?>
<?php if ($auth->role() != 1 || $auth->id() == $_GET['id']) {
    $sql = 'SELECT * FROM users WHERE id=' . $_GET['id'] . ';';
    $result = $conn->query($sql)->fetch_assoc();
    if ($auth->role() != 3 && $result['roles'] == 3) {
        echo '<script>window.location.href = "../user/list-users.php?na=true";</script>';
    } else {
        if ($auth->role() == $result['roles'] && $auth->id() != $_GET['id']) {
            echo '<script>window.location.href = "../user/list-users.php?na=true";</script>';
        } else {
            echo "
            <form method='get' action='#' class='p-4' id='edit-form'>
            <h1 class='h3 mb-3 fw-normal'>Edit User</h1>
            <div class='form-floating mb-2'>
                <input type='number' class='form-control' id='id' name='id' placeholder='name@example.com' value='".$result["id"]."' readonly>
                <label for='id'>id</label>
            </div>
            <div class='form-floating mb-2'>
                <input type='text' class='form-control' id='name' name='name' placeholder='Your Name' value='".$result["name"]."'>
                <label for='name'>Name</label>
            </div>
            <div class='form-floating'>
                <input type='email' class='form-control' id='email' name='email' placeholder='name@example.com' value='".$result["email"]."'>
                <label for='email'>Email address</label>
            </div>"?>
            <?php if($auth->role() == 3):?>
            <div class='form-floting'>
                <label for='role' class='form-label'>Roles</label>
                <select class='form-select' name='role' id='role'>"
                <?php 
                    $sql = "SELECT * FROM roles";
                    $result_roles = $conn->query($sql);
                    
                ?>
                <?php while($roles = $result_roles->fetch_assoc()):?>
                    <option value='<?= $roles["id"]?>' <?= $roles["id"] == $result["roles"] ? "selected" : "" ?>><?= $roles["name"]?></option>
                <?php endwhile;?>    
                </select>
            </div>
            <?php endif;?>
            <?php echo "<button class='w-100 btn btn-lg btn-dark mt-2' type='submit'>Edit</button>
            
        </form>
            
            ";
        }
    }
} else {
    echo '<script>window.location.href = "../categories/show-categories.php?na=true";</script>';
} ?>
<?php require '../layouts/footer.php'; ?>
