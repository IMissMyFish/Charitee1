<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.php"); }
 ?>

<html lang="en" >

<head>

        <title>Charitee Questionaire</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/jquery"></script>
				<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
				<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
		    <link  rel = "stylesheet" type = "text/css"  href = "./standard.css">
        <script src="https://surveyjs.azureedge.net/1.0.56/survey.jquery.js"></script>
        <link href="https://surveyjs.azureedge.net/1.0.56/survey.css" type="text/css" rel="stylesheet"/>
        <!--<link rel="stylesheet" href="./index.css">-->
        <script src="https://unpkg.com/sortablejs@1.7.0/Sortable.js"></script>
        <script src="https://unpkg.com/surveyjs-widgets"></script>

    </head>
    <body>

			  <div id = "header">

    <h3>  <a href="./dash.php">Charitee</a></h3>
    <h4><a class = "topLinks" href = "./settings.php">Settings</a></h4>
    <h4><a class = "topLinks" href = "./profile.php">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>

  </div>
        <div id="surveyElement"></div>
        <div id="surveyResult"></div>



        <script type="text/javascript" src="./index.js"></script>

    </body>

</html>
