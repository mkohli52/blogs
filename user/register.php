<?php if(isset($_COOKIE["email"])){
    header("Location: ../index.php");
}?>
<?php require 'layouts/user-header.php'; ?>
<body class="text-center">
    <div class="form-signin bg-light">
        <form method="get" action="#" id="register-form">
            
            <h1 class="h3 mb-3 fw-normal">Sign up</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                <label for="name">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-dark" type="submit">Sign up</button>
            <a href="login.php" class ="d-flex mt-2" style="text-decoration: none;">Already a user?</a>
        </form>
    </div>
</body>
<?php require 'layouts/user-footer.php'; ?>
