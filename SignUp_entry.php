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

if(!$email || !$pword || !$cword || !$type) {
    header("Location: general_error_page.html");
}

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword) or die("no connection");
mysqli_select_db($conn, $dbName) or die("no db");

if(!$conn){
    header("Location: general_error_page.html");
}

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
            mysqli_select_db($conn, 'student_profile') or die("no db");
            if(!$conn){
                header("Location: general_error_page.html");
            }
            $sql3 = "INSERT INTO students (email) VALUES ('$email')";
            $res3 = mysqli_query($conn, $sql3);
            if(mysqli_affected_rows($conn) > 0) {
                header("Location: stu_profile_edit.php");
            } else {
                header("Location: general_error_page.html");
            }
        }
        else if($type == "Professor"){
            mysqli_select_db($conn, 'professor_profile') or die("no db");
            if(!$conn){
                header("Location: general_error_page.html");
            }
            $sql4 = "INSERT INTO professor (email) VALUES ('$email')";
            $res4 = mysqli_query($conn, $sql4);
            if(mysqli_affected_rows($conn) > 0) {
                header("Location: prof_profile_edit.php");
            } else {
                header("Location: general_error_page.html");
            }
        }
    } else {
        echo "<br/>Error: Info not Inserted.";
        header("Location: general_error_page.html");
    }
}


?>