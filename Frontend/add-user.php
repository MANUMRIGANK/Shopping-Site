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
        <h3>Create Account</h3>

    <form action="../template/front/addaccount.php" method='post'>
        <div class='row'>
            <div class='col-sm-6'>
                <label for="fname">Full Name:</label>
                <input type="text" name='fname' class="form-control" required>
                <label for="email">Email:</label>
                <input type="email" name='email' class="form-control" required>
                <label for="number">Number:</label>
                <input type="text" name='number' class="form-control" required>
                <label for="Address">Address:</label>
                <textarea type="text" name='Address' class="form-control"></textarea>
            </div>
            <div class='col-sm-6'>
                <label for="username">Username:</label>
                <input type="text" name='username' class="form-control" required>
                <label for="pass">Password:</label>
                <input type="password" name='pass' class="form-control" required>
                <label for="cpass">Retype Password:</label>
                <input type="password" name='cpass' class="form-control" required>

                <div class="row">
                    <div class="col-sm-6">
                    <label for="city">City:</label>
                    <input type="text" name='city' class="form-control" required>
                    </div>
                    <div class="col-sm-6">
                    <label for="state">State:</label>
                    <input type="text" name='state' class="form-control" required>
                    </div>
                </div>
            </div>
        
        
        </div>

        <div style="margin-top: 20px;" class="col-lg-12 text-center">
            <div id="success">
            <button type="submit" class="btn btn-primary"> Register </button>
            </div>
        </div>
    </form>


</div>

<!-- /.container -->

<div class="container">

<hr>
<!-- Footer -->
<?php include(TEMPLATE_FRONT . '\footer.php'); ?>