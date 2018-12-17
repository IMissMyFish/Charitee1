<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.php"); }
 ?>




 <?php

 if(isset($_GET['id'])){



   include('../charities.php');

   $result = mysqli_query($connection, 'SELECT * FROM charities WHERE uname = "'.$_GET['id'].'" ');

   $stmt = $connection->stmt_init();
   $stmt = $connection->prepare('SELECT * FROM charities WHERE uname = "'.$_GET['id'].'" ');
   $stmt->execute();
   $stmt->store_result();
   $stmt->fetch();

   $numberofrows = $stmt->num_rows; //this is an integer!!
   $stmt -> close();


   if ($numberofrows > 0) {
     // output data of each row

     $id = array();
     $cname = array();
     $city = array();
     $zip = array();


     while($row = mysqli_fetch_assoc($result)) {


       $id[] =  $row['id'];
       $cname[] = $row['cname'];
       $city[] =$row['city'];
       $zip[] =$row['zip'];


     }

     unset($_SESSION["id"]);
     unset($_SESSION["cname"]);
     unset($_SESSION["city"]);
    unset($_SESSION["zip"]);

     $_SESSION['id'] = $id;
     $_SESSION['cname'] = $cname;
     $_SESSION['city'] = $city;
    $_SESSION['zip'] = $zip;

   }






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

    <h3><a href="./dash.php"><!--<img id = "logoimg" src = "./dark_logo_transparent.png"/>-->Charitee</a></h3>
    <h4><a class = "topLinks" href = "./settings.php">Settings</a></h4>
    <h4><a class = "topLinks" href = "./cprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>

  </div>

  <div id = "exploreBox" class = "container">
    <h1><?php echo $_SESSION['cname'][0]?></h1>
    <br>
    <h3><?php echo $_SESSION['city'][0]?>, <?php echo $_SESSION['zip'][0] ?></h3>
    <br>
  </div>

</body>

<foot>
</foot>

</html>
