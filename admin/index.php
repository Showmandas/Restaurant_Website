<?php 
include 'partials/menu.php';
?>
            <!-- main content start here  -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <div class="col-4 txt-center">
            <h1>5</h1><br>
            categories
        </div><!--/col-4-->
        <div class="col-4 txt-center">
            <h1>5</h1><br>
            categories
        </div><!--/col-4-->
        <div class="col-4 txt-center">
            <h1>5</h1><br>
            categories
        </div><!--/col-4-->
        <div class="col-4 txt-center">
            <h1>5</h1><br>
            categories
        </div><!--/col-4-->
        <div class="clearfix"></div>
</div><!--/wrapper-->

</div><!---/main-content-->
                <!-- main content start here  -->
    <?php include 'partials/footer.php';?>    

    