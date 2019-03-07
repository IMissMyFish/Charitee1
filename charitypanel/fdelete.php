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



<?php

if(isset($_POST['num'])){
  $_SESSION['pnum'] =  $_POST['num'];
}


if($_POST['action']== "delete")
{


    include("../charities.php");

      $n1 = $_SESSION['pnum'];
      $_SESSION['trueid'] = $_SESSION['f_fid'][$n1];



      $sql0 = "SELECT id FROM charities WHERE uname = '".$_SESSION['sess_user']."' ";
      $resultz = mysqli_query($connection, $sql0);



          $result0 = array();



          while($row = mysqli_fetch_assoc($resultz)) {

            $result0[] = $row['id'];

          }

          unset($_SESSION["result0"]);

          $_SESSION['result0'] = $result0;




      $sql = "DELETE FROM fundraiser WHERE fid = '".$_SESSION['trueid']."' AND cid = '".$_SESSION['result0'][0]."' ";
      mysqli_query($connection, $sql);

      header("Location: dash.php");

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
    <h4><a class = "topLinks" href = "./settings.php"><i class="fas fa-wrench"></i></a></h4>
    <h4><a class = "topLinks" href = "./cprofile.php?id=<?php echo $_SESSION['sess_user'] ?>">Profile</a></h4> <h4><a class = "topLinks" href = "./dash.php">Dashboard</a></h4>
    <h4><a class = "topLinks" href = "./explore.php">Explore</a></h4>
  </div>



    <div id = "mainBox">
      <h2>Are you sure you want to delete this fundraiser? All data will be lost!</h2>


      <form action = "" method = "post">
        <input name="action" type="hidden" value="delete" />
        <input id = "deleteBtn" class = "submitButton" type="submit" value="Yes">
      </form>


      <a  href = "/dash.php" ><input id = "editBtn"class = "submitButton" type="submit" value="No"></a>


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
