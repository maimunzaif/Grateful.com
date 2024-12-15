<?php
require_once("db_connect.php");
session_start();

//getting the post id to delete
$data = json_decode(file_get_contents("php://input"), true);

//assigning postid to a vairable
$postID = $data['id'];

$sql = "DELETE FROM posts WHERE id = '$postID'  ";


// Execute the query
if ($dbconn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $dbconn->error]);
}

// Close the connection
$dbconn->close();
?>
