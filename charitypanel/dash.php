<!DOCTYPE html>

<?php
session_start();
//user panel
$_SESSION['trend'] = "No";
$row_itr = 0;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  ?>


  <?php
}
else { header("Location: ./index.php"); }

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



//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

$totalnum = 0;
include("../users.php");
$sql = "SELECT * FROM likes WHERE cid = '".$_SESSION['cidT'][0]."' AND itemid = '".$_SESSION['cidT'][0]."' AND type = 'charity' ";


$stmt2 = $connection->stmt_init();
$stmt2 = $connection->prepare($sql);
$stmt2->execute();
$stmt2->store_result();
$stmt2->fetch();

$_SESSION['totalsub'] = $stmt2->num_rows; //this is an integer!!
$stmt2 -> close();



//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

$totalnumtrend = 0;
include("../charities.php");
$resulttrend = mysqli_query($connection,"SELECT       `id`, `pop`,
             COUNT(`pop`) AS `topfive`
    FROM     `charities`
    GROUP BY `pop`
    ORDER BY `topfive` DESC
    LIMIT    5;");


$sqltrend = "SELECT       `id`, `pop`,
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




  while($row = mysqli_fetch_assoc($resulttrend)) {


    if($row['id'] == $_SESSION['cidT'][0]){
      unset($_SESSION['trend']);
      $_SESSION['trend'] = "Yes";


    }


  }


//oooooooooooooooooooooooooooo

  $totalnumtrend = 0;
  include("../charities.php");
  $resulttrend = mysqli_query($connection,"SELECT *, FIND_IN_SET( pop, (
SELECT GROUP_CONCAT( pop
ORDER BY pop DESC )
FROM charities )
) AS rank
FROM charities");


  $sqltrend = "SELECT *, FIND_IN_SET( pop, (
SELECT GROUP_CONCAT( pop
ORDER BY pop DESC )
FROM charities )
) AS rank
FROM charities";


  $stmt2trend = $connection->stmt_init();
  $stmt2trend = $connection->prepare($sqltrend);
  $stmt2trend->execute();
  $stmt2trend->store_result();
  $stmt2trend->fetch();

  $_SESSION['totalrows'] = $stmt2trend->num_rows; //this is an integer!!
  $stmt2trend -> close();




    while($row = mysqli_fetch_assoc($resulttrend)) {

      if($_SESSION['cidT'][0] == $row['id']){

        $_SESSION['rowrank'] = $row['rank'];

      }
        $row_itr = $row_itr + 1;
    }

    $_SESSION['totalrows'] = $row_itr;
    

?>


<html>

<head>
  <title>Charitee</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
    <h4><a class = "topLinks" href = "./cprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4> <h4><a class = "topLinks" href = "./dash.php">Dashboard</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>



  </div>

  <div id = "logoSec">
    <!--<img id = "logo" src="./../white_logo_transparent.png">  -->
  </div>

  <br>
  <br>

  <div id = "settingsBox" class = "container2">
    <h1>Actions</h1>
    <br>

    <div id = "actionBox">
      <a href = "needvol.php"><h3><i class="fas fa-hands-helping fa-2x"></i><br><br>Need Volunteers</h3></a>
      <a href = "hostev.php"><h3><i class="fas fa-calendar-alt fa-2x"></i><br><br>Host Event</h3></a>
      <a href = "postfund.php"><h3><i class="fas fa-dollar-sign fa-2x"></i><br><br>Post Fundraiser</h3></a>
    </div>

    <hr>
  </div>

  <div id = "settingsBox" class = "container3">
    <h1>Statistics</h1>
    <br>
    <div id = "statSec">
      <div class = "statPiece">
        <h2><?php echo($_SESSION['totalsub']);?></h2>
        <h3>Total Page Subscribers</h3>
      </div>
      <br>
      <div class = "statPiece">
        <h2><?php echo($_SESSION['trend']);?></h2>
        <h3>Trending?</h3>
      </div>
      <br>
      <div class = "statPiece">
        <h2>Rank #<?php echo($_SESSION['rowrank'])?> out of <?php echo $_SESSION['totalrows']?></h2>
        <h3>Popularity Ranking This Month</h3>
      </div>
    </div>
    <br>
    <hr>
  </div>

  <div id = "settingsBox" class = "container4">
    <h1>Recent Donations</h1>
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
