<?php

include_once 'dbh.inc.php';

$name = $_POST['name'];
$email = $_POST['email'];
$year = $_POST['year'];
$major = $_POST['major'];
$aoi = $_POST['aoi'];
$career = $_POST['career'];
$reason = $_POST['reason'];

$sql = "INSERT INTO students (name, email, years, major, aoi, career, reason)
    VALUES ('$name', '$email', '$year', '$major', '$aoi', '$career', '$reason');";
mysqli_query($conn, $sql);

header("Location: profile_webpage.php?profile=success");

 ?>
