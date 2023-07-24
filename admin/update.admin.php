<?php include('pathway/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1> Add Admin</h1>
            <br><br>

            <?php
                // get the id of the selected Admin
                $id = $_GET['id'];

                // create sql to get the details
                $sql = "SELECT * FROM tl_admin WHERE id=$id";

                // Execute query
                $res = mysqli_query($conn, $sql);

                //check whether the query is executed or not
                if($res==TRUE){
                    //cehck whether the data is executed or not
                    $count = mysqli_num_rows($res);
                    // check whether we have admin data or not
                    if ($count==1){
                        // get the details
                        $row = mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];

                    } else{
                        // Redirects to manage.admin.php
                        header('location:'.SITEURL.'admin/manage.admin.php');

                    }
                }

            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr> 
                        <td>Full Name:</td>
                        <td> <input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                    </tr>

                    <tr> 
                        <td>Username:</td>
                        <td> <input type="text" name="username" value="<?php echo $username;?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
 
            </form>
        </div>
    </div>

    <?php
    
        if(isset($_POST['submit'])){
           $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

        //create sql query to update the file
            $sql = "UPDATE tl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = $id";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // check whether the query is updated successfully or not
            if($res==TRUE){
                //query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                 header('location:'.SITEURL.'admin/manage.admin.php');
            }else{
                $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
                 header('location:'.SITEURL.'admin/manage.admin.php');
            }
    }
    ?>
<?php include('pathway/footer.php');?>