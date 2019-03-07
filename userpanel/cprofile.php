<!DOCTYPE html>

<?php
session_start();
$_SESSION['f_itr'] = 0;
$_SESSION['v_itr'] = 0;
$_SESSION['e_itr'] = 0;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  ?>


  <?php
}
else { header("Location: ./index.php"); }
?>




<?php
$u1 = "";
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
    $uname = array();
    $bio = array();
    $cat = array();
    $pop = array();

    while($row = mysqli_fetch_assoc($result)) {


      $id[] =  $row['id'];
      $cname[] = $row['cname'];
      $city[] =$row['city'];
      $zip[] =$row['zip'];
      $uname[] = $row['uname'];
      $bio[] = $row['bio'];
      $cat[] = $row['cat'];
      $pop[] = $row['pop'];

    }

    unset($_SESSION["id"]);
    unset($_SESSION["cname"]);
    unset($_SESSION["city"]);
    unset($_SESSION["zip"]);
    unset($_SESSION["uname"]);
    unset($_SESSION["bio"]);
    unset($_SESSION["cat"]);
    unset($_SESSION['pop']);

    $_SESSION['id'] = $id;
    $_SESSION['cname'] = $cname;
    $_SESSION['city'] = $city;
    $_SESSION['zip'] = $zip;
    $_SESSION['uname'] = $uname;
    $_SESSION['bio'] = $bio;
    $_SESSION['cat'] = $cat;
    $_SESSION['pop'] = $pop;
    $u1 = $uname;
  }


  include('../charities.php');

  $result2 = mysqli_query($connection, 'SELECT * FROM volunteer WHERE cid = "'.$_SESSION['id'][0].'" ');

  $stmt2 = $connection->stmt_init();
  $stmt2 = $connection->prepare('SELECT * FROM volunteer WHERE cid = "'.$_SESSION['id'][0].'" ');
  $stmt2->execute();
  $stmt2->store_result();
  $stmt2->fetch();

  $numberofrows2 = $stmt2->num_rows; //this is an integer!!
  $stmt2 -> close();



if($numberofrows2 > 0){


    // output data of each row

    $v_vid = array();
    $v_name = array();
    $v_description = array();
    $v_date1 = array();
    $v_date2 = array();
    $v_itr = 0;

    while($row2 = mysqli_fetch_assoc($result2)) {


      $v_vid[] =  $row2['vid'];
      $v_name[] = $row2['name'];
      $v_description[] =$row2['description'];
      $v_date1[] =$row2['date1'];
      $v_date2[] = $row2['date2'];
      $v_itr = $v_itr + 1;

    }

    unset($_SESSION["v_vid"]);
    unset($_SESSION["v_name"]);
    unset($_SESSION["v_description"]);
    unset($_SESSION["v_date1"]);
    unset($_SESSION["v_date2"]);
    unset($_SESSION["v_itr"]);

    $_SESSION['v_vid'] = $v_vid;
    $_SESSION['v_name'] = $v_name;
    $_SESSION['v_description'] = $v_description;
    $_SESSION['v_date1'] = $v_date1;
    $_SESSION['v_date2'] = $v_date2;
    $_SESSION["v_itr"] = $numberofrows2;



}



  include('../charities.php');

  $result3 = mysqli_query($connection, 'SELECT * FROM event WHERE cid = "'.$_SESSION['id'][0].'" ');

  $stmt3 = $connection->stmt_init();
  $stmt3 = $connection->prepare('SELECT * FROM event WHERE cid = "'.$_SESSION['id'][0].'" ');
  $stmt3->execute();
  $stmt3->store_result();
  $stmt3->fetch();

  $numberofrows3 = $stmt3->num_rows; //this is an integer!!
  $stmt3-> close();




