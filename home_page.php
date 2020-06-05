<!DOCTYPE html>
<html>
    <head>
        <title>
            Home
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
            margin: 0;
            font-family: menlo;
            background-color: white;
            }

            .topnav {
            overflow: hidden;
            background-color: #22FFAD;
            border-bottom: 3px solid #05386B;
            }

            .topnav a {
            float: left;
            color: #05386B;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            }

            .topnav a:hover {
            background-color: #ddd;
            color: black;
            }

            .topnav a.active {
            background-color: #05386B;
            color: white;
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
                height: 300px;
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
                margin-top: 40px;
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

        </style>
    </head>
    <body>

        <div class="topnav">
            <img src="Qlogo1.png" alt="Quest Logo Top" width=45 style="margin-top: 12px; margin-left: 5px; margin-right: 20px; float:left">
            <div class="search-container">
                <form action="search.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
                </form>
            </div>
            <a href="home_page.php">Home</a>
            <a href="projects.html">Projects</a>
            <a href="labs.html">Labs</a>
            <a href="professors.html">Professors</a>
            <a href="people.html">People</a>
            <a href="messages.html" style="float:right">Messages</a>
            <a href="notifications.html" style="float:right">Notifications</a>
        </div>

        <div class="center">
            <div class="sidecontainer">
                <div class="self" style="margin-bottom: 5px;">Name</div>
                <div class="network">Network</div>
            </div>
            <div class="contentcontainer">
                <div class=newscontainer>
                    <div class=news style="padding: 5px">News</div>
                    <div class=news style="padding: 5px; margin-left: 35px">Scientific Papers</div>
                    <div class=news style="padding: 5px; margin-left: 35px">Top Universities</div>
                </div>
                <div class=feedcontainer>
                        <?php

                            $user = 'root';
                            $pass = '';
                            $db = 'projects';

                            $tag = array("arthist", "econ", "cmpsci");

                            ?>
                                <div class=project>
                            <?php
                            foreach($tag as $tagelement){
                                echo "$tagelement ";
                            }
                            ?>
                                </div>
                            <?php

                            $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
                            mysqli_select_db($conn, $db) or die("Unable to connect to db");

                            $sql = "SELECT ID, Title, rLocation, Instructor, Website, rDescription, Tags FROM projects";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    
                                    $tagarray = str_split($row["Tags"]);
                                    $newarray = "";
                                    foreach ($tagarray as $char) {
                                        if(($char == "/" || $char == "#") && in_array($newarray, $tag)){
                                            writeProject($row);
                                            break;
                                        }
                                        else if($char == "/" && !in_array($newarray, $tag)){
                                            $newarray = "";
                                            continue;
                                        }
                                        $newarray .= $char;
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
                        <?php
                                echo $row["Website"]
                        ?>
                                </p>
                                <p>
                        <?php
                                echo $row["rDescription"]
                        ?>
                                </p>
                                <p>Tags:
                        <?php
                                $array = str_split($row["Tags"]);
                                foreach ($array as $char) {
                                    if($char == "/"){
                                        echo ", ";
                                        continue;
                                    }
                                    if($char == "#") {
                                        break;
                                    }
                                    echo $char;
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