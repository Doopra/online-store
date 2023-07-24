<?php
    include('pathway/menu.php');
   ?>
   
   <div class="main-content">
        <div class="wrapper">
            <h1> Update Order</h1>

            <br /> <br />


            <?php
            
            // check whether the id is set or not
            if (isset($_GET['id'])){
                // set the id and all other data
                $id = $_GET['id'];
                // create sql query to get other details
                $sql = "SELECT * FROM tl_order WHERE id=$id";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count the row to check whether the id is added or not
                $count = mysqli_num_rows($res);

                if ($count==1){
                     // get all the data

                     $rows = mysqli_fetch_assoc($res);
                     $quantity = $rows['quantity'];
                     $food = $rows['food'];
                     $price = $rows['price'];
                     $status = $rows['status'];
                     $customer_name = $rows['customer_name'];
                     $customer_contact = $rows['customer_contact'];
                     $customer_email = $rows['customer_email'];
                     $customer_address = $rows['customer_address'];


                }else{
                    // redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'> Order Not Found </div>";
                     // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.order.php');

                }

            } else{

                // redirect to manage category page
                // $_SESSION['add'] = "<div class='error'> Category added successfuly </div>";
                   // Redirect to manage category page
                   header('location:'.SITEURL.'admin/manage.order.php');
            }
            ?>


            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><b> <?php echo $food;?></b> </td>
                </tr> 

                <tr>
                    <td>Price:</td>
                    <td><b>$<?php echo $price;?></b> </td>
                </tr> 

                <tr>
                   
                        
                        <td>Quantity</td>
                        <td><input type="text" name="quanity" value="<?php echo $quantity?>"></td>
                    
                </tr>

                <tr>
                   
                        
                   <td>Status</td>
                   <td>
                       <select name="status" >
                           <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                           <option <?php if($status=="On Delivery"){echo "selected";}?>  value="On Delivery">On Delivery</option>
                           <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                           <option <?php if($status=="cancelled"){echo "selected";}?> value="cancelled">cancelled</option>
                       </select>
                   </td>
               
                 </tr>

                 <tr>
                    <td>Customer Name:</td>
                    <td> <input type="text" name="customer_name" value="<?php echo $customer_name;?>"> </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td> <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>"> </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td> <input type="text" name="customer_email" value="<?php echo $customer_email;?>"> </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td> <textarea name="customer_address" cols="30" rows="5" ><?php echo $customer_address;?></textarea>  </td>
                </tr>

                 <tr>
                   
                        
                        <td clospan="2"></td>
                        
                         <input type="hidden" name="id" value="<?php echo $id ?>">
                         <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <td><input type="submit" name="submit" value="Update Order" class="btn-secondary"></td>
                    
                </tr>

                    </td>
                </tr> 

                

            </table>
            </form>
            <?php

                     if(isset($_POST['submit'])){
                         //1. get data from the form
                         $id = $_POST['id'];
                         $quantity = $_POST['quantity'];
                         $price = $_POST['price'];
                         $total = $price * $quantity ;
                         $status = $_POST['status'];
                         $customer_name = $_POST['customer_name'];
                         $customer_contact = $_POST['customer_contact'];
                         $customer_email = $_POST['customer_email'];
                         $customer_address = $_POST['customer_address'];

                         //2. updating new image if selected
                         // check whether the image is selected or not

                         

                         //3. update database
                         $sql2 = "UPDATE tl_order SET
                            quantity =   $quantity,
                            total =   $total,
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        WHERE id=$id
                         
                         ";

                         $res2 = mysqli_query($conn, $sql2);
                         

                         //checking if query is executed or not
                         if ($res2==true)
                         {
                         $_SESSION['update'] = "<div class='success'> Order Updated Successfully  </div>";
                         header('location:'.SITEURL.'admin/manage.order.php');

                         } else{
                         //4. Redirect to manage category with message

                         $_SESSION['update'] = "<div class='error'> Failed to Update Order </div>";
                         header('location:'.SITEURL.'admin/manage.order.php');
                         }
                     
                          
                        }

                     
    ?>
        </div>
    </div>

    

   <?php


    include('pathway/footer.php');
 ?>