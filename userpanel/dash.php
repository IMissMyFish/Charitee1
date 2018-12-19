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
    <h4><a class = "topLinks" href = "./uprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>



  </div>

        <br>
        <br>

    	  <div id = "settingsBox" class = "container5">
         <h1>Trending Non-Profits in Your Area</h1>
        <br>
        <?php for($i = 0; $i < $totalnum; $i++){
    ?>
    <div>
      <a id = "clink" href = "./cprofile.php?id=<?php echo $_SESSION['uname'][$i]?>"><h2><?php echo $_SESSION['cname'][$i]?></h2></a>
      <h3><?php echo $_SESSION['city'][$i]?>, <?php echo $_SESSION['zip'][$i]?></h3>
    </div>

      <?php
        }?>

        <hr>
      </div>

	  <div id = "settingsBox" class = "container2">
     <h1>Trending Relief Efforts:</h1>
    <br>
    <hr>
  </div>

		<div id = "settingsBox" class = "container4">
     <h1>Feed:</h1>
    <br>
    <hr>
	</div>

</body>

<foot>
</foot>

</html>
