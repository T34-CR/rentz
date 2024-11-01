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
// $username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = "";
$profile = "profile.png";

$percent = 3;
$id = $price = $pricec = $count = 0;
$room_id = $lodge_name = $sender = $sender_pr = $first_payment = $image1 = $image2 = $image3 = $category = $type = $spec = $status = $state = $lga = $town = $area = $description = "";
$rent = $type = $rooms = $floor_size = $distance = $room_floor = $water_source = $power_source = "";

if(isset($_GET["id"])){$id = $_GET["id"];}
$sqlu = "SELECT id,room_id,lodge_name,sender,sender_pr,image1,image2,image3,first_payment,rent,type,rooms,floor_size,distance,room_floor,water_source,power,state,lga,town,area,description,time FROM listings WHERE id = ".$id."";
    $resultu = mysqli_query($link,$sqlu);
    $rowu = mysqli_fetch_assoc($resultu);
    $id = $rowu["id"];
    $room_id = $rowu["room_id"];
    $lodge_name = $rowu["lodge_name"];
    $sender = $rowu["sender"];
    $sender_pr = "zprofile".$rowu["sender_pr"];
    $image1 = "zlodge_image".$rowu["image1"];
    $image2 = "zlodge_image".$rowu["image2"];
    $image3 = "zlodge_image".$rowu["image3"];

    $cut = 100/$percent;
    $gain = $rowu["first_payment"]/$cut;
    $pricel = $rowu["first_payment"]+$gain;
    $first_payment = $pricel; 
    $pricec = $pricel/4060537.99;

    $rent = $rowu["rent"];
    $type = $rowu["type"];
    $rooms = $rowu["rooms"];
    $floor_size = $rowu["floor_size"];
    $distance = $rowu["distance"];
    $room_floor = $rowu["room_floor"];
    $water_source = $rowu["water_source"];
    $power_source = $rowu["power"];
    $state = $rowu["state"];
    $lga = $rowu["lga"];
    $town = $rowu["id"];
    $area = $rowu["area"];
    $description = $rowu["description"];
    

if(empty($image1)){$image1 = "img/ic_launcher.jpeg";}
if(empty($image2)){$image2 = "img/ic_launcher.jpeg";}
if(empty($image3)){$image3 = "img/ic_launcher.jpeg";}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = htmlspecialchars($_SESSION["username"]);
    $item_name = $type = $item_des = $item_image = "";
    $item_price = 0;
    $ref_type = "lodge";
    
//Getting id
$sqld = "SELECT id FROM enquiries ORDER BY id DESC";
$resultd = mysqli_query($link,$sqld);
$rowd = mysqli_fetch_assoc($resultd);
$idi = 0;
if(!empty($rowd["id"])){ $idi = $rowd["id"]+1;}

