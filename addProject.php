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

            
            Form{
				Width: 32%; /*<!--30%,20%-->*/
				Height: auto;
				Padding: 20px;
				Margin: auto;
				Background: none;
				Font-size:20px;
				Border: 2px solid #05386B;
				Border-radius: 7px;
				position: relative;
				top: 110px;
			}

            Input[type=text]{
				Width:80%; /*<!--40%-->*/
				Padding: 5px;
				Font-size: 13px;
				font-family: Menlo;
				color: #EFEFEF;
            }


            input[type=submit] {
                width: 35%;
                height: 35px;
                background-color: rgb(134, 236, 180); /*#8EE4AF*/
                border: solid;
                border-color: #05386B;
                color: #05386B;
                Font-size: 15px;
                    font-family: Menlo;
                padding: 5px 20px;
                margin: 8px 0;
                border-radius: 9px;
                cursor: pointer;

            }
            /* "Sign Up" botton text and border outline */
            input[type=submit]:hover {
                color: #8EE4AF;
                background-image: linear-gradient(#05386B 5%, #031C36)
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
            <a href="home_page.php">Home</a>
            <a href="projects.html">Projects</a>
            <a href="labs.html">Labs</a>
            <a href="professors.html">Professors</a>
            <a href="people.html">People</a>
            <a href="messages.html" style="float:right">Messages</a>
            <a href="notifications.html" style="float:right">Notifications</a>
        </div>

        <div>
			<form align="middle" action="addProject.php" method="POST" id="form1">	
                <input type="text" id="title" name="title" placeholder="Title" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="text" id="loc" name="loc" placeholder="Location" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="text" id="inst" name="inst" placeholder="Instructor" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="text" id="web" name="web" placeholder="Website (Use full link)" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="text" id="des" name="des" placeholder="Description" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="text" id="tags" name="tags" placeholder="Tags" style="color: #FFFFFF" onkeypress="field_wait()">

                <input type="submit" value="Submit" size="50">
                
                <?php

                $title = $_POST["title"];
                $loc = $_POST["loc"];
                $inst = $_POST["inst"];
                $web = $_POST["web"];
                $des = $_POST["des"];
                $tags = $_POST["tags"];

                $user = 'root';
                $pass = '';
                $db = 'projects';

                $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
                mysqli_select_db($conn, $db) or die("Unable to connect to db");

                $sql = "INSERT INTO projects (Title, rLocation, Instructor, Website, rDescription, Tags) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $title, $loc, $inst, $web, $des, $tags);
                $stmt->execute();

                ?>

            </form>

        </div>
    </body>
</html>
    
    