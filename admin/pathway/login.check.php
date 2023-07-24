<?php
    // check whether the user is logged in or not
    // Authorization - Access Control
    if(!isset($_SESSION['user'])){ // if user session is not set
        // user is not logged in
        
        
        $_SESSION['no-login-message'] = "<div class='error'> Please Login to Access Admin Panel</div>";
        // redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>