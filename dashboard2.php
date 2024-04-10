<?php
include 'connectDB.php';

if (!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Security-Policy" content="img-src 'self' data: blob:;">
    <title>Dashboard 2</title>
    <link rel="stylesheet" href="dashboard.css">
	
</head>
<body>
    <div class="logo2">
        <a href="index.html">
            <img src="logo2.3.png" alt="logo">
            <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;"></span>
        </a>
    </div>
    <form action="logout.php" method="post" class="logout-button" onclick="return onLogoutClick(); ">
        <button type="submit" id="logout">Logout</button>
    </form>

    <script>
    function drawPuzzleState(canvasId, puzzleStateData, imageData) {
        const canvas = document.getElementById(canvasId);
        const ctx = canvas.getContext('2d');

        const blob = new Blob([imageData], { type: 'image/jpeg' });
        const imageUrl = URL.createObjectURL(blob);
        
        const image = new Image();
        image.onload = function() {
            const puzzleState = JSON.parse(puzzleStateData);
            puzzleState.tiles.forEach(tile => {
                ctx.drawImage(
                    image,
                    tile.col * (image.width / puzzleState.cols), tile.row * (image.height / puzzleState.rows), image.width / puzzleState.cols, image.height / puzzleState.rows,
                    tile.x, tile.y, puzzleState.tileSize, puzzleState.tileSize
                );
            });
        };

        image.src = imageUrl; 
    }
</script>

    <div class="container">
        <?php
            $sql = "SELECT * FROM saved_puzzle_states WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_COOKIE["user_id"]);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<canvas id='canvas{$row['id']}' width='200' height='200'></canvas>"; 
                    echo "</div>";
                    echo "</div>";

                    echo "<script>drawPuzzleState('canvas{$row['id']}', '{$row['puzzle_state']}', '" . base64_encode($row['image_data']) . "');</script>";
                }
            } else {
                echo "<div class='col-12 text-center'><p>No image passwords found.</p></div>";
            }
        ?>
        <div class="card">
            <a href="add_password.php"><span class="plus">+</span></a>
        </div>
    </div>
</body>
</html>

