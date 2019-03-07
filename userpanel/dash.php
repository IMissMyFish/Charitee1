<!DOCTYPE html>

<?php
session_start();
//user panel
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

 ?>

 <?php
 $totalnum = 0;
 include("../charities.php");
 $sql = "SELECT * FROM charities";


 $stmt2 = $connection->stmt_init();
 $stmt2 = $connection->prepare($sql);
 $stmt2->execute();
 $stmt2->store_result();
 $stmt2->fetch();

 $numberofrows = $stmt2->num_rows; //this is an integer!!
 $stmt2 -> close();

 $result = mysqli_query($connection, $sql);

 if ($numberofrows > 0) {
   // output data of each row



   $cname = array();
   $city = array();
   $zip = array();
   $uname = array();



   while($row = mysqli_fetch_assoc($result)) {
     $totalnum = $totalnum + 1;
     $cname[] = $row['cname'];
     $city[] = $row['city'];
     $zip[] =$row['zip'];
     $uname[] =$row['uname'];


   }

   unset($_SESSION["cname"]);
   unset($_SESSION["city"]);
   unset($_SESSION["zip"]);
   unset($_SESSION["uname"]);

   $_SESSION['cname'] = $cname;
   $_SESSION['city'] = $city;
   $_SESSION['zip'] = $zip;
   $_SESSION['uname'] = $uname;

 }








$totalnum000 = 0;



   include('../users.php');


   $postResult = mysqli_query($connection, 'SELECT cid FROM likes WHERE uid = "'.$_SESSION['sess_user'].'" AND type = "charity" ');


   $postStmt = $connection->stmt_init();
   $postStmt = $connection->prepare('SELECT cid FROM likes WHERE uid = "'.$_SESSION['sess_user'].'" AND type = "charity" ');
   $postStmt->execute();
   $postStmt->store_result();
   $postStmt->fetch();

   $postNumberofrows = $postStmt->num_rows; //this is an integer!!
   $postStmt -> close();
$totalnum00 = 0;

       if ($numberofrows > 0) {
         // output data of each row



         $xid = array();

         while($row = mysqli_fetch_assoc($postResult)) {
           $totalnum00 = $totalnum00 + 1;
           $xid[] = $row['cid'];


         }

         unset($_SESSION["xid"]);


         $_SESSION['xid'] = $xid;

       }




for($j = 0; $j < $totalnum00; $j++){

include("../charities.php");

  $postResult = mysqli_query($connection, 'SELECT * FROM cposts WHERE cid = "'.$_SESSION['xid'][$j].'" ORDER BY date DESC');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM cposts WHERE cid = "'.$_SESSION['xid'][$j].'"  ORDER BY  date DESC');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($numberofrows > 0) {
    // output data of each row



    $zid = array();
    $zcid = array();
    $zuname = array();
    $zmsg = array();
    $zdate = array();

    while($row = mysqli_fetch_assoc($postResult)) {
      $totalnum000 = $totalnum000 + 1;
      $zid[] = $row['id'];
      $zcid[] = $row['cid'];
      $zuname[] = $row['uname'];
      $zmsg[] = $row['msg'];
      $zdate[] = $row['date'];


    }

    unset($_SESSION["zid"]);
    unset($_SESSION["zcid"]);
    unset($_SESSION["zuname"]);
    unset($_SESSION["zmsg"]);
    unset($_SESSION["zdate"]);


    $_SESSION['zid'] = $zid;
    $_SESSION['zcid'] = $zcid;
    $_SESSION['zuname'] = $zuname;
    $_SESSION['zmsg'] = $zmsg;
    $_SESSION['zdate'] = $zdate;

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
</head>

<body>

  <figure class="tint">
    <img id = "bgImg" src="background.jpg">
  </figure>

  <div id = "header">

		<h3>  <a href="./dash.php">Charitee</a></h3>
    <!--<h3>Charitee</h3>-->

    <h4><a class = "topLinks" href = "./settings.php"><i class="fas fa-wrench"></i></a></h4>
    <h4><a class = "topLinks" href = "./uprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>
<h4><a class = "topLinks" href = "./dash.php">Feed</a></h4>



  </div>

        <br>
        <br>

		<div id = "settingsBox" class = "container">
     <h1>Feed:</h1>
     <?php

     for($z = 0; $z < $totalnum000; $z++){

       echo($_SESSION['zuname'][$z]);
       ?><br><?php
       echo($_SESSION['zmsg'][$z]);
       ?><br><?php
       echo($_SESSION['zdate'][$z]);
       ?><br><br><br><br><?php


     }


     ?>
    <br>
    <hr>
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
