<?php
     include ('pathway/constants.php');
    //destroy the session

    session_destroy();

    //2. redirect to login page
    header('location:'.SITEURL.'admin/login.php');
    ?>