<?php
//helper functions
function success_msg()
{
    if (isset($_SESSION['successmsg'])) {
        if ($_SESSION["successmsg"] != '') {

            echo <<<html
            <div class="container">
                <div class="alert alert-success">
                    <strong>{$_SESSION["successmsg"]}</strong>
                </div>
            </div>
    html;
            $_SESSION["successmsg"] = '';
        }
    }
}

function warn_msg()
{
    if (isset($_SESSION['warn'])) {
        if ($_SESSION["warn"] != '') {

            echo <<<html
            <div class="container">
                <div class="alert alert-warning">
                    <strong>{$_SESSION["warn"]}</strong>
                </div>
            </div>
    html;
            $_SESSION["warn"] = '';
        }
    }
}

function fail_msg()
{
    if (isset($_SESSION['failmsg'])) {
        if ($_SESSION["failmsg"] != '') {
            echo <<<html
            <div class="container">
                <div class="alert alert-danger">
                    <strong>{$_SESSION["failmsg"]}</strong>
                </div>
            </div>
    html;
            $_SESSION["failmsg"] = '';
        }
    }
}

function redirect($url)
{
    header("Location: " . $url);
    die();
}
// display side bar category
function display_category()
{

    global $conn;

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            echo <<<html
                
                <a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row["cat_name"]}</a>
        html;
        }
    } else {
        echo 'baka';
    }
}

// submitting contact form 
function contact_form()
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $message = $_POST['message'];
        global $conn;

        $sql = "INSERT INTO `contact_forms`(`name`, `email`, `number`, `Message`) VALUES ('{$name}','{$email}','{$number}','{$message}')";
        $insertion = mysqli_query($conn, $sql);

        if ($insertion) {
            $_SESSION["successmsg"] = "Successfully Send The Details";
        } else {
            $_SESSION["failmsg"] = "Failed To Send The Details";
        }
        redirect("../../Frontend/contact.php");
    }
}

//create account
function add_account()
{
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['fname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['Address'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        if ($pass === $cpass) {

            $sql_1 = "SELECT * FROM `users` WHERE username = '{$username}'";
            $sql_2 = "SELECT * FROM `users` WHERE email = '{$email}'";
            $result2 = mysqli_query($conn, $sql_2);
            $result = mysqli_query($conn, $sql_1);
            if (mysqli_num_rows($result) > 0) {

                $_SESSION["warn"] = "Username Already Exists";
                redirect("../../Frontend/add-user.php");
            } elseif (mysqli_num_rows($result2) > 0) {
                $_SESSION["warn"] = "Email Already Exists";
                redirect("../../Frontend/add-user.php");
            } else {

                $hashed_password = password_hash($cpass, PASSWORD_BCRYPT);
                $sql = "INSERT INTO `users`(`username`, `password`,`city`,`state`, `address`, `name`, `number`, `email`, `user_type`) VALUES ('{$username}','{$hashed_password}','{$city}','{$state}','{$address}','{$name}','{$number}','{$email}','CUSTOMER')";

                $insertion = mysqli_query($conn, $sql);
                if ($insertion) {
                    $_SESSION["successmsg"] = "Successfully Created Account";
                } else {
                    $_SESSION["failmsg"] = "Failed To Create Account Try Again";
                }
                redirect("../../Frontend/login.php");
            }
        } else {
            $_SESSION["failmsg"] = "Password and ReTyped password doesn't match";
            redirect("../../Frontend/add-user.php");
        }
    }
}

//login function 
function login()
{
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE username = '{$username}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $db_pass = $row['password'];
            $acc_type = $row['user_type'];
            $user_id  = $row['user_id'];

            $bool = password_verify($pass, $db_pass);
            if ($bool == true) {
                if ($acc_type == 'CUSTOMER') {
                    $_SESSION['user_id'] = $user_id;
                    setcookie("user_name", $username, time() + (86400 * 30), "/");
                    setcookie("user_pass", $pass, time() + (86400 * 30), "/");
                    redirect("../../Frontend/index.php");
                } elseif ($acc_type == 'ADMIN') {
                    $_SESSION['admin_login'] = 'ADMIN LOGGES IN';
                    setcookie("user_name", $username, time() + (86400 * 30), "/");
                    setcookie("user_pass", $pass, time() + (86400 * 30), "/");
                    redirect("../../Frontend/admin");
                }
            } else {
                $_SESSION["failmsg"] = "Wrong Password";
                redirect("../../Frontend/login.php");
            }
        } else {
            $_SESSION["warn"] = "Username Doesn't Exist";
            redirect("../../Frontend/login.php");
        }
    }
}

