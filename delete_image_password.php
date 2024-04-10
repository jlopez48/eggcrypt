<?php
include("connectToDB.php");


if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit; // Stop further execution
}


if(!isset($_COOKIE["delete_image_password_id"]) || $_COOKIE["delete_image_password_id"] < 0) {
    header("Location: dashboard.php");
    exit; // Stop further execution
}


$sql = "DELETE FROM image_passwords WHERE user_id=" . $_COOKIE["user_id"] ." AND image_password_id=". $_COOKIE["delete_image_password_id"] .";";


$result = mysqli_query($conn, $sql);

// close database connection
$conn->close();


setcookie("delete_image_password_id", -1, time() - 3600, "/");


header("Location: dashboard.php");
exit; // Stop further execution
?>
