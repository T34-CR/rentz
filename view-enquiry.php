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

// Define variables and initialize with empty values
$username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = "";
$profile = "profile.png";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = htmlspecialchars($_SESSION["username"]);
    $item_name = $type = $item_des = $item_image = "";
    $item_price = 0;
    $ref_type = "lodge";
    
//Getting id
$sqld = "SELECT id FROM enquiries ORDER BY id DESC";
$resultd = mysqli_query($link,$sqld);
$rowd = mysqli_fetch_assoc($resultd);
$idi  = $rowd["id"]+1;

// Prepare an insert statement
$sql = "INSERT INTO enquiries (id,sender,phone,email,ref_id,description,req_type,tour) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssssss", $param_id,$param_sender,$param_phone,$param_email,$param_ref_id,$param_des,$param_req_type,$param_tour);
    
    // Set parameters
    $param_id = $idi;
    $param_sender = trim($_POST["sender"]);
    $param_phone = trim($_POST["phone"]);
    $param_email = trim($_POST["email"]);
    $param_ref_id = trim($_POST["id"]);
    $param_des = trim($_POST["description"]);
    $param_ref_type = $ref_type;
    $param_tour = 1;
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Redirect user to home page
        //header("location: lodges.php");
        exit;
    } else{
        echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
    }
}

}
?>