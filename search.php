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
            Search
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="style_page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
           
            .search-container {
                text-align: center;
                margin: auto;
                width: 100%;
                padding: 4px;
                height: 40px;
            }   

            input[type=text] {
                float:left;
                width: 92%;
                margin-top: 5px;
                float: left;
                padding: 6px;
                font-size: 17px;
                border: 1px solid #05386B;
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

            .center {
                margin-left: auto;
                margin-right: auto;
                margin-top: 2%;
                width: 60%;
                height: 10%;
            }

            .contentcontainer {
                /*float:left;*/
                margin-left: auto;
                margin-right: auto;
                margin-top: 5%;
                width: 75%;
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
            <img src="Qlogo1.png" alt="Quest Logo Top" width=45 style="margin-top: 12px; margin-left: 5px; margin-right: 20px; float:left;">
            <a href="home_page.php">Projects</a>
            <a href="portfolio_edit.php">Portfolio</a>
            <a href="logout.php" style="float:right">Logout</a>
            <a href="profile_choose.php" style="float:right">Profile</a>

        </div>

        <div class="center">
            <form action="search.php" method="post">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" style="background-color: #d1d0ce"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
            </form>
        </div>
        <div class="contentcontainer">
            <?php 
            
            $search = $_POST["search"];
            $user = 'root';
            $pass = '';
            $db = 'projects';

            $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
            mysqli_select_db($conn, $db) or die("Unable to connect to db");

            $sql = "SELECT ID, Title, rLocation, Instructor, Website, rDescription, Tags FROM projects";
            $result = $conn->query($sql);

            ?>

            <div class=project>
                Showing Results for 
            <?php
                echo "'$search'";
            ?>
            </div>
            <?php
            
            $count = 0;
            if($search != ''){
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
                        if(strpos(strtoupper($row["Title"]), strtoupper($search)) !== false || 
                        strpos(strtoupper($row["rLocation"]), strtoupper($search)) !== false || 
                        strpos(strtoupper($row["Instructor"]), strtoupper($search)) !== false || 
                        strpos(strtoupper($row["Website"]), strtoupper($search)) !== false || 
                        strpos(strtoupper($row["rDescription"]), strtoupper($search)) !== false || 
                        strpos(strtoupper($row["Tags"]), strtoupper($search)) !== false) {
                            $count += 1;
                            writeProject($row);
                        }
                    }    
                }
            }
            else{
                echo "Empty Search";
                $count = -1;
            }
            
            if($count == 0) {
                echo "No search results for '$search'";
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
    </body>
</html>