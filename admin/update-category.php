<?php include 'partials/menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>
        <?php
        if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//remove session message
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];//display session message
            unset($_SESSION['upload']);//remove session message
    }

        ?>

        <?php
        if(isset($_GET['id'])){
            // get the value
                    
$id=$_GET['id'];
$sql="select * from category_tbl where id='$id'";
$res=mysqli_query($conn,$sql);
if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $featured=$row['featured'];
        $active=$row['active'];
        $curr_image=$row['image_name'];

    }else{
        $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }

        }else{
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" id="title" value="<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=='Yes'){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=='No'){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=='Yes'){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=='No'){echo "checked";}?> type="radio" name="active" value="No">No
                    
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <!-- image will be displayed here. -->
                        <?php
                        if($curr_image != ""){
                            // display the image 
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $curr_image ; ?>" width="100px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $curr_image;?>">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <?php

if(isset($_POST['submit'])){
    //get data
    $id=$_POST['id'];
    $title=$_POST['title'];
    $curr_image=$_POST['current_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    // updating new image if selected
    if(isset($_FILES['image']['name'])){
        // get the image detail 
        $image_name=$_FILES['image']['name'];
        // check whether the image is available or not 
        if($image_name!=''){
        //    image available 
        // upload the new image /
        //auto rename image
       //get the extensionof our image(jpg,png,gif,etc)
       $ext=end(explode('.',$image_name));

       //    rename the image
       $image_name="Food_category_".rand(000,999).'.'.$ext;
          $source_path=$_FILES['image']['tmp_name'];
          $dest_path="../images/category/".$image_name;
   
       //    now upload the image
       $upload=move_uploaded_file($source_path,$dest_path);
       if($upload==false){
           $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
           header("location:".SITEURL."admin/manage-category.php");
          die();

       }
   
        //   remove the current image 
        if($curr_image!=''){
            $removepath="../images/category/".$curr_image;
            $remove=unlink($removepath);
            // check whether the image is removed or not 
            if($remove==false){
                $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
                header("location:".SITEURL."admin/manage-category.php");
                die();
            }
            }
        }
        else{
         $image_name=$curr_image;
        }
    }else{
        $image_name=$curr_image;
    }

    //  update the database
    $sql="UPDATE category_tbl SET title='$title',featured='$featured',active='$active',image_name='$image_name' WHERE id='$id'";

    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        $_SESSION['update']="<div class='success'>Category updated succesfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    
    }
    else{
        $_SESSION['update']="<div class='error'> failed to update category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    
    }

}
    
        ?>
    </div><!--/wrapper-->
</div><!---/main-content-->

<?php include 'partials/footer.php';?>
