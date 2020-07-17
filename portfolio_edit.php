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
                margin: auto;
                margin-top: 10px;
                width:75%;
                height: 100%;
                Font-size:20px;
                Border-radius: 10px;
                padding: 10px;
            }
            .maingrid:after{
                content: " "; 
                display: block;
                clear: both;
            }
            .subgrid {
                margin: auto;
                width: 100%;
                height: auto;
                Font-size:20px;
                Border-radius: 10px;
                padding: 10px;
            }

            .subgrid Textarea {
                overflow: auto;
                outline: none;
                resize: none;
                width: 80%;
                padding: 12px 20px;
                margin: auto;
                display: inline-block;
                font-size: 17px;
                border: 1px solid #05386B;
                color: #05386B;
            }

            .subgrid:after{
                content: " "; 
                display: block;
                clear: both;
            }
            .box1 {
                height: auto;
                border-radius: 15px;
                width: 45%;
                margin: 10px;
                min-height: 300px;
                border: 2px solid #05386B;
                Border-radius: 15px;
                float:left;
            }
            .box2 {
                height: auto;
                border-radius: 15px;
                width: 45%;
                margin: 10px;
                min-height: 300px;
                border: 2px solid #05386B;
                Border-radius: 15px;
                float:right;
            }
            .fm {
                border: none;
            }

            #content {
                width: 550px;
                margin: auto;
                margin-top: 10px;
                Border-radius: 15px;
                background-color: Transparent;
                border: 1px solid #05386B;
                text-align:center;
            }
            #content:after{
                content: " "; 
                display: block;
                clear: both;
            }
            .projects {
                width: 100%; 
                height: 100%;
                border-radius: 15px;
                object-fit: contain;
                object-position: center;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .name-text {
                margin: auto;
                margin-top: 10px;
                width:75%;
                height: 100%;
                Font-size:20px;
                Border-radius: 10px;
                padding: 10px;
            }

            .name-text .button {
                background-color: White;
                border-radius: 25px;
                color:#05386B;
                border: 3px solid #05386B;
                padding: 15px 32px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                margin-top: 10px;
                float: right;
            }

            .name-text .button:hover {
                background-color: #05386B;
                color: white;
            }

            .upload {
                background-color: white;
                border-radius: 25px;
                color:#05386B;
                border: 3px solid #05386B;
                padding: 10px 24px;
                /*text-align: center;*/
                display: inline-block;
                font-size: 16px;
                margin-top: 10px;
                margin-bottom: 10px;
                float: center;
            }

            .upload:hover {
                cursor: pointer;
                background-color: #05386B;
                color: white;
            }

            input[type="file"] {
                display:none;
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
            <a href="portfolio_post.php">Portfolio</a>
            <a href="logout.php" style="float:right">Logout</a>
            <a href="profile_choose.php" style="float:right">Profile</a>
        </div>


        <div class="name-text">
        <?php
            $email = $_SESSION["email"];
            
            $db = mysqli_connect("localhost", "root", "", "student_profile");
            $sql = "SELECT * FROM students WHERE email='$email'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($result);
            if($row) {
                ?>
                <p style="font-size: 48px; color: #05386B">
                <?php
                echo $row['name1'];
                ?>
                <a href="portfolio_post.php" class="button" >Save</a>
                </p>
                <p style="font-size: 20px; color: #05386B">
                <?php
                echo $row['email'];
            }
        ?>
        </div>

        <div class="maingrid">
            <div class="subgrid">
            <div class="box1">
                    <?php

                        $msg = "";
                        // if upload button is pressed 
                        if (isset($_POST['upload1'])) {
                            // the path store the uploaded image 
                            $target = "images/".basename($_FILES['image1']['name']);

                            // connect to the database 
                            $db = mysqli_connect("localhost", "root", "", "student_profile");

                            // Get all the submitted data from the form 
                            $image = $_FILES['image1']['name'];
                            $text = $_POST['text1'];

                            $qry = "UPDATE portfolios1 SET images='$image', rDescription='$text' WHERE email='$email'";
                            $res1 = mysqli_query($db, $qry);
                            if (mysqli_affected_rows($db) == 0)  {
                                $sql2 = "INSERT INTO portfolios1 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
                                $res2 = mysqli_query($db, $sql2);
                                if (mysqli_affected_rows($db) <= 0) {
                                    echo "<br/>Error.";
                                }     
                            }

                            // move the uploaded image into the folder: images 
                            if (move_uploaded_file($_FILES['image1']['tmp_name'], $target)) {
                                $msg = "Image uploaded succesfully";
                            } else {
                                $msg = "There was a problem uploading image";
                            }

                        }

                        $sql = "SELECT * FROM portfolios1 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            //echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <div id="content">
                            <i class="material-icons" style="color:#05386B; font-size: 72px;">add_photo_alternate</i>
                            </div>
                            <?php
                        }


                    ?>

                <form align= 'center' method="post" action="portfolio_edit.php" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <div>
                    <label for="file-upload1" class="upload">
                        Choose Image
                    </label>
                    <input id="file-upload1" name="image1" type="file" accept="image/*"/>
                    </div>
                    <div>
                        <textarea name="text1" cols="40" rows="4" placeholder="Describe your project" ><?PHP echo ($row)?$row["rDescription"]:''; ?></textarea>
                    </div>
                    <div>
                        <input type="submit" name="upload1" value="Update" class="upload">
                    </div>
                </form>

            </div>
            <div class="box2">

                    <?php

                        $msg = "";
                        // if upload button is pressed 
                        if (isset($_POST['upload2'])) {
                            // the path store the uploaded image 
                            $target = "images/".basename($_FILES['image2']['name']);

                            // connect to the database 
                            $db = mysqli_connect("localhost", "root", "", "student_profile");

                            // Get all the submitted data from the form 
                            $image = $_FILES['image2']['name'];
                            $text = $_POST['text2'];

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
                            if (move_uploaded_file($_FILES['image2']['tmp_name'], $target)) {
                                $msg = "Image uploaded succesfully";
                            } else {
                                $msg = "There was a problem uploading image";
                            }

                        }

                        $sql = "SELECT * FROM portfolios2 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            //echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <div id="content">
                            <i class="material-icons" style="color:#05386B; font-size: 72px;">add_photo_alternate</i>
                            </div>
                            <?php
                        }

                    ?>

                        <form align= 'center' method="post" action="portfolio_edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div>
                            <label for="file-upload2" class="upload">
                                Choose Image
                            </label>
                            <input id="file-upload2" name="image2" type="file" accept="image/*"/>
                            </div>
                            <div>
                                <textarea name="text2" cols="40" rows="4" placeholder="Describe your project"><?PHP echo ($row)?$row["rDescription"]:''; ?></textarea>
                            </div>
                            <div>
                                <input type="submit" name="upload2" value="Update" class="upload">
                            </div>
                        </form>

            </div>
            </div>
            <div class="subgrid">
            <div class="box1">

                    <?php

                        $msg = "";
                        // if upload button is pressed 
                        if (isset($_POST['upload3'])) {
                            // the path store the uploaded image 
                            $target = "images/".basename($_FILES['image3']['name']);

                            // connect to the database 
                            $db = mysqli_connect("localhost", "root", "", "student_profile");

                            // Get all the submitted data from the form 
                            $image = $_FILES['image3']['name'];
                            $text = $_POST['text3'];

                            $qry = "UPDATE portfolios3 SET images='$image', rDescription='$text' WHERE email='$email'";
                            $res1 = mysqli_query($db, $qry);
                            if (mysqli_affected_rows($db) == 0)  {
                                $sql2 = "INSERT INTO portfolios3 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
                                $res2 = mysqli_query($db, $sql2);
                                if (mysqli_affected_rows($db) <= 0) {
                                    echo "<br/>Error.";
                                }     
                            }

                            // move the uploaded image into the folder: images 
                            if (move_uploaded_file($_FILES['image3']['tmp_name'], $target)) {
                                $msg = "Image uploaded succesfully";
                            } else {
                                $msg = "There was a problem uploading image";
                            }

                        }

                        $sql = "SELECT * FROM portfolios3 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            //echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <div id="content">
                            <i class="material-icons" style="color:#05386B; font-size: 72px;">add_photo_alternate</i>
                            </div>
                            <?php
                        }
                    ?>

                        <form align= 'center' method="post" action="portfolio_edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div>
                            <label for="file-upload3" class="upload">
                                Choose Image
                            </label>
                            <input id="file-upload3" name="image3" type="file" accept="image/*"/>
                            </div>
                            <div>
                                <textarea name="text3" cols="40" rows="4" placeholder="Describe your project"><?PHP echo ($row)?$row["rDescription"]:''; ?></textarea>
                            </div>
                            <div>
                                <input type="submit" name="upload3" value="Update" class="upload">
                            </div>
                        </form>

            </div>
            <div class="box2">

                    <?php

                        $msg = "";
                        // if upload button is pressed 
                        if (isset($_POST['upload4'])) {
                            // the path store the uploaded image 
                            $target = "images/".basename($_FILES['image4']['name']);

                            // connect to the database 
                            $db = mysqli_connect("localhost", "root", "", "student_profile");

                            // Get all the submitted data from the form 
                            $image = $_FILES['image4']['name'];
                            $text = $_POST['text4'];

                            $qry = "UPDATE portfolios4 SET images='$image', rDescription='$text' WHERE email='$email'";
                            $res1 = mysqli_query($db, $qry);
                            if (mysqli_affected_rows($db) == 0)  {
                                $sql2 = "INSERT INTO portfolios4 (images, rDescription, email) VALUES ('$image', '$text', '$email')";
                                $res2 = mysqli_query($db, $sql2);
                                if (mysqli_affected_rows($db) <= 0) {
                                    echo "<br/>Error.";
                                }     
                            }

                            // move the uploaded image into the folder: images 
                            if (move_uploaded_file($_FILES['image4']['tmp_name'], $target)) {
                                $msg = "Image uploaded succesfully";
                            } else {
                                $msg = "There was a problem uploading image";
                            }

                        }

                        $sql = "SELECT * FROM portfolios4 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            //echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <div id="content">
                            <i class="material-icons" style="color:#05386B; font-size: 72px;">add_photo_alternate</i>
                            </div>
                            <?php
                        }
                    ?>

                        <form align= 'center' method="post" action="portfolio_edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div>
                            <label for="file-upload4" class="upload">
                                Choose Image
                            </label>
                            <input id="file-upload4" name="image4" type="file" accept="image/*"/>
                            </div>
                            <div>
                                <textarea name="text4" cols="40" rows="4" placeholder="Describe your project"><?PHP echo ($row)?$row["rDescription"]:''; ?></textarea>
                            </div>
                            <div>
                                <input type="submit" name="upload4" value="Update" class="upload">
                            </div>
                        </form>


            </div>
            </div>		
		
	</body>
</html>