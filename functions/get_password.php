<?php 
require "./connect.php";
session_start();

$pass = $_POST["pass"];

if($pass == $_SESSION["pass"]) {
  echo 1;
} else {
  echo 0;
}
?>