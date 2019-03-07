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

  if(isset($_GET['id'])){



    include('../users.php');

    $result = mysqli_query($connection, 'SELECT * FROM users WHERE uname = "'.$_GET['id'].'" ');

    $stmt = $connection->stmt_init();
    $stmt = $connection->prepare('SELECT * FROM users WHERE uname = "'.$_GET['id'].'" ');
    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch();

    $numberofrows = $stmt->num_rows; //this is an integer!!
    $stmt -> close();





    if ($numberofrows > 0) {
      // output data of each row

      $id = array();
      $uname = array();
      $bio = array();

      while($row = mysqli_fetch_assoc($result)) {


        $id[] =  $row['id'];
        $uname[] = $row['uname'];
        $bio[] = $row['bio'];


      }

      unset($_SESSION["id"]);
      unset($_SESSION["uname"]);
      unset($_SESSION["bio"]);

      $_SESSION['id'] = $id;
      $_SESSION['uname'] = $uname;
      $_SESSION['bio'] = $bio;
      $u1 = $uname;
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

    <h3><a href="./dash.php"><!--<img id = "logoimg" src = "./dark_logo_transparent.png"/>-->Charitee</a></h3>
    <h4><a class = "topLinks" href = "./settings.php"><i class="fas fa-wrench"></i></a></h4>
    <h4><a class = "topLinks" href = "./uprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4>
    <h4><a class = "topLinks" href = "./volunteer.php">Volunteer</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
    <h4><a class = "topLinks" href = "./recommended.php">Recommended</a></h4>
<h4><a class = "topLinks" href = "./dash.php">Feed</a></h4>

  </div>

  <div id = "exploreBox" class = "container">
    <?php if($_SESSION['sess_user'] == $_SESSION['uname'][0]){

      ?>
      <a href = "./editupro.php" id = "editbtn"><h6>Edit</h6></a>
      <?php
    }?>
    <br>
  <?php
  $files = glob("./uploads/{$_SESSION['uname'][0]}/p/1/*.*");

  for ($i=0; $i<count($files); $i++)
  {
    $num = $files[$i];

    echo '<img id = "profilepic" src="'.$num.'" alt="profile picture">'."&nbsp;&nbsp;";
  }
  ?>
    <h1><?php echo($_SESSION['sess_user']);?></h1>
    <br>
    <h5><em>"<?php echo $_SESSION['bio'][0]?>"</em></h5>
    <br>
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
