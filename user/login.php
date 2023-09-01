<?php if(isset($_COOKIE["email"])){
    header("Location: ../index.php");
}?>
<?php require 'layouts/user-header.php'; ?>

<?php
echo 'PHP version: ' . phpversion();?>
<body class="text-center">
    <div class="form-signin bg-light">
    <form method="get" action="#" id="login-form">
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>
    <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        <label for="email">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-dark" type="submit">Sign in</button>
    <a href="register.php" class ="d-flex mt-2" style="text-decoration: none;">Not a user?</a>
</form>
    </div>
</body>

<?php require 'layouts/user-footer.php'; ?>
