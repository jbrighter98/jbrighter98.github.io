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

    $sql = "INSERT INTO professor (name, email, years, major, aoi, career, reason)
        VALUES ('$name', '$email', '$expertise', '$background', '$aoi', '$projects', '$research', '$links');";
    mysqli_query($conn, $sql);

    header("Location: ../professor_profile.php?profsignup=success");





    /*include_once 'dbh.inc.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
        VALUES ('$first', '$last', '$email', '$uid', '$pwd');";
    mysqli_query($conn, $sql);

    header("Location: ../index.php?signup=success");*/
 ?>
