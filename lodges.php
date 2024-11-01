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
$id = 0;
$lcount = $icount = 1;
$percent = 3;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Rentz</title>

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
              <a class="nav-link me-md-4" href="lodges.php" class="active">Properties</a>
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

  <!-- Residence start  -->
  <section id="residence">
    <div class="container  my-5 py-5">
      <h2 class="text-capitalize m-0 py-lg-5" style="width: 100%;text-align: center;">For Rent</h2>

      <div class="container">
        <div class="row g-4">

        <?php
          
          $sqlr = "SELECT id,room_id,lodge_name,sender,sender_pr,image1,first_payment,rent,type,rooms,floor_size,distance,room_floor,water_source,power,state,lga,town,area,description,time FROM listings ORDER BY id DESC";
          $resultr = mysqli_query($link,$sqlr);
          while($rowr = mysqli_fetch_assoc($resultr)){
            if($lcount <= 20){
                $cut = 100/$percent;
                $gain = $rowr["first_payment"]/$cut;
                $pricel = $rowr["first_payment"]+$gain;
                $pricel = $pricel/4060537.99;
                echo "
                  <div class='swiper-slide col-md-4'>
                    <div class='card'>
                      <a href='view.php?id=".$rowr["id"]."'><div style='height: 300px; overflow-x: hidden;'><img width='max-content' height='100%' src='zlodge_image".$rowr["image1"]."' class='card-img-top' alt='image'></div></a>
                      <div class='card-body p-0'>
                        <a href='index.html'>
                          <h5 class='card-title pt-4'>ETH".$pricel."</h5>
                        </a>
                        <p class='card-text'>".$rowr["area"].", ".$rowr["state"]."</p>

                        <div class='card-text'>
                          <ul class='d-flex'>
                            <li class='residence-list'> <img src='images/bed.png' alt='image'> ".$rowr["rooms"]." bed</li>
                            <li class='residence-list'> <img src='images/bath.png' alt='image'> ".$rowr["room_floor"]." bath</li>
                            <li class='residence-list'> <img src='images/square.png' alt='image'> ".$rowr["floor_size"]." Sqft.</li>
                          </ul>
                        </div>

                      </div>
                    </div>
                  </div>";
                $lcount = $lcount+1;
            }
          }
                  ?>
          
        </div>




      </div>

      <!--div class="residence-btn">
        <a href="lodges.php" class="btn btn-primary btn-lg my-5">More Content</a>
      </div-->
    </div>
  </section>

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
</body>

</html>