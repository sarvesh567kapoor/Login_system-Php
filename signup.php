<?php
$show_alert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{

include "./partials/db_connect.php";
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
$email = $_POST["email"];

//check wheather this username Exists
$exists_sql = "SELECT *  FROM `users` WHERE `username` LIKE '$username'";
$result= mysqli_query($conn,$exists_sql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows > 0) {
    // $exists = true;
    $showError= true;
    $showError_text = "Username already Exist Please Enter  a Unique  Name";
}
//checking wheather this email already exists
$exists_sql1 = "SELECT *  FROM `users` WHERE `email` LIKE '$email'";
$result2= mysqli_query($conn,$exists_sql1);
$numExistRows1 = mysqli_num_rows($result2);
if($numExistRows1 > 0) {
  // $exists = true;
  $showError= true;
  $showError_text = "Email is already linked to a account either use a different email or login with the email";
}
else
{
// $exists= false;

if($password == $cpassword )
{
  $hash = password_hash($cpassword, PASSWORD_BCRYPT);
  $sql= "INSERT INTO `users` ( `username`, `password`, `date`, `email`) VALUES ( '$username', '$hash', current_timestamp(), '$email')";
  $result = mysqli_query($conn,$sql);
  if($result) 
  {
        $show_alert= true;
  }
}
else {
  $showError= true;
  $showError_text = "Password do not match with confirm password";
}

}






}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
    <title>SignUp</title>
  </head>
  <body>
    <?php require './partials/_nav.php' // for nav_bar  we are calling the   file _nav.php 
    
    
    ?>
    <?php
    if($show_alert){
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> Your Account has been created Sucessfully thankyou.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if($showError){
      echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry !</strong>'.$showError_text.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
?>

    <div class="container">
        <h1 class="text-center">Sign Up To Our Website</h1>
        <form id="sign_up" action="/login_system/signup.php" method="POST">
  <div class="mb-3 col-md-6" >
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input name="email" maxlength="30" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3 col-md-6">
    <label for="username" class="form-label">UserName</label>
    <input name="username"  maxlength="12" type="text" class="form-control" id="username" aria-describedby="usernamehelp">
   
  </div>
  <div class="mb-3 col-md-6">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="password" maxlength="25" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input name="cpassword"  maxlength="25" type="password" class="form-control" id="cpassword">
    <div id="emailHelp" class="form-text">Make Sure To Type The Same Password</div>
  </div>
  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html> 