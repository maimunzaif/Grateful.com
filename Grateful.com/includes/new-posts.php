<?php

require_once("db_connect.php");
session_start();
function dataCleaner($data){

    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
}


$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //assigning the post title and content
    $postTitle = dataCleaner($_POST['title']);
    $postContent = dataCleaner($_POST['content']);
    
    //inserting the post to the db
    $query = "INSERT INTO posts (user_id, title, content) VALUES ('$userID', '$postTitle', '$postContent')";
    
    //excueiting the query
    $dbconn->query($query);
    header("Location: ../index.php");
}

