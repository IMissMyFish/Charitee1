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
  $result = mysqli_query($connection, 'SELECT * FROM interests WHERE uname = "'.$_SESSION['sess_user'].'" ');


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
     else{

       include("../users.php");
       $resultx = mysqli_query($connection, 'SELECT * FROM users WHERE uname = "'.$_SESSION['sess_user'].'" ');

       $cityx = array();
       $statex = array();

       while($row = mysqli_fetch_assoc($resultx)){

         $cityx = $row['city'];
         $statex = $row['state'];


       }



       $ints = array();
       $ints_c = "";
       $ints_s = "";
       $ints3 = array();

       while($row = mysqli_fetch_assoc($result)) {

         if($row['c1'] == "yes"){

          $ints[] = "Water";

         }

         if($row['c2'] == "yes"){

          $ints[] = "Food";

         }


         if($row['c3'] == "yes"){

          $ints[] = "Shelter";

         }


         if($row['c4'] == "yes"){

          $ints[] = "Orphanage/Foster";

         }


         if($row['c5'] == "yes"){

          $ints[] = "Disease/Disorder";

         }


         if($row['c6'] == "yes"){

          $ints[] = "Abuse";

         }


         if($row['c7'] == "yes"){

          $ints[] = "Addiction";

         }


         if($row['c8'] == "yes"){

          $ints[] = "Family Support";

         }


         if($row['c9'] == "yes"){

          $ints[] = "Arts/Culture";
         }


         if($row['c10'] == "yes"){

          $ints[] = "Animals";

         }


         if($row['c11'] == "yes"){

          $ints[] = "Environment";

         }


         if($row['c12'] == "yes"){

          $ints[] = "Disaster Relief";

         }


         if($row['c13'] == "yes"){

          $ints[] = "Human Rights";

         }

         if($row['c14'] == "yes"){

          $ints[] = "Education";

         }


         if($row['c15'] == "yes"){

          $ints[] = "Cancer Research";

         }


         if($row['d1'] == "yes"){

          $ints_c = $cityx;

         }
         else{

           $ints_c = "*";

         }

         if($row['d2'] == "yes"){

          $ints_s = $statex[0];

         }
         else{

           $ints_s = "*";

         }


         if($row['e1'] == "yes"){

          $ints3[] = "1";

         }


         if($row['e2'] == "yes"){

          $ints3[] = "2";

         }

         if($row['e3'] == "yes"){

          $ints3[] = "3";

         }




       }

       $totalcid = array();
       $totalcname = array();
       $totalcity = array();
       $totalstate = array();
       $totalcat = array();
       $totaluname = array();

       for($a = 0; $a < sizeof($ints); $a++){


         for($b = 0; $b < sizeof($ints3); $b++){

include("../charities.php");
                  $result44 = mysqli_query($connection, 'SELECT * FROM charities WHERE (cat = "'.$ints[$a].'" AND city = "'.$ints_c.'") OR
                  (cat = "'.$ints[$a].'" AND state = "'.$ints_s.'")
                  OR (relig = "'.$ints3[$b].'" AND cat != "'.$ints[$a].'" AND city = "'.$ints_c.'")
                  OR (relig = "'.$ints3[$b].'" AND cat != "'.$ints[$a].'" AND state = "'.$ints_s.'") OR (cat = "'.$ints[$a].'")');


                     while($row = mysqli_fetch_assoc($result44)){


                       $totalcid[] = $row['id'];
                       $totalcname[] = $row['cname'];
                       $totalcity[] = $row['city'];
                       $totalstate[] = $row['state'];
                       $totalcat[] = $row['cat'];
                       $totaluname[] = $row['uname'];


                     }


         }

       }

       unset($_SESSION['cidT']);
       unset($_SESSION['cnameT']);
       unset($_SESSION['cityT']);
       unset($_SESSION['stateT']);
       unset($_SESSION['catT']);
       unset($_SESSION['unameT']);

       $_SESSION['cidT'] = $totalcid;
       $_SESSION['cnameT'] = $totalcname;
       $_SESSION['cityT'] = $totalcity;
       $_SESSION['stateT'] = $totalstate;
       $_SESSION['catT'] = $totalcat;
       $_SESSION['unameT'] = $totaluname;


     }



     //SURVEY

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

  <div id = "recBox" class = "container">
    <h1>Recommended Charities</h1>
    <br>

        <?php

        for($i = 0; $i < sizeof($_SESSION['cidT']); $i++) {

          ?>

          <div id = "exploreBox" class = "container">
          <a id = "clink" href = "./cprofile.php?id=<?php echo $_SESSION['unameT'][$i]?>"><h2><?php echo $_SESSION['cnameT'][$i]?></h2></a>
          <h3><?php echo $_SESSION['catT'][$i] ?> </h3>
          <h3><?php echo $_SESSION['cityT'][$i]?>, <?php echo $_SESSION['stateT'][$i]?></h3>
          </div>
          <br>
          <?php
        }

        ?>
  </div>


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
