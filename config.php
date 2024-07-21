<?php
ob_start();
session_start();

require_once('functions.php');
require('template/front/header.php');

define('TEMPLATE_FRONT', __DIR__ . '\template\front');
define('TEMPLATE_BACK', __DIR__ . '\template\back');
$conn = mysqli_connect('localhost', 'root', '', 'ecom');

require_once("cart.php");






