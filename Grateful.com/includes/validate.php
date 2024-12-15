<?php

session_start();

require_once("db_connect.php");



if($_SERVER['REQUEST_METHOD'] == "POST"){

    // Read the raw JSON input
    $input = file_get_contents('php://input');

    // Decode JSON into a PHP array
    $data = json_decode($input, true);

    //assigning the username and password to variables for chekcing
    $username = $data['username'];
    $password = $data['password'];
    
    //getting the users authentication info from the db
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $dbconn->query($query);
    
    //if user exists, proceed with validation or else show the user does not exisit
    if($result->num_rows>0){

        //getting user credentials from db into an array
        $cred = $result->fetch_assoc();

        //verying if thepassword entered matches the credentials from the db
        if(password_verify($password,$cred['password'] )){
            $_SESSION['user_id'] = $cred['id'];
            $_SESSION['username'] = $cred['username'];

            //upon successful validation
            echo json_encode(["status" => "success" ]);
        }else{

            //if the passwords dont match
            echo json_encode(["status" => "fail" , "error" => "Wrong Password" ]);
        }

    }else{

        //if there are no rows that match username measn the username doesn't exist
        echo json_encode(["status" => "fail" , "error" => "Username does not exist" ]);
    }
}

?>