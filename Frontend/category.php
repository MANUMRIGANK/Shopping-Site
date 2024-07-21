<?php 

   require('../config.php');
   include(TEMPLATE_FRONT . '\header.php');
?>
<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_FRONT . '\navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3><?php $id=$_GET['id'];
                $sql = "SELECT `cat_name` FROM `category` where cat_id = {$id}";
                $fetching = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($fetching);
                echo $row['cat_name'];
                ?></h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php display_products_categorywise();?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . '\footer.php'); ?>   