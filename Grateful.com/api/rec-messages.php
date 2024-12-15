<?php
require_once("../includes/db_connect.php");

$data = json_decode(file_get_contents("php://input"),true);
$user_id = $data["id"];

$sql = "SELECT 
    m.id AS message_id,
    m.sender_id,
    u.username AS sender_username,
    m.content,
    m.timestamp
FROM 
    messages m
INNER JOIN 
    users u ON m.sender_id = u.id
WHERE 
    m.receiver_id = '$user_id'
ORDER BY 
    m.timestamp DESC;
"; 

$result = $dbconn->query(query: $sql);

if($result->num_rows>0){
$msgArr = array();

while($row=$result->fetch_assoc()){
    array_push($msgArr,$row);
}


echo json_encode($msgArr);

$dbconn->close();

exit;
}
?>