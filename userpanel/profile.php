<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.html"); }
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

    <h3>  <a href="./dash.php"><img id = "logoimg" src = "./dark_logo_transparent.png"/></a></h3>
    <h4><a class = "topLinks" href = "./settings.php">Settings</a></h4>
    <h4><a class = "topLinks" href = "./profile.php">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>

  </div>

  <div id = "exploreBox" class = "container">
    <h1>Explore Charities</h1>
    <br>
  </div>

</body>

<foot>
</foot>

</html>
