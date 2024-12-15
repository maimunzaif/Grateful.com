<?php

//getting the db connection
require_once("../includes/db_connect.php");

//query to get the posts 
$sql = "SELECT 
    posts.id AS id,
    posts.title AS title,
    posts.content AS content,
    users.username AS author,
    COALESCE(upvote_counts.upvotes, 0) AS upvotes
FROM 
    posts
INNER JOIN 
    users
ON 
    posts.user_id = users.id
LEFT JOIN 
    (SELECT post_id, COUNT(*) AS upvotes FROM upvotes GROUP BY post_id) AS upvote_counts
ON 
    posts.id = upvote_counts.post_id
ORDER BY
    posts.created_at DESC;
";

$result = $dbconn->query($sql);

$postsArr = array();

//adding the posts to the array
while($row=$result->fetch_assoc()){
    array_push($postsArr,$row);
}

//sending the post array to index
echo json_encode($postsArr);

$dbconn->close();

exit;

?>