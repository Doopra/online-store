<?php
session_start();
define('SITEURL', 'http://localhost/online-store/');

// create constant to store non repeating values
$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());   // database connection
 $dbselect = mysqli_select_db($conn,'new-foodorder')or die(mysqli_error());//selectiong database
       

?>