if($numberofrows3 > 0){



    // output data of each row

    $e_eid = array();
    $e_name = array();
    $e_description = array();
    $e_date1 = array();
    $e_itr = 0;

    while($row3 = mysqli_fetch_assoc($result3)) {


      $e_eid[] =  $row3['eid'];
      $e_name[] = $row3['name'];
      $e_description[] =$row3['description'];
      $e_date1[] =$row3['date1'];
      $e_itr = $e_itr + 1;

    }

    unset($_SESSION["e_eid"]);
    unset($_SESSION["e_name"]);
    unset($_SESSION["e_description"]);
    unset($_SESSION["e_date1"]);
    unset($_SESSION["e_itr"]);

    $_SESSION['e_eid'] = $e_eid;
    $_SESSION['e_name'] = $e_name;
    $_SESSION['e_description'] = $e_description;
    $_SESSION['e_date1'] = $e_date1;

    $_SESSION["e_itr"] = $numberofrows3;





}
  include('../charities.php');

  $result4 = mysqli_query($connection, 'SELECT * FROM fundraiser WHERE cid = "'.$_SESSION['id'][0].'" ');

  $stmt4 = $connection->stmt_init();
  $stmt4 = $connection->prepare('SELECT * FROM fundraiser WHERE cid = "'.$_SESSION['id'][0].'" ');
  $stmt4->execute();
  $stmt4->store_result();
  $stmt4->fetch();

  $numberofrows4 = $stmt4->num_rows; //this is an integer!!
  $stmt4-> close();



  // output data of each row

if($numberofrows4 > 0){
  $f_fid = array();
  $f_name = array();
  $f_description = array();

  $f_date2 = array();
  $f_current = array();
  $f_goal = array();
  $f_itr = 0;

  while($row4 = mysqli_fetch_assoc($result4)) {


    $f_fid[] =  $row4['fid'];
    $f_name[] = $row4['name'];
    $f_current[] = $row4['current'];
    $f_goal[] = $row4['goal'];
    $f_description[] =$row4['description'];
    $f_date2[] =$row4['date2'];
    $f_itr = $f_itr + 1;

  }

  unset($_SESSION["f_fid"]);
  unset($_SESSION["f_date2"]);
  unset($_SESSION["f_current"]);
  unset($_SESSION["f_goal"]);
  unset($_SESSION["f_name"]);
  unset($_SESSION["f_description"]);
  unset($_SESSION["f_itr"]);

  $_SESSION['f_fid'] = $f_fid;
  $_SESSION['f_name'] = $f_name;
  $_SESSION['f_description'] = $f_description;
  $_SESSION['f_date2'] = $f_date2;
  $_SESSION['f_current'] = $f_current;
  $_SESSION['f_goal'] = $f_goal;

  $_SESSION["f_itr"] = $numberofrows4;



}





}



if(isset($_POST['newpost'])){

  $msg = mysqli_real_escape_string($connection,$_POST['post1']);
  $cid = mysqli_real_escape_string($connection,$_SESSION['id'][0]);
  $uname = mysqli_real_escape_string($connection,$_SESSION['sess_user']);

  mysqli_query($connection, 'INSERT INTO cposts (msg, cid, uname) VALUES ("'.$msg.'", "'.$cid.'", "'.$uname.'")');

}




include('../charities.php');

$postResult = mysqli_query($connection, 'SELECT * FROM cposts WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY id DESC');

$postStmt = $connection->stmt_init();
$postStmt = $connection->prepare('SELECT * FROM cposts WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY id DESC');
$postStmt->execute();
$postStmt->store_result();
$postStmt->fetch();

$postNumberofrows00 = $postStmt->num_rows; //this is an integer!!
$postStmt -> close();





if ($postNumberofrows00 > 0) {
  // output data of each row

  $msg = array();
  $date = array();
  $pid = array();

  while($row = mysqli_fetch_assoc($postResult)) {


    $msg[] =  $row['msg'];
    $date[] = $row['date'];
    $pid[] = $row['id'];
  }

  unset($_SESSION["msg"]);
  unset($_SESSION["date"]);
  unset($_SESSION["pid"]);

  $_SESSION['msg'] = $msg;
  $_SESSION['date'] = $date;
  $_SESSION['pid'] = $pid;
}




//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx




if(isset($_POST['likeF'])){


  include('../users.php');



  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeF'].'" AND type = "fund" ');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeF'].'" AND type = "fund" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    mysqli_query($connection, 'DELETE FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeF'].'" AND type = "fund" ');

  }
  else{

    mysqli_query($connection, 'INSERT INTO likes VALUES ("'.$_SESSION['sess_user'].'", "'.$_SESSION['id'][0].'", "'.$_POST['likeF'].'",  "fund")');

  }

}






include('../charities.php');


$checkResult = mysqli_query($connection, 'SELECT fid FROM fundraiser WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY fid ASC ');


