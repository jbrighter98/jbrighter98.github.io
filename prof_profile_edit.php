<?php
session_start();

if(!$_SESSION["email"]){
    header("Location: Login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>
            Quest - Profile
    </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="style_page.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<style>

	* {
	  margin: 0;
	  padding: 0;
	}

input, select, textarea{  
    -ms-box-sizing:content-box;
    -moz-box-sizing:content-box;
    box-sizing:content-box;
    -webkit-box-sizing:content-box; 
}

.tab {
	display: inline-block;
	margin-left: 70px;
}

.image-previewer {
	height: 205px;
	width: 205px;
	display: flex;
	border-radius: 15px;
	border: 3px solid #05386B;
	margin: auto;
	float: center;
}

.center input[type=text], select {
	float:left;
    width: 100%;
    margin-top: 5px;
    float: left;
    padding: 6px;
    font-size: 17px;
	border: 1px solid #05386B;
	color: #05386B;
}

.center Input[type=text]{
	float:left;
    width: 100%;
    margin-top: 5px;
    float: left;
    padding: 6px;
    font-size: 17px;
	border: 1px solid #05386B;
	color: #05386B;
}

.center Textarea {
	overflow: auto;
	outline: none;
	resize: none;
	width: 100%;
   	padding: 12px 20px;
   	margin: auto;
   	display: inline-block;
   	font-size: 17px;
	border: 1px solid #05386B;
	color: #05386B;
}

input[type=submit] {
    background-color: #d1d0ce;
	border-radius: 25px;
	color:#05386B;
	border: 3px solid #05386B;
	padding: 10px 24px;
	text-align: center;
	display: inline-block;
	font-size: 16px;
	margin: 10px;
	float:center;
}

input[type=submit]:hover {
    background-color: #05386B;
    color: white;
}

.center input[type="file"] {
    visibility: hidden;
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
	margin-left: 3%;
	margin-top: 10px;
	float: center;
}

.upload:hover {
	cursor: pointer;
	background-color: #05386B;
    color: white;
}
/********************************************************************************************** */
.center {
    margin: auto;
    margin-top: 10px;
    width:50%;
    height: 100%;
    Font-size:20px;
    Border-radius: 10px;
    background-color: white;
    border: 1px solid #05386B;
    padding: 10px;

}

.center:after{
    content: " "; 
    display: block;
    clear: both;
}
.pic_container {
	float: left;
	height: 100%;
}
.name_container {
	float: left;
	width: 50%;
	margin-top: 75px;
}
.button_container {
	float: center;
	width: 100%;
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

	<?php

      $user = 'root';
      $pass = '';
      $db = 'professor_profile';

      $email = $_SESSION["email"];


      $conn = mysqli_connect('localhost',$user,$pass) or die("Unable to connect");
      mysqli_select_db($conn, $db) or die("Unable to connect to db");

      $sql1 = "SELECT name1, email, expertise, background, aoi, projects, research, links, imageName, image1 FROM professor WHERE email='$email'";
 
	  $sth = $conn->query($sql1);
	  $row = Null;
	  if ($sth->num_rows == 1) {
		$row = $sth->fetch_assoc();
	  }
	?>

	<form action="prof_profile.inc.php" align="center" method="post" enctype="multipart/form-data">
  		<div class="center">
			<div class="pic_container">
				<pre class="tab"></pre>
				<div class="button_container">
					<label class="image-previewer" style="background: #05386B">
					<?php echo ($row)?'<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'" width="203" height="203" style="border: 1px solid #05386B; border-radius: 15px;"/>':'';?>
				</label>
				</div>
				<div class="button_container">
					<label for="file-upload" class="upload">
						Change Image
					</label>
					<input id="file-upload" name="image" type="file" accept="image/*"/>
				</div>
			</div>
			<div class="name_container">
				<input type="text" id="uname" name="name" placeholder="Name" value="<?PHP echo ($row)?$row["name1"]:''; ?>" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
				<input type="text" id="expertise" name="expertise" placeholder="Expertise" value="<?PHP echo ($row)?$row["expertise"]:''; ?>" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
			</div>
		</div>
		<div class="center">
				<h1 align="left" style="font-size: 24px;">Professional Background</h1>
			<textarea cols="40" rows="5" maxlength="20000" id="aoi" name="background" placeholder="Educational and Professional Background" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: serif;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
<?PHP echo ($row)?$row["background"]:''; ?>
</textarea>
		</div>
		<div class="center">
				<h1 align="left" style="font-size: 24px;">Areas of Interest</h1>
			<textarea cols="40" rows="5" maxlength="20000" id="aoi" name="aoi" placeholder="Research Area(s) Of Interest" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: serif;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
<?PHP echo ($row)?$row["aoi"]:''; ?>
</textarea>
		</div>
		<div class="center">
				<h1 align="left" style="font-size: 24px;">Current Projects</h1>
			<textarea cols="40" rows="5" maxlength="20000" id="career" name="projects" placeholder="Current Projects" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: serif;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
<?PHP echo ($row)?$row["projects"]:''; ?>
</textarea>
		</div>
		<div class="center">
				<h1 align="left" style="font-size: 24px;">Research Goals</h1>
			<textarea cols="40" rows="5" maxlength="20000" id="reason" name="research" placeholder="Research Goals" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: serif;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
<?PHP echo ($row)?$row["research"]:''; ?>
</textarea>
		</div>
		<div class="center">
				<h1 align="left" style="font-size: 24px;">External Links</h1>
			<textarea cols="40" rows="5" maxlength="20000" id="reason" name="links" placeholder="Links to Your Website, Blog and/or Research Articles" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: serif;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
<?PHP echo ($row)?$row["links"]:''; ?>
</textarea>
		</div>
		<input type="submit" name="submit" value="Make Changes" size="50">

	</form>


</body>
</html>