<?php
session_start();

$email = $_POST['email'];
$pword = $_POST['pword'];

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "user_info";

if(!$email || !$pword) {
    header("Location: general_error_page.html");
}

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword) or die("no connection");
mysqli_select_db($conn, $dbName) or die("no db");

if(!$conn){
    header("Location: general_error_page.html");
}

$sql1 = "SELECT email, pword FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $sql1);
$row = $res->fetch_assoc();
if(mysqli_num_rows($res) > 0){
    if($row['pword'] == $pword) {
        $_SESSION["email"] = $email;
        header("Location: home_page.php");
    }
    else{
        header("Location: Login_Error.html");
    }
}
else{
    header("Location: Login_Error.html");
}


?>