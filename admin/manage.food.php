<?php include('pathway/menu.php')?>

<div class="main-content">
    <div class="wrapper">
      <h1>Manage Food</h1>

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
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
            if(isset($_SESSION['unauthorize'])){
                echo $_SESSION['unauthorize'];
                unset ($_SESSION['unauthorize']);
            }

            
         ?>
<br />
<!--- Button to add admin-->


<a href="<?php echo SITEURL; ?>admin/add.food.php" class="btn-primary">Add Food</a>
<br /><br />

<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>

    <?php
        // create sql query to get data from the database
        $sql = "SELECT * FROM tl_food";
        //execute the query
        $res = mysqli_query($conn, $sql);
        // count rows to check whether we have food or not
        $count = mysqli_num_rows($res);
        if($count >0 ){
            // we have data in the database
            // display the food from database

            while($row=mysqli_fetch_assoc($res)){

                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

                ?>
        <tr>
        <td><?php echo $id++; ?></td>
        <td><?php echo $title; ?></td>
        <td><?php echo $price; ?></td>
        <td>
            <?php 
        if($image_name!=""){

        //display the image
         ?>
        <img src="<?php echo SITEURL; ?>images/category/food/<?php echo $image_name; ?>" width="100px" height="100px">
        <?php

            } else{

        //display the message
    echo "<div class='error>'> Image not Added. </div>";

}
?>
        </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
        
        <a href="#" class="btn-secondary"> Update Admin  </a>
        <a href="<?php echo SITEURL; ?>admin/delete.food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Admin  </a>

        
        
        
        </td>
    </tr>

                <?php
            }
        } else{

            // we do not have data
            echo "<tr><td colspan='7' class='error'> Food Not Added Yet<td></tr>";
        }
    ?>

    

   
</table>
    </div>
</div>

<?php include('pathway/footer.php')?>