<?php

require('../config.php');
include(TEMPLATE_FRONT . '\header.php');

global $conn;
$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE product_id = '$id'";
$fetch = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($fetch);
?>

<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_FRONT . '\navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Side Navigation -->

        <div class="col-md-3">
            <?php include(TEMPLATE_FRONT . '\sidebar.php') ?>
        </div>

        <div class="col-md-9">

            <!--Row For Image and Short Description-->

            <div class="row">

                <div class="col-md-7">
                    <img class="img-responsive" src="../files/product_img/<?php echo $row['product_main_img']; ?>" alt="">

                </div>

                <div class="col-md-5">

                    <div class="thumbnail">


                        <div class="caption-full">
                            <h4><?php echo $row['product_name']; ?></h4>
                            <hr>
                            <h4 class=""><span>&#8377;</span><?php echo $row['product_price']; ?></h4>

                            <div class="ratings">

                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    4.0 stars
                                </p>
                            </div>

                            <p><?php echo $row['product_short_desc']; ?></p>


                            <a type="button" class="btn btn-primary" href="../cart.php?add=<?php echo $row['product_id']; ?>">Add To Cart</a>
                            <a type="button" class="btn btn-primary" href="../cart.php?add=<?php echo $row['product_id']; ?>">Add To WishList</a>
                        </div>

                    </div>

                </div>


            </div><!--Row For Image and Short Description-->


            <hr>


            <!--Row for Tab Panel-->

            <div class="row">

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <p></p>

                            <p><?php echo $row['product_long_desc']; ?></p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">

                            <div class="col-md-6">

                                <h3>2 Reviews From </h3>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        Anonymous
                                        <span class="pull-right">10 days ago</span>
                                        <p>This product was great in terms of quality. I would definitely buy another!</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        Anonymous
                                        <span class="pull-right">12 days ago</span>
                                        <p>I've alredy ordered another one!</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        Anonymous
                                        <span class="pull-right">15 days ago</span>
                                        <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-6">
                                <h3>Add A review</h3>

                                <form action="" class="form-inline">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="test" class="form-control">
                                    </div>

                                    <div>
                                        <h3>Your Rating</h3>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <textarea name="" id="" cols="60" rows="10" class="form-control"></textarea>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>


            </div><!--Row for Tab Panel-->




        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . '\footer.php'); ?>