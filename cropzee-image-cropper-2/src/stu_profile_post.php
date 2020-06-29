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

nav {
  width: 100%;
  height: 36px;
  background-color: #22FFAD;
}

nav p {
  font-family: menlo;
  color: #22FFAD;
  font-size: 24px;
  line-height: 55px;
  float: right;
  padding: 0px 20px;
}

nav ul {
  float: right;
  list-style: none;
  text-align: center;
}

nav ul li {
  float: right;
  list-style: none;
  position: relative;
  top: 20px; /*10px*/
  right: 150px;
  display: inline-block;
  text-align: center;
  /*top: 2%;*/
  /*left: 20%;*/
  transform: translate(-50%, -50%);
}

nav ul li a {
  display: block;
  font-family: menlo;
  color: #05386B;
  font-size: 16px;
  font-weight: regular;
  padding: 8px 15px; /* 8px 9px */
  text-decoration: none;
  file:///Users/jason/Desktop/Manuelshomepage.html;
}

nav ul li a:hover {
    text-decoration: underline;
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

<nav>
    <ul>
    <!--<a href="file:///Users/jason/Desktop/Manuelshomepage.html">-->
    <a href="Manuelshomepage.html">
    <img style="position: absolute; top:10px; left:150px; width:30px; height:15px color: #05386B" src="Qlogo2.png"></a> <!--WIDTH:60px; HEIGHT:30px-->
    <!--<IMG STYLE="align: left; position:relative; TOP:10px; LEFT:10px; WIDTH:30px; HEIGHT:15px" SRC="Qlogo1.png"></a>-->
        <li><a href="newsignup.html">Log Out</a></li>
        <li><a href="file:///Users/jason/Desktop/Quest%20progress/Published%20Work/SignUp.html">Home</a></li>
  </ul>
</nav>

<hr class="sexy_line" color="#05386B">

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