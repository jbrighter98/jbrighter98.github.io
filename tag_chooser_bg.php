<?php
session_start();
if(!$_SESSION["email"]){
    header("Location: Login.html");
}
$email = $_SESSION["email"];

if(isset($_POST['chosen'])){
    $tags = $_POST['chosen'];
}
else {
    header("Location: tag_chooser.php");
}

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "student_profile";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword) or die("no connection");
mysqli_select_db($conn, $dbName) or die("no db");

if(!$conn){
    header("Location: general_error_page.html");
}

if($_POST['action'] == 'Add'){
    $sql1 = "SELECT aoi FROM students WHERE email = '$email'";
    $res = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($res) > 0){
        $row = $res->fetch_assoc();
        $aoi = $row["aoi"];
        if($aoi == ""){
            $input = http_build_query($tags);
            $sql2 = "UPDATE students SET aoi='$input' WHERE email = '$email'";
            $res2 = mysqli_query($conn, $sql2);
            if(mysqli_affected_rows($conn) <= 0) {
                header("Location: general_error_page.html");
            }
            else{
                header("Location: tag_chooser.php");
            }
        }
        else {
            parse_str($aoi, $output);
            foreach($tags as $tag){
                $num = array_search($tag, $output);
                if(!($num === false)){
                    echo "test - $tag";
                    echo "</br>num = $num";
                    array_splice($output, $num, 1);
                }
            }
            echo "</br>num = $num";
            foreach($output as $temp) {
                echo "</br>$temp";
            }
            $result = array_merge($output, $tags);
            echo"</br>---------------";
            foreach($result as $temp) {
                echo "</br>$temp";
            }
            $input = http_build_query($result);
            $sql3 = "UPDATE students SET aoi='$input' WHERE email = '$email'";
            $res3 = mysqli_query($conn, $sql3);
            if(mysqli_affected_rows($conn) < 0) {
                header("Location: general_error_page.html");
            }
            else{
                header("Location: tag_chooser.php");
            }
        }
    }
    else {
        header("Location: general_error_page.html");
    }
}
else if($_POST['action'] == 'Delete'){
    $sql1 = "SELECT aoi FROM students WHERE email = '$email'";
    $res = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($res) > 0){
        $row = $res->fetch_assoc();
        $aoi = $row["aoi"];
        if($aoi == ""){
            header("Location: tag_chooser.php");
        }
        else {
            parse_str($aoi, $output);
            foreach($tags as $tag){
                $num = array_search($tag, $output);
                if(!($num === false)){
                    echo "test - $tag";
                    echo "</br>num = $num";
                    array_splice($output, $num, 1);
                }
            }
            $input = http_build_query($output);
            $sql3 = "UPDATE students SET aoi='$input' WHERE email = '$email'";
            $res3 = mysqli_query($conn, $sql3);
            if(mysqli_affected_rows($conn) < 0) {
                header("Location: general_error_page.html");
            }
            else{
                header("Location: tag_chooser.php");
            }
        }
    }
}
else{
    header("Location: general_error_page.html");
}




?>