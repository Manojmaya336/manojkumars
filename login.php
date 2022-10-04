<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/styles.css">
      <script src="js/script.js"></script>
</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to profile.php
	    header("Location: profile.php");
         }else{
	echo "<div class='container'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<div class="container">
	<div class="row">
        <div class="col justify-content-center">
          <div class="card mx-auto">
            <h1 class="text-center text-primary">Log In</h1>
            <div class="card-body">
				<form action="" method="post" name="login">
				<div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <label for="username"><h4>Username</h4></label>
                  </div>
                  <div class="col-8">
				  <input type="text" name="username" placeholder="Username" required />
					</div>
                </div>
              	</div>
				
				  <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <label for="password"><h4>Password</h4></label>
                  </div>
                  <div class="col-8">
                    <input type="password" name="password" class="form-control" required placeholder="password" id="password">
                  </div>
                </div>
              </div>
<br>
			<div class="form-group text-center">
                <button type="submit" class="btn btn-lg btn-primary">Log In</button>
              </div>
              <div class="form-group text-center">
                <h5>Don't have an account?<a href="registration.php">Register</a></h5>
              </div>
	</form>
</div>
<?php } ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
