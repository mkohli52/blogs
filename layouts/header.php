<?php if(!isset($_COOKIE["email"])){
    header("Location: ../user/login.php");
    exit();
}?>
<?php require "../auth/auth.php" ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blogs</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" integrity="sha256-VJuwjrIWHWsPSEvQV4DiPfnZi7axOaiWwKfXaJnR5tA=" crossorigin="anonymous">
  <style>
    a{
      text-decoration:none;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">



  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed;">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blogs</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php 
            $auth = new Auth($_COOKIE["email"]);
            echo($auth->name());
            echo "</br>";
            echo("Role: ".$auth->roleName());
          ?></a>
          
        </div>
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?= $_SERVER['PHP_SELF'] == "/blogs/categories/create-category.php" || $_SERVER['PHP_SELF'] == "/blogs/categories/show-categories.php" ? "menu-open" : "" ?> ">
            <a href="#" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/categories/create-category.php" || $_SERVER['PHP_SELF'] == "/blogs/categories/show-categories.php" || $_SERVER['PHP_SELF'] == "/blogs/categories/show-category-posts.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/user-all-posts.php"  ? "active" : "" ?>">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../categories/create-category.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/categories/create-category.php" ? "active" : "" ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../categories/show-categories.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/categories/show-categories.php" ? "active" : "" ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Categories</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?= $_SERVER['PHP_SELF'] == "/blogs/posts/create-post.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/show-posts-user.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/all-posts.php" ? "menu-open" : "" ?>">
            <a href="#" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/posts/create-post.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/show-posts-user.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/all-posts.php" || $_SERVER['PHP_SELF'] == "/blogs/posts/show-post.php" ? "active" : "" ?>">
              <i class="nav-icon fas fa-pencil-alt"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../posts/create-post.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/posts/create-post.php" ? "active" : "" ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Posts</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../posts/show-posts-user.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/posts/show-posts-user.php" ? "active" : "" ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Posts</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../posts/all-posts.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/posts/all-posts.php" ? "active" : "" ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Posts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?= $_SERVER['PHP_SELF'] == "/blogs/user/list-users.php"  ? "menu-open" : "" ?>">
            <a href="#" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/user/list-users.php"  ? "active" : "" ?>">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <?php if($auth->role() != 1):?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../user/list-users.php" class="nav-link <?= $_SERVER['PHP_SELF'] == "/blogs/user/list-users.php"  ? "active" : "" ?>">
                <i class="far fa-circle nav-icon"></i>
                  <p>List Users</p>
                </a>
              </li>
            </ul>
            <?php endif;?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../user/logout-user.php" class="nav-link ">
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <div class="content mt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card" id="all-data">
            