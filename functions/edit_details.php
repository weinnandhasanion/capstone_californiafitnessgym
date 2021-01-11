<?php
require "./connect.php";
session_start();

$user = $_POST["user"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$birthdate = $_POST["birthdate"];
$address = $_POST["address"];

$sql = "UPDATE member SET username = '". $user ."', email = '". $email ."', phone = '". $phone ."', birthdate = '". $birthdate ."', 
      address = '". $address ."' WHERE username = '". $_SESSION["user"] ."' and password = '". $_SESSION["pass"] ."'";
$result = mysqli_query($con, $sql);

if($result) {
  $_SESSION["user"] = $user;
  echo 1;
} else {
  echo 0;
}
?>