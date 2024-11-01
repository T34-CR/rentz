<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: login.php");
    //exit;
//}

// Include config file
require_once "config.php";

$rate = $username = $star1 = $star2 = $star3 = $star4 = $star5 = "";
if(isset($_GET["username"]) && isset($_GET["rate"])){
    $username = $_GET["username"];
    
}
    $rate = $_GET["rate"];

    $sqlep = "SELECT star1,star2,star3,star4,star5 FROM users WHERE username = '".$username."'";
    $resultep = mysqli_query($link,$sqlep);
    $rowep = mysqli_fetch_assoc($resultep);
    $star1 = $rowep["star1"];
    $star2 = $rowep["star2"];
    $star3 = $rowep["star3"];
    $star4 = $rowep["star4"];
    $star5 = $rowep["star5"];
    
// Processing form data when form is submitted
echo intval($star1)+$rate;
if($rate = 1){
    $sql = "UPDATE users SET star1 = '".intval($star1)+$rate."' WHERE username = '".$username."'";
} elseif($rate = 2){
    $sql = "UPDATE users SET star2 = '".intval($star2)+$rate."' WHERE username = '".$username."'";
} elseif($rate = 3){
    $sql = "UPDATE users SET star3 = '".intval($star3)+$rate."' WHERE username = '".$username."'";
} elseif($rate = 4){
    $sql = "UPDATE users SET star4 = '".intval($star4)+$rate."' WHERE username = '".$username."'";
} elseif($rate = 5){
    $sql = "UPDATE users SET star5 = '".intval($star5)+$rate."' WHERE username = '".$username."'";
}
    if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
          exit;
        } else {
          echo "Error updating record: " . $conn->error;
            }
?>