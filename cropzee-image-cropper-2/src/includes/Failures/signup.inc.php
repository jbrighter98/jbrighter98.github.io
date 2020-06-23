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

    header("Location: ../index.php?signup=success");*/





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