$checkStmt = $connection->stmt_init();
$checkStmt = $connection->prepare('SELECT fid FROM fundraiser WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY fid ASC ');
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->fetch();

$checkNumberofrows = $checkStmt->num_rows; //this is an integer!!


$toggleword = array();
$togglecolor = array();
$itr = 0;



while($row = mysqli_fetch_assoc($checkResult)) {


  $togglefid =  $row['fid'];



  include('../users.php');
  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglefid.'" AND type = "fund" ');

  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglefid.'" AND type = "fund" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    $toggleword[$itr] = "Unlike";
    $togglecolor[$itr] = "pink";

  } else {

    $toggleword[$itr] = "Like";
    $togglecolor[$itr] = "gray";

  }

  $itr = $itr + 1;
}








//XXXXXXXXXXXxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx



if(isset($_POST['likeE'])){


  include('../users.php');



  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeE'].'" AND type = "event" ');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeE'].'" AND type = "event" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();

  if ($postNumberofrows > 0) {

    mysqli_query($connection, 'DELETE FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeE'].'" AND type = "event" ');

  }
  else{

    mysqli_query($connection, 'INSERT INTO likes VALUES ("'.$_SESSION['sess_user'].'", "'.$_SESSION['id'][0].'", "'.$_POST['likeE'].'",  "event")');

  }

}




include('../charities.php');


$checkResult = mysqli_query($connection, 'SELECT eid FROM event WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY eid ASC ');


$checkStmt = $connection->stmt_init();
$checkStmt = $connection->prepare('SELECT eid FROM event WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY eid ASC ');
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->fetch();

$checkNumberofrows = $checkStmt->num_rows; //this is an integer!!


$toggleword2 = array();
$togglecolor2 = array();
$itr = 0;


while($row = mysqli_fetch_assoc($checkResult)) {


  $toggleeid =  $row['eid'];



  include('../users.php');
  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$toggleeid.'" AND type = "event" ');

  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$toggleeid.'" AND type = "event" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    $toggleword2[$itr] = "Unlike";
    $togglecolor2[$itr] = "pink";

  } else {

    $toggleword2[$itr] = "Like";
    $togglecolor2[$itr] = "gray";

  }

  $itr = $itr + 1;
}



//XXXXXXXXXXX



if(isset($_POST['likeV'])){


  include('../users.php');



  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeV'].'" AND type = "volunteer" ');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeV'].'" AND type = "volunteer" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    mysqli_query($connection, 'DELETE FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeV'].'" AND type = "volunteer" ');

  }
  else{

    mysqli_query($connection, 'INSERT INTO likes VALUES ("'.$_SESSION['sess_user'].'", "'.$_SESSION['id'][0].'", "'.$_POST['likeV'].'",  "volunteer")');

  }

}




include('../charities.php');


$checkResult = mysqli_query($connection, 'SELECT vid FROM volunteer WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY vid ASC ');


$checkStmt = $connection->stmt_init();
$checkStmt = $connection->prepare('SELECT vid FROM volunteer WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY vid ASC ');
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->fetch();

$checkNumberofrows = $checkStmt->num_rows; //this is an integer!!


$toggleword3 = array();
$togglecolor3 = array();
$itr = 0;


while($row = mysqli_fetch_assoc($checkResult)) {


  $togglevid =  $row['vid'];



  include('../users.php');
  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglevid.'" AND type = "volunteer" ');

  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglevid.'" AND type = "volunteer" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    $toggleword3[$itr] = "Unlike";
    $togglecolor3[$itr] = "pink";

  } else {

    $toggleword3[$itr] = "Like";
    $togglecolor3[$itr] = "gray";

  }

  $itr = $itr + 1;
}



//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx





if(isset($_POST['likeP'])){


  include('../users.php');



  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeP'].'" AND type = "post" ');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeP'].'" AND type = "post" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    mysqli_query($connection, 'DELETE FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_POST['likeP'].'" AND type = "post" ');

  }
  else{

    mysqli_query($connection, 'INSERT INTO likes VALUES ("'.$_SESSION['sess_user'].'", "'.$_SESSION['id'][0].'", "'.$_POST['likeP'].'",  "post")');

  }

}




include('../charities.php');


