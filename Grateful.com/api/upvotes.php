<?php
require_once("../includes/db_connect.php");
session_start();

header("Content-Type: application/json");

//getting post ID from index
$data = json_decode(file_get_contents("php://input"), true);

//assigning values to the variables
$user_id = $_SESSION['user_id'];
$post_id = $data['post_id'];

// Check if the user has liked the post
$sqlCheck = "SELECT id FROM upvotes WHERE user_id = $user_id AND post_id = $post_id";
$result = $dbconn->query($sqlCheck);

//checks if the post has been liked by the user before
if ($result->num_rows > 0) {
    // Un-upvote the post 
    $sqlDelete = "DELETE FROM upvotes WHERE user_id = $user_id AND post_id = $post_id";
    if ($dbconn->query($sqlDelete) === TRUE) {
        echo json_encode(["success" => true, "message" => "Upvote removed"]);
    } else {
        echo json_encode(["error" => "Failed to remove upvote"]);
    }
} else {
    // Add upvote
    $sqlInsert = "INSERT INTO upvotes (user_id, post_id) VALUES ($user_id, $post_id)";
    if ($dbconn->query($sqlInsert) === TRUE) {
        echo json_encode(["success" => true, "message" => "Upvote added"]);
    } else {
        echo json_encode(["error" => "Failed to add upvote"]);
    }
}

$dbconn->close();
?>
