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



if(isset($_POST['num'])){
  $n1 = $_POST['num'];
  $_SESSION['trueid'] = $_SESSION['v_vid'][$n1];
}


?>

<?php
      $totalnum = 0;
include("../charities.php");
$sql0 = "SELECT * FROM volunteer WHERE vid = '".$_SESSION['trueid']."' AND cid = '".$_SESSION['id'][0]."' ";


    $stmt0 = $connection->stmt_init();
    $stmt0 = $connection->prepare($sql0);
    $stmt0->execute();
    $stmt0->store_result();
    $stmt0->fetch();

    $numberofrows0 = $stmt0->num_rows; //this is an integer!!
    $stmt0 -> close();

    $result0 = mysqli_query($connection, $sql0);

    if ($numberofrows0 > 0) {
      // output data of each row



      $name0 = array();
      $description0 = array();
      $date10 = array();
      $date20 = array();



      while($row = mysqli_fetch_assoc($result0)) {
        $totalnum = $totalnum + 1;
        $name0[] = $row['name'];
        $description0[] = $row['description'];
        $date10[] =$row['date1'];
        $date20[] = $row['date2'];


      }

      unset($_SESSION["name0"]);
      unset($_SESSION["description0"]);
      unset($_SESSION["date10"]);
      unset($_SESSION["date20"]);

      $_SESSION['name0'] = $name0;
      $_SESSION['description0'] = $description0;
      $_SESSION['date10'] = $date10;
      $_SESSION['date20'] = $date20;

    }

?>


<?php
$date1Err = $date2Err = $nameErr = $descriptionErr = "";





if($_POST['action']== "edit")
{

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

      if (empty($_POST["date2"])) {
        $date2Err = " is required*";
        $problemCounter = $problemCounter + 1;
      } else {
        $date2 = test_input($_POST["date2"]);
      }

if($problemCounter == 0){


      include("../charities.php");



        $nm = mysqli_real_escape_string($connection,$_POST['name']);
        $dt1 = mysqli_real_escape_string($connection,$_POST['date1']);
        $dt2 = mysqli_real_escape_string($connection,$_POST['date2']);
        $ds = mysqli_real_escape_string($connection,$_POST['description']);


        $vid = $_SESSION['trueid'];
        $cid = $_SESSION['id'][0];

        $sql0 = "UPDATE
          volunteer
        SET
          name = '".$nm."',
          date1 = '".$dt1."',
          date2 = '".$dt2."',
          description = '".$ds."'
        WHERE
          vid = '".$vid."'
          AND cid = '".$cid."'

        ";
        if(mysqli_query($connection, $sql0)){

          header("Location: dash.php");

        };








}
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
      <h2>Edit Volunteer Oppurtunity</h2>
<br><br>

<form name = "master" action="" method = "post">
  <div id = "inputSec" class = "textInput">
    <?php echo $nameErr ?>
    <input  value = "<?php echo $_SESSION['name0'][0]?>" class = "auto" type="text" name="name" pattern = ".{1,50}" placeholder="Oppurtunity Name (1-50 characters)">
    <?php echo $descriptionErr?>
    <textarea readonly = "readonly" cols = "4" rows = "1" id = "counter"></textarea>
    <br>
    <input  value = "<?php echo $_SESSION['description0'][0]?>"  onkeyup="textCounter(this,'counter',255);" class = "auto" type="text" name="description"  pattern = ".{1,255}"  placeholder="Oppurtunity Description (1-255 characters)">


    <?php echo $date1Err ?>
    <input value = "<?php echo $_SESSION['date10'][0]?>" name="date1" placeholder="Beginning Date"  class="datepicker-here" data-position="right top"  data-language='en'   required>
    <?php echo $date2Err ?>
    <input  value = "<?php echo $_SESSION['date20'][0]?>" name="date2" placeholder="End Date"  class="datepicker-here" data-position="right top"  data-language='en'   required>
  </div>
  <input name="action" type="hidden" value="edit" />
  <input id = "mainSB" class = "submitButton" type="submit" value="Submit">

</form>



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
