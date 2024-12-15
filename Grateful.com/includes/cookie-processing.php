<?php

session_start();

$data = json_decode(file_get_contents("php://input"),true);

if($_SERVER['REQUEST_METHOD']=='POST'  && isset($_COOKIE['theme'])){
    setcookie("theme", "dark", time() - 24*60*60);
    echo json_encode(["theme" => "light"]);
}elseif($_SERVER['REQUEST_METHOD']=='POST'){
    setcookie("theme", "dark");
    echo json_encode(["theme" => "dark"]);
}

