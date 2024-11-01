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

  <!-- billboard start  -->
  <section id="billboard">
    <div class="container ">
      <div class="row flex-lg-row-reverse align-items-center ">

        <div class="col-lg-6">
          <img src="images/eth.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700"
            height="500" loading="lazy">
        </div>

        <form class="col-lg-6">
          <h1 class=" text-capitalize  lh-1 my-3">Pay your rent in crypto</h1>
          <p class="lead">The future of rent is here. Pay with crypto. Effortless rent payments, powered by blockchain.</p>
          <nav class="navbar navbar-expand-lg billboard-nav">
            <div class="container billboard-search p-0">

              <div class="row billboard-row">
                <div class="col-lg-3 billboard-select">
                  <select class="form-select mb-2 mb-lg-0" aria-label="Purpose">
                    <option selected>Purpose</option>
                    <option>Buy</option>
                    <option>Rent</option>
                    <option>Sell</option>
                    <option>Something else here</option>

                  </select>
                </div>
                <div class="col-lg-3 billboard-select">
                  <select class="form-select mb-2 mb-lg-0" aria-label="Location">
                    <option selected>Location</option>
                    <!-- Add options for Nigerian universitiess -->
                      <option>Abia State University	Uturu</option>
                      <option>Abubakar Tafawa Balewa University	Bauchi</option>
                      <option>Achievers University, Owo	Owo</option>
                      <option>Adamawa State University	Mubi</option>
                      <option>Adekunle Ajasin University	Akungba Akoko</option>
                      <option>Adeleke University	Ede</option>
                      <option>Admiralty University of Nigeria	Ibusa</option>
                      <option>Afe Babalola University	Ado-Ekiti</option>
                      <option>African University of Science and Technology	Abuja</option>
                      <option>Ahmadu Bello University	Zaria</option>
                      <option>Ajayi Crowther University	Oyo Town</option>
                      <option>Akwa Ibom State University	Ikot Akpad</option>
                      <option>Alex Ekwueme Federal University	Ikwo</option>
                      <option>Al-Hikmah University	Ilorin</option>
                      <option>Al-Qalam University, Katsina	Katsina</option>
                      <option>Ambrose Alli University	Ekpoma</option>
                      <option>American University of Nigeria	Yola</option>
                      <option>Anchor University, Lagos	Lagos</option>
                      <option>Arthur Jarvis University	Calabar</option>
                      <option>Atiba University	Oyo Town</option>
                      <option>Augustine University	Ilara</option>
                      <option>Babcock University	Ilishan-Remo</option>
                      <option>Bamidele Olumilua University of Education, Science and Technology, Ikere-Ekiti	Ikere-Ekiti</option>
                      <option>Bauchi State University	Gadau</option>
                      <option>Bayero University Kano	Kano</option>
                      <option>Baze University	Abuja</option>
                      <option>Bells University of Technology	Ota</option>
                      <option>Benson Idahosa University	Benin City</option>
                      <option>Benue State University	Makurdi</option>
                      <option>Bingham University	Auta Balifi</option>
                      <option>Borno State University	Maiduguri</option>
                      <option>Bowen University	Iwo</option>
                      <option>Caleb University	Imota</option>
                      <option>Caritas University	Enugu</option>
                      <option>Chrisland University	Abeokuta</option>
                      <option>Christopher University	Mowe</option>
                      <option>Chukwuemeka Odumegwu Ojukwu University	Uli</option>
                      <option>Clifford University	Ihie</option>
                      <option>Coal City University	Enugu</option>
                      <option>Covenant University	Ota</option>
                      <option>Crawford University	Faith City</option>
                      <option>Crescent University, Abeokuta	Abeokuta</option>
                      <option>Crown Hill University	Ilorin</option>
                      <option>Delta State University, Abraka	Abraka</option>
                      <option>Dominican University, Ibadan	Ibadan</option>
                      <option>Ebonyi State University	Abakaliki</option>
                      <option>Edo State University Uzairue	Iyamho</option>
                      <option>Edwin Clark University	Kiagbodo</option>
                      <option>Ekiti State University, Ado Ekiti	Ado-Ekiti</option>
                      <option>Eko University of Medical and Health Sciences	Ijanikin</option>
                      <option>Elizade University	Ilara-Mokin</option>
                      <option>Enugu State University of Science and Technology	Enugu</option>
                      <option>Evangel University, Akaeze	Enugu</option>
                      <option>Federal University of Agriculture, Abeokuta	Abeokuta</option>
                      <option>Federal University of Petroleum Resources	Effurun</option>
                      <option>Federal University of Technology, Akure	Akure</option>
                      <option>Federal University of Technology, Minna	Minna</option>
                      <option>Federal University of Technology, Owerri	Owerri</option>
                      <option>Federal University, Birnin Kebbi	Birnin Kebbi</option>
                      <option>Federal University, Dutse	Dutse</option>
                      <option>Federal University, Dutsin-Ma	Dutsin-Ma</option>
                      <option>Federal University, Gashua	Gashua</option>
                      <option>Federal University, Gusau	Gusau</option>
                      <option>Federal University, Kashere	Kashere</option>
                      <option>Federal University, Lafia	Lafia</option>
                      <option>Federal University, Lokoja	Lokoja</option>
                      <option>Federal University, Otuoke	Otuoke</option>
                      <option>Federal University, Oye-Ekiti	Oye-Ekiti</option>
                      <option>Federal University, Wukari	Wukari</option>
                      <option>Fountain University, Osogbo	Oshogbo</option>
                      <option>Glorious Vision University	Ogwa</option>
                      <option>Godfrey Okoye University	Ugwuomu-Nike</option>
                      <option>Gombe State University	Gombe</option>
                      <option>Gombe State University of Science and Technology	Kumo</option>
                      <option>Gregory University, Uturu	Uturu</option>
                      <option>Hallmark University, Ijebu-Itele	Ijebu-Itele</option>
                      <option>Hezekiah University	Umudi</option>
                      <option>Ibrahim Badamasi Babangida University	Lapai</option>
                      <option>Igbinedion University Okada	Okada</option>
                      <option>Ignatius Ajuru University of Education	Port Harcourt</option>
                      <option>Imo State University	Owerri</option>
                      <option>Joseph Ayo Babalola University	Ikeji-Arakeji</option>
                      <option>Joseph Sarwuan Tarkaa University	Makurdi</option>
                      <option>Kaduna State University	Kaduna</option>
                      <option>Kano University of Science and Technology	Wudil</option>
                      <option>Kebbi State University of Science and Technology	Aliero</option>
                      <option>Kings University	Odeomu</option>
                      <option>Kingsley Ozumba Mbadiwe University	Ideato</option>
                      <option>Kola Daisi University	Ibadan</option>
                      <option>Kwara State University	Ilorin</option>
                      <option>Kwararafa University, Wukari	Wukari</option>
                      <option>Ladoke Akintola University of Technology	Ogbomoso</option>
                      <option>Lagos State University	Ojo</option>
                      <option>Landmark University	Omu-Aran</option>
                      <option>Lead City University	Ibadan</option>
                      <option>Legacy University, Okija	Okija</option>
                      <option>Madonna University, Nigeria	Elele</option>
                      <option>Mcpherson University	Seriki-Sotayo</option>
                      <option>Mewar International University	New Karu</option>
                      <option>Michael and Cecilia Ibru University	Agbara-Otor</option>
                      <option>Michael Okpara University of Agriculture	Umuahia</option>
                      <option>Modibbo Adama University, Yola	Yola</option>
                      <option>Moshood Abiola Polytechnic, Abeokuta	Abeokuta</option>
                      <option>Mountain Top University	Makogi Oba</option>
                      <option>Nasarawa State University	Keffi</option>
                      <option>Niger Delta University	Wilberforce Island</option>
                      <option>Nigerian Maritime University, Okerenkoko	Okerenghigho</option>
                      <option>Nile University of Nigeria	Abuja</option>
                      <option>Nnamdi Azikiwe University	Awka</option>
                      <option>Novena University	Ogume</option>
                      <option>Obafemi Awolowo University	Ile-Ife</option>
                      <option>Obong University	Obong Ntak</option>
                      <option>Oduduwa University	Ile Ife</option>
                      <option>Olabisi Onabanjo University	Ago Iwoye</option>
                      <option>Ondo State University of Science and Technology	Okitipupa</option>
                      <option>Osun State University	Oshogbo</option>
                      <option>PAMO University of Medical Sciences	Port-Harcourt</option>
                      <option>Pan-Atlantic University	Lagos</option>
                      <option>Paul University	Awka</option>
                      <option>Plateau State University	Bokkos</option>
                      <option>Precious Cornerstone University	Ibadan</option>
                      <option>Prince Abubakar Audu University	Anyigba</option>
                      <option>Redeemer's University	Ede</option>
                      <option>Renaissance University	Enugu</option>
                      <option>Rhema University	Aba</option>
                      <option>Ritman University	Ikot Ekpene</option>
                      <option>Rivers State University	Port Harcourt</option>
                      <option>Salem University	Lokoja</option>
                      <option>Skyline University Nigeria	Kano</option>
                      <option>Sokoto State University	Sokoto</option>
                      <option>Southwestern University, Nigeria	Okun Owa</option>
                      <option>Spiritan University Nneochi	Umunneochi</option>
                      <option>Sule Lamido University	Kafin Hausa</option>
                      <option>Summit University Offa	Offa</option>
                      <option>Tai Solarin University of Education	Ijebu-Ode</option>
                      <option>Tansian University	Umunya</option>
                      <option>Taraba State University	Jalingo</option>
                      <option>The Technical University	Ibadan</option>
                      <option>Umaru Musa Yar'Adua University	Katsina</option>
                      <option>University of Abuja	Abuja</option>
                      <option>University of Africa	Toru-Orua</option>
                      <option>University of Benin	Benin City</option>
                      <option>University of Calabar	Calabar</option>
                      <option>University of Cross River State	Calabar</option>
                      <option>University of Ibadan	Ibadan</option>
                      <option>University of Ilorin	Ilorin</option>
                      <option>University of Jos	Jos</option>
                      <option>University of Lagos	Lagos</option>
                      <option>University of Maiduguri	Maiduguri</option>
                      <option>University of Medical Sciences	Ondo City</option>
                      <option>University of Mkar	Mkar</option>
                      <option>University of Nigeria	Enugu</option>
                      <option>University of Nigeria	Nsukka</option>
                      <option>University of Nigeria	Teaching Hospital</option>
                      <option>University of Port Harcourt	Port Harcourt</option>
                      <option>University of Uyo	Uyo</option>
                      <option>Usmanu Danfodio University	Sokoto</option>
                      <option>Veritas University	Abuja</option>
                      <option>Wellspring University	Benin City</option>
                      <option>Wesley University of Science and Technology	Ondo City</option>
                      <option>Western Delta University	Oghara</option>
                      <option">Yobe State University	Damaturu</option>
                      <option>Yusuf Maitama Sule University, Kano	Kano</option>
                      <option>Zamfara State University</option>
                      
                  </select>
                </div>
                <div class="col-lg-3 billboard-select">
                  <select class="form-select mb-2 mb-lg-0" aria-label="Type">
                    <option selected>Type</option>
                    <option>House</option>
                    <option>Appartment</option>
                    <option>Villa</option>
                    <option>Self contain</option>
                    <option>Mini Self contain</option>
                    <option>Something else here</option>
                  </select>
                </div>

                <div class="col-lg-3 billboard-btn">
                  <a href="lodges.php"><button type="submit" class="btn btn-primary btn-lg billboard-search">Search</button></a>
                </div>
              </div>


            </div>
          </nav>
        </form>
      </div>
    </div>
  </section>

  <!-- Feature start  ->
  <section id="feature">
    <div class="container py-5">
      <div class="row">
        <div class="section-header align-center mb-5">
          <h2 class=" text-capitalize m-0">Featured In</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-between">
        <div class="col-md-2 ">
          <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
              alt="image" src="images/logo1.png"></div>
        </div>
        <div class="col-md-2">
          <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
              alt="image" src="images/logo2.png"></div>
        </div>
        <div class="col-md-2">
          <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
              alt="image" src="images/logo3.png"></div>
        </div>
        <div class="col-md-2">
          <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
              alt="image" src="images/logo4.png"></div>
        </div>
        <div class="col-md-2">
          <div class="my-3" role="group" aria-label="3 / 7" style="width: 158.667px; margin-right: 20px;"><img
              alt="image" src="images/logo6.png"></div>
        </div>


      </div>
    </div>
  </section-->

  <!-- Residence start  -->
  <section id="residence">
    <div class="container  my-5 py-5">
      <h2 class="text-capitalize m-0 py-lg-5">Top Residence</h2>

      <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
      <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>

      <div class="swiper residence-swiper">
        <div class="swiper-wrapper">

        <?php
          
          $sqlr = "SELECT id,room_id,lodge_name,sender,sender_pr,image1,first_payment,rent,type,rooms,floor_size,distance,room_floor,water_source,power,state,lga,town,area,description,time FROM listings ORDER BY id DESC";
          $resultr = mysqli_query($link,$sqlr);
          while($rowr = mysqli_fetch_assoc($resultr)){
            if($lcount <= 6){
                $cut = 100/$percent;
                $gain = $rowr["first_payment"]/$cut;
                $pricel = $rowr["first_payment"]+$gain;
                $pricel = $pricel/4060537.99;
                echo "
                  <div class='swiper-slide'>
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

      <div class="residence-btn">
        <a href="lodges.php" class="btn btn-primary btn-lg my-5">View All Properties</a>
      </div>

    </div>
  </section>

  <!--About us start  -->
  <section id="about-us">
    <div class="container">
      <div class="row py-lg-5">

        <h2 class="text-capitalize text-center m-0 py-lg-5">Why to choose us</h2>

        <div class="text-center col-lg-4">
          <img src="images/search.png" class="bd-placeholder-img rounded-circle" alt="Bootstrap Themes" width="140"
            height="140" loading="lazy">
          <h4 class="fw-normal mt-5 ">Easy to find</h4>
          <p>We have a wide range of properties available, ensuring you find the right fit. Find the right property with ease, thanks to our expertise and user-friendly platform.</p>
        </div>

        <div class="text-center col-lg-4">
          <img src="images/price.png" class="bd-placeholder-img rounded-circle" alt="Bootstrap Themes" width="140"
            height="140" loading="lazy">
          <h4 class="fw-normal mt-5">Affordable Prices</h4>
          <p>Get more for your money. Our listings offer exceptional value and affordability. Transparent pricing. No hidden fees. Just honest and affordable options.</p>
        </div>

        <div class="text-center col-lg-4">
          <img src="images/time.png" class="bd-placeholder-img rounded-circle" alt="Bootstrap Themes" width="140"
            height="140" loading="lazy">
          <h4 class="fw-normal mt-5 ">Quickly Process</h4>
          <p>Fast and efficient. We handle the details so you can relax and enjoy the process. Get the results you need, quickly and efficiently, with our streamlined processes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonial start  ->
  <section id="testimonial">
    <div class="container my-5">



      <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="row my-5 py-lg-5">
              <div class="col-md-8 mx-auto">
                <img src="images/quote.png" class="rounded mx-auto d-inline" alt="...">
                <p class="testimonial-p mt-4">Massa semper non rutrum orci facilisi sit. Lectus porta quam a fringilla
                  eget viverra sem. Vulputate massa hendrerit turpis gravida tempor, porttitor.</p>

                <div class="row">
                  <div class="col-md-8">
                    <p class="pt-5 mb-1">Elena Pravo</p>
                    <p class="">Ceo, Upstate</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="row my-5 py-lg-5">
              <div class="col-md-8 mx-auto">
                <img src="images/quote.png" class="rounded mx-auto d-inline" alt="...">
                <p class="testimonial-p mt-4">Massa semper non rutrum orci facilisi sit. Lectus porta quam a fringilla
                  eget viverra sem. Vulputate massa hendrerit turpis gravida tempor, porttitor.</p>

                <div class="row">
                  <div class="col-md-8">
                    <p class="pt-5 mb-1">Elena Pravo</p>
                    <p class="">Ceo, Upstate</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="row my-5 py-lg-5">
              <div class="col-md-8 mx-auto">
                <img src="images/quote.png" class="rounded mx-auto d-inline" alt="...">
                <p class="testimonial-p mt-4">Massa semper non rutrum orci facilisi sit. Lectus porta quam a fringilla
                  eget viverra sem. Vulputate massa hendrerit turpis gravida tempor, porttitor.</p>

                <div class="row">
                  <div class="col-md-8">
                    <p class="pt-5 mb-1">Elena Pravo</p>
                    <p class="">Ceo, Upstate</p>
                  </div>
                </div>
              </div>
            </div>
          </div>




        </div>

        <div class=" testimonial-swiper-button col-md-3 position-absolute">
          <div class="swiper-button-prev testimonial-arrow"></div>
          <div class="arrow-divider"> | </div>
          <div class="swiper-button-next testimonial-arrow"></div>
        </div>

      </div>
    </div>
  </section-->

  <!-- Help start  -->
  <section id="help" class="py-5"
    style="background: linear-gradient(270deg, #1A242F 0.01%, rgba(26, 36, 47, 0.00) 100%);">
    <div class="container-lg my-5">

      <div class="row d-flex justify-content-between align-items-center">

        <div class="col-md-6">
          <div class="image-holder d-flex">
            <img src="images/group.png" class="img-fluid" alt="Bootstrap Themes" loading="lazy">
          </div>
        </div>

        <div class="col-md-6">
          <div class="text-content ps-md-5 mt-4 mt-md-0">
            <h2 class="text-capitalize">We help people to find homes</h2>
            <p>Finding a home shouldn't be a struggle. We're here to help every step of the way. We simplify the home search process, making it easier than ever to find your perfect fit. Your home search ends here. Let us help you find the perfect place.</p>
            <a href="lodge_request.php" class="btn btn-primary btn-lg">Request a Property type</a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Lets start  -->
  <section id="start">
    <div class="container my-5 py-5">
      <div class="row featurette py-lg-5 ">
        <div class="col-md-5 order-md-1 d-flex">
          <h1 class="text-capitalize  lh-1 mb-3">Let’s simply begin with rentz.</h1>
        </div>
        <div class="col-md-7 order-md-2">
          <div class="text-content ps-md-5 mt-4 mt-md-0">
            <p class="py-lg-2">Ready to rent? Let's Rentz! It's that easy. Finding the perfect rental shouldn't be complicated. Let's Rentz!</p>
            <a class="btn btn-primary btn-lg px-4 me-md-2" href="lodges.php">Get
              Started</a>
          </div>
        </div>
      </div>
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