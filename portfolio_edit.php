<?php
session_start();

if(!$_SESSION["email"]){
    header("Location: Login.html");
}
?>

<!DOCTYPE html>
<html>
	<head>
        <title>
            Quest - Portfolio
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="style_page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

            .maingrid {
                display: grid;
                border: none;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(4, 1fr);
                grid-gap: 4px;
            }
            .box {
                height: 300px;
                border: 2px solid #031C36;
                border-radius: 15px;
                margin-left: 120px;
                margin-right: 60px;
            }
            .fm {
                border: none;
            }

            #content {
                width: 50%;
                margin: 20px auto;
            }
            /*form {
                width: 50%;
                margin: 20px auto;
                display: inline-block;
            }*/
            #img_div {
                width: 80%;
                padding: 5px;
                border: none;
                justify-items: stretch;
            }
            #img_div:after {
                content: "";
                display: block;
                clear: both;
            }
            .projects {
                height: 200px;
                border: 2px solid #031C36;
                border-radius: 15px;
            }

        </style>
    </head>

    <body>

        <div class="topnav">
            <img src="Qlogo1.png" alt="Quest Logo Top" width=45 style="margin-top: 12px; margin-left: 5px; margin-right: 20px; float:left">
            <div class="search-container">
                <form action="search.php" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
                </form>
            </div>
            <a href="home_page.php">Projects</a>
            <a href="portfolio_edit.php">Portfolio</a>
            <a href="logout.php" style="float:right">Logout</a>
            <a href="profile_choose.php" style="float:right">Profile</a>
        </div>


        <div class="maingrid">
            <div class="box">
            <div id="content">
<?php

    $email = $_SESSION["email"];

    $msg = "";
    // if upload button is pressed 
    if (isset($_POST['upload'])) {
        // the path store the uploaded image 
        $target = "images/".basename($_FILES['image']['name']);

        // connect to the database 
        $db = mysqli_connect("localhost", "root", "", "student_profile");

        // Get all the submitted data from the form 
        $image = $_FILES['image']['name'];
        $text = $_POST['text'];

        $qry = "UPDATE portfolios1 SET images='$image', rDescription='$text' WHERE email='$email'";
        $res1 = mysqli_query($db, $qry);
        if (mysqli_affected_rows($db) <= 0)  {
            $sql2 = "INSERT INTO portfolios1 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
            $res2 = mysqli_query($db, $sql2);
            if (mysqli_affected_rows($db) <= 0) {
                echo "<br/>Error.";
            }     
        }

        // move the uploaded image into the folder: images 
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded succesfully";
        } else {
            $msg = "There was a problem uploading image";
        }

    }

?>

<?php 
    $db = mysqli_connect("localhost", "root", "", "student_profile");
    $sql = "SELECT * FROM portfolios1 WHERE email='$email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    if($row) {
        echo "<img class='projects' src='images/".$row['images']."' >";
        echo "<p>".$row['rDescription']."</p>"; 
    }

?>

</div>
            </div>
            <div class="box">
            <div id="content">

            <?php

$email = $_SESSION["email"];

$msg = "";
// if upload button is pressed 
if (isset($_POST['upload2'])) {
    // the path store the uploaded image 
    $target = "images/".basename($_FILES['image']['name']);

    // connect to the database 
    $db = mysqli_connect("localhost", "root", "", "student_profile");

    // Get all the submitted data from the form 
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $qry = "UPDATE portfolios2 SET images='$image', rDescription='$text' WHERE email='$email'";
    $res1 = mysqli_query($db, $qry);
    if (mysqli_affected_rows($db) <= 0)  {
        $sql2 = "INSERT INTO portfolios2 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
        $res2 = mysqli_query($db, $sql2);
        if (mysqli_affected_rows($db) <= 0) {
            echo "<br/>Error.";
        }     
    }

    // move the uploaded image into the folder: images 
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded succesfully";
    } else {
        $msg = "There was a problem uploading image";
    }

}

?>

