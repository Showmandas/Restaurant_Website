<?php

// start session
session_start();
define('SITEURL','http://localhost/food-order/');

$conn=mysqli_connect('localhost','root') or die(mysqli_error());
$db_sel=mysqli_select_db($conn,'food-order');
?>