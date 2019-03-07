<!DOCTYPE html>


<?php
$cnameErr = $emailErr = $pswErr = $cityErr = $unameErr = $zipErr = $catErr = $religErr = "";

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
        $cat  =  mysqli_real_escape_string($connection,$_POST['cat']);
        $state =  mysqli_real_escape_string($connection,$_POST['state']);
        $relig =  mysqli_real_escape_string($connection,$_POST['religion']);

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
        $cat =  test_input($_POST["cat"]);
        $state =  test_input($_POST["state"]);
        $relig =  test_input($_POST["religion"]);


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


                if (empty($_POST["cat"])) {
                  $catErr = " is required";
                  $problemCounter = $problemCounter + 1;
                } else {
                  $cat = test_input($_POST["cat"]);
                  // check if name only contains letters and whitespace
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

        $sql = "insert into `charities` (`uname`, `cname`, `city`, `state`, `zip`, `email`, `password`, `cat`, `relig`) values('".$uname."','".$cname."','".$city."','".$state."','".$zip."','".$email."','".password_hash($psw, PASSWORD_DEFAULT)."', '".$cat."', '".$relig."')";

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
      <input type="text" placeholder="Enter Email"  pattern = ".{1,}" name="email" required>

      <label for="cname"><b>Charity Name</b></label>
      <span class="error">* <?php echo $cnameErr;?></span>
      <input type="text" placeholder="Enter Charity Name"  pattern = ".{1,}" name="cname" required>

      <label for="cat"><b>Category</b></label>
      <br>
      <select placeholder="Select Category" name="cat" required><?php echo $catErr ?>
                <option value="Religious">Religious</option>
                <option value="Education">Education</option>
                <option value="Disease">Disease</option>
                <option value="Disaster">Disaster Relief</option>
                <option value="Shelter">Shelter</option>
                <option value="Food">Food</option>
                <option value="Water">Water</option>
                <option value="Environment">Environment</option>
                <option value="Animals">Animals</option>
                <option value="Arts/Culture">Arts/Culture</option>
              </select>

              <br><br>
                    <label for="religion"><b>Religious Affiliation</b></label>
                    <br>
                    <select placeholder="Select Category" name="religion" required><?php echo $religErr ?>
                        <option value="0">None</option>
                        <option value="1">Christian</option>
                        <option value="2">Islamic</option>
                        <option value="3">Jewish</option>
                      </select>
<br>
<br>
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
      <label for="zip"><b>Zip</b></label>
      <span class="error">* <?php echo $zipErr;?></span>
      <input type="text" placeholder="Enter Your 5-digit Zipcode" pattern = "[0-9]{5,}"name="zip"required>


      <label for="uname"><b>Username (6-32 characters)</b></label>
      <span class="error">* <?php echo $unameErr;?></span>
      <input type="text" placeholder="Create a username " name="uname" pattern=".{6,32}"  required>

      <label for="psw"><b>Password (6-32 characters)</b></label>
      <span class="error">* <?php echo $pswErr;?></span>
      <input type="password" placeholder="Enter Password" name="psw" pattern=".{6,32}"  required>

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
