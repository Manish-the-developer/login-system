<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "task";
$conn = new mysqli($server,$username,$password,$db_name);
if($conn->connect_errno){
    echo 'error in establishing database connection00';
    exit;
}