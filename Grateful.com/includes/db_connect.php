<?php
require_once('config.php');

$dbconn = new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);


if($dbconn->connect_errno){
    echo "there is an error";
}
?>