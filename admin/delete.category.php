<?php
    include('pathway/constants.php');

   // echo "Delete page";
   // check whether id and image name value is set or not
   if (isset($_GET['id']) && isset($_GET['image_name']))
   {
        // get the value and delete
       // echo "get value and delete";

       $id = $_GET['id'];
       $image_name = $_GET['image_name'];
       // remove physical image file if available
       if($image_name!=""){
           // this means image is available, so we can remove it
           $path= "../images/category/".$image_name;
           // remove the image
            $remove = unlink($path);
            // if failed to remove image display and error message and stop the process

            if($remove==false){
                // set session message 
                $_SESSION['remove'] = "<div class='error'> Failed to remove category image</div>";
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage.category.php');

                // stop the process

                die();
            }
       }

       // delete data from database

       $sql = "DELETE FROM tl_category WHERE id=$id";

       // execute the query
       $res = mysqli_query($conn, $sql);
       // check whether the data is deleted from database or not

       if($res==TRUE){

            // display success message and redirect
            $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully </div>";
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage.category.php');
       } else{

            // display error message and redirect to manage category
            $_SESSION['delete'] = "<div class='error'> Failed to delete category </div>";
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage.category.php');

       }
      

   } else{

        // redirect to manage page
        header('location:'.SITEURL.'admin/manage.category.php');

   }

?>