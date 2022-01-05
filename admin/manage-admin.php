 <?php include 'partials/menu.php';?>     
   <!-- main content start here  -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
        if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//remove session message
        }
        if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//display session message
                unset($_SESSION['delete']);//remove session message
        }
        if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//display session message
                unset($_SESSION['update']);//remove session message
        }
        if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//display session message
                unset($_SESSION['user-not-found']);//remove session message
        }
        
        if(isset($_SESSION['pass-not-match'])){
                echo $_SESSION['pass-not-match'];//display session message
                unset($_SESSION['pass-not-match']);//remove session message
        }
        
        if(isset($_SESSION['pass-change'])){
                echo $_SESSION['pass-change'];//display session message
                unset($_SESSION['pass-change']);//remove session message
        }
        ?>
        <br><br>
<!-- add admin button -->
<a href="add-admin.php" class="btn-primary">Add Admin</a>
<br> <br><br>
<table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                </tr>
                <?php
                $selq="select * from admin_tbl";
                $res=mysqli_query($conn,$selq);
                if($res==TRUE){
                        $count=mysqli_num_rows($res);
                        if($count>0){
                                while($rows=mysqli_fetch_assoc($res)){
                                        $id=$rows['id'];
                                        $fullname=$rows['fullname'];
                                        $username=$rows['username'];
                                        // display values
                                        ?>
                                        <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $fullname;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change Password</a>
                              <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">update admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">delete admin</a>       
                        </td>
                </tr>

                                        <?php
                                }
                        }else{

                        }
                }
                ?>
                
        </table>
        <div class="clearfix"></div>
</div><!--/wrapper-->

</div><!---/main-content-->
                <!-- main content start here  -->
        

    <?php include 'partials/footer.php';?>