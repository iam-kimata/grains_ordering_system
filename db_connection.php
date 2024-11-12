<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "grains_ordering";

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn){
    die("mysql connect error");
}

?>