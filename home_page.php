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
            Quest - Projects
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="style_page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .center {
                margin: auto;
                width: 75%;
                height: 10%;
            }

            .sidecontainer {
                margin-top: 5%;
                height: auto;
                width: 20%;
                float:left;
            }

            .self {
                border: 1px solid #05386B;
                border-radius: 15px;
                width: 100%;
                min-height: 130px;
                height:auto;
                background-color: white;
                padding: 5px;
                color: #05386B;
            }
            .network{
                border: 1px solid #05386B;
                border-radius: 15px;
                width: 100%;
                height: 300px;
                background-image: url("network.jpg"), linear-gradient(white, #05386B);
                padding: 5px;
                color: white;
            }

            .contentcontainer {
                float:left;
                margin-left: 35px;
                margin-top: 5%;
                width: 70%;
                height: auto;
            }


            .newscontainer {
                width:auto;
                height:100px;
                margin-bottom: 40px;
            }

            .news {
                width: 25%;
                height: 100px;
                float:left;
                border: 1px solid #05386B;
                border-radius: 15px;
                background-color: #05386B;
                color: white;
            }

            .feedcontainer {
                /*margin-top: 40px;*/
                width: 100%;
                height: auto;
            }

            .project {
                border: 1px solid #05386B;
                border-radius: 15px;
                width: 100%;
                height: auto;
                background-color: white;
                color: #05386B;
                padding: 5px;
                margin-bottom: 10px;
            }
            .project:after{
                content: " "; 
                display: block;
                clear: both;
            }

            .button {
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

            .button:hover {
                background-color: #05386B;
                color: white;
            }

            .self .button {
                background-color: White;
                border-radius: 25px;
                color:#05386B;
                border: 2px solid #05386B;
                padding: 5px 12px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                float: right;
            }

            .self .button:hover {
                background-color: #05386B;
                color: white;
            }

            .sidecontainer p {
                font-size: 18px;
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

        <div class="center">
            <div class="sidecontainer">
                <div class="self" style="margin-bottom: 5px;">
                <?php

                $user = 'root';
                $pass = '';
                $db = 'student_profile';

                $email = $_SESSION["email"];


                $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
                mysqli_select_db($conn, $db) or die("Unable to connect to db");

                $sql1 = "SELECT name1, email, years, major, aoi, career, reason, imageName, image1 FROM students WHERE email='$email'";
                $sth = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($sth) == 1) {
                    $row = $sth->fetch_assoc();
                    ?>
                        <a href="stu_profile_edit.php" class="button" >Edit</a>
                        <div style="float: left; height: max-content;">
                            <p>
                    <?php
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="100" height="100" style="border: 1px solid #05386B; border-radius: 15px;"/>';
                    ?>
                            </p>
                            
                        </div>
                        <div style="float: left; margin-left: 5px; height: max-content;">
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
                                echo $row["major"];
                    ?>
                            </p>
                        </div>
                    <?php
                }else{
                    mysqli_select_db($conn, "professor_profile") or die("Unable to connect to db");
                    $sql1 = "SELECT name1, email, expertise, background, aoi, projects, research, links, imageName, image1 FROM professor WHERE email='$email'";
                    $sth = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($sth) == 1) {
                        $row = $sth->fetch_assoc();
                        ?>
                        <a href="prof_profile_edit.php" class="button" >Edit</a>
                        <div style="float: left; height: max-content;">
                            <p>
                    <?php
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="100" height="100" />';
                    ?>
                            </p>
                        </div>
                        <div style="float: left; margin-left: 5px; height: max-content;">
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
                                echo $row["expertise"];
                    ?>
                            </p>
                    </div>
                        <?php
                    }
                }
                ?>
                </div>
                <div class="network">Network - Coming Soon</div>
            </div>
            <div class="contentcontainer">
                <!--<div class=newscontainer>
                    <div class=news style="padding: 5px">News</div>
                    <div class=news style="padding: 5px; margin-left: 35px">Scientific Papers</div>
                    <div class=news style="padding: 5px; margin-left: 35px">Top Universities</div>
                </div>-->
                <div class=feedcontainer>
                        <?php

                            $user = 'root';
                            $pass = '';
                            $db = 'projects';



                            ?>
                                <div class=project>
                                <h1 >Areas of Interest</h1>
                                <a href="tag_chooser.php" class="button" >Edit</a>
                                <p style="font-size: 24px">
                            <?php
                                $user1 = 'root';
                                $pass1 = '';
                                $db1 = 'student_profile';
                                $conn1 = mysqli_connect('localhost',$user1,$pass1) or die("Unable to connect");
                                mysqli_select_db($conn1, $db1) or die("Unable to connect to db");
                
                                $sql1 = "SELECT aoi FROM students WHERE email='$email'";
                                $result1 = $conn1->query($sql1);
                                $output = [];
                                if(mysqli_num_rows($result1) > 0){
                                    $row1 = $result1->fetch_assoc();
                                    $aoi = $row1["aoi"];
                                    if($aoi == ""){
                                        echo "None";
                                    }
                                    else {
                                        parse_str($aoi, $output);
                                        $c = 0;
                                        foreach($output as $tag){
                                            if($c == 0) {
                                                echo $tag;
                                            }
                                            else {
                                                echo " - $tag";
                                            }
                                            $c += 1;
                                        }
                                    }
                                }
                                else {
                                    header("Location: general_error_page.html");
                                }
                            ?>
                                </p>
                                </div>
                            <?php

                            $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
                            mysqli_select_db($conn, $db) or die("Unable to connect to db");

                            $sql = "SELECT ID, Title, rLocation, Instructor, Website, rDescription, Tags FROM projects";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0 && !empty($output)) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    testtags($row, $output);
                                }    
                            }
                            else {
                                ?>
                                <div class=project>
                                <h style="font-size: xx-large;">
                                    No projects to show. Add some Areas of Interest!
                                </h>
                                </div>
                                <?php

                            }

                            function testtags($row, $output){
                                foreach($output as $temp) {
                                    if(strpos($row["Tags"], $temp) !== false){
                                        writeProject($row);
                                        break;
                                    }
                                }
                            }
                            
                            function writeProject($row){
                        ?>
                            <div class=project>
                                <h style="font-size: xx-large;">
                        <?php
                                echo $row["Title"]
                        ?>
                                </h>
                                <p>Location:
                        <?php
                                echo $row["rLocation"]
                        ?>
                                </p>
                                <p>Instructor:
                        <?php
                                echo $row["Instructor"]
                        ?>
                                </p>
                                <p>Website:
                                <a href="<?php echo $row["Website"] ?>">
                        <?php
                                echo $row["Website"]
                        ?>
                                </a>
                                </p>
                                <p>
                        <?php
                                echo $row["rDescription"]
                        ?>
                                </p>
                                <p>Tags:
                        <?php
                                parse_str($row["Tags"], $tags);
                                $c = 0;
                                foreach($tags as $tag){
                                    if($c == 0) {
                                        echo $tag;
                                    }
                                    else {
                                        echo " - $tag";
                                    }
                                    $c += 1;
                                }
                        ?>
                                </p>
                            </div>
                        <?php            
                            }
                        ?>
                </div>
            </div>

        </div>

    </body>
</html>