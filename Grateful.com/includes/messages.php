<?php

require_once("db_connect.php");
session_start();

//function to sanitize data
function dataCleaner($data){

    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
}

//assigning userID to assign whos the sneder
$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //sanitizing and assigning the reciepient and the message to be send
    $recepientName = dataCleaner($_POST['recipient']);
    $message = dataCleaner($_POST['message']);
    
    //query to add message to db
    $getIdQuery = "SELECT * FROM users WHERE username = '$recepientName'";
    
    //getting recipeint id based on the username
    $getIdResponse = $dbconn->query($getIdQuery);
    $recepientId = $getIdResponse->fetch_assoc()['id'];

    //add the message to the db 
    $query = "INSERT INTO messages (sender_id, receiver_id, content) VALUES($userID, $recepientId, '$message')";
    $dbconn->query(query: $query);
    header("Location: ../messages.php");
}

