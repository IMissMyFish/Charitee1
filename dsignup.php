<!DOCTYPE html>


<?php
$fnameErr = $lnameErr = $ageErr = $unameErr = $emailErr = $pswErr = $cityErr = "";

include('users.php');
if(isset($_POST['action']))
{

  if($_POST['action']=="signup")
  {

        $fname = mysqli_real_escape_string($connection,$_POST['fname']);
        $lname = mysqli_real_escape_string($connection,$_POST['lname']);
        $age  = mysqli_real_escape_string($connection,$_POST['age']);
        $uname       = mysqli_real_escape_string($connection,$_POST['uname']);
        $email      = mysqli_real_escape_string($connection,$_POST['email']);
        $psw   = mysqli_real_escape_string($connection,$_POST['psw']);
        $city    = mysqli_real_escape_string($connection,$_POST['city']);
        $state    = mysqli_real_escape_string($connection,$_POST['state']);
        $query = "SELECT email FROM users where email='".$email."'";
        $query2 = "SELECT uname FROM users where uname='".$uname."'";

        $result = mysqli_query($connection,$query);
        $result2  = mysqli_query($connection,$query2);

        $numResults = mysqli_num_rows($result);
        $numResults2 = mysqli_num_rows($result2);

        $problemCounter = 0;

        $email = test_input($_POST["email"]);
        $uname = test_input($_POST["uname"]);
        $psw = test_input($_POST["psw"]);
        $city = test_input($_POST["city"]);
        $state = test_input($_POST["state"]);
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $age = test_input($_POST["age"]);

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

        if (empty($_POST["fname"])) {
          $fnameErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $fname = test_input($_POST["fname"]);
        }

        if (empty($_POST["lname"])) {
          $lnameErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $lname = test_input($_POST["lname"]);
        }

        if (empty($_POST["city"])) {
          $cityErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $city = test_input($_POST["city"]);
        }

        if (empty($_POST["age"])) {
          $ageErr = " is required";
          $problemCounter = $problemCounter + 1;
        } else {
          $age = test_input($_POST["age"]);
        }


        if (empty($_POST["uname"])) {
          $unameErr = " is required";
          $problemCounter = $problemCounter + 1;
        }
        else {
          $uname = test_input($_POST["uname"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z0-9]*$/",$uname)) {
            $nameErr = "Only letters and numbers allowed";
            $problemCounter = $problemCounter + 1;
          }
        }

        if (empty($_POST["psw"])) {
          $problemCounter = $problemCounter + 1;
          $pswErr = " is required";
        }
        else {
          $psw = test_input($_POST["psw"]);
        }

        if($numResults2 >= 1){

          $unameErr = $uname." Username already exists";
          $problemCounter = $problemCounter + 1;
        }

        if($numResults>=1)
        {
            $emailErr = $email." Email already exists";
            $problemCounter = $problemCounter + 1;
        }

        $sql = "insert into `users` (`fname`, `lname`, `uname`, `city`, `state`, `age`, `email`, `password`) values('".$fname."','".$lname."','".$uname."','".$city."','".$state."','".$age."','".$email."','".password_hash($psw, PASSWORD_DEFAULT)."')";

        if($problemCounter == 0){

        if(mysqli_query($connection, $sql))
        {

          header("Location: ./donator.php");
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
    <link  rel = "stylesheet" type = "text/css"  href = "./dsignup.css">
  </head>

  <body>

    <figure class="tint">
      <img id = "bgImg" src="background.JPG">
    </figure>

    <div id = "dHeadSec">
      <h1>Donor</h1>
      <p>Giving back to local nonprofits.</p>
    </div>


    <form action = "" method="post" >

    <div class="container">


      <label for="email"><b>Email</b></label>
      <span class="error">* <?php echo $emailErr;?></span>
      <input type="text" placeholder="Enter Email"  pattern = ".{1,}" name="email" required>

      <label for="fname"><b>First Name</b></label>
      <span class="error">* <?php echo $fnameErr;?></span>
      <input type="text" placeholder="Enter First Name"  pattern = ".{1,}" name="fname" required>

      <label for="lname"><b>Last Name</b></label>
      <span class="error">* <?php echo $lnameErr;?></span>
      <input type="text" placeholder="Enter Last Name"   pattern = ".{1,}" name="lname" required>

      <label for="city"><b>City</b></label>
      <br>
      <select placeholder="City"  name="city" required>* <?php echo $cityErr;?>
        <option value="Tallahassee">Tallahassee</option>
      </select>
<br><br>
      <label for="state"><b>State</b></label>
      <br>
      <select placeholder="Enter State of listing" name="state" required><?php echo $stateErr ?>
          <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
<br><br>

      <label for="age"><b>Age</b></label>
      <span class="error">* <?php echo $ageErr;?></span>
      <input type="text" placeholder="Enter Your Age"  pattern="[0-9]{2,3}" name="age"required>


      <label for="uname"><b>Username (6-32 characters)</b></label>
      <span class="error">* <?php echo $unameErr;?></span>
      <input type="text" placeholder="Enter Username" name="uname"  pattern=".{6,32}" required>


      <label for="psw"><b>Password (6-32 characters)</b></label>
      <span class="error">* <?php echo $pswErr;?></span>
      <input type="password" placeholder="Enter Password"  pattern=".{6,32}" name="psw" required>

       <input name="action" type="hidden" value="signup" />
      <button type="submit" value = "Signup">Signup</button>
    <br>
    <br>
      <button type="button"  onclick="location.href='./donator.php';"  class="loginbtn">Have an account? Log in.</button>
    </div>
  </form>

  </body>

  <foot>
  </foot>

</html>
