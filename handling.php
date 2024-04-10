<?php
include("connectDB.php");

$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);
$confirm_pass = test_input($_POST["confirmPassword"]);
$email = test_input($_POST["email"]);
$type = $_POST["type"];

$name_query = "SELECT * FROM users WHERE user_name = '$username'";
$name_result = mysqli_query($conn, $name_query);
$user_row = mysqli_num_rows($name_result);

if ($user_row > 0) {
    $usernameErr = "Username already used.";
}

$pass_query = "SELECT user_password FROM users";
$pass_result = mysqli_query($conn, $pass_query);

if ($pass_result) {
    while ($row = mysqli_fetch_assoc($pass_result)) {
        if (password_verify($password, $row["user_password"])) {
            $passwordErr = "Password already used.";
        }
    }
}

$email_query = "SELECT * FROM users WHERE user_email = '$email'";
$email_result = mysqli_query($conn, $email_query);
$email_row = mysqli_num_rows($email_result);

if ($email_row > 0) {
    $emailErr = "Email already used.";
}

if ($user_row == 0 && $passwordErr == "" && $email_row == 0) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, user_password, user_email, user_type) VALUES ('$username', '$passwordHash', '$email', '$type')";
    mysqli_query($conn, $sql);
    header("Location: login.php"); 
}

include("signup.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