<?php 
$db = mysqli_connect("localhost", "root", "", "student_profile");
$sql = "SELECT * FROM portfolios2 WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
if($row) {
    echo "<img class='projects' src='images/".$row['images']."' >";
    echo "<p>".$row['rDescription']."</p>"; 
}

?>

</div>
            </div>
            <div class="fm">
            <div id="content">

        <form method="post" action="portfolio_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" cols="40" rows="4" placeholder="Describe your project"></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value="Upload Image">
            </div>
        </form>

</div>
            </div>
            <div class="fm">
            <div id="content">


        <form method="post" action="portfolio_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" cols="40" rows="4" placeholder="Describe your project"></textarea>
            </div>
            <div>
                <input type="submit" name="upload2" value="Upload Image">
            </div>
        </form>

</div>
            </div>
            <div class="box">
            <div id="content">

<?php

$email = $_SESSION["email"];

$msg = "";
// if upload button is pressed 
if (isset($_POST['upload3'])) {
    // the path store the uploaded image 
    $target = "images/".basename($_FILES['image']['name']);

    // connect to the database 
    $db = mysqli_connect("localhost", "root", "", "student_profile");

    // Get all the submitted data from the form 
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $qry = "UPDATE portfolios3 SET images='$image', rDescription='$text' WHERE email='$email'";
    $res1 = mysqli_query($db, $qry);
    if (mysqli_affected_rows($db) <= 0)  {
        $sql2 = "INSERT INTO portfolios3 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
        $res2 = mysqli_query($db, $sql2);
        if (mysqli_affected_rows($db) <= 0) {
            echo "<br/>Error.";
        }     
    }

    // move the uploaded image into the folder: images 
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded succesfully";
    } else {
        $msg = "There was a problem uploading image";
    }

}

?>

<?php 
$db = mysqli_connect("localhost", "root", "", "student_profile");
$sql = "SELECT * FROM portfolios3 WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
if($row) {
    echo "<img class='projects' src='images/".$row['images']."' >";
    echo "<p>".$row['rDescription']."</p>"; 
}
?>

</div>
            </div>
            <div class="box">
            <div id="content">

<?php

$email = $_SESSION["email"];

$msg = "";
// if upload button is pressed 
if (isset($_POST['upload5'])) {
    // the path store the uploaded image 
    $target = "images/".basename($_FILES['image']['name']);

    // connect to the database 
    $db = mysqli_connect("localhost", "root", "", "student_profile");

    // Get all the submitted data from the form 
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $qry = "UPDATE portfolios4 SET images='$image', rDescription='$text' WHERE email='$email'";
    $res1 = mysqli_query($db, $qry);                                              
    if (mysqli_affected_rows($db) <= 0)  {
        $sql2 = "INSERT INTO portfolios4 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
        $res2 = mysqli_query($db, $sql2);
        if (mysqli_affected_rows($db) <= 0) {
            echo "<br/>Error.";
        }     
    }

    // move the uploaded image into the folder: images 
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded succesfully";
    } else {
        $msg = "There was a problem uploading image";
    }

}

?>

<?php 
$db = mysqli_connect("localhost", "root", "", "student_profile");
$sql = "SELECT * FROM portfolios4 WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
if($row) {
    echo "<img class='projects' src='images/".$row['images']."' >";
    echo "<p>".$row['rDescription']."</p>"; 
}
?>

</div>
            </div>
            <div class="fm">
            <div id="content">

        <form method="post" action="portfolio_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" cols="40" rows="4" placeholder="Describe your project"></textarea>
            </div>
            <div>
                <input type="submit" name="upload3" value="Upload Image">
            </div>
        </form>


        </div>
            </div>
            <div class="fm">
            <div id="content">



        <form method="post" action="portfolio_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <div>
                <textarea name="text" cols="40" rows="4" placeholder="Describe your project"></textarea>
            </div>
            <div>
                <input type="submit" name="upload5" value="Upload Image">
            </div>
        </form>
        </div>
        </div>


        </div>
		
		
	</body>
</html>


