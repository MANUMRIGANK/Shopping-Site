<h1 class="page-header">
    Update category
</h1>
<div class="col-md-4">

    <form action="../../template/back/update_cat_real.php" method="post">

        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="updated_catergory_name" value="<?php echo $_GET['cat_name']; ?>" class="form-control">
            <input type="hidden" name="updated_catergory_id" value="<?php echo $_GET['catid'];?>">
            <input type="hidden" name="old_catergory_name" value="<?php echo $_GET['cat_name'];?>">
        </div>
        

        <div class="form-group">

            <input type="submit" class="btn btn-warning" name="submit" value="Update Category">
        </div>


    </form>


</div>