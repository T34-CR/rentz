<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";
 
if(isset($_GET["username"])){
  $username = $_GET["username"];
} else{
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
}

// Define variables and initialize with empty values
$username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = "";
$profile = "profile.png";

$image = $image2 = $image3 = $target_dir = "";
$lodge_name_err = $room_id_err = $power_source_err = $water_source_err = $type_err = $room_des_err = $room_image_err = "";
$room_price_err = $room_rent_err = $distance_err = $room_size_err = $room_count_err = $room_floor_err = "";
$item_name_err = $type_err = $item_des_err = $item_price_err = $item_image_err = "";
$price_err = $theme1_err = $theme2_err = $style_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

            $image = basename($_FILES["imageUpload1"]["name"]);
            $target_dir = "zlodge_image";
            $target_file = $target_dir . basename($_FILES["imageUpload1"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["imageUpload1"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
              }
            }
             
            // Check if file already exists
            if (file_exists($target_file)) {
              echo "<script>alert('Sorry, file already exists.');</script>";
              $uploadOk = 0;
            }
            
            // Check file size
            if ($_FILES["imageUpload1"]["size"] > 5000000) {
              echo "<script>alert('Sorry, your file is too large.');</script>";
              $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
              $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "<script>alert('Sorry, your file was not uploaded.');</script>";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["imageUpload1"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["imageUpload1"]["name"])). " has been uploaded.";

                




                $image2 = basename($_FILES["imageUpload2"]["name"]);
                $target_dir = "zlodge_image";
                $target_file = $target_dir . basename($_FILES["imageUpload2"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                  $check = getimagesize($_FILES["imageUpload2"]["tmp_name"]);
                  if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                  } else {
                    echo "<script>alert('File is not an image.');</script>";
                    $uploadOk = 0;
                  }
                }
                
                // Check if file already exists
                if (file_exists($target_file)) {
                  echo "<script>alert('Sorry, file already exists.');</script>";
                  $uploadOk = 0;
                }
                
                // Check file size
                if ($_FILES["imageUpload2"]["size"] > 5000000) {
                  echo "<script>alert('Sorry, your file is too large.');</script>";
                  $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                  $uploadOk = 0;
                }
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  echo "<script>alert('Sorry, your file was not uploaded.');</script>";
                // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["imageUpload2"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["imageUpload2"]["name"])). " has been uploaded.";




                    $image3 = basename($_FILES["imageUpload3"]["name"]);
                    $target_dir = "zlodge_image";
                    $target_file = $target_dir . basename($_FILES["imageUpload3"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                      $check = getimagesize($_FILES["imageUpload3"]["tmp_name"]);
                      if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                      } else {
                        echo "<script>alert('File is not an image.');</script>";
                        $uploadOk = 0;
                      }
                    }
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                      echo "<script>alert('Sorry, file already exists.');</script>";
                      $uploadOk = 0;
                    }
                    
                    // Check file size
                    if ($_FILES["imageUpload3"]["size"] > 5000000) {
                      echo "<script>alert('Sorry, your file is too large.');</script>";
                      $uploadOk = 0;
                    }
                    
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                      echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                      $uploadOk = 0;
                    }
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                      echo "<script>alert('Sorry, your file was not uploaded.');</script>";
                    // if everything is ok, try to upload file
                    } else {
                      if (move_uploaded_file($_FILES["imageUpload3"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["imageUpload3"]["name"])). " has been uploaded.";







                        //lodge
                        $uid = $uidr = $lodge_name = $room_id = $lodge_namer = $room_idr = $power_source = $water_source = $type = $room_des = $room_image = "";
                        $room_price = $room_rent = $distance = $room_size = $room_count = $room_floor = $id = 0;
                        $style_err = $design_des_err = $design_image_err = "";
                        $state = $lga = $town = $area = $sender_pr = "";

                        //Getting location
                        $sqld = "SELECT state,lga,town,area,profile1 FROM users WHERE username = '".$username."'";
                        $resultd = mysqli_query($link,$sqld);
                        $rowd = mysqli_fetch_assoc($resultd);
                        $state = $rowd["state"];
                        $landmark = $rowd["lga"];
                        $town = $rowd["town"];
                        $area = $rowd["area"];
                        $sender_pr = $rowd["profile1"];

                        $uid = trim($_POST["room_id"]).trim($_POST["lodge_name"]);
                        //Getting id,room_id,lodge_name
                        $sqld = "SELECT id,room_id,lodge_name FROM listings";
                        $resultd = mysqli_query($link,$sqld);
                        while($rowd = mysqli_fetch_assoc($resultd)){
                            $id  = $rowd["id"]+1;
                            $room_idr  = $rowd["room_id"];
                            $lodge_namer  = $rowd["lodge_name"];
                            $uidr = $room_idr.$lodge_namer;
                            if($uid = $uidr){
                              $uid_err = "Already exists";
                            }
                        }

                      if(isset($uid_err)){
                        // Prepare an insert statement
                        $sql = "INSERT INTO listings (id,sender,sender_pr,lodge_name,room_id,power,water_source,type,description,image1,image2,image3,first_payment,rent,distance,floor_size,rooms,room_floor,state,lga,town,area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        
                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", $param_id,$param_username,$param_sender_pr,$param_lodge_name,$param_room_id,$param_power,$param_water_source,$param_type,$param_room_des,$param_room_image,$param_room_image2,$param_room_image3,$room_price,$param_room_rent,$param_distance,$param_room_size,$param_room_count,$param_room_floor,$param_state,$param_lga,$param_town,$param_area);
                            
                            // Set parameters
                            $param_id = $id;
                            $param_username = $username;
                            $param_sender_pr = $sender_pr;
                            $param_lodge_name = trim($_POST["lodge_name"]);
                            $param_room_id = trim($_POST["room_id"]);
                            $param_power = trim($_POST["power"]);
                            $param_water_source = trim($_POST["water"]);
                            $param_type = trim($_POST["type"]);
                            $param_room_des = trim($_POST["description"]);
                            $param_room_image = $image;
                            $param_room_image2 = $image2;
                            $param_room_image3 = $image3;
                            $room_price = trim($_POST["price"]);
                            $param_room_rent = trim($_POST["rent"]);
                            $param_distance = trim($_POST["distance"]);
                            $param_room_size = trim($_POST["floor_size"]);
                            $param_room_count = trim($_POST["rooms"]);
                            $param_room_floor = trim($_POST["room_floor"]);
                            $param_state = $state;
                            $param_landmark = trim($_POST["landmark"]);
                            $param_town = $town;
                            $param_area = trim($_POST["area"]);
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                // Redirect user to home page
                                header("location: lodges.php");
                                exit;
                            } else{
                                echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
                            }
                        }

                      }else{
                        echo "<script>alert('Sorry,room already exists! ".$uid." = ".$uidr."')</script>";
                      }



                    } else {
                        echo "<script>alert('Please upload a profile photo!');</script>";
                        $profile_err = "please provide a profile photo";
                            }
                        }

          } else {
              echo "<script>alert('Please upload a profile photo!');</script>";
              $profile_err = "please provide a profile photo";
                  }
              }

        } else {
            echo "<script>alert('Please upload a profile photo!');</script>";
            $profile_err = "please provide a profile photo";
                }
            }
        
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post - Rentz</title>

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <!-- Fonts ->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!- Vendor CSS Files ->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/vendor.css"-->

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />


  <!-- Link Bootstrap's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">

  <!-- Google Fonts ================================================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- script ================================================== -->
  <script src="js/modernizr.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <style>
    .form-container {
      max-height: 60%;
      padding: 30px;
    }

    label {
      width: 100%;
    }

    .image-preview {
      width: 100%;
      min-height: 300px;
      background-color: rgba(65, 64, 64, 0.1);
      margin-bottom: 20px;
      overflow: hidden;
      border-radius: 5px;
    }

    .image-preview img {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }

    /* Navmenu - Mobile */
    @media (max-width: 999px) {
      #file2,#file3 {
        width: 50%;
        float: left;
        padding: 5px;
      }

      #file2 .image-preview,
      #file3 .image-preview {
        min-height: 100px;
      }

      .image-preview {
        min-height: 200px;
      }
    }

  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">

  <!-- nav bar start  -->
  <header id="nav" class="site-header position-fixed text-white bg-dark">
    <nav id="navbar-example2" class="navbar navbar-expand-lg py-2">

      <div class="container ">

      <a class="navbar-brand" href="./index.html"><h2><span style="color:aquamarine">Rent</span>z</h2></a>


      <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon
          name="menu-outline" style="font-size: 30px;"></ion-icon></button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
        aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav align-items-center justify-content-end align-items-center flex-grow-1 ">
            <li class="nav-item">
              <a class="nav-link active me-md-4" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-md-4" href="lodges.php">Properties</a>
            </li>
            <li class="nav-item dropdown ">
              <a class="nav-link me-md-4 text-center dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false">More</a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a href="report.php" class="dropdown-item">Report a property</a>
                </li>
                <li><a href="post.php" class="dropdown-item">Post a property</a>
                </li>
                <li><a href="lodge_request.php" class="dropdown-item">Request a property type</a>
                </li>
                <li><a href="lodge_request_view.php" class="dropdown-item">View a property request <span
                      class="badge bg-secondary">PRO</span></a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-md-4" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a>
            </li>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="tabs-listing mt-4">
                      <nav>
                        <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab" role="tablist">
                          <button class="btn btn-outline-primary text-uppercase me-3 active" id="nav-sign-in-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab"
                            aria-controls="nav-sign-in" aria-selected="true">Log In</button>
                          <button onclick="window.location.replace('register.php');" class="btn btn-outline-primary text-uppercase" id="nav-register-tab"
                            type="button" role="tab"
                            aria-controls="nav-register" aria-selected="false">Sign Up</button>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel"
                          aria-labelledby="nav-sign-in-tab">
                          <form action="login.php" id="form1" class="form-group flex-wrap p-3 ">
                            <div class="form-input col-lg-12 my-4">
                              <label for="exampleInputEmail1"
                                class="form-label fs-6 text-uppercase fw-bold text-black">User Name</label>
                              <input type="text" id="exampleInputEmail1" name="username" placeholder="username" required
                                class="form-control ps-3" required>
                            </div>
                            <div class="form-input col-lg-12 my-4">
                              <label for="password"
                                class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                              <input type="password" id="password" placeholder="Password"
                                class="form-control ps-3" aria-describedby="passwordHelpBlock" name="password" required>
                              <div id="passwordHelpBlock" class="form-text text-center">
                                <a href="#" class=" password">Forgot Password ?</a>
                              </div>

                            </div>
                            <label class="py-3">
                              <input type="checkbox" required="" class="d-inline">
                              <span class="label-body text-black">Remember Me</span>
                            </label>
                            <div class="d-grid my-3">
                              <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Log
                                In</button>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade" id="nav-register" role="tabpanel"
                          aria-labelledby="nav-register-tab">
                          <form id="form2" class="form-group flex-wrap p-3 ">
                            <div class="form-input col-lg-12 my-4">
                              <label for="exampleInputEmail2"
                                class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                Address</label>
                              <input type="text" id="exampleInputEmail2" name="email" placeholder="Email"
                                class="form-control ps-3">
                            </div>
                            <div class="form-input col-lg-12 my-4">
                              <label for="inputPassword2"
                                class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                              <input type="password" id="inputPassword2" placeholder="Password"
                                class="form-control ps-3" aria-describedby="passwordHelpBlock">
                            </div>
                            <label class="py-3">
                              <input type="checkbox" required="" class="d-inline">
                              <span class="label-body text-black">I agree to the <a href="#"
                                  class="text-black password border-bottom">Privacy Policy</a>
                              </span>
                            </label>
                            <div class="d-grid my-3">
                              <button
                                class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Sign
                                Up</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <li class="nav-item">
              <a class="btn-medium btn btn-primary" href="register.php">Sign Up</a>
                <!--a class="btn-medium btn btn-primary" href="register.php" data-bs-toggle="modal"
                data-bs-target="#exampleModal2">Sign Up</a-->
            </li>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="tabs-listing mt-4">
                      <nav>
                        <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab2" role="tablist">
                          <button class="btn btn-outline-primary text-uppercase me-4 " id="nav-sign-in-tab2"
                            data-bs-toggle="tab" data-bs-target="#nav-sign-in2" type="button" role="tab"
                            aria-controls="nav-sign-in2" aria-selected="false">Log In</button>
                          <button class="btn btn-outline-primary text-uppercase active" id="nav-register-tab2"
                            data-bs-toggle="tab" data-bs-target="#nav-register2" type="button" role="tab"
                            aria-controls="nav-register2" aria-selected="true">Sign Up</button>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent1">
                        <div class="tab-pane fade " id="nav-sign-in2" role="tabpanel"
                          aria-labelledby="nav-sign-in-tab2">
                          <form id="form3" class="form-group flex-wrap p-3 ">
                            <div class="form-input col-lg-12 my-4">
                              <label for="exampleInputEmail3"
                                class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                Address</label>
                              <input type="text" id="exampleInputEmail3" name="email" placeholder="Email"
                                class="form-control ps-3">
                            </div>
                            <div class="form-input col-lg-12 my-4">
                              <label for="inputPassword3"
                                class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                              <input type="password" id="inputPassword3" placeholder="Password"
                                class="form-control ps-3" aria-describedby="passwordHelpBlock">
                              <div id="passwordHelpBlock2" class="form-text text-center">
                                <a href="#" class=" password">Forgot Password ?</a>
                              </div>

                            </div>
                            <label class="py-3">
                              <input type="checkbox" required="" class="d-inline">
                              <span class="label-body text-black">Remember Me</span>
                            </label>
                            <div class="d-grid my-3">
                              <button class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Log
                                In</button>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade active show" id="nav-register2" role="tabpanel"
                          aria-labelledby="nav-register-tab2">
                          <form id="form4" class="form-group flex-wrap p-3 ">
                            <div class="form-input col-lg-12 my-4">
                              <label for="exampleInputEmail4"
                                class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                Address</label>
                              <input type="text" id="exampleInputEmail4" name="email" placeholder="Email"
                                class="form-control ps-3">
                            </div>
                            <div class="form-input col-lg-12 my-4">
                              <label for="inputPassword4"
                                class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                              <input type="password" id="inputPassword4" placeholder="Password"
                                class="form-control ps-3" aria-describedby="passwordHelpBlock">
                            </div>
                            <label class="py-3">
                              <input type="checkbox" required="" class="d-inline">
                              <span class="label-body text-black">I agree to the <a href="#"
                                  class="text-black password border-bottom">Privacy Policy</a>
                              </span>
                            </label>
                            <div class="d-grid my-3">
                              <button
                                class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Sign
                                Up</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>

        </div>
      </div>


      </div>
    </nav>
  </header>

  <main>
    <div style="height: 60px;"></div>
    <div class="container form-container">
      <h2 class="mb-4">Post a Property</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
        <div class="row justify-content-between gy-4 mt-4">

          <div id="fileContainer" class="col-lg-4">
            <div id="file1">
              <label for="imageUpload1" class="file-upload">
                <div class="image-preview">
                  <img id="previewImage1" src="" alt="Click to add thumbnail image">
                </div>
              </label>
              <input name="imageUpload1" type="file" class="form-control" id="imageUpload1" hidden required>
            </div>
            <div id="subFileContainer">
              <div id="file2">
                <label for="imageUpload2" class="file-upload">
                  <div class="image-preview">
                    <img id="previewImage2" src="" alt="Click to add second image">
                  </div>
                </label>
                <input name="imageUpload2" type="file" class="form-control" id="imageUpload2" hidden required>
              </div>
              <div id="file3">
                <label for="imageUpload3" class="file-upload">
                  <div class="image-preview">
                    <img id="previewImage3" src="" alt="Click to add third image">
                  </div>
                </label>
                <input name="imageUpload3" type="file" class="form-control" id="imageUpload3" hidden required>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="row mb-3">
              <label for="price" class="col-sm-2 col-form-label">First payment</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="price" placeholder="500000" name="price" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="rent" class="col-sm-2 col-form-label">Rent</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="rent" placeholder="400000" name="rent" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="lodge_name" class="col-sm-2 col-form-label">Lodge Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lodge_name" placeholder="Califonia" name="lodge_name" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="room_id" class="col-sm-2 col-form-label">Room ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="room_id" placeholder="D7" name="room_id" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="type" class="col-sm-2 col-form-label">Apartment Type</label>
              <div class="col-sm-10">
                <select class="form-select" id="type" name="type" required>
                  <option value="self_con">Self con</option>
                  <option value="mini_self_con">Mini Self Con</option>
                  <option value="flat">Flat</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="area" class="col-sm-2 col-form-label">District</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="area" placeholder="Hilltop" name="area" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="landmark" class="col-sm-2 col-form-label">Land mark</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="landmark" placeholder="Landmark" name="landmark">
              </div>
            </div>

            <!--div class="row mb-3">
              <label for="zip" class="col-sm-2 col-form-label">Zip Code</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="zip" placeholder="90210">
              </div>
            </div-->

            <div class="row mb-3">
              <label for="rooms" class="col-sm-2 col-form-label">Bedrooms</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="rooms" placeholder="3" name="rooms" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="distance" class="col-sm-2 col-form-label">Minutes walk to campus</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="distance" placeholder="3" name="distance" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="floor_size" class="col-sm-2 col-form-label">Size in square feet</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="floor_size" placeholder="200" name="floor_size" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="room_floor" class="col-sm-2 col-form-label">Room floor</label>
              <div class="col-sm-10">
                <select class="form-select" id="room_floor" name="room_floor" required>
                  <option value="0">Ground Floor</option>
                  <option value="1">1st Floor</option>
                  <option value="2">2nd Floor</option>
                  <option value="3">3rd Floor</option>
                  <option value="4">4th Floor</option>
                  <option value="5">5th Floor</option>
                  <option value="6">6th Floor</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="power" class="col-sm-2 col-form-label">Electricity type</label>
              <div class="col-sm-10">
                <select class="form-select" id="power" name="power" required>
                  <option value="pre-paid">Pre-paid</option>
                  <option value="monthly">Monthly</option>
                  <option value="annual">Annual</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="water" class="col-sm-2 col-form-label">Water source</label>
              <div class="col-sm-10">
                <select class="form-select" id="water" name="water" required>
                  <option value="buy_water">Buy Water</option>
                  <option value="over-head_tank">Over-head Tank</option>
                  <option value="running_water">Running Water</option>
                  <option value="well">Well</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="description" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="description" rows="3" placeholder="Enter a description" name="description" required></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success" style="color: white;">Create Post</button>
              </div>
            </div>
          </div>

      </form>
    </div>
  </main>

  <!-- Footer start  -->
  <section id="footer">
    <div class="container footer-container">
      <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5  ">

        <div class=" col-md-4">
          <h3><h2><span style="color:aquamarine">Rent</span>z</h2></h3>
          <p>Find a home away from home</p>
          <i class="bi-facebook pe-4"></i>
          <i class="bi-instagram pe-4"></i>
          <i class="bi-twitter pe-4"></i>
          <i class="bi-youtube pe-4"></i>
        </div>

        <div class="col-md-2 ">
          <h5>Project</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Houses</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Rooms</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Flats</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Appartments</a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Company</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">How we work ?</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Capital </a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Security </a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Movement</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Movement</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Support us</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Pricing</a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Help</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Privacy </a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Condition</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Blog</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">FAQs</a></li>
          </ul>
        </div>
      </footer>
    </div>



    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 ">
        <div class="col-md-8 d-flex align-items-center">
          <p>© 2023 Rentz All rights reserved.</p>

        </div>
        
      </footer>
    </div>
  </section>




  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    <script>
    const imageUpload1 = document.getElementById('imageUpload1');
    const imageUpload2 = document.getElementById('imageUpload2');
    const imageUpload3 = document.getElementById('imageUpload3');
    const previewImage1 = document.getElementById('previewImage1');
    const previewImage2 = document.getElementById('previewImage2');
    const previewImage3 = document.getElementById('previewImage3');

    imageUpload1.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImage1.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        previewImage1.src = "";
      }
    });

    imageUpload2.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImage2.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        previewImage2.src = "";
      }
    });

    imageUpload3.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImage3.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        previewImage3.src = "";
      }
    });
  </script>

</body>

</html>