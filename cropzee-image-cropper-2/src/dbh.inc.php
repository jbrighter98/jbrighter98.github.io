<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "student_profile";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword);
mysqli_select_db($conn, $dbName);
?>