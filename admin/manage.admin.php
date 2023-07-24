<?php include('pathway/menu.php')?>
    <!-- Menu section ends -->

    <!-- Main Content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br />

                <?php
                    if (isset($_SESSION['add'])){
                        echo $_SESSION['add']; // adding session message
                        unset ($_SESSION['add']); // removing session message 
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete']; // adding session message
                        unset ($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update']; // adding session message
                        unset ($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found']; // adding session message
                        unset ($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd']; // adding session message
                        unset ($_SESSION['change-pwd']);
                    }
                   
                   
                
                ?>
<br /><br />
                <!--- Button to add admin-->

                <a href="add.admin.php" class="btn-primary">Add Admin</a>
                <br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>


                    <?php
                        // query to get all admin
                        $sql = "SELECT * FROM tl_admin";
                        // execute the query
                        $res = mysqli_query($conn, $sql);
                        // check whether the query is executed or not
                        if($res==True){
                            $count = mysqli_num_rows($res); //function to get all the rows in the database
                            //check number of rows

                            $sn = 1;
                            if($count>0){
                                // we have data in the database
                                while($rows=mysqli_fetch_assoc($res)){
                                       // using while loop to get all the data from the database
                                       // get individual data
                                       $id = $rows['id'];
                                       $full_name = $rows['full_name'];
                                       $username = $rows['username'];

                                       //display the values in our table
                                       ?>

                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $full_name?></td>
                        <td><?php echo $username?></td>
                        <td>
                        
                        
                        <a href="<?php echo SITEURL; ?>admin/update.password.php?id=<?php echo $id; ?>" class="btn-primary"> Change password </a>
                        <a href="<?php echo SITEURL; ?>admin/update.admin.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin  </a>
                        <a href="<?php echo SITEURL; ?>admin/delete.admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin  </a>
                        
                        </td>
                    </tr>
                                       <?php

                                }

                            }

                            // we don not have data in database
                            
                        }
                
                    ?>
                  

                </table>

                <div class="clearfix"></div>
            </div>
        </div>

    <!-- Main Content section ends -->

    <!-- Footer section starts -->
    <?php include('pathway/footer.php')?>