<!DOCTYPE html>


<?php

$unameErr = $pswErr = "";

include('charities.php');
if(isset($_POST['action']))
{
    if($_POST['action']=="login")
    {
        $uname = mysqli_real_escape_string($connection,$_POST['uname']);
        $psw = mysqli_real_escape_string($connection,$_POST['psw']);


        $stmt2 = $connection->stmt_init();
        $stmt2 = $connection->prepare("SELECT password FROM charities WHERE uname = ?");
        $stmt2->bind_param("s", $uname);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($hashedPassword);
        $stmt2->fetch();
        //echo $hashedPassword; this returns hashed password string from DB
        $numberofrows = $stmt2->num_rows; //this is an integer!!
        $stmt2 -> close();

        if($numberofrows > 0) //if username exists in database
        {
            if (password_verify($psw, $hashedPassword)) //if user-inputted password (from form) equals hashed password from DB...
            {
                print("Password is valid, login successful!");
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['sess_user'] = $uname;

                header("location:charitypanel/dash.php"); //redirect user to member page
            }

            else
            {
                $pswErr = " is invalid.";//if num_rows is 0, we know username doesnt exist
              }
        }
        else
        {
            $unameErr = " is invalid.";//if num_rows is 0, we know username doesnt exist
        }



    }
  }

?>


<html>

  <head>
    <title>Charitee</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link  rel = "stylesheet" type = "text/css"  href = "./index.css">
    <link  rel = "stylesheet" type = "text/css"  href = "./charity.css">
  </head>

  <body>

    <figure class="tint">
      <img id = "bgImg" src="background.jpg">
    </figure>

    <div id = "cHeadSec">
      <h1>Nonprofit</h1>
      <p>Providing help to local communities.</p>
    </div>


    <form action="" method = "post">

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <span class="error">* <?php echo $unameErr;?></span>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <span class="error">* <?php echo $pswErr;?></span>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <input name="action" type="hidden" value="login" />
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
      <br>
      <br>
      <button type="button"  onclick="location.href='./csignup.php';"  class="signupbtn">Need an account? Sign up.</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>


  </body>

  <foot>
  </foot>

</html>
