<?php

//include constants.php file here
include('pathway/constants.php');

//1. get id of the admin to be deleted
$id = $_GET['id'];
//2. Create sql query to delete admin

$sql = "DELETE FROM tl_admin WHERE id=$id";

//execute the code
$res = mysqli_query($conn, $sql);
// check whether the query is executed successfully or not

if($res==TRUE){

    //query executed successfully and Admin deleted
    // create session varibale to redeirect the page
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
} else{

    //failed to delete Admin
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin, Try again later</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');

}

//3.  Redirect to manage admin page with message (success/error) 



?>