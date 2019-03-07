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



     $totalnum = 0;
include("../users.php");

$sql = "SELECT city FROM users WHERE uname = '".$_SESSION['sess_user']."' ";


   $result = mysqli_query($connection, $sql);

     $city = array();


     while($row = mysqli_fetch_assoc($result)) {
       $totalnum = $totalnum + 1;

       $city[] = $row['city'];


     }

     unset($_SESSION["homecity"]);

     $_SESSION['homecity'] = $city;



   $totalnum = 0;
include("../charities.php");
$sql = "SELECT cname, id FROM charities WHERE city = '".$_SESSION['homecity'][0]."' ";


 $result = mysqli_query($connection, $sql);

   $charityid = array();
   $charityname = array();

   while($row = mysqli_fetch_assoc($result)) {
     $totalnum = $totalnum + 1;

     $charityid[] = $row['id'];
     $charityname[] = $row['cname'];


   }

   unset($_SESSION["charityid"]);
   unset($_SESSION["charityname"]);

   $_SESSION['charityid'] = $charityid;
   $_SESSION["charityname"] = $charityname;


$o_vid = array();
$o_name = array();
$o_description = array();
$o_cid = array();
$o_date1 = array();
$o_date2 = array();
$o_cname = array();

include("../charities.php");

for($x = 0; $x < sizeof($_SESSION['charityid']); $x++){


  $sql = "SELECT * FROM volunteer WHERE cid = '".$_SESSION['charityid'][$x]."' ";
  $result = mysqli_query($connection, $sql);

   while($row = mysqli_fetch_assoc($result)) {


       $o_vid[] = $row['vid'];
       $o_name[] = $row['name'];
       $o_description[] = $row['description'];
       $o_cid[] = $row['cid'];
       $o_date1[] = $row['date1'];
       $o_date2[] = $row['date2'];
       $o_cname[] = $_SESSION["charityname"][$x];



     }



}



unset($_SESSION["o_vids"]);
unset($_SESSION["o_names"]);
unset($_SESSION["o_descriptions"]);
unset($_SESSION["o_cids"]);
unset($_SESSION["o_date1s"]);
unset($_SESSION["o_date2s"]);
unset($_SESSION["o_cnames"]);

$_SESSION['o_vids'] = $o_vid;
$_SESSION['o_names'] = $o_name;
$_SESSION['o_descriptions'] = $o_description;
$_SESSION['o_cids'] = $o_cid;
$_SESSION['o_date1s'] = $o_date1;
$_SESSION['o_date2s'] = $o_date2;
$_SESSION['o_cnames'] = $o_cname;



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

  <div id = "volunteerBox" class = "container">
    <h1>Volunteer Oppurtunities Nearby</h1>
    <br>
    <?php for($y = 0; $y < sizeof($_SESSION['o_vids']); $y++){
      ?>
      <h3><?php echo($_SESSION['o_names'][$y])?></h3>
      <h3><?php echo($_SESSION['o_descriptions'][$y])?></h3>
        <h3>for: <?php echo($_SESSION['o_cnames'][$y])?></h3>


          <?php

          $dayname = date('l', strtotime($_SESSION['o_date1s'][$y]));
          $daynum =  date('j', strtotime($_SESSION['o_date1s'][$y]));
          $suffix =  date('S', strtotime($_SESSION['o_date1s'][$y]));
          $month = date('M', strtotime($_SESSION['o_date1s'][$y]));
          $year = date('Y', strtotime($_SESSION['o_date1s'][$y]));

          ?>
          <div id = "sideDates"/>

          <div id = "begDate">
            <time datetime="<?php echo ($_SESSION['o_date1s'][$y]);?>" class="icon">
              <em><?php echo ($dayname);?></em>
              <strong><?php echo ($month);?> <?php echo ($year);?></strong>
              <span><?php echo ($daynum);?></span>
            </time>
          </div>

          <?php

          $dayname = date('l', strtotime($_SESSION['o_date2s'][$y]));
          $daynum =  date('j', strtotime($_SESSION['o_date2s'][$y]));
          $suffix =  date('S', strtotime($_SESSION['o_date2s'][$y]));
          $month = date('M', strtotime($_SESSION['o_date2s'][$y]));
          $year = date('Y', strtotime($_SESSION['o_date2s'][$y]));

          ?>
          <div id = "endDate">
            <time datetime="<?php echo ($_SESSION['o_date2s'][$y]);?>" class="icon">
              <em><?php echo ($dayname);?></em>
              <strong><?php echo ($month);?> <?php echo ($year);?></strong>
              <span><?php echo ($daynum);?></span>
            </time>
          </div>


      <?php
    }?>
  </div>


</body>

<foot>
</foot>

</html>
