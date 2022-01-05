<?php include 'partials/menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <?php
        
$id=$_GET['id'];
$sql="select * from admin_tbl where id='$id'";
$res=mysqli_query($conn,$sql);
if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1){
        $row=mysqli_fetch_assoc($res);
        $full_name=$row['fullname'];
        $username=$row['username'];

    }else{
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}

        ?>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username"  value="<?php echo $username; ?>"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div><!--/wrapper-->
</div><!--/main*-content-->

<?php

if(isset($_POST['submit'])){
        //get data
        $id=$_POST['id'];
        $fullname=$_POST['full_name'];
        $username=$_POST['username'];

        $sql="UPDATE admin_tbl SET fullname='$fullname',username='$username' WHERE id='$id'";

        $res=mysqli_query($conn,$sql);
        if($res==TRUE){
            $_SESSION['update']="<div class='success'>Admin updated succesfully.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        
        }
        else{
            $_SESSION['update']="<div class='error'> failed to delete admin.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        
        }
    
}

?>

<?php include 'partials/footer.php';?>