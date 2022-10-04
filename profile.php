<?php
session_start();
$img='imgs/blank.png';
$name="Your name";
$abt="Please edit it.";
$loc="N/A";
if (isset($_POST['username']) && isset($_POST['password'])) {
    $secret="6Lf...SHi";
    // $res=$_POST['g-recaptcha-response'];
    // $url="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$res";
    $response=file_get_contents($url);
    $response=json_decode($response);
    if ($response->success) {
      $query="SELECT * FROM user WHERE username=:un";
      $stmt=$db->prepare($query);
      $stmt->execute(array(':un'=>hash('sha256',$_POST['username'])));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      if ($row===false) {
        $_SESSION['error']="Incorrect Username or Password";
        header('Location:login.php');
        return;
      }
      else if ($row['password']!==hash('sha256',$_POST['password'])) {
        $_SESSION['error']="Incorrect Username or Password";
        header('Location:login.php');
        return;
      }
      else {
      $_SESSION['id']=$row['id'];
      $sql="SELECT * FROM detaa WHERE id=:id";
      $det=$db->prepare($sql);
      $det->execute(array(':id'=>$_SESSION['id']));
      $row2=$det->fetch(PDO::FETCH_ASSOC);
      if($row2['image']!==NULL && $row2['image']!=="")
      $img="uploads/".$row2['image'];
      if($row2['name']!==NULL && $row2['name']!=="")
      $name=$row2['name'];
      if($row2['about']!==NULL && $row2['about']!=="")
      $abt=$row2['about'];
      if($row2['location']!==NULL && $row2['location']!=="")
      $loc=$row2['location'];
      }
    }
  else {
    // $_SESSION['error']="Captcha not verified";
    header('Location:login.php');
    return;
  }
  }

if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
 <meta charset="utf-8">
 <title><?="".$name.""; ?></title>
 <link rel="icon"  <? echo("href=".$img.""); ?> >
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="js/script.js"></script>
</head>
<body>
<div class="container">
 </div>
 <div class="row  sticky-top justify-content-end">
   <!-- <a class="ip logout" href="editprofile.php">Edit</a> -->
 <a class="ip logout" href="login.php">Log out</a>
 </div>
 <div class="row">
   <div class="col justify-content-center">
     <div class="card mx-auto">
       <div class="card-body">
     <form action="" enctype="multipart/form-data" method="post">
           <div class="form-group">
             <div class="row">
<img <?php echo "src='".$img."'"; ?>  id="profile_pic" class="img-thumbnail img-fluid" alt="profile-pic">
</div>
   </div>
<div class="form-group">
<div class="row">
 <div class="col-12 text-center">
   <h3 class="text-primary"><?="".$name.""; ?></h3>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
 <label for="about"><h5 class="text-primary">About me</h5></label>
</div>
<div class="row">
<textarea name="about" disabled id="about" rows="4" class="form-control" cols="100"><?="".$abt.""; ?></textarea>
</div>
</div>
     <div class="form-group">
       <div class="row">
         <div class="col-md-6 text-center">
           <label for="uname"><h5 class="text-primary">Username</h5></label>
         </div>
         <div class="col-md-6 text-center">
           <label for="pass"><h5 class="text-primary">Password</h5></label>
         </div>
       </div>
     </div>

<div class="form-group">
<div class="row">
<div class="col-md-6">
<input type="text" disabled id="uname" value="&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;" class="form-control" >
<small class="form-text text-center text-muted">We don't know your username.</small>
</div>
<div class="col-md-6">
<input type="text" class="form-control" id="pass" disabled value="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
<small class="form-text text-center text-muted">We don't know your password.</small>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<div class="col-md-6 text-center">
 <label for="email"><h5 class="text-primary">Email</h5></label>
</div>
<div class="col-md-6 text-center">
 <label for="loc"><h5 class="text-primary">Location</h5></label>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<div class="col-md-6">
<input type="text" id="email" disabled class="form-control" <?="value='".$row['email']."'"; ?> >
</div>
<div class="col-md-6">
<input type="text" name="loc" disabled id="loc" class="form-control" <?php echo "value='".$loc."'"; ?> >
</div>
</div>
</div>
 </form>
 </div>
   </div>
     </div>
       </div>
</div>
</body>
</html>
 