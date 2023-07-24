<?php include('pathway/menu.php')?>

<div class="main-content">
    <div class="wrapper">
      <h1>Manage Order</h1>

      <br />

<!--- Button to add admin-->


<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th style="width:100px;">Food</th>
        <th>Price</th>
        <th style="padding-left:20px;padding-right:20px;">Qty</th>
        <th style="padding-left:20px; padding-right:20px;">Total</th>
        <th style="width:160px; ">Order Date</th>
        <th style="width:100px;">Status</th>
        <th style="width:100px;">customer Name</th>
        <th style="width:100px;">customer Contact</th>
        <th style="width:300px; padding-left:20px;">Email</th>
        <th style="width:300px;">Address</th>
        <th style="width:100px;">Action</th>
    </tr>


    <?php
            // get all the orders from database
            $sql = "SELECT * FROM tl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if($count>0){

                //order is available
                while($rows=mysqli_fetch_assoc($res)){

                    // get all the order details
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $quantity = $rows['quantity'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];

                    ?>


                <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                            <td> 
                                <?php  
                                
                                //Ordered, On Delivery, Delivered, Cancelled

                                if($status=="Ordered"){
                                    echo "<label>$status</label>";

                                }
                                elseif($status=="On Delivery"){
                                    echo "<label style='color:orange;'>$status</label>";

                                }
                                elseif($status=="Delivered"){
                                    echo "<label style='color:green;'>$status</label>";

                                }
                                elseif($status=="Cancelled"){
                                    echo "<label style='color:red;'>$status</label>";

                                }

                                ?>
                            
                            </td>
                        <td><?php echo $customer_name ;?></td>
                        <td><?php echo $customer_contact ;?></td>
                        <td><?php echo $customer_email ; ?></td>
                        <td><?php echo $customer_address ; ?></td>
                         <td style="width:500px;">

                        <a href="<?php echo SITEURL ;?>admin/update.order.php?id=<?php echo $id;?>" class="btn-secondary"> Update Order  </a>
                        <a href="#" class="btn-danger"> Delete Order  </a>
                        
                        </td>


                    <?php

                }
            } else{

                //order is not available
                echo "<tr><td colspan='12' class='error'> Order Not Available </td></tr>";

            }
    ?>
    
        </tr>
    
</table>
    </div>
</div>

<?php include('pathway/footer.php')?>