<?php
require ("config.php");

session_unset();
session_destroy();

redirect("Frontend/");

?>