$checkResult = mysqli_query($connection, 'SELECT id FROM cposts WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY id DESC ');


$checkStmt = $connection->stmt_init();
$checkStmt = $connection->prepare('SELECT id FROM cposts WHERE cid = "'.$_SESSION['id'][0].'" ORDER BY id DESC ');
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->fetch();

$checkNumberofrows = $checkStmt->num_rows; //this is an integer!!


$toggleword4 = array();
$togglecolor4 = array();
$itr = 0;


while($row = mysqli_fetch_assoc($checkResult)) {


  $togglepid =  $row['id'];



  include('../users.php');
  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglepid.'" AND type = "post" ');

  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$togglepid.'" AND type = "post" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    $toggleword4[$itr] = "Unlike";
    $togglecolor4[$itr] = "pink";

  } else {

    $toggleword4[$itr] = "Like";
    $togglecolor4[$itr] = "gray";

  }

  $itr = $itr + 1;
}




//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx





if(isset($_POST['likeC'])){


  include('../users.php');



  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_SESSION['id'][0].'" AND type = "charity" ');


  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_SESSION['id'][0].'" AND type = "charity" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    mysqli_query($connection, 'DELETE FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_SESSION['id'][0].'" AND type = "charity" ');
    include('../charities.php');
    mysqli_query($connection, 'UPDATE charities SET pop = pop - 1 WHERE id = "'.$_SESSION['id'][0].'"');
    echo("yes1");
    include('../users.php');
  }
  else{
echo("yes2");
echo($_SESSION['sess_user']);
echo($_SESSION['id'][0]);
    if(mysqli_query($connection, 'INSERT INTO likes VALUES ("'.$_SESSION['sess_user'].'", "'.$_SESSION['id'][0].'", "'.$_SESSION['id'][0].'",  "charity")')){
      echo("yes3");
      include('../charities.php');
      mysqli_query($connection, 'UPDATE charities SET pop = pop + 1 WHERE id = "'.$_SESSION['id'][0].'"');
      include('../users.php');
      }


    };


}




include('../charities.php');


$checkResult = mysqli_query($connection, 'SELECT id FROM charities WHERE id = "'.$_SESSION['id'][0].'" ');


$checkStmt = $connection->stmt_init();
$checkStmt = $connection->prepare('SELECT id FROM charities WHERE id = "'.$_SESSION['id'][0].'"  ');
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->fetch();

$checkNumberofrows = $checkStmt->num_rows; //this is an integer!!


$toggleword5 = array();
$togglecolor5 = array();
$itr = 0;


