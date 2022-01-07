<?php include 'partials/menu.php';?>
   <!-- main content start here  -->
   <div class="main-content">
        <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
<!-- add admin button -->
<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
<br> <br><br>
<?php
        if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//remove session message
        }
        if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];//display session message
                unset($_SESSION['remove']);//remove session message
        }
        if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//display session message
                unset($_SESSION['delete']);//remove session message
        }
        if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];//display session message
                unset($_SESSION['no-category-found']);//remove session message
        }
        if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//display session message
                unset($_SESSION['update']);//remove session message
        }
        if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//display session message
                unset($_SESSION['upload']);//remove session message
        }
        if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];//display session message
                unset($_SESSION['failed-remove']);//remove session message
        }
        ?>
        <br><br>

<table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Image</th>
                </tr>
                <?php
                $selq="select * from category_tbl";
                $res=mysqli_query($conn,$selq);
                if($res==TRUE){
                        // count rows 
                        $count=mysqli_num_rows($res);
                        // create a serial number
                        $sn=1;
                        if($count>0){
                                while($rows=mysqli_fetch_assoc($res)){
                                        $id=$rows['id'];
                                        $title=$rows['title'];
                                        $featured=$rows['featured'];
                                        $active=$rows['active'];
                                        $image_name=$rows['image_name'];
                                        // display values
                                        ?>
                                        <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                            <?php 
                                    if($image_name!=""){
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
                                            <?php
                                            //display the image
                                    }else{
                                            echo "<div class='error'>Image not added.</div>";
                                    }
                                    
                                    ?></td>
                                    <td>
                              <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">delete Category</a>       
                        </td>
                </tr>

                                        <?php
                                }
                        }else{
                                ?>
                                <tr>
                                        <td colspan="6"><div class="error">No category</div></td>
                                </tr>
                                <?php

                        }
                }
                ?>
               
        </table>
        <div class="clearfix"></div>
</div><!--/wrapper-->

</div><!---/main-content-->
                <!-- main content start here  -->
<?php include 'partials/footer.php';?>