// Prepare an insert statement
$sql = "INSERT INTO enquiries (id,sender,phone,email,ref_id,sl_time,sl_date,req_type,tour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssssssss", $param_id,$param_sender,$param_phone,$param_email,$param_ref_id,$param_sl_time,$param_sl_date,$param_req_type,$param_tour);
    
    // Set parameters
    $param_id = $idi;
    $param_sender = trim($_POST["sender"]);
    $param_phone = trim($_POST["phone"]);
    $param_email = trim($_POST["email"]);
    $param_ref_id = $id;
    $param_sl_time = trim($_POST["time"]);
    $param_sl_date = trim($_POST["date"]);
    $param_ref_type = "lodge";
    $param_tour = 1;
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Redirect user to home page
        header("location: lodges.php");
        exit;
    } else{
        echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
    }
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $description; ?> - Rentz</title>

  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="<?php echo $first_payment; ?>,<?php echo $rent; ?>,<?php echo $type; ?>,<?php echo $rooms; ?>,<?php echo $floor_size; ?>,<?php echo $distance; ?>,<?php echo $room_floor; ?>,<?php echo $water_source; ?>,<?php echo $power_source; ?>,<?php echo $state; ?>">


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

    <style>
    /* Navmenu - Mobile */
    @media (max-width: 990px) {
      #conimg2,#conimg3 {
        width: 50%;
        float: left;
        padding: 5px;
      }

      #conimg2,
      #conimg3,
      #img2,
      #img3,
      #subconimg {
        min-height: 100px;
      }

      /* .image-preview {
        min-height: 200px;
      } */
    }
  </style>

  <!-- script ================================================== -->
  <script src="js/modernizr.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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

  <main class="main">
  <div style="height: 60px;"></div>
    
    <div class="container">
      <div class="row justify-content-between gy-4 mt-4">

        <div class="col-lg-5">
          <section id="img-section" class="section">
            <div id="conimg1" class="post-img">
              <a href="<?php echo $image1; ?>">
                <img id="img1" src="<?php echo $image1; ?>" alt="" class="img-fluid">
              </a>
            </div>
            <div id="subconimg">
              <div id="conimg2">
                <a href="<?php echo $image2; ?>">
                  <img id="img2" src="<?php echo $image2; ?>" alt="" class="img-fluid">
                </a>
              </div>
              <div id="conimg3">
                <a href="<?php echo $image3; ?>">
                  <img id="img3" src="<?php echo $image3; ?>" alt="" class="img-fluid">
                </a>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-6">
          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">
                <h2 class="title"><?php echo $description; ?></h2>

                <!--div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-heart"></i> <a href="blog-details.html">213<span class="d-md-inline-block"> Likes</span></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 <span class="d-md-inline-block">Comments</span></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
                  </ul>
                </div><-- End meta top -->

                <div class="content" style="background-color: none;color:white">
                  
                  <div class="list-group">
                    <a href="#" class="list-group-item">
                      Type
                      <span style="float: right;"><?php echo $type; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      First payment
                      <span style="float: right;">₦<?php echo $first_payment; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Rent
                      <span style="float: right;">₦<?php echo $rent; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Floor size
                      <span style="float: right;"><?php echo $floor_size; ?>sqft</span>
                    </a>
                    <a href="#" class="list-group-item">
                      Floor
                      <span style="float: right;"><?php echo $room_floor; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Rooms
                      <span style="float: right;"><?php echo $rooms; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Water source
                      <span style="float: right;"><?php echo $water_source; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Power
                      <span style="float: right;"><?php echo $power_source; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                      Distance from campus
                      <span style="float: right;"><?php echo $distance; ?>min</span>
                    </a>
                    <a href="#" class="list-group-item">
                      Location
                      <span style="float: right;"><?php echo $area; ?></span>
                    </a>
                  </div>

                  <br />
                  <hr />
                  <h5 id="address">Address</h5>
                  <b>Campus:</b>
                  <p class="detail"><?php echo $state; ?></p>
                  <b>District:</b>
                  <p class="detail"><?php echo $area; ?></p>
                  <!--h5>Land mark:</h5>
                  <p class="detail">?php echo $landmark; ?</p-->
                  <hr />
                  <br />
                  <br />
                  <h5>description</h5>
                  <p><?php echo $description; ?></p>
                  <hr />
                  <br />
                  <br />
                  <h4 id="tour">schedule tour</h4>
                  <div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <div class="row gy-4">
                      <input name="id" type="hidden" value="<?php echo $id; ?>">
        
                        <div class="col-md-6">
                          <input name="date" type="date" class="form-control">
                        </div>
                      <div class="col-md-6">
                          <input name="time" type="time" class="form-control">
                      </div>
                      <div class="col-md-12">
                          <input name="sender" type="text" placeholder="Name&hellip;" class="form-control">
                      </div>
                      <div class="col-md-6">
                          <input name="email" type="text" placeholder="Email&hellip;" class="form-control">
                      </div>
                      <div class="col-md-6">
                          <input name="phone" type="tel" placeholder="Phone Number&hellip;" class="form-control">
                      </div>
                      <div class="form-group">
                          <sub>submiting this form means that you have agree to our<a href="#"><b> Terms of Use</b></a></sub>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </form>
                  </div>
                  <br />
                  <br />
                  <hr />
                  <br />
                  <br />
                  <h4 id="enquiry">make enquiry</h4>
                  <div>
                    <form action="view-enquiry.php" method="post">
                      <div class="row gy-4">
                        <input name="id" type="hidden" value="<?php echo $id; ?>">
                      
                        <div class="col-md-6">
                          <input name="sender" type="text" placeholder="Full Name&hellip;" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input name="email" type="text" placeholder="Email&hellip;" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <input name="phone" type="tel" placeholder="Phone Number&hellip;" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <textarea name="description" class="form-control" placeholder="Description&hellip;"></textarea>
                        </div>
                        <div class="form-group">
                            <sub>submiting this form means that you have agree to our<a href="#"><b> Terms of Use</b></a></sub>
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <br /><br />
                  <h4 id="enquiry">Pay via metamax wallet</h4>
                  <h3 id="amount"></h3>
                  <div>
                    <div class="row gy-4">
                      <input name="id" type="hidden" value="<?php echo $id; ?>">
                      
                        <div class="col-md-12">
                          <input name="sender" type="text" placeholder="Full Name&hellip;" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input name="email" type="text" placeholder="Email&hellip;" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input name="phone" type="tel" placeholder="Phone Number&hellip;" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <button id="wallet" onclick="wallet();" name="wallet" type="button" class="form-control"><i class="bi bi-wallet"></i> Connect wallet</button>
                        </div>
                        <div class="col-md-12">
                            <textarea name="description" class="form-control" placeholder="Description&hellip;"></textarea>
                        </div>
                        <div class="form-group">
                            <sub>submiting this form means that you have agree to our<a href="#"><b> Terms of Use</b></a></sub>
                        </div>
                        <div class="col-md-12">
                          <button id="pay" style="display: none;" onclick="sendtx()" type="submit" class="btn btn-success">Pay</button>
                        </div>
                      </div>
                  </div>
                  <br />
                </div><!-- End meta bottom -->

              </article>

              <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item" style="margin-top: 50px;">

              <div class="d-flex flex-column align-items-center">
                <img style="height: 100px;width: 100px;" src="<?php echo $sender_pr; ?>" class="rounded-circle flex-shrink-0" alt="">
                <h4><?php echo $sender; ?></h4>
                <div class="social-links">
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                </div>

                <p>
                  description
                </p>

              </div>
            </div><!--/Blog Author Widget -->

            </div>
          </section><!-- /Blog Details Section -->

          

        </div>
        
      </div>
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

