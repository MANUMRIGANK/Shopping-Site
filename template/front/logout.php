<?php
if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    setcookie('user_name', '', time() + (86400 * 30), '/');
    setcookie('user_pass', '', time() + (86400 * 30), '/');
    redirect("../Frontend/index.php");
}
?>