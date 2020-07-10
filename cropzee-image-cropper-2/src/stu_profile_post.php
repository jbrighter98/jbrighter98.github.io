<?php
session_start();

if(!$_SESSION["email"]){
      header("Location: ../../Login.html");
}
?>

<!DOCTYPE html>
<html>
<head>
      <title>
            Quest - Profile
      </title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" type="text/css" href="../../style_page.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
<style>

* {
  margin: 0;
  padding: 0;
}


.center {
      margin: auto;
      margin-top: 10px;
      width:50%;
      height: 100%;
      Font-size:20px;
      Border-radius: 10px;
      background-color: white;
      border: 1px solid #05386B;
      padding: 10px;

}

.center:after{
      content: " "; 
      display: block;
      clear: both;
}

.center1 {
      margin: auto;
      width: 5%;
      height: 10%;
      Font-size:20px;
      Border-radius: 5px;

}

.tab {
    display: inline-block;
    margin-left: 70px;

}

  .image-previewer {
    height: 205px;
    width: 205px;
    display: flex;
    border-radius: 25px;
    border: 3px solid #05386B;
    margin-left: 50px;
  }


  .container1{
      width: 100%;
      height: auto;
      margin: auto;
      float:left;
  }
  .subcontainer1{
      /*margin: auto;*/
      width: 50%;
      height: 10%;
      Font-size:20px; 
  }

  .container2{
      width: 100%;
      height: auto;
      margin: auto;
      float: left;
  }

  .button {
      background-color: #d1d0ce;
      border-radius: 25px;
      color:#05386B;
      border: 3px solid #05386B;
      padding: 15px 32px;
      text-align: center;
      display: inline-block;
      font-size: 16px;
      margin-top: 10px;
  }

  .button:hover {
      background-color: #05386B;
      color: white;
  }



</style>
</head>
<body>

      <div class="topnav">
            <img src="Qlogo1.png" alt="Quest Logo Top" width=45 style="margin-top: 12px; margin-left: 5px; margin-right: 20px; float:left">
            <div class="search-container">
                <form action="../../search.php" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
                </form>
            </div>
            <a href="../../home_page.php">Projects</a>
            <a href="../../portfolio_edit.php">Portfolio</a>
            <a href="../../logout.php" style="float:right">Logout</a>
            <a href="../../profile_choose.php" style="float:right">Profile</a>
      </div>

    <div class=center>

      <?php

      $user = 'root';
      $pass = '';
      $db = 'student_profile';

      $email = $_SESSION["email"];


      $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
      mysqli_select_db($conn, $db) or die("Unable to connect to db");

      $sql1 = "SELECT name1, email, years, major, aoi, career, reason, imageName, image1 FROM students WHERE email='$email'";
 
      $sth = $conn->query($sql1);
      if ($sth->num_rows == 1) {
        $row = $sth->fetch_assoc();
      ?>
            <div class="container1">
            <div class="subcontainer1">      
                  <div style="float:left; margin: 10px">
      <?php
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="200" height="200" style="border: 1px solid #05386B; border-radius: 15px;"/>';
      ?>
                  </div>
                  <div style="float:left; margin: 10px">
                        <p>
      <?php
                              echo $row["name1"];
      ?>
                        </p>
                        <p>
      <?php
                              echo $row["email"];
      ?>
                        </p>
                        <p>
      <?php
                              echo $row["years"];
      ?>
                        </p>
                        <p>
      <?php
                              echo $row["major"];
      ?>
                        </p>
                  </div>
            </div>
            </div>
      </div>
            <div class="container2">
                  <div class="center">
                  <h1 style="font-size: 24px;">Areas of Interest</h1>
                  <p>
      <?php
                        echo $row["aoi"];
      ?>
                  </p>
                  </div>
                  <div class="center">
                  <h1 style="font-size: 24px;">Carrer Ambitions</h1>
                  <p>
      <?php
                        echo $row["career"];
      ?>
                  </p>
                  </div>
                  <div class="center">
                  <h1 style="font-size: 24px;">Research Goals</h1>
                  <p>
      <?php
                        echo $row["reason"];
      ?>
                  </p>
                  </div>
            </div>

      <?php
      }
      ?>
      <div class="center1">
      <button class="button" onclick="window.location.href='stu_profile_edit.php'">Edit</button>
      </div>
  </body>