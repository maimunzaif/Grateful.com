<?php
require_once("../includes/db_connect.php");

//getting the userID for getting their messages
$data = json_decode(file_get_contents("php://input"),true);
$user_id = $data["id"];

//query to get the users recieved messages
$sql = "SELECT 
    m.id AS message_id,
    m.receiver_id,
    u.username AS receiver_username,
    m.content,
    m.timestamp
FROM 
    messages m
INNER JOIN 
    users u ON m.receiver_id = u.id
WHERE 
    m.sender_id = $user_id
ORDER BY 
    m.timestamp DESC;

"; 

//sxecuting the query
$result = $dbconn->query(query: $sql);

if($result->num_rows>0){
$msgArr = array();

//adding recieved messages to array
while($row=$result->fetch_assoc()){
    array_push($msgArr,$row);
}

//sending the array to messages.php
echo json_encode($msgArr);

$dbconn->close();

exit;
}
?>