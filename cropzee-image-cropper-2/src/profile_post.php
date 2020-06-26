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

<?php

/*$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "reg");
if(isset($_REQUEST['submit']))
{
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $year = $_REQUEST['year'];
  $major = $_REQUEST['major'];
  $aoi = $_REQUEST['aoi'];
  $career = $_REQUEST['career'];
  $reason = $_REQUEST['reason'];
  mysqli_query($conn, "insert into profile(name, email, major, aoi, career, reason, year)values('$name', '$email', '$major', '$aoi', '$career', '$reason', '$year')");
}*/

if(isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $major = $_POST['major'];
  $aoi = $_POST['aoi'];
  $career = $_POST['career'];
  $reason = $_POST['reason'];


  /*echo "Name: ".$name."<br>";*/
  /*echo "Email: ".$email."<br>";*/
  /*echo "Year: ".$year."<br>";*/
  /*echo "Major: ".$major."<br>";*/
  /*echo "Area of Interest: ".$aoi."<br>";*/
  /*echo "Career Interests: ".$career."<br>";*/
  /*echo "Reasons for Wanting Research: ".$reason;*/
}
?>

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

<!--<pre class="tab"></pre>
<label for="cropzee-input" class="image-previewer" data-cropzee="cropzee-input" style="background: #05386B"></label>
<input id="cropzee-input" type="file" accept="image/*" name="image" style="margin-left: 70px; padding: 10px 0px; float: left;"/>
<input type="button" name="image" value="Upload Image" class="upload" onclick="document.getElementById('cropzee-input').click()"/>
<script>
  $(document).ready(function(){
    $("#cropzee-input").cropzee({startSize: [85, 85, '%'],});

  });

</script>-->


    <div class=container>

      <?php

      $user = 'root';
      $pass = '';
      $db = 'student_profile';

      //$email = $_SESSION["email"];
      $email = "testemail@gmail.com";

      $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
      mysqli_select_db($conn, $db) or die("Unable to connect to db");

      $sql1 = "SELECT name1, email, years, major, aoi, career, reason FROM students";
      $sql = "SELECT name1, image1, email FROM images";

      $sth = $conn->query($sql);
      //$result = mysqli_fetch_array($sth);
      if ($sth->num_rows > 0) {
        while($row = $sth->fetch_assoc()) {
          if ($row["email"] == $email) {
      ?>
            <p>
      <?php
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="200" height="200" />';
      ?>
            </p>
      <?php
            break;
          }
        }
      }

      $result1 = $conn->query($sql1);

      if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
          if ($row["email"] == $email) {
      ?>
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
            break;
          }
        }
      }
      ?>

    </div>
  </body>