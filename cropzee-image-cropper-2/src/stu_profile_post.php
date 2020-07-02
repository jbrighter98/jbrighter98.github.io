<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>

* {
  margin: 0;
  padding: 0;
}

body {
  height: 100%;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-color: #22FFAD;
  background-image: linear-gradient(#22FFAD 35%, rgb(13, 117, 79))
}

.topnav a {
    float: left;
    display: block;
    color:#05386B;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}
#profile-link {
    float: right;
}  
/* Change the color of links on hover */
.topnav a:hover {
    background-color: #05386B;
    color:#25F09A;
}
/* Style the search box inside the navigation bar */
.topnav input[type=text] {
    float: left;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
}
.topnav .search-container {
      float:left;
      border-right: 3px solid #05386B;
      padding: 4px;
      height: 40px;
}



.topnav input[type=text] {
      margin-top: 5px;
      float: left;
      padding: 6px;
      font-size: 17px;
      border: none;
}

.topnav .search-container button {
      float: left;
      padding: 4px 5px;
      margin-top: 5px;
      background: #22FFAD;
      font-size: 17px;
      border: none;
      cursor: pointer;
}

.topnav .search-container button:hover {
      background: #ddd;
}

  hr.sexy_line {
  border: 0;
  height: 5px;
  background: #05386B;
  background-image: -webkit-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
  background-image: -moz-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
  background-image: -ms-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
  background-image: -o-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
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

  ::-webkit-input-placeholder {
    color: #EFEFEF;
  }

  .container{
    float: center;
    position: absolute;
    left: 500px;
    top: 60px; /*50px*/
    Width: 500px;
    Height: 720px;
    Padding: 0px;
    Margin-left: 7%
    Background: none;
    Font-size:20px;
    Border: 2px solid #05386B;
    Border-radius: 5px;
  }



</style>
</head>
<body>

<div class="topnav">
      <a onclick="window.location.href = 'quest_home.html'" class="top-logo"><img src="Qlogo1.png" id="toplogo" alt="Quest Logo Top" width = 45></a> 
      <div class="search-container">
            <form action="../../search.php" method="post">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
            </form>
      </div>
      <a href="../../home_page.php">PROJECTS</a>
      <a href="../../portfolio_edit.php">PORTFOLIO</a>
      <a id="profile-link" href="stu_profile_post.php">PROFILE</a>
</div>
      <br>
      <br>
      <br>
<hr class="sexy_line" color="#05386B">
      <br>
      <br>
      <br>
      <br>

    <div class=container>

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
            <p>
      <?php
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="200" height="200" />';
      ?>
            </p>
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
            <p>
      <?php
            echo $row["aoi"];
      ?>
            </p>
            <p>
      <?php
            echo $row["career"];
      ?>
            </p>
            <p>
      <?php
            echo $row["reason"];
      ?>
            </p>
      <?php
      }
      ?>

    </div>
  </body>