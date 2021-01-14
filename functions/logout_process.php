<?php 
require "./connect.php";
session_start();
unset($_SESSION["user"]);
unset($_SESSION["pass"]);
unset($_SESSION["member_id"]);
?>