function login_using_cookies()
{
    global $conn;
    if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_pass'])) {
        $username = $_COOKIE['user_name'];
        $pass = $_COOKIE['user_pass'];
        $sql = "SELECT * FROM `users` WHERE username = '{$username}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $db_pass = $row['password'];
            $acc_type = $row['user_type'];
            $user_id  = $row['user_id'];

            $bool = password_verify($pass, $db_pass);
            if ($bool == true) {
                if ($acc_type == 'CUSTOMER') {
                    $_SESSION['user_id'] = $user_id;
                } elseif ($acc_type == 'ADMIN') {
                    $_SESSION['admin_login'] = 'ADMIN LOGGES IN';
                }
            }
        }
    }
}

// display profile 
function update_account()
{
    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['fname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['Address'];
        $username = $_POST['username'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        $sql_1 = "SELECT * FROM `users` WHERE username = '{$username}'";
        $sql_2 = "SELECT * FROM `users` WHERE email = '{$email}'";
        $result2 = mysqli_query($conn, $sql_2);
        $result = mysqli_query($conn, $sql_1);
        while ($row = mysqli_fetch_assoc($result)) {
            $username_fromdb = $row['username'];
        }
        while ($row = mysqli_fetch_assoc($result2)) {
            $email_fromdb = $row['email'];
        }

        if ($username == $username_fromdb || $email == $email_fromdb) {

            $sql = "UPDATE `users` SET `username`='{$username}',`address`='{$address}',`city`='{$city}',`state`='{$state}',`name`='{$name}',`number`='{$number}',`email`='{$email}' WHERE user_id = {$_SESSION['user_id']}";
            $insertion = mysqli_query($conn, $sql);
            if ($insertion) {
                $_SESSION["successmsg"] = "Successfully Updated Account";
            } else {
                $_SESSION["failmsg"] = "Failed To Update Account Try Again";
            }
            redirect("../../Frontend/profile.php");
        } elseif (mysqli_num_rows($result) > 0) {

            $_SESSION["warn"] = "Username Already Exists";
            redirect("../../Frontend/profile.php?update_profile");
        } elseif (mysqli_num_rows($result2) > 0) {
            $_SESSION["warn"] = "Email Already Exists";
            redirect("../../Frontend/profile.php?update_profile");
        } else {
            $sql = "INSERT INTO `users`(`username`, `city`,`state`, `address`, `name`, `number`, `email`) VALUES ('{$username}','{$city}','{$state}','{$address}','{$name}','{$number}','{$email}')";
            $insertion = mysqli_query($conn, $sql);
            if ($insertion) {
                $_SESSION["successmsg"] = "Successfully Updated Account";
            } else {
                $_SESSION["failmsg"] = "Failed To Update Account Try Again";
            }
            redirect("../../Frontend/profile.php");
        }
    }
}

//add catergory
function add_catergory()
{

    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $name = $_POST['catergoryname'];
        $sql_for_cheking_if_category_exists = "SELECT * FROM `category` WHERE cat_name = '{$name}'";
        $result = mysqli_query($conn, $sql_for_cheking_if_category_exists);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["warn"] = "Catergory Named " . $name . " Already Exists";
        } else {
            $sql = "INSERT INTO `category`(`cat_name`) VALUES ('$name')";
            $insert = mysqli_query($conn, $sql);
            if ($insert) {
                $_SESSION["successmsg"] = "Successfully Created Catergory Named " . $name;
            } else {
                $_SESSION["failmsg"] = "Failed To Create Category Named " . $name;
            }
        }
    }
    redirect("../../Frontend/admin/index.php?Categories");
}

