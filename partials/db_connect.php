<?php

$server= "localhost";
$username= "root";
$password ="";
$database ="users";

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn){

    die("Error:Failed To connect to the Database!".mysqli_connect_error($conn));

}
else {
    // echo "sucessfully connected to the database";
}




?>