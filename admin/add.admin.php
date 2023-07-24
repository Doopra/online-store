<?php include('pathway/menu.php')?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /> <br />

        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                   <td> 
                       <input type="text"  name="full_name" placeholder="Enter your full name" class="inputField"> 
                    </td>
                    
                </tr>

                <tr>
                    <td>Username: </td>
                   <td> 
                       <input type="text"  name="username" placeholder="Enter your username" class="inputField"> 
                    </td>
                    
                </tr>

                <tr>
                    <td>Password: </td>
                   <td> 
                       <input type="password"  name="password" placeholder="Enter your password" class="inputField"> 
                    </td>
                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('pathway/footer.php')?>



<?php

    // process the value from the from to the database
    if(isset($_POST['submit'])){
        //check if button is clicked

        //get data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted with md5

        //mysql query to save the data into the form
        $sql = "INSERT INTO tl_admin SET
         full_name = '$full_name',
         username = '$username',
         password = '$password'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res==TRUE){
           
            // Create a session variable
            $_SESSION['add'] = "<div class='success'> Admin added successfuly </div>";
                        //redirect page
            header('location:'.SITEURL.'admin/manage.admin.php');

        } else{
            // Create a session variable
            $_SESSION['add'] = "Failed to add Admin";
            //redirect page
            header('location:'.SITEURL.'admin/add.admin.php');
            
        }
    
    
}
       
       
        
    


    // check whether the button is clicked or normalizer_get_raw_decomposition
    
    // cehck whether the query is executed or not 

?>