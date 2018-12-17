<!DOCTYPE html>

<?php
session_start();
//user panel
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.php"); }

 ?>

<html>

<head>
  <title>Charitee</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link  rel = "stylesheet" type = "text/css"  href = "./standard.css">
</head>

<body>

  <figure class="tint">
    <img id = "bgImg" src="background.jpg">
  </figure>

  <div id = "header">

		<h3>  <a href="./dash.php">Charitee</a></h3>
    <!--<h3>Charitee</h3>-->

    <h4><a class = "topLinks" href = "./settings.php">Settings</a></h4>
    <h4><a class = "topLinks" href = "./profile.php">Profile</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>



  </div>

    <div id = "logoSec">
      <!--<img id = "logo" src="./../white_logo_transparent.png">  -->
    </div>

  <div id = "settingsBox" class = "container">
    <h1>Username's Profile</h1>
    <br>
    <hr>
  </div>

	  <div id = "settingsBox" class = "container2">
     <h1>Trending Relief Efforts:</h1>
    <br>
    <hr>
  </div>

	<div id = "settingsBox" class = "container3">
     <h1>Trending Non-Profits in Your Area:</h1>
    <br>
    <hr>
	</div>

		<div id = "settingsBox" class = "container4">
     <h1>Feeeeed:</h1>
    <br>
    <hr>
	</div>

</body>

<foot>
</foot>

</html>
