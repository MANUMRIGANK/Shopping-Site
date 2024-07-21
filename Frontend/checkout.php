<?php

require('../config.php');
include(TEMPLATE_FRONT . '\header.php');
?>

<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_FRONT . '\navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- /.row -->
        <?php
        success_msg();
        fail_msg();
        ?>
        <div class="row">

            <h1>Checkout</h1>

            <form action="">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub-total</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php cart(); ?>

                    </tbody>
                </table>
            </form>



            <!--  ***********CART TOTALS*************-->

            <div class="col-xs-4 pull-right ">
                <h2>Cart Totals</h2>

                <table class="table table-bordered" cellspacing="0">

                    <tr class="cart-subtotal">
                        <th>Items:</th>
                        <td><span class="amount"><?php echo $_SESSION['item_count']; ?></span></td>
                    </tr>
                    <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>Free Shipping</td>
                    </tr>

                    <tr class="order-total">
                        <th>Order Total</th>
                        <td><strong><span class="amount"><span>&#8377;</span><?php echo $_SESSION['total']; ?></span></strong> </td>
                    </tr>


                    </tbody>

                </table>

            </div><!-- CART TOTALS-->


        </div><!--Main Content-->


        <hr>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . '\footer.php'); ?>