<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
        <title>Quest - Portfolio</title>
        <style>
            /* Style the links inside the navigation bar */
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
/* Navigation line */
hr.sexy_line {
    border: 0;
    height: 3px;
    background: #05386B;
    background-image: -webkit-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
    background-image: -moz-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
    background-image: -ms-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
    background-image: -o-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
    position: relative;
    top: -5px;
    }

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
    form {
        width: 50%;
        margin: 20px auto;
        display: inline-block;
    }
    form div {
        margin-top: 5px;
    }
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
        </style>
    </head>

    <body style="background-image: linear-gradient(#22FFAD 35%, rgb(13, 117, 79));">

        <div class="topnav">
            <a onclick="window.location.href = 'quest_home.html'" class="top-logo"><img src="Qlogo1.png" id="toplogo" alt="Quest Logo Top" width = 45></a> 
            <div class="search-container">
                <form action="search.php" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
                </form>
            </div>
            <a href="home_page.php">PROJECTS</a>
            <a href="portfolio_edit.php">PORTFOLIO</a>
            <a id="profile-link" href="cropzee-image-cropper-2/src/stu_profile_post.php">PROFILE</a>
        </div>


        <br>
        <br>
        <br>
        


        <hr class="sexy_line" color="#05386B">

        <br>
        <br>
        <br>
        <br>

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
    $sql = "SELECT * FROM portfolios1 ORDER BY id desc limit 1";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) {
        //echo "<div id='img_div'>";
            echo "<img class='projects' src='images/".$row['images']."' >";
            echo "<p>".$row['rDescription']."</p>"; 
        //echo "</div>";
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
$sql = "SELECT * FROM portfolios2 ORDER BY id desc limit 1";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    //echo "<div id='img_div'>";
        echo "<img class='projects' src='images/".$row['images']."' >";
        echo "<p>".$row['rDescription']."</p>"; 
    //echo "</div>";
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
$sql = "SELECT * FROM portfolios3 ORDER BY id desc limit 1";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    //echo "<div id='img_div'>";
        echo "<img class='projects' src='images/".$row['images']."' >";
        echo "<p>".$row['rDescription']."</p>"; 
    //echo "</div>";
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
$sql = "SELECT * FROM portfolios4 ORDER BY id desc limit 1";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    //echo "<div id='img_div'>";
        echo "<img class='projects' src='images/".$row['images']."' >";
        echo "<p>".$row['rDescription']."</p>"; 
    //echo "</div>";
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


