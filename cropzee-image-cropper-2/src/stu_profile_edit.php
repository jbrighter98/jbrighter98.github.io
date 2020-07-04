<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cropzee</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- cropzee.js -->
	<script src="cropzee.js" defer></script>
	<!--  -->
	<style>

	* {
	  margin: 0;
	  padding: 0;
	}

	body {
	  height: 100%;
	  background-repeat: no-repeat;
	  background-attachment: fixed;
	  background-color: #22FFAD;
	  background-image: linear-gradient(#22FFAD 35%, rgb(13, 117, 79))
	}

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
		hr.sexy_line {
		border: 0;
		height: 5px;
		background: #05386B;
		background-image: -webkit-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
		background-image: -moz-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
		background-image: -ms-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
		background-image: -o-linear-gradient(left, #22FFAD, #05386B, #22FFAD);
		}

	.tab {
	    display: inline-block;
	    margin-left: 70px;

	}

		.image-previewer {
			height: 205px;
			width: 205px;
			display: flex;
			border-radius: 25px;
			border: 3px solid #05386B;
			margin-left: 5%;
		}

		::-webkit-input-placeholder {
		 	color: #EFEFEF;
		}

		.form_cust{
			float: center;
			position: absolute;
			left: 500px;
			top: 60px; /*50px*/
			Width: 500px;
			Height: 720px;
			Padding: 0px;
			/*Margin: auto;*/
			margin-left: 10%;
			Background: none;
			Font-size:20px;
			Border: 2px solid #05386B;
			Border-radius: 5px;
		}

		input[type=text], select {
		    Float: center;
		    width: 75%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #05386B;
		    border-radius: 4px;
		    box-sizing: border-box;
		    background-image: radial-gradient(#05386B 5%, #031C36)
		}

		Input[type=text]{
			Width:80%;
			Font-size: 17px;
			font-family: Menlo;
		}

		Textarea {
			overflow: auto;
			outline: none;
			resize: none;
			width: 75%;
		    	padding: 12px 20px;
		    	margin: 8px 0;
		    	display: inline-block;
		    	border: 1px solid #05386B;
		    	border-radius: 4px;
		    	box-sizing: border-box;
		    	background-image: radial-gradient(#05386B 5%, #031C36)
		}

		input[type=submit] {
		    width: 30%;
		    background-color: #5CDB95;
		    border: solid;
		    border-color: #05386B;
		    color: #05386B;
		    padding: 5px 20px;
		    margin: 8px 0px;
		    border-radius: 4px;
		    cursor: pointer;

		}

		input[type=submit]:hover {
		    color: #8EE4AF;
		    background-image: linear-gradient(#05386B 5%, #031C36)
		}

		input[type="file"] {
        /*position: absolute;*/
        /*z-index: -1;
        top: 38%;
        left: 2%;*/
        font-size: 17px;
        color: transparent;
		/*width: 7.5%;*/
		height: 2%;
		visibility: hidden;
      }

			.upload {
				width: 8%;
				height: 30px;
				font-size: 15px;
				font-family: menlo;
				margin-left: 6.5%;
				margin-top: 1%;
				background-image: radial-gradient(#05386B 5%, #031C36);
				border-color: #05386B;
				color: #fff;
				outline: none;
			}

			.upload:hover {
				cursor: pointer;
			}

			

	</style>
</head>
<body>
<div class="topnav">
      <a onclick="window.location.href = 'quest_home.html'" class="top-logo"><img src="Qlogo1.png" id="toplogo" alt="Quest Logo Top" width = 45></a> 
      <div class="search-container">
            <form action="../../search.php" method="post">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit"><i class="material-icons" style="color:#05386B; float:left">search</i></button>
            </form>
      </div>
      <a href="../../home_page.php">PROJECTS</a>
      <a href="../../portfolio_edit.php">PORTFOLIO</a>
      <a id="profile-link" href="../../logout.php">LOGOUT</a>
      <a id="profile-link" href="stu_profile_post.php">PROFILE</a>
</div>

<hr class="sexy_line" color="#05386B">

</br>
	<form class="form_cust" action="stu_profile.inc.php" align="middle" method="post" enctype="multipart/form-data">
		<pre class="tab"></pre>
		<label for="cropzee-input" class="image-previewer" data-cropzee="cropzee-input" style="background: #05386B"></label>
		<input id="cropzee-input" name="image" type="file" accept="image/*" style="margin-left: 70px; padding: 10px 0px; float: left;"/>
		<input type="button" value="Upload Image" class="upload" onclick="document.getElementById('cropzee-input').click()"/>
		<!--<button type="button" style="top: 20px; left: 10%; padding: 10px 20px; font-size: 12px; color: white; background-image: radial-gradient(#05386B 5%, #031C36); border: none; cursor: pointer; font-family: Menlo;"><label for="file" style="cursor: pointer;">Upload Image</label></button>
		<button onclick="cropzeeGetImage('cropzee-input')">Get Image (as blob / data-url)</button>-->
		<script>
			$(document).ready(function(){
				$("#cropzee-input").cropzee({startSize: [85, 85, '%'],});
			});
		</script>

		<input type="text" id="uname" name="name" placeholder="Name" style="color: #FFFFFF;"  onfocus="this.placeholder = '' offfocus="this.placeholder = ''>

		</br>

									<!--<input type="text" id="year" name="year" placeholder="Academic Standing" style="color: #FFFFFF" onfocus="this.placeholder = ''">-->
		<select id="select" name="year" style="width: 75%; padding: 5px; font-size: 17px; font-family: Menlo; color: white; background-image: radial-gradient(#05386B 5%, #031C36);">
			<option hidden="">Academic Standing</option>
			<option value="Freshman">Freshman</option>
			<option value="Sophomore">Sophomore</option>
			<option value="Junior">Junior</option>
			<option value="Senior">Senior</option>
		</select>
		</br>

		<input type="text" id="major" name="major" placeholder="Major" style="color: #FFFFFF;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''>
		</br>

		<textarea cols="40" rows="5" maxlength="200" id="aoi" name="aoi" placeholder="Research Area(s) Of Interest" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: Menlo; color: white;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''></textarea>

		</br>

		<textarea cols="40" rows="5" maxlength="200" id="career" name="career" placeholder="Career Ambitions" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: Menlo; color: white;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''></textarea>

		</br>

		<textarea cols="40" rows="5" maxlength="200" id="reason" name="reason" placeholder="Reasons For Wanting to do Research" style="Width:80%; Padding: 5px; Font-size: 17px; font-family: Menlo; color: white;" onfocus="this.placeholder = '' offfocus="this.placeholder = ''></textarea>

		<input type="submit" name="submit" value="Make Changes" size="50">

	</form>


</body>
</html>
