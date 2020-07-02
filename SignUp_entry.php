<?php
session_start();

$email = $_POST['email'];
$pword = $_POST['pword'];
$cword = $_POST['cword'];
$type = $_POST['type'];

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "user_info";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword) or die("no connection");
mysqli_select_db($conn, $dbName) or die("no db");

$sql1 = "SELECT email FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $sql1);
if(mysqli_num_rows($res) > 0){
    header("Location: SignUp_eError.html");
}
else{
    $sql2 = "INSERT INTO users (email, pword, types) 
    VALUES ('$email', '$pword', '$type')";
    $res2 = mysqli_query($conn, $sql2);
    if(mysqli_affected_rows($conn) > 0) {
        echo "<br/>Info Inserted.";
        $_SESSION['email'] = $email;
        if($type == "Student"){
            header("Location: cropzee-image-cropper-2/src/stu_profile_edit.php");
        }
        else if($type == "Professor"){
            header("Location: cropzee-image-cropper-2/src/prof_profile_edit.php");
        }
    } else {
        echo "<br/>Error: Info not Inserted.";
        header("Location: SignUp.html");
    }
}


?>