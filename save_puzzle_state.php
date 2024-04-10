<?php
include 'connectDB.php';

if (!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$userId = $data['userId'];
$puzzleState = $data['puzzleState'];
$imageData = base64_decode(substr($data['imageData'], strpos($data['imageData'], ',') + 1));

try {
    $stmt = $conn->prepare('INSERT INTO saved_puzzle_states (user_id, puzzle_state, image_data) VALUES (?, ?, ?)'); 
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }
    
    $stmt->bind_param('isb', $userId, $puzzleState, $imageData);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }

    echo 'Puzzle state saved successfully.';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>


