<?php 

if(isset($_SESSION['admin_login'])){
    unset($_SESSION['admin_login']);
    
    setcookie('user_name', '', time() + (86400 * 30), '/');
    setcookie('user_pass', '', time() + (86400 * 30), '/');

    redirect("../");
}

?>