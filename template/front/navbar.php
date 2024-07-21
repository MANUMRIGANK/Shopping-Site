<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Shop</a>
                </li>

                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>

                <?php }
                //checks if admin is logges in if he is logged in only then the admin navbar element will be visible
                elseif (isset($_SESSION['admin_login'])) {
                ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>

                <?php
                } ?>
                <li>
                    <a href="checkout.php">

                        <div class="containerofcircle">
                            Checkout
                            <div class="circle">
                                <span class="number"><?php if (isset($_SESSION['just_for_green_circle_number']) && $_SESSION['just_for_green_circle_number'] != 0) {
                                                            echo $_SESSION['just_for_green_circle_number'];
                                                        } ?></span>
                            </div>
                        </div>

                    </a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<?php if (isset($_SESSION['just_for_green_circle_number']) && $_SESSION['just_for_green_circle_number'] != 0) { ?>
    <style>
        .containerofcircle {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10%;
        }

        .circle {
            width: 20px;
            height: 20px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: .8em;
            font-family: Arial, sans-serif;
        }

        .number {
            display: inline-block;
        }
    </style>

<?php } ?>