<?php
session_start();

include_once 'stu_dbh.inc.php';

$email = $_SESSION["email"];
$name = $_POST['name'];
$year = $_POST['year'];
$major = $_POST['major'];
$aoi = $_POST['aoi'];
$career = $_POST['career'];
$reason = $_POST['reason'];

$imagePost = $_FILES["image"]['name'];
if($imagePost) {
    $image = addslashes(file_get_contents($imagePost));
    $imageName = addslashes($imagePost);

    $sql1 = "UPDATE students SET name1='$name', years='$year', major='$major', aoi='$aoi', career='$career', reason='$reason', imageName='$imageName', image1='$image'
        WHERE email='$email'";
    $res1 = mysqli_query($conn, $sql1);
    if (mysqli_affected_rows($conn) > 0) {                                                                
        echo "<br/>Info updated.";                                                
    } else {
        echo "<br/>Info not updated.";
        $sql2 = "INSERT INTO students (name1, years, major, aoi, career, reason, imageName, image1) 
        VALUES ('$name', '$year', '$major', '$aoi', '$career', '$reason', '$imageName', '$image')";
        $res2 = mysqli_query($conn, $sql2);
        if(mysqli_affected_rows($conn) > 0) {
            echo "<br/>Info Inserted.";
        } else {
            echo "<br/>Info not Inserted.";
        }         
    }

    $_SESSION["email"] = $email;

    header("Location: stu_profile_post.php");
} 
else {
    $sql1 = "UPDATE students SET name1='$name', years='$year', major='$major', aoi='$aoi', career='$career', reason='$reason'
        WHERE email='$email'";
    $res1 = mysqli_query($conn, $sql1);
    if (mysqli_affected_rows($conn) > 0) {                                                                
        echo "<br/>Info updated.";                                                
    } else {
        echo "<br/>Info not updated.";
        $sql2 = "INSERT INTO students (name1, years, major, aoi, career, reason) 
        VALUES ('$name', '$year', '$major', '$aoi', '$career', '$reason')";
        $res2 = mysqli_query($conn, $sql2);
        if(mysqli_affected_rows($conn) > 0) {
            echo "<br/>Info Inserted.";
        } else {
            echo "<br/>Info not Inserted.";
        }         
    }

    $_SESSION["email"] = $email;

    header("Location: stu_profile_post.php");
}
?>
