<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

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
$nameErr = $descriptionErr = $date1Err = $nameErr = $typeErr = $date2Err = $cityErr = $stateErr = $zipErr = $bedsErr = $bathsErr = $priceErr = $rmNumErr = "";




include('../charities.php');
if(isset($_POST['action']))
{

  if($_POST['action']=="list")
  {


    $cid = $_SESSION['cidT'][0];
    $name = mysqli_real_escape_string($connection,$_POST['name']);
    $description = mysqli_real_escape_string($connection,$_POST['description']);
    $date1 = mysqli_real_escape_string($connection,$_POST['date1']);


    $problemCounter = 0;



    if (empty($_POST["name"])) {
      $nameErr = " is required*";
      $problemCounter = $problemCounter + 1;
    } else {
      $name = test_input($_POST["name"]);
    }

    if (empty($_POST["description"])) {
      $descriptionErr = " is required*";
      $problemCounter = $problemCounter + 1;
    } else {
      $description = test_input($_POST["description"]);
    }

    if (empty($_POST["date1"])) {
      $date1Err = " is required*";
      $problemCounter = $problemCounter + 1;
    } else {
      $date1 = test_input($_POST["date1"]);
    }




    $sql = "INSERT into `event` (`cid`, `name`, `description`, `date1`) values('".$cid."', '".$name."','".$description."','".$date1."')";

    if($problemCounter == 0){

      if(mysqli_query($connection, $sql))
      {


          header("Location: dash.php");
          exit();

        }


      }

    }


  mysqli_close($connection);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<html>

<head>
  <title>Charitee</title>
  <link href="dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
  <script src="dist/js/datepicker.min.js"></script>
  <script src="dist/js/i18n/datepicker.en.js"></script>

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

      <form name = "master" action="" method = "post">
        <h2 id = "headTitle">Create an Event</h2>
        <div id = "inputSec" class = "textInput">
          <?php echo $nameErr ?>
          <input class = "auto" type="text" name="name"  pattern = ".{1,50}"  placeholder="Event Name (1-50 characters)">

          <?php echo $descriptionErr?>
          <textarea readonly = "readonly" cols = "4" rows = "1" id = "counter"></textarea>
          <br>
          <input onkeyup="textCounter(this,'counter',255);" pattern = ".{1,255}"  class = "auto" type="text" name="description"  placeholder="Event Description (1-255 characters)">
          <?php echo $date1Err ?>
          <input name="date1" placeholder="Event Date"  class="datepicker-here" data-position="right top"  data-language='en'   required>
        </div>

        <input name="action" type="hidden" value="list" />
        <input id = "mainSB" class = "submitButton" type="submit" value="Submit">

      </form>
    </div>





          <script>
          function textCounter(field,field2,maxlimit)
          {
           var countfield = document.getElementById(field2);
           if ( field.value.length > maxlimit ) {
            field.value = field.value.substring( 0, maxlimit );
            return false;
           } else {
            countfield.value = maxlimit - field.value.length;
           }
          }
          </script>


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
