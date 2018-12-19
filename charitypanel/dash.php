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
    <h4><a class = "topLinks" href = "./cprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
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

    <div>
      <a><h3>Post Volunteer Oppurtunity</h3></a>
      <a><h3>Post Event</h3></a>
      <a><h3>Post Fundraiser</h3></a>
    </div>

    <hr>
  </div>

  <div id = "settingsBox" class = "container3">
    <h1>Statistics</h1>
    <br>
    <hr>
  </div>

  <div id = "settingsBox" class = "container4">
    <h1>Recent Donations</h1>
    <br>
    <hr>
  </div>

</body>

<foot>
</foot>

</html>
