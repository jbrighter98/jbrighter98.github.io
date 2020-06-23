<!--<!DOCTYPE html>
<html>
<head>
  <title>Upload Image</title>
  <style>
  body {
    background-color: lightblue;
  }
  input {
    width: 50%;
    height: 5%;
    border: 1px;
    border-radius: 05px;
    padding: 8px 15px 8px 15px;
    margin: 10px 0px 15px 0px;
    box-shadow: 1px 1px 2px 1px grey;
    font-weight: bold;
  }
  </style>
</head>
<body>

<center>
  <h1> Upload image into mySQL </h1>

<form action="" method="POST" enctype="multipart/form-data">
<label>Choose a Porfile Pic: </label>
<input type="file" name="image" id="image"/><br>
<label>Enter Username: </label>
<input type="text" name="username" placeholder="Enter username..."/><br>
<label>Enter Destination: </label>
<input type="text" name="destination" placeholder="Enter destination..."/><br>
<input type="submit" name="upload" value="Upload Image"/><br>

</form>
</center>

</body>
</html>-->

<?php
/*$connection = mysqli_connect("localhost", "root", "", "youtubedb");
$db = mysqli_select_db($connection, 'youtubedb');

if (isset($_POST['upload'])) {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $username = $_POST['username'];
  $destination = $_POST['destination'];

  $query = "INSERT INTO `empimages` (`image`,`username`, `destination`) VALUES ('$file', '$username', '$destination')";
  $query_run = mysqli_query($connection, $query);

  if ($query_run) {
    echo '<script type="text/javascript"> alert("Image Profile Uploaded") </script>';
  } else {
    echo '<script type="text/javascript"> alert("Image Profile Not Uploaded") </script>';
  }
}*/

 ?>


 <!--<!DOCTYPE html>
 <html>
 <head>
   <title></title>
 </head>
 <body>

   <form action="" method="POST" enctype="multipart/form-data">
     <input type="file" name="image"><input type="submit" name="submit" value="Upload">
   </form>

   <?php
   /*$connection = mysqli_connect("localhost", "root", "", "tutorial");
   if (isset($_POST['submit'])) {
     mysqli_connect("localhost", "root", "");
     mysqli_select_db($connection, "tutorial");

     $imageName = mysqli_real_escape_string($_FILES["image"]["tmp_name"]);
     $imageData = mysqli_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
     $imageType = mysqli_real_escape_string($_FILES["image"]["type"]);

     if (substr($imageType, 0, 5) == image)
     {
       echo "Working code";
     } else {
       echo "only images are allowed";
     }
   }*/
    ?>


 </body>
 </html>-->










<!--<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Blob File MySQL</title>
</head>
<body>
  <?php
/*  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "mydata";

  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

  $dbh = NEW PDO("mysql:host=localhost;dbname=mydata", "root", "");

  if (isset($_POST['btn'])) {
    $name = $_FILES['myfile']['name'];
    $type = $_FILES['myfile']['type'];
    $data = file_get_contents($_FILES['myfile']['tmp_name']);
    $stmt = $dbh->prepare("INSERT INTO myblob VALUES('',?,?,?)");
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$type);
    $stmt->bindParam(3,$data);
    $stmt->execute();
  }*/

  /*$name = $_POST['name'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $major = $_POST['major'];
  $aoi = $_POST['aoi'];
  $career = $_POST['career'];
  $reason = $_POST['reason'];
  $image = $_POST['image'];

  $sql = "INSERT INTO myblob (name, email, year, major, aoi, career, reason, image)
      VALUES ('$name', '$email', '$year', '$major', '$aoi', '$career', '$reason', '$image');";
  mysqli_query($conn, $sql);

  header("Location: ../uploadimage.php?=uploadsuccess");*/

   ?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="myfile"/>
  <button name="btn">Upload</button>
</form>
<p></p>
<ol>
  <?php
#$stat = $dbh->prepare("SELECT * FROM myblob");
#$stat->execute();
   ?>
</ol>
</body>
</html>-->








<?php
                                                                                # ini_set() function requires two string arguments; the first is the name of the string to be modified and the second is the new value to be assigned to it.
