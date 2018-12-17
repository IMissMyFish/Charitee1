<!DOCTYPE html>


<?php
$cnameErr = $emailErr = $pswErr = $cityErr = $unameErr = $zipErr = "";

include('charities.php');
if(isset($_POST['action']))
{

  if($_POST['action']=="signup")
  {

        $cname       = mysqli_real_escape_string($connection,$_POST['cname']);
        $email      = mysqli_real_escape_string($connection,$_POST['email']);
        $psw   = mysqli_real_escape_string($connection,$_POST['psw']);
        $city    = mysqli_real_escape_string($connection,$_POST['city']);
        $uname =  mysqli_real_escape_string($connection,$_POST['uname']);
        $zip =  mysqli_real_escape_string($connection,$_POST['zip']);

        $query = "SELECT email FROM charities where email='".$email."'";
        $query2 = "SELECT uname FROM charities where uname='".$uname."'";

        $result = mysqli_query($connection,$query);
        $result2  = mysqli_query($connection,$query2);

        $numResults = mysqli_num_rows($result);
        $numResults2 = mysqli_num_rows($result2);

        $problemCounter = 0;

        $email = test_input($_POST["email"]);
        $cname = test_input($_POST["cname"]);
        $psw = test_input($_POST["psw"]);
        $city = test_input($_POST["city"]);
        $uname = test_input($_POST["uname"]);
        $zip = test_input($_POST["zip"]);


        if (empty($_POST["email"])) {

          $emailErr = " is required";
          $problemCounter = $problemCounter + 1;

        } else {
          $email = test_input($_POST["email"]);

          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $problemCounter = $problemCounter + 1;
          }
        }


        if (empty($_POST["city"])) {
          $cityErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $city = test_input($_POST["city"]);
        }


        if (empty($_POST["cname"])) {
          $cnameErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $cname = test_input($_POST["cname"]);
          // check if name only contains letters and whitespace
        }

        if (empty($_POST["psw"])) {
          $problemCounter = $problemCounter + 1;
          $pswErr = " is required";
        } else {
          $psw = test_input($_POST["psw"]);
        }


                if (empty($_POST["uname"])) {
                  $problemCounter = $problemCounter + 1;
                  $unameErr = " is required";
                } else {
                  $uname = test_input($_POST["uname"]);
                }



                        if (empty($_POST["zip"])) {
                          $problemCounter = $problemCounter + 1;
                          $zipErr = " is required";
                        } else {
                          $zip = test_input($_POST["zip"]);
                        }

        if($numResults2 >= 1){

          $cnameErr = $cname."Charity name already exists";
          $problemCounter = $problemCounter + 1;
        }

        if($numResults>=1)
        {
            $emailErr = $email." Email already exists";
            $problemCounter = $problemCounter + 1;
        }

        $sql = "insert into `charities` (`uname`, `cname`, `city`, `zip`, `email`, `password`) values('".$uname."','".$cname."','".$city."','".$zip."','".$email."','".password_hash($psw, PASSWORD_DEFAULT)."')";

        if($problemCounter == 0){

        if(mysqli_query($connection, $sql))
        {

          header("Location: ./charity.php");
          exit;

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
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link  rel = "stylesheet" type = "text/css"  href = "./index.css">
    <link  rel = "stylesheet" type = "text/css"  href = "./donator.css">
    <link  rel = "stylesheet" type = "text/css"  href = "./csignup.css">
  </head>

  <body>

    <figure class="tint">
      <img id = "bgImg" src="background.JPG">
    </figure>

    <div id = "dHeadSec">
      <h1>Nonprofit</h1>
      <p>Providing help to local communities.</p>
    </div>


    <form action = "" method="post" >

    <div class="container">


      <label for="email"><b>Email</b></label>
      <span class="error">* <?php echo $emailErr;?></span>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="cname"><b>Charity Name</b></label>
      <span class="error">* <?php echo $cnameErr;?></span>
      <input type="text" placeholder="Enter Charity Name" name="cname" required>


      <label for="city"><b>City</b></label>
      <span class="error">* <?php echo $cityErr;?></span>
      <input type="text" placeholder="Enter Your City  " name="city"required>


      <label for="zip"><b>Zip</b></label>
      <span class="error">* <?php echo $zipErr;?></span>
      <input type="text" placeholder="Enter Your 5-digit Zipcode" name="zip"required>


      <label for="uname"><b>Username</b></label>
      <span class="error">* <?php echo $unameErr;?></span>
      <input type="text" placeholder="Create a username" name="uname"required>

      <label for="psw"><b>Password</b></label>
      <span class="error">* <?php echo $pswErr;?></span>
      <input type="password" placeholder="Enter Password" name="psw" required>

       <input name="action" type="hidden" value="signup" />
      <button type="submit" value = "Signup">Signup</button>
      <br>
      <br>
      <button type="button"  onclick="location.href='./charity.php';"  class="loginbtn">Have an account? Log in.</button>
    </div>
  </form>

  </body>

  <foot>
  </foot>

</html>
