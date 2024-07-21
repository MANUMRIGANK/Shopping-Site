

<h1 class="page-header">
  Update Product Details
</h1>
<?php 
global $conn;
$id = $_GET['id'];
$sql_fetch = "SELECT * FROM `products` WHERE product_id = {$id}";
$execute = mysqli_query($conn, $sql_fetch);
$row = mysqli_fetch_assoc($execute);

$sql_fetch_catname = "SELECT * FROM `category` WHERE cat_id = {$row['product_category_name']}";
$result_catname = mysqli_query($conn, $sql_fetch_catname);
$row_2 = mysqli_fetch_assoc($result_catname);


?>

<div class="col-md-4">
    
    <form action="../../template/back/update_name.php" method="post">
    
        <div class="form-group">
            <label for="Product_Name">Product Name</label>
            <input autocomplete="off" type="text" name="changed_name" class="form-control" value="<?php echo $row['product_name']; ?>">
        </div>
        <div class="form-group">
            <label for="Product_Desc">Product Description</label>
            <textarea autocomplete="off" type="text" name="changed_desc" class="form-control" value=""><?php echo $row['product_long_desc']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="Product_ShortDesc">Product Short Description</label>
            <textarea autocomplete="off" type="text" name="changed_shrt_desc" class="form-control" value=""><?php echo $row['product_short_desc']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="Product_Catergory">Product Category</label>
            <select name="changed_product_category" class="form-control">
            <option value="<?php echo $row['product_category_name'];?>"><?php echo $row_2['cat_name'];?></option>
            <?php display_cat_in_add_product();?>
            </select>
        </div>
    </div>
        <div class="form-group">
            <input hidden = 'true' type="text" name='id' value="<?php echo $_GET['id'];?>">
            <input type="submit" class="btn btn-primary" value="Update Product Details">
        </div>      


    </form>


</div>