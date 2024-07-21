<div class="col-md-12">

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        redirect("../../Frontend/admin/index.php?view_products");
    }
    ?>


    <div class="form-group">
        <a href="../../Frontend/admin/index.php?update_qty&id=<?php echo $_GET['id']; ?>">
            <input type="submit" name="update_qty" value='Update Quantity' class="form-control">
        </a>
    </div>
    <div class="form-group">
        <a href="../../Frontend/admin/index.php?update_name&id=<?php echo $_GET['id']; ?>">
            <input type="submit" name="update_name" value='Update Name, Category, Description, Short Description' class="form-control">
        </a>
    </div>
    <div class="form-group">
        <a href="../../Frontend/admin/index.php?update_price&id=<?php echo $_GET['id']; ?>">
            <input type="submit" name="update_price" value='Update Price' class="form-control">
        </a>
    </div>




</div>