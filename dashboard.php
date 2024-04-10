<?php
    if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
	<link rel="stylesheet" href="dashboard.css">
<script src="dashboard.js"></script>

</head>
<body>

  <div class="logo">
    <a href="index.html">
      <img src="logo2.3.png" alt="logo">
      <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;"></span>
    </a>
  </div>
	<form action="logout.php" method="post" class="logout-button" onclick="return onLogoutClick(); ">
        <button type="submit" id="logout">Logout</button>
    </form>
   <section class="header-section">
          <div class="center-div">
            <h1>Welcome to EggCrypt</h1>
            <p>Create your highly secure image passwords.</p>
            <div class="header-button"> 
              <a href="dashboard2.php">Get Started</a>
            </div>
          </div>
        </section>
      
</body>
</html>
