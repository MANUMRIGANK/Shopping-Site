<?php

require('../config.php');
include(TEMPLATE_FRONT . '\header.php');
fail_msg();
success_msg();
warn_msg();
?>

<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_FRONT . '\navbar.php'); ?>
    <!-- Page Content -->
    <div class="container">
        <h3>Profile</h3>

        <div class="row">
            <div class="col-md-3">
                <?php include(TEMPLATE_FRONT . '\sidebar_for_profile.php') ?>
            </div>
            <div class="col-md-6">

                <?php
                if (isset($_GET['update_profile']) && isset($_SESSION['user_id'])) {
                    include(TEMPLATE_FRONT . '\update_profile.php');
                } elseif (isset($_GET['orders']) && isset($_SESSION['user_id'])) {
                } elseif (isset($_GET['wishlist']) && isset($_SESSION['user_id'])) {
                } elseif (isset($_GET['logout']) && isset($_SESSION['user_id'])) {
                    include(TEMPLATE_FRONT . '\logout.php');
                } else {

                    if (isset($_SESSION['user_id'])) {

                        global $conn;
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `users` WHERE user_id = $user_id";
                        $execution = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($execution)) {

                ?>


                            <p>
                                <label>Name:</label>
                                <?php echo $row['name']; ?>
                            </p>
                            </br>
                            <p>
                                <label>Username:</label>
                                <?php echo $row['username'];
                                ?>
                            </p>
                            </br>
                            <p>
                                <label>Email:</label>
                                <?php echo $row['email']; ?>
                            </p>
                            </br>
                            <p>
                                <label>Number:</label>
                                <?php echo $row['number']; ?>
                            </p>
                            </br>
                            <p>
                                <label>Address:</label>
                                <?php echo $row['address'];
                                ?>
                            </p>
                            </br>
                            <p>
                                <label>City:</label>
                                <?php echo $row['city'];
                                ?>
                            </p>
                            </br>
                            <p>
                                <label>State:</label>
                                <?php echo $row['state']; ?>
                            </p>
                            </br>



                <?php
                        }
                    }
                    else{
                        redirect("index.php");
                    }
                }
                ?>
            </div>
        </div>


    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . '\footer.php'); ?>