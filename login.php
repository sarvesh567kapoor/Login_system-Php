<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{

include "./partials/db_connect.php";
$username = $_POST["username"];
$password = $_POST["password"];



// $sql= "Select * from users where username = '$username' and password = '$password'";
$sql= "Select * from users where username = '$username' ";

$result = mysqli_query($conn,$sql);
// $row = $result -> fetch_assoc();
$num= mysqli_num_rows($result);
if($num ==1){
  // echo "hello";
  while($row = mysqli_fetch_assoc($result)){
    if($auth = password_verify($password, $row['password'])){
      
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $row['email'];
      header("location: welcome.php"); //redirect the user to the welcome page .
    }
    else {
  
      $showError=true;
      $showError_text="Invalid Credentials";
    
    }
  }

 
}
else {
  $showError=true;
  $showError_text="Invalid Credentials";

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
     <link rel="stylesheet" href="./style.css">
    <title>Login</title>
  </head>
  <body>
    <?php require './partials/_nav.php' // for nav_bar  we are calling the   file _nav.php 
    
    
    ?>
    <?php
    if($login){
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> You are logged in 
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
        <h1 class="text-center">Login To Our Website</h1>
     <form id="login" action="/login_system/login.php" method="POST">
        <div class="mb-3 col-md-6">
        <label for="username" class="form-label">UserName</label>
        <input name="username" type="text" class="form-control" id="username" aria-describedby="usernamehelp">
        </div>
        <div class="mb-3 col-md-6">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
       
        <button type="submit" class="btn btn-primary">Login</button>
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