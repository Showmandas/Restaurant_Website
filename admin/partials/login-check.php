<?php

// Authorization/

if(!isset($_SESSION['user'])){
  $_SESSION['no-login-msg']="<div class='error'>Please login to access Admin panel</div>";
  header('location:'.SITEURL.'admin/login.php');
}

?>