<!-- Destroy session/-->

<?php
include '../dbcon.php';

session_destroy();
header('location:'.SITEURL.'admin/login.php');
?>