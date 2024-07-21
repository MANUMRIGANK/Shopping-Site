<?php

require('../../config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style=" overflow-x: hidden; /* Initially hide the scrollbar */">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?view_products"><i class="fa fa-fw fa-bar-chart-o"></i> View Products</a>
                    </li>
                    <li>
                        <a href="index.php?add_products"><i class="fa fa-fw fa-table"></i> Add Product</a>
                    </li>

                    <li>
                        <a href="index.php?Categories"><i class="fa fa-fw fa-desktop"></i> Categories</a>
                    </li>
                    <li>
                        <a href="index.php?orders"><i class="fa fa-fw fa-wrench"></i>Orders</a>
                    </li>
                    <li>
                        <a href="index.php?slides"><i class="fa fa-newspaper-o"></i> Slides</a>
                    </li>
                    <li>
                        <a href="index.php?add_user"><span class="glyphicon glyphicon-user"></span> Add User</a>
                    </li>
                    <li>
                        <a href="index.php?View_store"><span class="glyphicon glyphicon-home"></span> View Store</a>
                    </li>
                    <li>
                        <a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> LogOut</a>
                    </li>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>



        <div id="page-wrapper">

            <div class="container-fluid">
                <?php
                fail_msg();
                success_msg();
                warn_msg();
                ?>

                <?php


                if (isset($_SESSION['admin_login'])) {

                    if (isset($_GET['dashboard'])) {
                        include '../../template/back/dashboard.php';
                    } elseif (isset($_GET['Categories'])) {
                        include '../../template/back/categories.php';
                    } elseif (isset($_GET['update_category'])) {
                        include '../../template/back/update_category.php';
                    } elseif (isset($_GET['add_products'])) {
                        include '../../template/back/add_product.php';
                    } elseif (isset($_GET['slides'])) {
                        include '../../template/back/slides.php';
                    } elseif (isset($_GET['logout'])) {
                        include '../../template/back/logout.php';
                    } elseif (isset($_GET['view_products'])) {
                        include '../../template/back/products.php';
                    } elseif (isset($_GET['edit_product'])) {
                        include '../../template/back/edit_product_options.php';
                    } elseif (isset($_GET['update_price'])) {
                        include '../../template/back/update_price.php';
                    } elseif (isset($_GET['update_qty'])) {
                        include '../../template/back/update_qty.php';
                    } elseif (isset($_GET['update_name'])) {
                        include '../../template/back/update_names.php';
                    } elseif (isset($_GET['add_user'])) {
                        include '../../template/back/add_user.php';
                    }elseif (isset($_GET['View_store'])) {
                            redirect("../");
                    }else{
                        include '../../template/back/dashboard.php';
                    }
                } else {
                    redirect("../");
                }

                ?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>