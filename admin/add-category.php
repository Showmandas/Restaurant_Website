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
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" id="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <?php
        
        ?>
    </div><!--/wrapper-->
</div><!---/main-content-->

<?php include 'partials/footer.php';?>
<?php

// process value from form insert value in database

if(isset($_POST['submit'])){
    //get data
    $title=$_POST['title'];
    if(isset($_POST['featured'])){
         $featured=$_POST['featured'];
    }else{
          $featured="No";
    }
    if(isset($_POST['active'])){
        $active=$_POST['active'];
   }else{
         $active="No";
   }
   
   //upload images
   if(isset($_FILES['image']['name'])){
       $image_name=$_FILES['image']['name'];

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
        $_SESSION['upload']="<div class='error'>Failedto upload image.</div>";
        header("location:".SITEURL."admin/add-category.php");
       die();
    }
   }else{
       //don't upload image and set the image_name as blank
       $image_name="";

   }

    // sql query for save data into database

    $insQ="INSERT INTO category_tbl SET title='$title',featured='$featured',active='$active',image_name='$image_name'";
    
    $res=mysqli_query($conn,$insQ) or die(mysqli_error());
    if($res==TRUE){
        // echo "inserted";
        //create a session variable
        $_SESSION['add']="<div class='success'>Category added succesfully</div>";
        //Redirect page to add admin
        header("location:".SITEURL.'admin/manage-category.php');
    }else{
        // echo "not inserted";
            //create a session variable
            $_SESSION['add']="<div class='error'>Failed to add category</div>";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-category.php');
        
    }
}

?>