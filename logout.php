<?php
session_start();
session_destroy();
setcookie("user_id", -1, time()+60);
header("Location: login.php");
?>
