<?php
    include('partials-front/menu.php');
?>


    <?php
            // check whether food_id is set or not
            if(isset($_GET['food_id'])){

                // get the food_id and details of the selected food
                $food_id = $_GET['food_id'];
                // get the details of the selected food
                $sql = "SELECT * FROM tl_food WHERE id='$food_id'";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count the rows
                $count = mysqli_num_rows($res);
                // check if data is available 
                if($count==1){
                    // data is available
                    // get the data from the database

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                } else{
                    // data is not available
                    // redirect to homepage
                   header('location:'.SITEURL);
                }
            } else{

                //redirect to homepage
                header('location:'.SITEURL);
            }
   ?>


<?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset( $_SESSION['order']);
            }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->

    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
         
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    <?php 
                    if(isset($_POST['order'])){
                     echo $_SESSION['order'];
                     unset( $_SESSION['order']);
                     }
                 ?>
                    <div class="food-menu-img">
                    <?php
                    if($image_name==""){
                        echo "<div class='error'>Image  Not Available </div>";
                } else{

                    ?>

                    <img src="<?php echo SITEURL; ?>images/category/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                     <?php
                }
                ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="title" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Saviour Mkpong" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 070812xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. save.mkpong@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                    // checked whether submit button is clicked or not
                    if(isset($_POST['submit'])){

                        // get all the details from the form
                        $food = $_POST['title'];
                        $price = $_POST['price'];
                        $quantity = $_POST['quantity'];
                        $total = $price * $quantity;
                        $order_date = date('y:m:d h:i:s');
                        $status = "ordered"; // Ordered, On delivery, Delivered, Cancelled
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];

                        // save the order in database
                        // creating sql to save the data

                        $sql2 = "INSERT INTO tl_order SET
                            food = '$food',
                            price = $price,
                            quantity = $quantity,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        ";


                        // execute the query
                        $res2 = mysqli_query($conn, $sql2);
                        
                        
                        // check whether the query is executed or not
                        if($res2==true){
                           
                            // query executed successfully
                            $_SESSION['order'] = "<div class='success text-center'>Order placed Successfully.</div>";
                            header('location:'.SITEURL);


                        } else{
                            $_SESSION['order'] = "<div class='error text-center'>Failed to place order</div>";
                            header('location:'.SITEURL);
                            
                        }
                    }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    
    <?php
     include('partials-front/footer.php');
     ?>