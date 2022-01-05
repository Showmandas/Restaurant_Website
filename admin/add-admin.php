<?php include 'partials/menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>
        <?php
        if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//display session message
                unset($_SESSION['add']);//remove session message
        }
        ?>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" id="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password" placeholder="Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div><!--/wrapper-->
</div><!---/main-content-->

<?php include 'partials/footer.php';?>
<?php

// process value from form insert value in database

if(isset($_POST['submit'])){
    //get data
    $fullname=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']); //password encryption

    // sql query for save data into database

    $insQ="INSERT INTO admin_tbl(fullname, username, password) VALUES ('$fullname','$username','$password')";
    
    $res=mysqli_query($conn,$insQ) or die(mysqli_error());
    if($res==TRUE){
        // echo "inserted";
        //create a session variable
        $_SESSION['add']="Admin added succesfully";
        //Redirect page to add admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        // echo "not inserted";
            //create a session variable
            $_SESSION['add']="Failed to add admin";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        
    }
}

?>