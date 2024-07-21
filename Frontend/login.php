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

      <header>
            <h1 class="text-center">Login</h1>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="../template/Front/login.php" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    username<input autocomplete="off" type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input autocomplete="off" type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                  <a href="add-user.php" class="btn btn-primary" style="color:white;">Create account</a>
                </div>
            </form>
            
        </div>  


    </header>


        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <?php include(TEMPLATE_FRONT . '\footer.php'); ?>
