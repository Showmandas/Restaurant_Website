<?php
include '../dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">login</h1>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if($_SESSION['no-login-msg']){
            echo $_SESSION['no-login-msg'];
            unset($_SESSION['no-login-msg']);
        }
        ?>
        <br><br>
        <!-- login form start -->
        <form action="" method="post">
            username: <br>
            <input type="text" name="username" id="username" placeholder="Enter username"><br><br>
            Password: <br>
            <input type="password" name="password" id="password" placeholder="Enter password"><br><br>
            <input type="submit" name="submit" value="Log in" class="btn-primary">
        </form>
        <!-- login form end here/ -->
    </div><!--/login-->
</body>
</html>

<?php

if(isset($_POST['submit'])){
    $username=$_POST['username'];
     $password=md5($_POST['password']);

     $sql="select * from admin_tbl where username='$username' AND password='$password'";

     $res=mysqli_query($conn,$sql);

     $count=mysqli_num_rows($res);
     if($count==1){
         $_SESSION['login']="<div class='success'>Log in successful.</div>";
         $_SESSION['user']=$username;
         header("location:".SITEURL."admin/");


     }else{
        $_SESSION['login']="<div class='error'>Username or password did not match.</div>";
        header("location:".SITEURL."admin/login.php");


     }
}

?>