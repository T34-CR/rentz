<?php
// Initialize the session
session_start();
 
// Include configs file
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$_SESSION["loggedin"] = false;
header("location: login.php");

?>