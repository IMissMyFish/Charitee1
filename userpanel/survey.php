<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  ?>


  <?php
}
else { header("Location: ./index.php"); }




$c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7 = $c8 = $c9 = $c10 = $c11 = $c12 = $c13 = $c14 = $c15 = "no";
$d1 = $d2 = $d3 = "no";
$e1 = $e2 = $e3 = "no";
if(isset($_POST['action']))
{
  if($_POST['action']=="surveyed")
  {

  include('../users.php');

  mysqli_query($connection, 'DELETE FROM `interests` WHERE uname = "'.$_SESSION['sess_user'].'"');

  if (!empty($_POST["c1"])) {

    $c1 = "yes";

  }


  if (!empty($_POST["c2"])) {

    $c2 = "yes";

  }

  if (!empty($_POST["c3"])) {

    $c3 = "yes";

  }

  if (!empty($_POST["c4"])) {

    $c4 = "yes";

  }

  if (!empty($_POST["c5"])) {

    $c5 = "yes";

  }

  if (!empty($_POST["c6"])) {

    $c6 = "yes";

  }

  if (!empty($_POST["c7"])) {

    $c7 = "yes";

  }

  if (!empty($_POST["c8"])) {

    $c8 = "yes";

  }

  if (!empty($_POST["c9"])) {

    $c9 = "yes";

  }

  if (!empty($_POST["c10"])) {

    $c10 = "yes";

  }

  if (!empty($_POST["c11"])) {

    $c11 = "yes";

  }

  if (!empty($_POST["c12"])) {

    $c12 = "yes";

  }

  if (!empty($_POST["c13"])) {

    $c13 = "yes";

  }

  if (!empty($_POST["c14"])) {

    $c14 = "yes";

  }

  if (!empty($_POST["c15"])) {

    $c15 = "yes";

  }


  if (!empty($_POST["radio"])) {

    if($_POST["radio"] == "d1"){

      $d1 = "yes";

    }
    else if($_POST["radio"] == "d2"){

      $d2 = "yes";
    }
    else if($_POST["radio"] == "d3"){
      $d3 = "yes";

    }

  }


  if (!empty($_POST["e1"])) {

    $e1 = "yes";

  }


  if (!empty($_POST["e2"])) {

    $e2 = "yes";

  }

  if (!empty($_POST["e3"])) {

    $e3 = "yes";

  }



  mysqli_query($connection, 'INSERT INTO interests
    VALUES ("'.$_SESSION['sess_user'].'", "'.$c1.'", "'.$c2.'", "'.$c3.'", "'.$c4.'", "'.$c5.'",
     "'.$c6.'", "'.$c7.'", "'.$c8.'", "'.$c9.'",  "'.$c10.'",  "'.$c11.'",  "'.$c12.'",  "'.$c13.'",  "'.$c14.'",  "'.$c15.'",  "'.$d1.'",  "'.$d2.'",  "'.$d3.'",
    "'.$e1.'",  "'.$e2.'",  "'.$e3.'")');
header("Location: ./dash.php");

}
}
?>

<html>

<head>
  <title>Charitee</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link  rel = "stylesheet" type = "text/css"  href = "../standard.css">
  <!--<link type="text/css" href="quiz-survey/css/style.css" rel="alternate stylesheet" title="Charitee" />-->
</head>

<body>

  <figure class="tint">
    <!--<img id = "bgImg" src="background.jpg">-->
  </figure>

  <div id = "header">

    <h3>  <a href="./dash.php">Charitee</a></h3>
    <h4><a class = "topLinks" href = "./settings.php"><i class="fas fa-wrench"></i></a></h4>
    <h4><a class = "topLinks" href = "./uprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>
    <h4><a class = "topLinks" href = "./dash.php">Feed</a></h4>

  </div>


  <div id = "bodySec">


    <div id = "mainBox">

      <form name = "master" action="" method = "post">
        <h2 id = "headTitle">Survey</h2>

        <h3>Select all that interest you: </h3>
        <div id = "intBox">
          <div class="inputGroup">
            <input type="checkbox" id="c1" name = "c1"/><label for="c1">Water</label>
          </div>
          <div class="inputGroup">
            <input type="checkbox" id="c2"  name = "c2" /><label for="c2">Food</label>
          </div>
          <div class="inputGroup">
            <input type="checkbox" id="c3" name = "c3" /><label for="c3">Shelter</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c4" name = "c4"/><label for="c4">Orphanage/Foster</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c5"  name = "c5" /><label for="c5">Disease/Disorder</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c6" name = "c6" /><label for="c6">Abuse</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c7" name = "c7"/><label for="c7">Addiction</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c8"  name = "c8" /><label for="c8">Family Support</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c9" name = "c9" /><label for="c9">Arts/Culture</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c10" name = "c10"/><label for="c10">Animals</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c11"  name = "c11" /><label for="c11">Environment</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c12" name = "c12" /><label for="c12">Disaster Relief</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c13" name = "c13"/><label for="c13">Human Rights</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c14"  name = "c14" /><label for="c14">Education</label>
          </div>

          <div class="inputGroup">
            <input type="checkbox" id="c15" name = "c15" /><label for="c15">Cancer Research</label>
          </div>
        </div>

        <br>
        <br>

        <h3>Which locale of non-profits would you like to donate to?</h3>
        <div class="inputGroup">
          <input id="radio1" name="radio" type="radio" checked = "checked" value = "d1"/>
          <label for="radio1">City</label>
        </div>

        <div class="inputGroup">
          <input id="radio2" name="radio" type="radio" value = "d2"/>
          <label for="radio2">State</label>
        </div>

        <div class="inputGroup">
          <input id="radio3" name="radio" type="radio" value = "d3"/>
          <label for="radio3">Nation</label>
        </div>

        <br>
        <br>

        <h3>Which religious organizations are you interested in?</h3>
        <div class="inputGroup">
          <input type="checkbox" id="e1" name = "e1"/><label for="e1">Christian</label>
        </div>
        <div class="inputGroup">
          <input type="checkbox" id="e2"  name = "e2" /><label for="e2">Islamic</label>
        </div>
        <div class="inputGroup">
          <input type="checkbox" id="e3" name = "e3" /><label for="e3">Jewish</label>
        </div>

        <br>
        <br>


        <input name="action" type="hidden" value="surveyed" />
        <input id = "mainSB" class = "submitButton" type="submit" value="Submit">

      </form>
    </div>

    <!--  <div class="slide" id="slide2">-->
    <!--    <div class="question">-->
    <!--      Which of these interests you?-->
    <!--    </div>-->
    <!--			<div class="options">-->
    <!--				<span class="op" for="q2op1">Cancer Research</span>-->
    <!--				<span class="op " for="q2op4">Text field</span>-->
    <!--				<span class="op" for="q2op3">Religion</span>-->
    <!--				<span class="op op2" for="q2op5">Domestic Violence</span>-->
    <!--	-->
    <!--				<span class="op op2" id ="Poverty" checked="checked" for="q2op2">Poverty</span>-->
    <!--	-->
    <!--				<span class="op op2" for="q2op6">Animals</span>-->
    <!--	-->
    <!--				<span class="op op3" for="q2op7">Disaster Relief</span>-->
    <!--				<span class="op op3"  for="q2op8">Homeless</span>-->
    <!--				<span class="op op3" for="q2op9">Children</span>-->
    <!--				<span class="op op3" for="q2op9">Text field</span>-->
    <!--			</div>-->
    <!--	</div>-->







    <!--	<div class="slide" id="slide4">
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


<!--div class="slide" id="slide4">
Well Done!
<div class="re">
Reset
</div>-->
</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



<script  src="quiz-survey/js/index.js"></script>






<div class="footer">
  <div id = "links1">
    <a href = "//www.facebook.com/Charitee-2251481035076815/"><h2>Facebook</h2></a>
    <a href = "../usage.php"><h2>How It Works</h2></a>
    <a href = "../about.php"><h2>More About Us</h2></a>
    <a href = "../terms.php"><h2>Terms and Conditions</h2></a>
  </div>

  <div id = "info1">

    <h4>contact@charitee.com</h4>
    <br>
    <br>
    <h5>Charitee, LLC.</h5>
    <h5>Tallahassee, FL</h5>
    <h5>2019</h5>
  </div>
</div>
</body>

<foot>
</foot>

</html>
