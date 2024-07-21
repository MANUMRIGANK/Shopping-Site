<div class="col-md-12">

  <div class="row">
    <h1 class="page-header">
      Update Product

    </h1>
  </div>



  <form action="../../template/back/update_product_func.php" method="post" enctype="multipart/form-data">


    <div class="col-md-8">

      <div class="form-group">
        <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">

      </div>


      <div class="form-group">
        <label for="product-title">Product Description</label>
        <textarea name="product_description" id="" cols="30" rows="8" class="form-control"></textarea>
        <label for="product-title">Product Short Description</label>
        <textarea name="product_short_description" id="" cols="30" rows="2" class="form-control"></textarea>
      </div>



      <div class="form-group row">

        <div class="col-xs-3">
          <label for="product-price">Product Price</label>
          <input type="number" name="product_price" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Quantity</label>
          <input type="number" name="product_quantity" class="form-control" size="60">
        </div>
      </div>
      






    </div><!--Main Content-->


    <!-- SIDEBAR-->


    <aside id="admin_sidebar" class="col-md-4">


      <div class="form-group">
        <input type="submit" name="action" class="btn btn-warning btn-lg" value="Update">
      </div>


      <!-- Product Categories-->

      <div class="form-group">
        <label for="product-title">Product Category</label>
        <hr>
        <select name="product_category" id="" class="form-control">
          <option value="">Select Category</option>
          <?php display_cat_in_add_product();?>

        </select>


      </div>





      <!-- Product Brands-->

      <!-- 
      <div class="form-group">
        <label for="product-title">Product Brand</label>
        <select name="product_brand" id="" class="form-control">
          <option value="">Select Brand</option>
        </select>
      </div> -->


      <!-- Product Tags -->


      <!-- <div class="form-group">
        <label for="product-title">Product Keywords</label>
        <hr>
        <input type="text" name="product_tags" class="form-control">
      </div> -->

      <!-- Product Image -->
      <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">

      </div>
      <!-- Product thumbnail Image -->
       <!--
      <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="thumbnail">

      </div>
-->


    </aside><!--SIDEBAR-->



  </form>