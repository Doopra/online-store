<?php
    include('pathway/menu.php');
   ?>
   
   <div class="main-content">
        <div class="wrapper">
            <h1> Update Category</h1>

            <br /> <br />


            <?php
            
            // check whether the id is set or not
            if (isset($_GET['id'])){
                // set the id and all other data
                $id = $_GET['id'];
                // create sql query to get other details
                $sql = "SELECT * FROM tl_category WHERE id=$id";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count the row to check whether the id is added or not
                $count = mysqli_num_rows($res);

                if ($count==1){
                     // get all the data

                     $row = mysqli_fetch_assoc($res);
                     $title = $row['title'];
                     $current_image = $row['image_name'];
                     $featured = $row['featured'];
                     $active = $row['active'];


                }else{
                    // redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'> Category Not Found </div>";
                     // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.category.php');

                }

            } else{

                // redirect to manage category page
                // $_SESSION['add'] = "<div class='error'> Category added successfuly </div>";
                   // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.category.php');
            }
            ?>


            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td> <input type="text" name="title" value="<?php echo $title?>"> </td>
                </tr> 

                <tr>
                    <td>Current Image:</td>
                  
                  <td>
                      <?php 

                    if($current_image !=""){

                        //display images
                    
                    ?> 
                    
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"  width="150px" height="100px">
                    <?php
                        }   
                     else{
                         echo "<div class='error'> Image Not Added </div>";
                     }
                    ?>
                    </td>
                </tr> 

                <tr>
                    <td>New Image:</td>
                    <td> <input type="file" name="image" > </td>
                </tr> 
                <tr>
                     <td> Featured:</td>
                     <td> <input <?php if($featured=="yes"){ echo "checked";}?> type="radio" name="featured" value="yes"> Yes
                         <input <?php if($featured=="no"){ echo "checked";}?> type="radio" name="featured" value="no"> No
                    </td>
                 </tr>

                 <tr>
                     <td> Active:</td>
                     <td> <input <?php if($active=="yes"){ echo "checked";}?>  type="radio" name="active" value="yes"> Yes
                         <input <?php if($active=="no"){ echo "checked";}?>  type="radio" name="active" value="no"> No
                    </td>
                 </tr>

                 <tr>
                     <td colspan="2">
                         <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                         <input type="hidden" name="id" value="<?php echo $id ?>">
                         <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                     </td>
                 </tr>

            </table>
            </form>
            <?php

                     if(isset($_POST['submit'])){
                         //1. get data from the form
                         $id = $_POST['id'];
                         $title = $_POST['title'];
                         $current_image = $_POST['current_image'];
                         $featured = $_POST['featured'];
                         $active = $_POST['active'];

                         //2. updating new image if selected
                         // check whether the image is selected or not

                         if(isset($_FILES['image']['name'])){

                            // get the image details
                            $image_name = $_FILES['image']['name'];
                            // check whether the image is available or not
                            if($image_name !=""){

                                // image is available
                                // upload the new image  (section A)

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
                                header('location:'.SITEURL.'admin/manage.category.php');
                                // stop the process
                                die();
             
                                } 
                                

                                
                                // remove the current image
                               
                                if($current_image!=""){
                                    $remove_path = "../images/category/".$current_image;
                                    $remove = unlink($remove_path);
    
                                    // check whether the image is removed or not
                                    // if failed to remove, display error message and stop the process
                                    if($remove == false){
    
                                        $_SESSION['failed-remove'] = "<div class='error'> Failed to remove image</div>";
                                        header('location:'.SITEURL.'admin/manage.category.php');
                                        die();
                                    }
    
                                }
                                


                            }
                             else{

                                // image is not available 
                                $image_name = $current_image;
                            }
                         } else{

                            $image_name = $current_image;
                         }


                         //3. update database
                         $sql2 = "UPDATE tl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            WHERE id=$id
                         
                         ";

                         $res2 = mysqli_query($conn, $sql2);
                         

                         //checking if query is executed or not
                         if ($res2==true)
                         {
                         $_SESSION['update'] = "<div class='success'> Category Updated Successfully  </div>";
                         header('location:'.SITEURL.'admin/manage.category.php');

                         } else{
                         //4. Redirect to manage category with message

                         $_SESSION['update'] = "<div class='error'> Failed to Update Category </div>";
                         header('location:'.SITEURL.'admin/manage.category.php');
                         }
                     
                          
                        }

                     
    ?>
        </div>
    </div>

    

   <?php


    include('pathway/footer.php');
 ?>