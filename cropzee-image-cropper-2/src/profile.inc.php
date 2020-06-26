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

/*$image1 = addslashes(file_get_contents($_FILES[$image]['tmp_name']));                          # Add slashes to certain characters in the strings of the images temporary name (useful when entering stings into a database).
$name = addslashes($_FILES[$image]['name']);                               # Add slashes to the images actual name.

$con = mysqli_connect("localhost", "root", "", "student_profile");                              
if($con) {
    echo "<br/>connected";
}
$qry = "INSERT INTO images (name1, image1) VALUES ('$name', '$image1')";         
                                                                                  
$result = mysqli_query($con, $qry);                                                                                                                              
if ($result) {                                                                
    echo "<br/>Image uploaded.";                                                
} else {
    echo "<br/>Image not uploaded.";                                            
}*/

//header("Location: profile_post.php?profile=success");

 ?>