// display catergory
function display_category_in_admin()
{

    global $conn;
    $sql = "SELECT * FROM `category`";
    $execution = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($execution)) {

        echo <<<html
                    <tr>
                        <td>{$i}</td>
                        <td id="catname_{$row['cat_id']}">{$row['cat_name']}</td>
                        <td><a href="index.php?update_category&cat_name={$row['cat_name']}&catid={$row['cat_id']}">Update</a></td>
                        <td><a href="../../template/back/delete_cat_admin.php?cat_name={$row['cat_name']}&catid={$row['cat_id']}">Delete</a></td>
                        <td style="visibility:hidden;">{$row['cat_id']}</td>                    
                    </tr>
            html;
        $i++;
    }
}


function delete_cat()
{
    global $conn;
    if (isset($_GET['catid'])) {
        $cat_id = $_GET['catid'];
        $sql_check = "SELECT * FROM `products` WHERE product_category_name = '$cat_id'";
        $result = mysqli_query($conn, $sql_check);
        $number_of_products = mysqli_num_rows($result);
        if ($number_of_products > 0) {
            $_SESSION['successmsg'] = "There Are " . $number_of_products . " Products With this category";
        } else {

            $cat_name = $_GET['cat_name'];
            $sql = "DELETE FROM `category` WHERE cat_id = $cat_id";
            $deletion = mysqli_query($conn, $sql);

            if ($deletion) {
                $_SESSION["successmsg"] = "Successfully Deleted Catergory Named " . $cat_name;
            } else {
                $_SESSION["failmsg"] = "Failed to Delete Catergory Named " . $cat_name;
            }
            redirect("../../Frontend/admin/index.php?Categories");
        }
    }
}

function update_category()
{
    global $conn;
    if (isset($_POST['submit'])) {
        $update_name = $_POST['updated_catergory_name'];
        $cat_id_to_be_updated = $_POST['updated_catergory_id'];
        $old_cat_name = $_POST['old_catergory_name'];
        $sql = "UPDATE `category` SET `cat_name`='{$update_name}' WHERE cat_id={$cat_id_to_be_updated}";
        $updation = mysqli_query($conn, $sql);
        if ($updation) {
            $_SESSION["successmsg"] = "Successfully Updated Catergory Named " . $old_cat_name . " To " . $update_name;
        } else {
            $_SESSION["failmsg"] = "Failed to Update Catergory Named " . $old_cat_name . " To " . $update_name;
        }
        redirect("../../Frontend/admin/index.php?Categories");
    }
}


function delete_slide()
{

    global $conn;
    if (isset($_GET['slide_id'])) {

        $slide_id = $_GET['slide_id'];
        $slide_name = $_GET['slide_name'];

        $sql = "SELECT `slide_img` FROM `slide` WHERE slide_id=$slide_id";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        $file_2b_deleted = $row['slide_img'];
        $files_dir = '../../files/slideimg/';
        $file_exists_or_not = file_exists($files_dir . $file_2b_deleted);
        if ($file_exists_or_not != true || $file_exists_or_not = true) {
            $unlink = unlink($files_dir . $file_2b_deleted);
            if (!$unlink) {
                $_SESSION["failmsg"] = "Failed to Delete Slide File But It Wont appear ";
            }
            $sql = "DELETE FROM `slide` WHERE slide_id = $slide_id";
            $deletion = mysqli_query($conn, $sql);

            if ($deletion) {
                $_SESSION["successmsg"] = "Successfully Deleted Slide Named " . $slide_name;
            } else {
                $_SESSION["failmsg"] = "Failed to Delete Slide Named " . $slide_name;
            }
        } else {
            $_SESSION["failmsg"] = "UnKnown Error Occured";
        }
        redirect("../../Frontend/admin/index.php?slides");
    }
}

function display_slides_inadmin()
{

    global $conn;
    $sql = "SELECT * FROM `slide`";
    $execution = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($execution)) {

        echo <<<html
                    <tr>
                        <td>{$i}</td>
                        <td id="catname_{$row['slide_id']}">{$row['slide_name']}</td>
                        <td><div class="rightImg"><img height='50px' width='50px' src='../../files/slideimg/{$row['slide_img']}' alt="image"/></div></td>
                        <td><a href="../../template/back/delete_slide_admin.php?slide_name={$row['slide_name']}&slide_id={$row['slide_id']}">Delete</a></td>
                        <td style="visibility:hidden;">{$row['slide_id']}</td>                    
                    </tr>
            html;
        $i++;
    }
}

