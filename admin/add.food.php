<?php include('pathway/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Category</h1>
        <br /><br />

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
        <table class="tbl-30">
            <tr>
                <td> Title:</td>
                <td><input type="text" name="title" placeholder="Title of the Food"></td>
            </tr>
            <tr>
                <td> Description:</td>
                <td>
                    <textarea name="description" cols="23" rows="4" placeholder="description of the food"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="price"></td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr> 
                <td> Category:</td>
                <td>
                    <select name="category" >
                        <?php
                            // create sql query to get all active value
                            $sql = "SELECT * FROM tl_category WHERE active='yes'";
                            $res = mysqli_query($conn, $sql);
                            // count rows to check whether we have category or not
                            $count = mysqli_num_rows($res);
                            // if count is greater than zero, we have categories else we do not have category
                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    // get the details of the category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"> <?php echo $title; ?> </option>
                                    <?php
                                }

                            } else{
                                ?>
                                <option value="0">No food category</option>
                                <?php
                            }

                        ?>
                        
                        
                     </select>
                 </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="yes"> Yes
                    <input type="radio" name="featured" value="no"> No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="yes"> Yes
                    <input type="radio" name="active" value="no"> No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-primary">
                </td>
            </tr>
        </table>
        
        </form>
        <?php
            // check whether the button is clicked or not
            if(isset($_POST['submit'])){
                // add the food in database

                //1. Get the data from the form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether the radio button for featured and active are checked or not
                if (isset($_POST['featured'])){

                    $featured = $_POST['featured'];
                }else{
                    $featured = "no";
                }

                if (isset($_POST['active'])){

                    $active = $_POST['active'];
                }else{
                    $active = "no";
                }

                //2. upload the image if selected
                // check whether the select image is clicked or not and upload te image if it is selected
                if (isset($_FILES['image']['name'])){

                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];
                    //checking whether the image is selected or not, if selected then upload the image
                    if ($image_name!=""){

                        // image is selected

                         //2, upload the image
                        $ext = end(explode('.', $image_name)); //b. get the extension of the selexted image
                                $image_name = "food_category".rand(000, 999).'.'.$ext;  //a. Rename the image
             
                                $source_path = $_FILES['image']['tmp_name'];
                                
                                
                                $destination_path = "../images/category/food/".$image_name;
             
                                // finally upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);
                                // check whether the image is uploaded or not
                                // and check if the image is not uploaded then we will stop the process and redirect with error message
             
                                if ($upload==false){
                                    // set message
                                    $_SESSION['upload'] = "<div class='error'> Failed to upload image</div>";
                                // Redirect to add category page
                                header('location:'.SITEURL.'admin/manage.food.php');
                                // stop the process
                                die();
             
                                } 
                    }

                } else{

                    $image_name = ""; // setting default value as blank
                }

                //3. insert into database
                // for numberic we do not need to put the variable in a quote 
                $sql2 = "INSERT INTO tl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,  
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2== TRUE){
                    // data is available

                    $_SESSION['add'] = "<div class='success'> Food added successfuly </div>";
                   // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.food.php');
                } else{
                    $_SESSION['add'] = "<div class='error'>  Failed to add Food </div>";
                    // Redirect to manage category page
                    header('location:'.SITEURL.'admin/manage.food.php');

                }

                //4. redirect with message to manage food page

            }
        ?>
    </div>
</div>
<?php include('pathway/footer.php')?>