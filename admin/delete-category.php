<?php

include '../dbcon.php';



if(isset($_GET['id']) AND isset($_GET['image_name'])){
    // get the value and delete/
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    // remove the physical image file is available
    if($image_name!=''){
        // image is available.so remove it 
        $path="..image/category/".$image_name;
        // remove the image 
        $remove=unlink($path);
        // if remove fail 
        if($remove=false){
            $_SESSION['remove']="<div class='error'>failed to remove image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');      
            // stop the process 
            die();   
        }
    }
    // delete data from database
    $del="DELETE FROM category_tbl WHERE id=$id";
$res=mysqli_query($conn,$del);
if($res==true){
    $_SESSION['delete']="<div class='success'>Category deleted succesfully.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
}else{
    $_SESSION['delete']="<div class='error'>Failed to delete Category</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
}

}else{
    header('location:'.SITEURL.'admin/manage-category.php');

}


?>