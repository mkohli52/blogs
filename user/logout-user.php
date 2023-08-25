<?php 
  $cookie_expire = time() - 3600;
  setcookie("email","",$cookie_expire,"/");
  header("Location: login.php");
?>