<?php
// require_once("./includes/db_connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en"
<?php

//sets dark mode if the cookie is set
if(isset($_GET['toggle'])){

    echo 'data-bs-theme="dark" ';

}

?>
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grateful.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-image: url('img/bg_upscaled.jpg'); /* Replace with your image URL */
            background-size: cover; /* Ensures the image covers the entire page */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the background fixed during scroll */

        }
    </style>





</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #001f3f; color: white;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="
            <?php 
            
            if (basename($_SERVER['PHP_SELF']) !== 'login.php'){
                echo "./index.php";
            }else{
                echo "../index.php";
            }        
            
            ?>
        " style="color: white;">Grateful.com</a>

        <!-- User Context Menu -->
        <div class="d-flex">
        <!-- <button id="darkTheme" class="btn btn-outline-primary">Theme</button> -->

        <?php
        // show this nav if the user is not on login.php
        if (basename($_SERVER['PHP_SELF']) !== 'login.php'):
        ?>
            <?php if(isset($_SESSION["username"])): ?>
            <!-- Dropdown Menu for Logged-in User -->
            <div class="dropdown">
                <a href="#" style="background-color: #87CEEB;" class="btn dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Hello, <?php echo $_SESSION["username"]; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="./index.php">Home</a></li>
                    <li><a class="dropdown-item" href="messages.php">Messages</a></li>
                    <li><a class="dropdown-item" href="my-posts.php">My Post</a></li>
                    <li><a class="dropdown-item" href="new-post.php">Create New Post</a></li>
                    <li><a class="dropdown-item text-danger" href="includes/logout.php">Logout</a></li>
                </ul>
            </div>

            <?php else: ?>
            <!-- Dropdown Menu for non Logged-in User -->

            <div class="dropdown">
                <a href="#" class="btn btn-dark dropdown-toggle text-warning" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Hello User
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="./index.php">Home</a></li>
                    <li><a class="dropdown-item" href="includes/login.php">LogIn</a></li>
                </ul>
            </div>

            <?php endif;?>
            <?php else: ?>

                <!-- dropdown menu for non-logged in users on the login page -->
                <div class="dropdown">
                <a href="#" class="btn btn-dark dropdown-toggle text-warning" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Hello User
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="../index.php">Home</a></li>
                </ul>
            </div>
            <?php endif;?>

        </div>
    </div>
</nav>

<?php

function dataCleaner($data){

    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
}

?>
