<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'lanchonete';

$mysqli = new mysqli($host,$user,$pass,$db);


if($mysqli->connect_errno){
    echo "Connect Failed: " . $mysqli->connect_error;
    exit();
}
?>