<?php include('pathway/menu.php');?>

    <!-- Main Content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br /> <br />

                <?php 
                    if(isset($_POST['login'])){
                     echo $_SESSION['login'];
                     unset( $_SESSION['login']);
                     }
                 ?>

<br /> <br />

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    <!-- Main Content section ends -->

    <?php include('pathway/footer.php')?>