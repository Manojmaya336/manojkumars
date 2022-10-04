<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/angular.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/script.js"></script>
    
</head>
<body ng-app="signup">
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='container'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="container">
  <div class="row">
    <div class="col justify-content-center">
      <div class="card mx-auto">
        <h1 class="text-center text-primary">Create Account</h1>
        <div class="card-body">
<!-- <h1>Registration</h1> -->
          <form name="registration" action="" method="post">
              <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <label for="username"><h4>Create Username</h4></label>
                    </div>
                    <div class="col-10">
                    <input type="text" name="username" placeholder="Username" required />
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <label for="email"><h4>Enter Email</h4></label>
                    </div>
                    <div class="col-10">
                    <input type="email" name="email" placeholder="Email" required />
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <label for="password"><h4>Enter Password</h4></label>
                    </div>
                    <div class="col-10">
                    <input type="password" name="password" placeholder="******" required />
                    </div>
                  </div>
              </div>
              <div class="form-group text-center">
                  <button type="submit" name="submit" class="btn btn-lg btn-primary">Register</button>
              </div>
              <div class="form-group text-center">
                  <h5>Already have an account?<a href="login.php">Log In</a></h5>
                </div>
          </form>
</div>
<?php } ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
