<?php
require_once("db_connect.php");
session_start();

//setting content type
header("Content-Type: application/json");

//function to sanitize input
function dataCleaner($data){

    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
}

//getting edited content of the post
$data = json_decode(file_get_contents("php://input"), true);

//sanitizing and assigning data to variable
$postID = dataCleaner($data['id']);
$newContent = dataCleaner($data['content']);

//excecuting the query to update the post
$sql = "UPDATE posts SET content = '$newContent' WHERE id = $postID";

//sending response based on the query exceqution
if ($dbconn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to update post."]);
}

$dbconn->close();
?>
