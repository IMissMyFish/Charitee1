<!DOCTYPE html>

<?php
session_start();
$imgError1 = "";
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>


<?php
  }
  else { header("Location: ./index.php"); }
 ?>

<?php

if(isset($_POST['submit1'])){


  if($_SESSION['sess_user'] == $_SESSION['uname'][0]){



      $target8_dir = "uploads/{$_SESSION['sess_user']}";
      $target9_dir = "uploads/{$_SESSION['sess_user']}/p";
      $target0_dir = "uploads/{$_SESSION['sess_user']}/p/1";
      $target0_dir_delete = "uploads/{$_SESSION['sess_user']}/p/1/*";


      if (!file_exists($target0_dir) && !is_dir($target0_dir)) {

        if (!file_exists($target9_dir) && !is_dir($target9_dir)) {

          if (!file_exists($target8_dir) && !is_dir($target8_dir)) {

            mkdir($target8_dir);
            mkdir($target9_dir);
            mkdir($target0_dir);
          }
          else {

            mkdir($target9_dir);
            mkdir($target0_dir);
          }



        }
        else {

          mkdir($target0_dir);


        }
      }
      else{

        $files1 = glob($target0_dir_delete); // get all file names

        foreach($files1 as $file){ // iterate files
          if(is_file($file))
          unlink($file); // delete file
        }

      }

      $target_dir = "uploads/{$_SESSION['sess_user']}/p/1/";

      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit1"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {

          $uploadOk = 1;
        } else {
          $imgError1 = "File is not an image.";
          $uploadOk = 0;
        }
      }
      // Check if file already exists
      if (file_exists($target_file)) {
        $imgError1 = "Sorry, file already exists.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 1000000) {
        $imgError1 = "Sorry, your file is too large.";
        $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $imgError1 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {

        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $imgError1 = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
          $imgError1 = "Sorry, there was an error uploading your file.";
        }
      }

  }


}


if(isset($_POST['submit2'])){
include('../charities.php');
if(isset($_POST['bio1'])){

    $result0 = mysqli_query($connection, 'UPDATE charities SET bio = "'.$_POST['bio1'].'" WHERE uname = "'.$_SESSION['sess_user'].'"  ');

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

    <div id = "inputSec" class = "textInput">
      <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit1">
        <?php echo $imgError1; ?>
      </form>
    </div>

    <div id = "inputSec" class = "textInput">
      <form action="" method="post" enctype="multipart/form-data">
        <input type = "text" placeholder = "Bio" name = "bio1">
        <input type="submit" value="Change Bio" name="submit2">
      </form>
    </div>

  </div>

</body>

<foot>
</foot>

</html>
