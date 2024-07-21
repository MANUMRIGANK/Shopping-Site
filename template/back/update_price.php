<h1 class="page-header">
  Update Product Price
</h1>
<div class="col-md-4">

    <?php 
    
    global $conn;
    $sql = "SELECT `product_price` FROM `products` WHERE product_id = {$_GET['id']}";
    $execution = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($execution);
    ?>
    
    <form action="../../template/back/update_price_func.php" method="post">
    
        <div class="form-group">
            <label for="category-title">Price</label>
            <input autocomplete="off" type="text" value="<?php echo $row['product_price'];?>" name="price_changed" class="form-control">
        <input type="text" hidden='true' name="id" value='<?php echo $_GET['id'];?>'>
        </div>

        <div class="form-group">
            
            <input type="submit" class="btn btn-primary" value="Update Price">
            </div>      


    </form>


</div>



