<?php
session_start();

include_once 'prof_dbh.inc.php';

$email = $_SESSION["email"];

$name = $_POST['name'];
$exp = $_POST['expertise'];
$bg = $_POST['background'];
$aoi = $_POST['aoi'];
$projects = $_POST['projects'];
$research = $_POST['research'];
$links = $_POST['links'];

$imagePost = $_FILES["image"]['name'];
echo $imagePost;
echo "<br/>$email";
$image = addslashes(file_get_contents($imagePost));
$imageName = addslashes($imagePost);

$sql1 = "UPDATE professor SET name1='$name', expertise='$exp', background='$bg', 
aoi='$aoi', projects='$projects', research='$research', links='$links', imageName='$imageName',
image1='$image' WHERE email='$email'";
$res1 = mysqli_query($conn, $sql1);
echo "<br/>$res1";
if (mysqli_affected_rows($conn) > 0) {                                                                
    echo "<br/>Info updated.";                                                
} else {
    echo "<br/>Info not updated.";
    $sql2 = "INSERT INTO professor (name1, expertise, background, aoi, projects, research, links, imageName, image1) 
    VALUES ('$name', '$exp', '$bg', '$aoi', '$projects', '$research', '$links', '$imageName', '$image')";
    $res2 = mysqli_query($conn, $sql2);
    if (mysqli_affected_rows($conn) > 0) {
        echo "<br/>Info Inserted.";
    } else {
        echo "<br/>Info not Inserted.";
    }         
}

$_SESSION["email"] = $email;

header("Location: prof_profile_post.php");

?>
