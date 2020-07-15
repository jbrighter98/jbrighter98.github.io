<?php
session_start();

if(!$_SESSION["email"]){
      header("Location: Login.html");
}
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Quest - Areas of Interest
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="style_page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

            * {
            margin: 0;
            padding: 0;
            }



            .center button {
                float:left;
                padding: 4px 5px;
                margin-top: 5px;
                background: white;
                font-size: 17px;
                border: none;
                cursor: pointer;
            }

            .center button:hover {
                background: #ddd;
            }

            form .button {
                background-color: White;
                border-radius: 25px;
                color:#05386B;
                border: 3px solid #05386B;
                padding: 15px 32px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                margin-top: 10px;
            }

            form .button:hover {
                background-color: #05386B;
                color: white;
            }

            a .button {
                background-color: White;
                border-radius: 25px;
                color:#05386B;
                border: 3px solid #05386B;
                padding: 15px 32px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                margin-top: 10px;
            }

            a .button:hover {
                background-color: #05386B;
                color: white;
            }


            .center {
                margin-left: auto;
                margin-right: auto;
                margin-top: 2%;
                width: 60%;
                height: 10%;
            }

            .center:after{
                content: " "; 
                display: block;
                clear: both;
            }

            .center input[type=text] {
                float:left;
                width: 92%;
                margin-top: 5px;
                float: left;
                padding: 6px;
                font-size: 17px;
                border: 1px solid #05386B;
            }

            .contentcontainer {
                /*float:left;*/
                margin-left: auto;
                margin-right: auto;
                margin-top: 10px;
                width: 75%;
                height: auto;
                background-color: white;
                border: 1px solid #05386B;
                border-radius: 15px;
                text-align:center;
            }
            
            .contentcontainer:after{
                content: " "; 
                display: block;
                clear: both;
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

            .choices {
                float: left;
                width: 50%;
                height: auto;
                text-align:center;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border: 1px solid #05386B;
            border-radius: 5px;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
            background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .container input:checked ~ .checkmark {
            background-color: #05386B;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
            display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
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

        <div class=center>
            <form action="tag_chooser.php" method="post">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" style="background-color: #d1d0ce"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
            </form>
        </div>

        <div class="contentcontainer">
            <h1>Current Areas of Interest</h1>
            <?php
                $user1 = 'root';
                $pass1 = '';
                $db1 = 'student_profile';
                $conn1 = mysqli_connect('localhost',$user1,$pass1) or die("Unable to connect");
                mysqli_select_db($conn1, $db1) or die("Unable to connect to db");

                $sql = "SELECT aoi FROM students WHERE email='$email'";
                $result = $conn1->query($sql);

                if(mysqli_num_rows($result) > 0){
                    $row = $result->fetch_assoc();
                    $aoi = $row["aoi"];
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
        </div>

            

        <form action="tag_chooser_bg.php" style="text-align:center;" method="post">
            <input type='submit' class='button' name="action" value="Add" size="50">
            <input type='submit' class='button' name="action" value="Delete" size="50">
            <a href="profile_choose.php" class="button" >Save</a>
            <div class="contentcontainer">
                <?php
                    $search = null;    
                    if(isset($_POST["search"])){
                        $search = $_POST["search"];
                    }
                    $user = 'root';
                    $pass = '';
                    $db = 'projects';

                    $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
                    mysqli_select_db($conn, $db) or die("Unable to connect to db");

                    $sql = "SELECT name1, Tag FROM tags";
                    $result = $conn->query($sql);

                    $count = 0;
                    if($search != ''){
                /*?>
                        <div class=project>
                            Showing Results for 
                <?php
                            echo "'$search'";
                ?>
                        </div>
                <?php*/
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                
                                if(strpos(strtoupper($row["name1"]), strtoupper($search)) !== false || 
                                strpos(strtoupper($row["Tag"]), strtoupper($search)) !== false) {
                                    $count += 1;
                                    writeChoice($row);
                                }
                            }    
                        }
                    }
                    else{
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                writeChoice($row);
                            }    
                        }
                        $count = -1;
                    }

                    if($count == 0) {
                        echo "No search results for '$search'";
                    }


                    function writeChoice($row){
                        ?>
                            <div class=choices>
                                <label class="container">
                        <?php
                                echo $row["name1"]
                        ?>
                                    <input type="checkbox" name="chosen[]" value="<?php echo $row["name1"]?>"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php            
                    }

                ?>
            </div>
        </form>
    </body>
</html>