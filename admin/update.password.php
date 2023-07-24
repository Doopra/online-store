<?php include('pathway/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(Isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">


            <table class="tbl-30">

                <tr>
                    <td> Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>

                <tr>
                    <td> New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td> Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>

                <tr>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password"  class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // check whether the button is clicked
    if(isset($_POST['submit'])){

        $id =$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        //1. get the data from the form

        //2. check whether the user with current Id and cuurent password exit or not

        $sql = "SELECT * FROM tl_admin WHERE id=$id AND password='$current_password'";

        // execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $count = mysqli_num_rows($res);

            if($count==1){
                // User exits and password can be changed
                // check whether new password and confirm password match
                if ($new_password == $confirm_password){
                   
                    $sql2 = "UPDATE tl_admin SET
                     password='$new_password'
                     WHERE id=$id ";

                     // execute the code
                     $res2  = mysqli_query($conn, $sql2);

                     // check whether the query is executed or not
                     if($res2==TRUE){
                         // display success message
                          // user doesn't exits
                         $_SESSION['change-pwd'] = "<div class='success'> Password changed successfully</div>";
                         // Redirects the user
                         header('location:'.SITEURL.'admin/manage.admin.php');
                     } else{
                         // user doesn't exits
                         $_SESSION['pwd-not-match'] = "<div class='error'> Password changed successfully</div>";
                         // Redirects the user
                         header('location:'.SITEURL.'admin/manage.admin.php');
                     }

                }
                 else{
                    // user doesn't exits
                $_SESSION['pwd-not-match'] = "<div class='error'> Password doesn't match </div>";
                // Redirects the user
                header('location:'.SITEURL.'admin/manage.admin.php');
                }
            }
            
        }
        //3. check whether the new password and confirm password match or now

        //4. change password if all above is true


    }
?>

<?php include('pathway/footer.php');?>