<?php
session_start();

if(!$_SESSION["email"]){
    header("Location: Login.html");
}

$email = $_SESSION["email"];

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "user_info";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword) or die("no connection");
mysqli_select_db($conn, $dbName) or die("no db");

echo $email;

$sql1 = "SELECT types FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $sql1);
$row = $res->fetch_assoc();
if(mysqli_num_rows($res) > 0){
    if($row['types'] == "Professor") {
        header("Location: prof_profile_post.php");
    }
    else if($row['types'] == "Student") {
        header("Location: stu_profile_post.php");
    }
    else{
        header("Location: general_error_page.html");
    }
}
else{
    header("Location: general_error_page.html");
}