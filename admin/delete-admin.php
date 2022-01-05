<?php

include '../dbcon.php';

$id=$_GET['id'];

$del="DELETE FROM admin_tbl WHERE id=$id";
$res=mysqli_query($conn,$del);
if($res==true){
    $_SESSION['delete']="<div class='success'>Admin deleted succesfully.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete']="<div class='error'>Failed to delete admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>