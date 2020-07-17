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
                float:left;
            }
            .box2 {
                height: auto;
                border-radius: 15px;
                width: 45%;
                margin: 10px;
                float:right;
            }
            .fm {
                border: none;
            }

            #content {
                width: 550px;
                margin: auto;
                Border-radius: 15px;
                background-color: white;
                border: 1px solid #05386B;
            }
            .projects {
                width: 100%; 
                height: 100%;
                border-radius: 15px;
                object-fit: contain;
                object-position: center;
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
                <a href="portfolio_edit.php" class="button" >Edit</a>
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

                        $sql = "SELECT * FROM portfolios1 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }


                    ?>

            </div>
            <div class="box2">

                    <?php

                        $sql = "SELECT * FROM portfolios2 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }

                    ?>

            </div>
            </div>

            <div class="subgrid">
            <div class="box1">

                    <?php

                        $sql = "SELECT * FROM portfolios3 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                    ?>

            </div>
            <div class="box2">

                    <?php

                        $sql = "SELECT * FROM portfolios4 WHERE email='$email'";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($result);
                        if($row) {
                            ?>
                            <div id="content">
                            <?php
                            echo "<img class='projects' src='images/".$row['images']."' >";
                            echo "<p>".$row['rDescription']."</p>"; 
                            ?>
                            </div>
                            <?php
                        }
                    ?>

            </div>		
            </div>                
	</body>
</html>


