<?php 
require "./connect.php";
session_start();

$pass = $_POST["pass"];

$sql = "UPDATE member SET password = '$pass' WHERE username = '". $_SESSION["user"] ."' AND password = '". $_SESSION["pass"] ."'";
$result = mysqli_query($con, $sql);

if($result) {
  $_SESSION["pass"] = $pass;
  echo 1;
} else {
  echo 0;
}
?>