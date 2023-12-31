<?php
    include('partials-front/menu.php');
?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset( $_SESSION['order']);
            }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
                // create sql query to display the categories in the database
                $sql = "SELECT * FROM tl_category WHERE active='yes' AND featured='yes' LIMIT 3";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count rows to check whether the category is available
                $count = mysqli_num_rows($res);

                if($count>0){

                    // data is available
                    while($rows=mysqli_fetch_assoc($res)){
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    
                    

                    ?>

            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
            <div class="box-3 float-container">
                <?php
                    if($image_name==""){
                        echo "<div class='error'>Image  Not Available </div>";
                } else{

                    ?>

                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                }

                ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>

                    <?php
            
                }
             }
              else{

                    // data is not available
                    echo "<div class='error'> Category Not Added</div>";
                }
            ?>
           

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // getting food from database that are active and featured
                $sql2 = "SELECT * FROM tl_food WHERE active='yes' AND featured='yes' LIMIT 6";

                //execute the code
                $res2 = mysqli_query($conn, $sql2);
                

                //count rows
                $count2 = mysqli_num_rows($res2);

                if($count2 >0){

                    while($row=mysqli_fetch_assoc($res2)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>



                <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php 
                        if($image_name==""){

                            echo "<div class='error'> Image Not Available </div>";
                        } else{

                            ?>

                        <img src="<?php echo SITEURL; ?>images/category/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                        <?php
                        
                        }

                    ?>
                
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    

                </div>
            </div>

                        <?php
                    }   
            }else{

                    echo "<div class='error'> Food Is Not Available </div>";
                }
            ?>

            

            

                   
                </div>
            </div>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
     include('partials-front/footer.php');
     ?>