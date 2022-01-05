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
                    <td>Old Password</td>
                    <td><input type="password" name="curr_pass" id="curr_pass" placeholder="Current password"></td>
                </tr>
                <tr>
                    <td>Enter New Password</td>
                    <td><input type="password" name="new_pass" id="new_pass" placeholder="Enter new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="con_pass" id="con_pass" placeholder="confirm password"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
        $curr_pass=md5($_POST['curr_pass']);
        $new_pass=md5($_POST['new_pass']);
        $con_pass=md5($_POST['con_pass']);
        
        $sql="select * from admin_tbl where id='$id' AND password='$curr_pass'";

        $res=mysqli_query($conn,$sql);

        if($res==TRUE){
            $count=mysqli_num_rows($res);
            if($count==1){
               if($new_pass==$con_pass){
                   $sql2="update admin_tbl set password='$new_pass' where id=$id";
                   $res2=mysqli_query($conn,$sql2);
                   if($res2==TRUE){
                       
                $_SESSION['pass-change']="<div class='success'>Password Changed successfully.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php'); 
                   }else{
                    $_SESSION['pass-change']="<div class='error'>Failed to Changed Password .</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php'); 
                       
                   }

               }else{
                $_SESSION['pass-not-match']="<div class='error'>Password did not found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');        
               }
            }
        }else{
            $_SESSION['user-not-found']="<div class='error'>User not found</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    
}

?>

<?php include 'partials/footer.php';?>