function add_silde()
{
    global $conn;
    $target_dir = '../../files/slideimg/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION["failmsg"] = 'File is not an image';
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION["failmsg"] = 'Sorry, file already exists.';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION["failmsg"] = 'Sorry, your file is too large.';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION["failmsg"] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_SESSION["failmsg"] = 'Sorry, your file was not uploaded.';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $name = $_POST['slide_name'];
            $file_name = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
            $sql = "INSERT INTO `slide` (`slide_name`, `slide_img`) VALUES ('{$name}','{$file_name}')";
            $insertion = mysqli_query($conn, $sql);
            if ($insertion) {
            } else {
                $_SESSION["failmsg"] = 'An Error Occured';
            }
        } else {
            $_SESSION["failmsg"] = 'Sorry, there was an error uploading your file.';
        }
    }
    redirect("../../Frontend/admin/index.php?slides");
}

function display_carousel()
{
    global $conn;
    $sql = "SELECT * FROM `slide`";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        echo <<<kartik
                    <div  class = 'item'>
                        <img style = "height:300px; width:800px;"  class = 'slide-image' src='../files/slideimg/{$row['slide_img']}' alt=''>
                    </div>
        kartik;
    }
}

function getting_the_caraousel_dots()
{
    global $conn;
    $sql = "SELECT * FROM `slide`";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    for ($i = 1; $i <= $count; $i++) {
        echo <<<html
                    <li data-target="#carousel-example-generic" data-slide-to="{$i}"></li>
    html;
    }
}

function display_cat_in_add_product()
{

    global $conn;

    $sql = "SELECT * FROM `category`";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {

        echo <<<html
                <option value="{$row['cat_id']}">{$row['cat_name']}</option>
    html;
    }
}

