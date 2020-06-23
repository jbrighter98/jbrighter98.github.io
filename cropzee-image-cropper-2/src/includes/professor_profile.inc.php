<?php

include_once 'professor_dbh.inc.php';

$name = $_POST['name'];
$email = $_POST['email'];
$expertise = $_POST['expertise'];
$background = $_POST['background'];
$aoi = $_POST['aoi'];
$projects = $_POST['projects'];
$research = $_POST['research'];
$links = $_POST['links'];

$sql = "INSERT INTO professor (name, email, expertise, background, aoi, projects, research, links) /*add database in phpmyadmin and chage these values*/
    VALUES ('$name', '$email', '$expertise', '$background', '$aoi', '$projects', '$research', '$links');";
mysqli_query($conn, $sql);

header("Location: ../professor_profile.php?professor_profile=success");

 ?>