const ethers = require('ethers');

// MetaMask connection function
async function wallet() {
    // Check if MetaMask is installed
    if (typeof window.ethereum === 'undefined') {
        console.error('MetaMask is not installed. Please install it to use this feature.');
        return;
    }

    // Request account access
    try {
        const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
        const userAddress = accounts[0];
        document.getElementById('wallet').innerText = 'Connected';
        document.getElementById('amount').innerText = 'ETH<?php echo $pricec; ?>';
        document.getElementById('pay').style.display = 'block';
        console.log('Connected wallet address:', userAddress);
        
        // Create a provider and signer from the MetaMask wallet
        const provider = new ethers.providers.Web3Provider(window.ethereum);
        const signer = provider.getSigner();
        
        // Use the signer to send transactions
        const receiver = '0x2a8717831e4c924DE0083d04Ba88A64Dc225D906';
        await sendTx(signer, receiver, "<?php echo $pricec; ?>");
    } catch (error) {
        console.error('User denied account access or there was an error:', error);
    }
}

// Function to send Ether using the connected wallet
async function sendTx(signer, to, amount) {
    try {
        const tx = await signer.sendTransaction({
            to: to,
            value: ethers.parseEther(amount) // Sending the specified amount of Ether
        });

        console.log('Transaction sent:', tx);
    } catch (error) {
        console.error('Transaction failed:', error);
    }
}

// Call the wallet function to initiate connection
// wallet();






    //const ethers = require('ethers');
    //const url = 'https://rpc.sepolia-api.lisk.com';
    //const provider = new ethers.JsonRpcProvider(url);

    //const privateKey = '373e426aa02d3ba7c4267e36be7c35a96d82c63a846fcdea1c50ec0fa345cbf9';
    //const signer = new ethers.Wallet(privateKey, provider);
    //const receiver = '0x2a8717831e4c924DE0083d04Ba88A64Dc225D906';
    // Send 0.01 ether to a given address.
    //async function sendTx(to) {
        //const tx =  await signer.sendTransaction({
            //to: to,
            //value: ethers.parseEther("0.001")
        //});

        //console.log(tx);
    //}

    //sendTx();
  </script>
</body>

</html>