function add_product()
{

    global $conn;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $target_dir = '../../files/product_img/';
        $uploadOk_main = 1;
        // $uploadOk_thumbnail = 1;
        $main_img = $target_dir . basename($_FILES["file"]["name"]);
        $thumbnail = $target_dir . basename($_FILES["thumbnail"]["name"]);
        $main_imageFileType = strtolower(pathinfo($main_img, PATHINFO_EXTENSION));
        // $thumbnail_FileType = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check_main = getimagesize($_FILES["file"]["tmp_name"]);
            // $check_thumbnail = getimagesize($_FILES["thumbnail"]["tmp_name"]);
            if ($check_main !== false /* && $check_thumbnail !== false */) {
                $uploadOk_main = 1;
                // $check_thumbnail = 1;
            } elseif ($check_main == false) {
                $_SESSION["failmsg"] = 'Main Image is not an image';
                $uploadOk_main = 0;
            }   // elseif ($check_thumbnail == false) {
            //     $_SESSION["failmsg"] = 'Thumbnail Image is not an image';
            //     $uploadOk_thumbnail = 0;
            // }
        }
        // Check if file already exists
        if (file_exists($main_img)) {
            $_SESSION["failmsg"] = 'Sorry, Main Image already exists rename and try again.';
            $uploadOk_main = 0;
        }   //elseif (file_exists($thumbnail)) {
        // $_SESSION["failmsg"] = 'Sorry, Thumbnail Image already exists rename and try again.';
        // $uploadOk_thumbnail = 0;
        //}


        // Check file size
        if ($_FILES["file"]["size"] > 1000000) {
            $_SESSION["failmsg"] = 'Sorry, your Main Image is too large.';
            $uploadOk_main = 0;
        }   //elseif ($_FILES["thumbnail"]["size"] > 1000000) {
        // $_SESSION["failmsg"] = 'Sorry, your thumbnail file is too large.';
        // $uploadOk_thumbnail = 0;
        //}


        // Allow certain file formats
        if (
            $main_imageFileType != "jpg" && $main_imageFileType != "png" && $main_imageFileType != "jpeg"
            && $main_imageFileType != "gif" /* &&  $thumbnail_FileType != "jpg" && $thumbnail_FileType != "png" && $thumbnail_FileType != "jpeg"
            && $thumbnail_FileType != "gif" */
        ) {
            $_SESSION["failmsg"] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk_main = 0;
            // $uploadOk_thumbnail = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        //elseif ($uploadOk_thumbnail == 0) {
        //  $_SESSION["warn"] = 'Sorry, your Thumbnail was not uploaded.';
        /* } */
        if ($uploadOk_main == 0) {
            $_SESSION["warn"] = 'Sorry, your Main Image was not uploaded.';
        } else {


            $name         = $_POST['product_title'];
            $price        = $_POST['product_price'];
            $short_desc   = $_POST['product_short_description'];
            $long_desc    = $_POST['product_description'];
            $category     = $_POST['product_category'];
            $draft_or_not = $_POST['action'];
            $pro_qty      = $_POST['product_quantity'];
            $main_upload = move_uploaded_file($_FILES["file"]["tmp_name"], $main_img);
            //$thumbnail_upload = move_uploaded_file($_FILES["thumbail"]["tmp_name"], $thumbnail);


            if ($main_upload == true /* && $thumbnail_upload == true */) {
                $main_file_name = htmlspecialchars(basename($_FILES["file"]["name"]));
                //$thumbnail_file_name = htmlspecialchars(basename($_FILES["thumbnail"]["name"]));
                if ($draft_or_not === 'Draft') {
                    $draft = 1;
                    $draft_msg = "Drafted";
                } elseif ($draft_or_not === 'Publish') {
                    $draft = 0;
                    $draft_msg = "Publised";
                }
                $sql = "INSERT INTO `products`(`product_name`, `product_category_name`, `product_short_desc`, `product_long_desc`, `product_price`, `product_main_img`, `product_thumbnail`, `draft`, `product_quantity`) VALUES ('{$name}','{$category}','{$short_desc}','{$long_desc}','{$price}','{$main_file_name}','{$main_file_name}','{$draft}', '{$pro_qty}')";
                $insertion = mysqli_query($conn, $sql);
                if ($insertion) {
                    $_SESSION["successmsg"] = 'Successfully ' . $draft_msg  . ' that product ';
                } else {
                    $_SESSION["failmsg"] = 'An Error Occured';
                }
            } /* elseif ($thumbnail_upload !== true) {
                $_SESSION["failmsg"] = 'Sorry, there was an error uploading Thumbnail.';
            } */ elseif ($main_upload !== true) {
                $_SESSION["failmsg"] = 'Sorry, there was an error uploading Main Img.';
            } else {
                $_SESSION["failmsg"] = 'BKL UNKnown error hai';
            }
        }
    } else {
        $_SESSION["failmsg"] = 'some error occured try again';
        redirect("../../Frontend/admin/Index.php?add_products");
    }

    redirect("../../Frontend/admin/Index.php?add_products");
}