ini_set('mysql.connect_timeout',300);                                           # Tell the PHP how long to wait (300 seconds) for a response from the mySQL server when trying to connect.
ini_set('default_socket_timeout',300);                                          # Determine the time-out of the socket-based stream in seconds (PHP 4.3.0).

 ?>
<html>
<body>
  <form method="post" enctype="multipart/form-data">                            <!-- Create a form with the post method (safer for user data) and set the enctype to accept images. -->
    <br/>
    <input type="file" name="image"/>                                           <!-- Set the input type to accept files so that images may be uploaded. -->
    <br/><br/>
    <input type="submit" name="submit" value="Upload"/>                         <!-- Add a button that can submit the data (the image) to the database. -->
  </form>
  <?php
if (isset($_POST['submit'])) {                                                  # If statement to check if the user clicked the submit button.
  if(getimagesize($_FILES['image']['tmp_name'])== FALSE) {                      # The getimagesize() function will retrieve the size of the image. The $_FILES superglobal is used for the name of the file input name="image"
                                                                                # as well as the temporary name of the image that is stored on the server's hard disk system in the system temporary file directory.
                                                                                # An alternate directory may be specified using the upload_tmp_dir setting in PHP.
                                                                                # Make an if statement to satisfy the situation where the user does not select an image setting the getimagesize() function equal to false.

    echo "Please select an image.";                                             # If the user does not select an image the getimagesize() function is indeed false and they will see this string echoed on the page.
  } else {                                                                      # If the if statement is true:
    $image = addslashes($_FILES['image']['tmp_name']);                          # Add slashes to certain characters in the strings of the images temporary name (useful when entering stings into a database).
    $name = addslashes($_FILES['image']['name']);                               # Add slashes to the images actual name.
    $image = file_get_contents($image);                                         # The file_get_contents() function will read the contents of the file (the user's image) into a string.
    $image = base64_encode($image);                                             # the base64_encode() function will encode the user's image data with MIME base64. The base64_encoded() function takes up 33% more space.
    saveimage($name, $image);                                                   # Run the saveimage function created below.
  }
}
function saveimage($name, $image) {                                             # Create a function called saveimage() to save the user's image. The two parameters included are the name of the image that the user uploads,
                                                                                # and the second parameter is the encoded image data from the MIME base64 function.
  $con = mysqli_connect("localhost", "root", "");                               # Connect this program to the phpmyadmin database using the mysqli_connect() function. The parameters include the server ( XAMPP is "localhost"
                                                                                # which will change to the hosting service we use), the username of the database which for XAMPP is "root" and the password which for XAMPP is
                                                                                # nothing i.e. "".

  mysqli_select_db($con, "student_profile");                                             # Use the mysqli_select_db() function to select the default database specified by the second parameter "kstark". kstark is the name of the database
                                                                                # in phpmyadmin and the first parameter is the connection variable to the database.
  $qry = "INSERT INTO images (name, image) VALUES ('$name', '$image')";         # Create a variable using SQL code to insert the data into each column of the database table except for the id and include the variables
                                                                                # that stores the data for each column again except for the id column. The name of the table in the kstark database is called `images`.
  $result = mysqli_query($con, $qry);                                           # Use the mysqli_query() function to execute the SQL queries that inserts the user's data into each column of the table. This requires two parameters,
                                                                                # the connection to the database variable first and the database query variable second.
  if ($result) {                                                                # Optional: Create an if statement for the result variable that is supposed to enter the data into the database.
    echo "<br/>Image uploaded.";                                                # If the image was uploaded echo a string onto the page letting the user know their image was entered into the database.
  } else {
    echo "<br/>Image not uploaded.";                                            # If the image was not entered into the database, echo a string onto the page letting the user know to redo it.
  }
}
   ?>
 </body>
 </html>

 <!-- The SQL code to create the table:

CREATE TABLE images (

id int(11) PRIMARY KEY AUTO_INCREMENT not null,
name varchar(255) not null,
mime varchar(255) not null,
image LONGBLOB not null

);

-->