while($row = mysqli_fetch_assoc($checkResult)) {


  $togglecid =  $row['id'];



  include('../users.php');
  $postResult = mysqli_query($connection, 'SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_SESSION['id'][0].'" AND type = "charity" ');

  $postStmt = $connection->stmt_init();
  $postStmt = $connection->prepare('SELECT * FROM likes WHERE cid = "'.$_SESSION['id'][0].'" AND uid = "'.$_SESSION['sess_user'].'" AND itemid = "'.$_SESSION['id'][0].'" AND type = "charity" ');
  $postStmt->execute();
  $postStmt->store_result();
  $postStmt->fetch();

  $postNumberofrows = $postStmt->num_rows; //this is an integer!!
  $postStmt -> close();


  if ($postNumberofrows > 0) {

    $toggleword5[$itr] = "Unlike";
    $togglecolor5[$itr] = "pink";

  } else {

    $toggleword5[$itr] = "Like";
    $togglecolor5[$itr] = "gray";

  }

  $itr = $itr + 1;
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
    <!--<h3>Charitee</h3>-->

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
      <a href = "./editcpro.php" id = "editbtn"><h6>Edit</h6></a>
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
    <br>
    <br>
    <h1><?php echo $_SESSION['cname'][0]?></h1>
    <br>
    <h2><?php echo $_SESSION['cat'][0]?></h2>
    <br>
    <h3><?php echo $_SESSION['city'][0]?>, <?php echo $_SESSION['zip'][0] ?></h3>
    <br>
    <h5><em>"<?php echo $_SESSION['bio'][0]?>"</em></h5>
    <br>
    <br>
    <br>

    <form action = "" method = "post">
      <input type="hidden" name="likeC" value = "<?php echo $_SESSION['id'][0]?>" required>
      <input id = "editBtn" class = "submitButton" type="submit" value="<?php echo $toggleword5[$i]?>">
    </form>

  </div>

  <?php if($_SESSION['f_itr'] > 0){

    ?>
    <div id = "fundBox" class = "container">
      <h2>Current Fundraisers</h2>
      <br>
      <div id = "fundList">
        <?php



      }?>

      <?php for($i = 0; $i < $_SESSION['f_itr']; $i++){

        ?>
        <div id = "fundBox">

          <h3><?php echo($_SESSION['f_name'][$i]);?></h3>
          <br>
          <h4><?php echo($_SESSION['f_description'][$i]);?></h4>
          <br>
          <h3><?php echo($_SESSION['f_current'][$i]);?> out of <?php echo($_SESSION['f_goal'][$i]);?></h3>
          <br>


          <h3>Ends on
          </h3><?php

          $dayname = date('l', strtotime($_SESSION['f_date2'][$i]));
          $daynum =  date('j', strtotime($_SESSION['f_date2'][$i]));
          $suffix =  date('S', strtotime($_SESSION['f_date2'][$i]));
          $month = date('M', strtotime($_SESSION['f_date2'][$i]));
          $year = date('Y', strtotime($_SESSION['f_date2'][$i]));

          ?>

          <time datetime="<?php echo ($_SESSION['f_date2'][$i]);?>" class="icon">
            <em><?php echo ($dayname);?></em>
            <strong><?php echo ($month);?> <?php echo ($year);?></strong>
            <span><?php echo ($daynum);?></span>
          </time>

          <br>
          <?php if($_SESSION['sess_user'] == $_SESSION['uname'][0]){?>
            <form action = "fdelete.php" method = "post">
              <input type="hidden" name="num" value = "<?php echo $i?>" required>
              <input id = "deleteBtn" class = "submitButton" type="submit" value="Delete">
            </form>

            <form action = "fedit.php" method = "post">
              <input type="hidden" name="num" value = "<?php echo $i?>" required>
              <input id = "editBtn" class = "submitButton" type="submit" value="Edit">
            </form>
          <?php }
          else {
            ?>
            <form action = "" method = "post">
              <input type="hidden" name="likeF" value = "<?php echo $_SESSION['f_fid'][$i]?>" required>
              <input id = "editBtn" class = "submitButton" type="submit" value="<?php echo $toggleword[$i]?>">
            </form>
          <?php }

        }


        ?>
      </div>
      <?php



      ?>
    </div>
  </div>


  <?php if($_SESSION['e_itr'] > 0){

    ?>
    <div id = "eventBox" class = "container">
      <h2>Upcoming Events</h2>
      <br>
      <div id = "evList">

      <?php } ?>
      <?php for($i = 0; $i < $_SESSION['e_itr']; $i++){

        ?>
        <div id = "evBox">
          <?php

          $dayname = date('l', strtotime($_SESSION['e_date1'][$i]));
          $daynum =  date('j', strtotime($_SESSION['e_date1'][$i]));
          $suffix =  date('S', strtotime($_SESSION['e_date1'][$i]));
          $month = date('M', strtotime($_SESSION['e_date1'][$i]));
          $year = date('Y', strtotime($_SESSION['e_date1'][$i]));

          ?>

          <time datetime="<?php echo ($_SESSION['e_date1'][$i]);?>" class="icon">
            <em><?php echo ($dayname);?></em>
            <strong><?php echo ($month);?> <?php echo ($year);?></strong>
            <span><?php echo ($daynum);?></span>
          </time>
          <br>
        </div>

        <h3><?php echo($_SESSION['e_name'][$i]);?></h3>
        <h4><?php echo($_SESSION['e_description'][$i]);?></h4>



        <br>
        <?php if($_SESSION['sess_user'] == $_SESSION['uname'][0]){?>
          <form action = "edelete.php" method = "post">
            <input type="hidden" name="num" value = "<?php echo $i?>" required>
            <input id = "deleteBtn" class = "submitButton" type="submit" value="Delete">
          </form>



          <form action = "eedit.php" method = "post">
            <input type="hidden" name="num" value = "<?php echo $i?>" required>
            <input id = "editBtn" class = "submitButton" type="submit" value="Edit">
          </form>


        <?php } else {
          ?>
          <form action = "" method = "post">
            <input type="hidden" name="likeE" value = "<?php echo $_SESSION['e_eid'][$i]?>" required>
            <input id = "editBtn" class = "submitButton" type="submit" value="<?php echo $toggleword2[$i]?>">
          </form>
        <?php }

        ?>

      </div><?php
    }?>
  </div>
</div>



<?php
if($_SESSION['v_itr'] > 0){

  ?>
  <div id = "volunteerBox" class = "container">
    <h2>Volunteer Oppurtunities</h2>
    <br>
    <div id = "volList">

    <?php } ?>

    <?php

    for($i = 0; $i < $_SESSION['v_itr']; $i++){

      ?>
      <div id = "volBox">

        <?php

        $dayname = date('l', strtotime($_SESSION['v_date1'][$i]));
        $daynum =  date('j', strtotime($_SESSION['v_date1'][$i]));
        $suffix =  date('S', strtotime($_SESSION['v_date1'][$i]));
        $month = date('M', strtotime($_SESSION['v_date1'][$i]));
        $year = date('Y', strtotime($_SESSION['v_date1'][$i]));

        ?>
        <div id = "sideDates"/>

        <div id = "begDate">
          <time datetime="<?php echo ($_SESSION['v_date1'][$i]);?>" class="icon">
            <em><?php echo ($dayname);?></em>
            <strong><?php echo ($month);?> <?php echo ($year);?></strong>
            <span><?php echo ($daynum);?></span>
          </time>
        </div>

        <?php

        $dayname = date('l', strtotime($_SESSION['v_date2'][$i]));
        $daynum =  date('j', strtotime($_SESSION['v_date2'][$i]));
        $suffix =  date('S', strtotime($_SESSION['v_date2'][$i]));
        $month = date('M', strtotime($_SESSION['v_date2'][$i]));
        $year = date('Y', strtotime($_SESSION['v_date2'][$i]));

        ?>
        <div id = "endDate">
          <time datetime="<?php echo ($_SESSION['v_date2'][$i]);?>" class="icon">
            <em><?php echo ($dayname);?></em>
            <strong><?php echo ($month);?> <?php echo ($year);?></strong>
            <span><?php echo ($daynum);?></span>
          </time>
        </div>
      </div>



      <h3><?php echo($_SESSION['v_name'][$i]);?></h3>
      <h4><?php echo($_SESSION['v_description'][$i]);?></h4>

      <br>
      <?php if($_SESSION['sess_user'] == $_SESSION['uname'][0]){?>
        <form action = "vdelete.php" method = "post">
          <input type="hidden" name="num" value = "<?php echo $i?>" required>
          <input id = "deleteBtn" class = "submitButton" type="submit" value="Delete">
        </form>



        <form action = "vedit.php" method = "post">
          <input type="hidden" name="num" value = "<?php echo $i?>" required>
          <input id = "editBtn" class = "submitButton" type="submit" value="Edit">
        </form>

      <?php } else {

        ?>
        <form action = "" method = "post">
          <input type="hidden" name="likeV" value = "<?php echo $_SESSION['v_vid'][$i]?>" required>
          <input id = "editBtn" class = "submitButton" type="submit" value="<?php echo $toggleword3[$i]?>">
        </form>
        <?

      }?>

    </div>
    <?php

  }

  //}
  ?> </div> </div> </div> <?php
//111?>


<div class = "container">
  <h2 id = "postBox">Posts</h2>
  <?php if($_SESSION['sess_user'] == $_SESSION['uname'][0]){?>
    <form action = "" method = "post">
      <input type = "text" placeholder = "Write something..." name = "post1">
      <input id = "editBtn" class = "submitButton" type="submit" name = "newpost">
    </form>

  <?php } ?>
  <br><br><br>
  <?php

  for($i = 0; $i < $postNumberofrows00; $i++){
    echo($_SESSION['msg'][$i]);
    ?><br><?php
    echo($_SESSION['date'][$i]);
    ?> <br>

    <form action = "" method = "post">
      <input type="hidden" name="likeP" value = "<?php echo $_SESSION['pid'][$i]?>" required>
      <input id = "editBtn" class = "submitButton" type="submit" value="<?php echo $toggleword4[$i]?>">
    </form><br><br><?php


//}
  }

  ?>

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