function display_product_in_admin()
{
    global $conn;
    $sql = "SELECT * FROM `products`";
    $query = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        $sql_fetch_cat_name = "SELECT * FROM `category` WHERE cat_id = {$row['product_category_name']}";
        $fetching = mysqli_query($conn, $sql_fetch_cat_name);
        $row_two = mysqli_fetch_assoc($fetching);
        echo <<<html
        <tr>
                    <td>{$i}</td>
                    <td>{$row['product_name']}<br>
                    <img height="62" width="62" src="../../files/product_img/{$row['product_main_img']}" alt="Img">
                    </td>
                    <td>{$row_two['cat_name']}</td>
                    <td>{$row['product_price']}</td>
                    <td>{$row['product_quantity']}</td>
                    <form action="../../template/back/product_editing.php" method="post">
                        <td><input id="draft_{$row['product_id']}" type="submit" name="action" class="btn btn-warning btn-lg" value="Draft"></td>
                        <td><input id="publish_{$row['product_id']}" type="submit" name="action" class="btn btn-primary btn-lg" value="Publish"></td>
                        <th><a href = "../../Frontend/admin/index.php?edit_product&id={$row['product_id']}">Update</a></th>
                        <td><input type="submit" name="action" class="btn btn-danger btn-lg" value="Delete"></td>
                        
                        <td><input hidden type="text" name="product_id" value="{$row['product_id']}"></td>
                    </form>
                    
                    </tr>
        html;
        $i++;

        if ($row['draft'] == 0 && $row['product_quantity'] != 0) {
?> <script>
                document.getElementById("draft_<?php echo $row['product_id']; ?>").disabled = false;
                document.getElementById("publish_<?php echo $row['product_id']; ?>").disabled = true;
            </script> <?php
                    } elseif ($row['draft'] == 1 && $row['product_quantity'] != 0) {
                        ?><script>
                document.getElementById("draft_<?php echo $row['product_id']; ?>").disabled = true;
                document.getElementById("publish_<?php echo $row['product_id']; ?>").disabled = false;
            </script><?php
                    } else {
                        ?> <script>
                document.getElementById("draft_<?php echo $row['product_id']; ?>").disabled = true;
                document.getElementById("publish_<?php echo $row['product_id']; ?>").disabled = true;
            </script> <?php
                    }
                }
            }

            function editing_product_draft_delete_publish()
            {
                global $conn;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['action'])) {
                        $product_id = $_POST['product_id'];
                        $action = $_POST['action'];

                        if ($action == "Draft") {
                            $sql = "UPDATE `products` SET `draft`='1' WHERE product_id = {$product_id}";
                            $execution = mysqli_query($conn, $sql);

                            if ($execution) {
                                $_SESSION["successmsg"] = "Successfully Added The Product To Draft";
                            } else {
                                $_SESSION["failmsg"] = "Failed to Add Product To Draft";
                            }
                        } elseif ($action == 'Publish') {

                            $sql = "UPDATE `products` SET `draft`='0' WHERE product_id = {$product_id}";
                            $execution = mysqli_query($conn, $sql);
                            if ($execution) {
                                $_SESSION["successmsg"] = "Successfully Published The Product To Shop";
                            } else {
                                $_SESSION["failmsg"] = "Failed to Publish Product To Shop";
                            }
                        } elseif ($action == 'Delete') {

                            $sql = "DELETE FROM `products` WHERE product_id={$product_id}";
                            $execution = mysqli_query($conn, $sql);
                            if ($execution) {
                                $_SESSION["successmsg"] = "Successfully Deleted The Product";
                            } else {
                                $_SESSION["failmsg"] = "Failed to Delete Product";
                            }
                        }
                    } else {
                        $_SESSION["failmsg"] = "You can't access the page like that";
                    }

                    redirect("../../Frontend/admin/Index.php?view_products");
                } else {

                    $_SESSION["failmsg"] = "No Post Request Made";
                    redirect("../../Frontend/admin/Index.php?view_products");
                }
            }

            function edit_product_price()
            {
                global $conn;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $new_price = $_POST['price_changed'];
                    $sql = "UPDATE `products` SET `product_price`='{$new_price}' WHERE product_id={$id}";
                    $execution = mysqli_query($conn, $sql);

                    if ($execution) {
                        $_SESSION['successmsg'] = "Price Edited SuccessFully";
                    } else {
                        $_SESSION['failmsg'] = "Some Error Occured Updating Price";
                    }
                } else {
                    $_SESSION['failmsg'] = "Some Error Occured Editing Price";
                }
                redirect("../../Frontend/admin/Index.php?view_products");
            }

            function edit_product_qty()
            {
                global $conn;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $new_qty = $_POST['qty_changed'];
                    $sql = "UPDATE `products` SET `product_quantity`='{$new_qty}' WHERE product_id={$id}";
                    $execution = mysqli_query($conn, $sql);

                    if ($execution) {
                        $_SESSION['successmsg'] = "Quantity Edited SuccessFully";
                    } else {
                        $_SESSION['failmsg'] = "Some Error Occured Updating Quantity";
                    }
                } else {
                    $_SESSION['failmsg'] = "Some Error Occured Editing Quantity";
                }
                redirect("../../Frontend/admin/Index.php?view_products");
            }


            function update_name_desc_shortdesc()
            {
                global $conn;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $changed_name = $_POST['changed_name'];
                    $changed_caterogory = $_POST['changed_product_category'];
                    $changed_long_desc = $_POST['changed_desc'];
                    $changed_short_desc = $_POST['changed_shrt_desc'];
                    $sql = "UPDATE `products` SET `product_name`='{$changed_name}',`product_category_name`='{$changed_caterogory}',`product_short_desc`='{$changed_short_desc}',`product_long_desc`='{$changed_long_desc}' WHERE product_id={$id}";
                    $execution = mysqli_query($conn, $sql);
                    if ($execution) {
                        $_SESSION['successmsg'] = "Succesfully edited product details";
                    } else {
                        $_SESSION['successmsg'] = "Some error occured while edited product details";
                    }
                } else {
                    $_SESSION['failmsg'] = "Some Error Occured Editing Name, Description, Short Description and Category";
                }
                redirect("../../Frontend/admin/Index.php?view_products");
            }


            function display_admins_in_admin()
            {
                global $conn;
                $sql = "SELECT * FROM `users` WHERE user_type = 'ADMIN'";
                $fetching = mysqli_query($conn, $sql);
                if ($fetching) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($fetching)) {
                        echo <<<html
                            <tr>
                            <th>{$i}</th>
                            <th>{$row['username']}</th>
                            <th>{$row['name']}</th>
                            <th><a href = "../../template/back/delete_admin.php?id={$row['user_id']}&name={$row['name']}">Delete</a></th>
                            </tr>
                html;
                        $i++;
                    }
                } else {
                    $_SESSION['failmsg'] = "Some error Occured";
                    redirect("../../Frontend/admin/index.php?add_user");
                }
            }


            function add_admin()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $username = $_POST['username'];
                    global $conn;

                    $check_if_username_exist = "SELECT * FROM `users` WHERE username = '$username'";
                    $result = mysqli_query($conn, $check_if_username_exist);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $_SESSION['failmsg'] = "Sorry Username Already Exists";
                        } else {
                            $name = $_POST['name'];
                            $pass = $_POST['pass'];
                            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
                            $sql = "INSERT INTO `users`(`username`, `password`, `name`,`user_type`) VALUES ('{$username}','{$hashed_password}','{$name}','ADMIN')";
                            if (mysqli_query($conn, $sql)) {
                                $_SESSION['successmsg'] = "Succesfully Added New Admin With name " . $name . " and username " . $username;
                            } else {
                                $_SESSION['failmsg'] = "Failed To Add Admin Named . " . $name;
                            }
                        }
                    } else {
                        $_SESSION['failmsg'] = "error occured while fetching number of rows";
                    }
                } else {
                    $_SESSION['failmsg'] = "Some error Occured";
                }
                redirect("../../Frontend/admin/index.php?add_user");
            }


            function delete_admin()
            {
                global $conn;
                if (isset($_GET['id']) && isset($_GET['name'])) {
                    $id = $_GET['id'];
                    $name = $_GET['name'];

                    // Use prepared statements to prevent SQL injection
                    $stmt = $conn->prepare("DELETE FROM `users` WHERE user_id = ?");
                    $stmt->bind_param("s", $id);

                    if ($stmt->execute()) {
                        if ($stmt->affected_rows > 0) {
                            $_SESSION['successmsg'] = "Successfully deleted Admin Named " . htmlspecialchars($name);
                        } else {
                            $_SESSION['failmsg'] = "No admin found with the username " . htmlspecialchars($id);
                        }
                    } else {
                        $_SESSION['failmsg'] = "Something went wrong while deleting admin";
                    }
                    $stmt->close();
                } else {
                    $_SESSION['failmsg'] = "Get Request Not Found";
                }
                redirect("../../Frontend/admin/index.php?add_user");
            }


            function display_products_categorywise()
            {
                global $conn;
                if (isset($_GET['id'])) {
                    $cat_id = $_GET['id'];

                    $sql = "SELECT * FROM `products` WHERE product_category_name = {$cat_id} AND draft = 0";
                    $execution = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($execution)) {
                        echo <<<html
                        <div class="col-md-3 col-sm-6 hero-feature">
                            <div class="thumbnail">
                                <img style="height:200px; width:300px;" src="../files/product_img/{$row['product_thumbnail']}" alt="images">
                                <div class="caption">
                                    <h3>Feature Label</h3>
                                    <p>Lorem ipsum dolor sit .</p>
                                    <p>
                                        <a href="../cart.php?add={$row['product_id']}" class="btn btn-primary">Add To Cart!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                html;
                    }
                } else {
                    redirect("index.php");
                }
            }
