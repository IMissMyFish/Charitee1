<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.php"); }

  //SURVEY

  include("../users.php");
  $survResult = mysqli_query($connection, 'SELECT * FROM interests WHERE uname = "'.$_SESSION['sess_user'].'" ');


     $survStmt = $connection->stmt_init();
     $survStmt = $connection->prepare('SELECT * FROM interests WHERE uname = "'.$_SESSION['sess_user'].'" ');
     $survStmt->execute();
     $survStmt->store_result();
     $survStmt->fetch();

     $survNumberofrows = $survStmt->num_rows; //this is an integer!!
     $survStmt -> close();

     if($survNumberofrows == 0){

       header("Location: survey.php");

     }

     //SURVEY



     //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

     $totalnumtrend = 0;
     include("../charities.php");
     $resulttrend = mysqli_query($connection,"SELECT      *, `pop`,
                  COUNT(`pop`) AS `topfive`
         FROM     `charities`
         GROUP BY `pop`
         ORDER BY `topfive` DESC
         LIMIT    5;");


     $sqltrend = "SELECT      *, `pop`,
                  COUNT(`pop`) AS `topfive`
         FROM     `charities`
         GROUP BY `pop`
         ORDER BY `topfive` DESC
         LIMIT    5;";


     $stmt2trend = $connection->stmt_init();
     $stmt2trend = $connection->prepare($sqltrend);
     $stmt2trend->execute();
     $stmt2trend->store_result();
     $stmt2trend->fetch();

     $temp1trend = $stmt2trend->num_rows; //this is an integer!!
     $stmt2trend -> close();


     $topfivename = array();
     $topfiveid = array();
     $topfivecity = array();
     $topfivetype = array();
     $topfivestate = array();
     $topfiveuname = array();

       while($row = mysqli_fetch_assoc($resulttrend)) {

         $topfivename[] = $row['cname'];
         $topfiveid[] = $row['id'];
         $topfivecity[] = $row['city'];
         $topfivetype[] = $row['cat'];
         $topfivestate[] = $row['state'];
         $topfiveuname[] = $row['uname'];


       }

       unset($_SESSION['t5name']);
      unset($_SESSION['t5id']);
        unset($_SESSION['t5city']);
        unset($_SESSION['t5type']);
        unset($_SESSION['t5state']);
        unset($_SESSION['t5uname']);

       $_SESSION['t5name'] = $topfivename;
       $_SESSION['t5id'] = $topfiveid;
       $_SESSION['t5city'] = $topfivecity;
       $_SESSION['t5type'] = $topfivetype;
       $_SESSION['t5state'] = $topfivestate;
       $_SESSION['t5uname'] = $topfiveuname;

 ?>



<html>

<head>
  <title>Charitee</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link  rel = "stylesheet" type = "text/css"  href = "../standard.css">
</head>

<body>

  <figure class="tint">
    <img id = "bgImg" src="background.jpg">
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

<div class = container>
  <h1>Explore Charities</h1>
</div>

<div class = "container">
<h1>Trending Nonprofits:</h1>

<br>

    <?php

    for($i = 0; $i < $temp1trend; $i++) {

      ?>

      <div id = "exploreBox" class = "container">
      <a id = "clink" href = "./cprofile.php?id=<?php echo $_SESSION['t5uname'][$i]?>"><h2><?php echo $_SESSION['t5name'][$i]?></h2></a>
      <h3><?php echo $_SESSION['t5type'][$i] ?> </h3>
      <h3><?php echo $_SESSION['t5city'][$i]?>, <?php echo $_SESSION['t5state'][$i]?></h3>
      </div>
      <br>
      <?php
    }

    ?>
</div>


    <?php

    /*for($i = 0; $i < $totalnum; $i++) {

      ?>

      <div id = "exploreBox" class = "container">
      <a id = "clink" href = "./cprofile.php?id=<?php echo $_SESSION['uname'][$i]?>"><h2><?php echo $_SESSION['cname'][$i]?></h2></a>
      <h3><?php echo $_SESSION['city'][$i]?>, <?php echo $_SESSION['zip'][$i]?></h3>
      </div>

      <?php
    }*/

    ?>







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
