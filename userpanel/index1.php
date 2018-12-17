<!DOCTYPE html>

<?php
session_start();

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
	<!--<link type="text/css" href="quiz-survey/css/style.css" rel="alternate stylesheet" title="Charitee" />-->
</head>

<body>

  <figure class="tint">
    <!--<img id = "bgImg" src="background.jpg">-->
  </figure>

  <div id = "header">

    <h3>  <a href="./dash.php">Charitee</a></h3>
    <h4><a class = "topLinks" href = "./settings.php">Settings</a></h4>
    <h4><a class = "topLinks" href = "./uprofile.php">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>

  </div>

  <div id = "surveyBox" class = "container">
    <h1>Survey</h1>
  </div>


 <div id="q-cont" class = "container">

  <div class="slide" id="slide1">
    <div class="question">
      User's FN, would you like to answer a quick questionaire before you get started to help find charities for you?
    </div>
    <div class="options">


      <span class="op" for="q2op1">YES! I'd love to!</span>
			<span class="op op2" for="q2op2">Not just yet.</span><br />

    </div>


  </div>

  <div class="slide" id="slide2">
    <div class="question">
      Which of these interests you?
    </div>
    <div class="options">
      <span class="op" for="q1op1">Cancer Research</span>
			<span class="op " for="q1op4">Text field</span>
			<span class="op" for="q1op3">Religion</span>
			<span class="op op2" for="q1op5">Domestic Violence</span>

			<span class="op op2" id ="Poverty" checked="checked" for="q1op2">Poverty</span>

			<span class="op op2" for="q1op6">Animals</span>

			<span class="op op3" for="q1op7">Disaster Relief</span>
			<span class="op op3"  for="q1op8">Homeless</span>
			<span class="op op3" for="q1op9">Children</span>
			<span class="op op3" for="q1op9">Text field</span>
    </div>
    </div
  </div>

<!--  <div class="slide" id="slide3">
    <div class="question">
      How far would you like your money to reach?
    </div>
    <div class="options">
      <span class="op" for="q3op1">Locally</span>
			<span class="op op2" for="q3op2">Regionally</span>
			<span class="op" for="q3op3">Nationally</span>
			<span class="op op2" for="q3op4">Globally</span>
    </div>
  </div>

	  <div class="slide" id="slide4">
    <div class="question">
      Which religions would you be interested in?
    </div>
    <div class="options">
      <span class="op" for="q4op1">Christian</span>
			<span class="op op2" for="q4op2">Regionally</span>
			<span class="op" for="q4op3">Nationally</span>
			<span class="op op2" for="q4op4">Globally</span>
    </div>
  </div>-->


  <<!--div class="slide" id="slide4">
    Well Done!
    <div class="re">
      Reset
    </div>-->
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="quiz-survey/js/index.js"></script>





</body>

<foot>
</foot>

</html>
