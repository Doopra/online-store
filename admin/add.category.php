<?php
 include('pathway/menu.php'); ?>


 <div class="main-content">
    <div class="wrapper">
         <h1>Add Category</h1>
         <br /> <br />

         <?php
            // check whether the session is set or not
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
         ?>

         <form action="" method="POST" enctype="multipart/form-data">
             <!--- Add category form starts here--->

             <table class="tbl-30">
                 <tr>
                     <td> Title:</td>
                     <td> <input type="text" name="title" placeholder="Category Title"> </td>
                 </tr>

                 <tr>
                     <td> Select Image:</td>
                     <td>
                         <input type="file" name="image">
                     </td>
                 </tr>

                 <tr>
                     <td> Featured:</td>
                     <td> <input type="radio" name="featured" value="yes"> Yes
                         <input type="radio" name="featured" value="no"> No
                    </td>
                 </tr>

                 <tr>
                     <td> Active:</td>
                     <td> <input type="radio" name="active" value="yes"> Yes
                         <input type="radio" name="active" value="no"> No
                    </td>
                 </tr>

                 <tr>
                     <td colspan="2">
                         <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                     </td>
                 </tr>

             </table>
             <!--- Add category form stops here--->
         </form>

         <?php
            // Check if the button is clicked or not
            if(isset($_POST['submit'])){
               // check the value from category form
               $title = $_POST['title'];
               // for radio button we need to check whether the button is selected or not
               if(isset($_POST['featured'])){
                   // get the value from form
                   $featured = $_POST['featured'];
               } else{
                   // get the default value
                   $featured = "no";
               }
               if(isset($_POST['active'])){
                   $active  = $_POST['active'];
               } else{
                   $active = "no";

               }
               // check whether the image is selected or not and set the value for image name accordingly 
             //  print_r($_FILES['image']);

             //  die(); // break the code here

               if(isset($_FILES['image']['name'])){
                   // upload the image
                   // to upload the image we need the source path and the destination path
                   $image_name = $_FILES['image']['name'];
                     if($image_name !=""){                   // auto rename image
                   // Get the extension of the image 
                   $ext = end(explode('.', $image_name));
                   $image_name = "food_category".rand(000, 999).'.'.$ext;

                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path = "../images/category/".$image_name;

                   // finally upload the image
                   $upload = move_uploaded_file($source_path, $destination_path);
                   // check whether the image is uploaded or not
                   // and check if the image is not uploaded then we will stop the process and redirect with error message

                   if ($upload==false){
                       // set message
                       $_SESSION['upload'] = "<div class='error'> Failed to upload image</div>";
                   // Redirect to add category page
                   header('location:'.SITEURL.'admin/add.category.php');
                   // stop the process
                   die();

                   } 
                   
                }
               } else{
                   // dont upload image, set the image file name as black
                   $image_name = "";
               }

               // create sql to insert data into database
               $sql = " INSERT INTO tl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
               ";
               // execute the query and save in databae
               $res = mysqli_query($conn, $sql);

               // check whether the query is executed or not and add added
               if($res==TRUE){
                   // query executed and data added
                   $_SESSION['add'] = "<div class='success'> Category added successfuly </div>";
                   // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.category.php');

               } else{
                   //failed to add category
                   $_SESSION['add'] = "<div class='error'> Failed to add category </div>";
                   // Redirect to manage category page
                   header('location:'.SITEURL.'admin/add.category.php');
               }
            }
         ?>
    </div>
</div>


<?php
 include('pathway/footer.php');
?>