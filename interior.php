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

$id = $price = $count = 0;
$package_name = $sender = $sender_pr = $image = $type = $rank = $state = $lga = $town = $area = $description = "";

$sqlu = "SELECT id,package_name,sender,sender_pr,image,price,type,rank,state,lga,town,area,description FROM interior_options ORDER BY id DESC";
    $resultu = mysqli_query($link,$sqlu);
    while($rowu = mysqli_fetch_assoc($resultu)){
    $id = $rowu["id"];
    $price = $rowu["price"];
    $package_name = $rowu["package_name"];
    $sender = $rowu["sender"];
    $sender_pr = $rowu["sender_pr"];
    $image = "zdesign_image".$rowu["image"];
    $type = $rowu["type"];
    $rank = $rowu["rank"];
    $state = $rowu["state"];
    $lga = $rowu["lga"];
    $town = $rowu["id"];
    $area = $rowu["area"];
    $description = $rowu["description"];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Interior - Uniproperties</title>
  <meta name="description" content="Get your room setup">
  <meta name="keywords" content="interior,design">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="blog-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Uniproperties</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="lodges.php"><span>Listings</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="lodges.php">Listings</a></li>
              <li><a href="report.php">Report</a></li>
              <li><a href="post.php">Post</a></li>
              <li><a href="lodge_request.php">Lodge Request</a></li>
              <li><a href="lodge_request_view.php">View Requests</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="active"><span>Interior</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Designs</a></li>
              <li><a href="post-design.php">Post</a></li>
              <li><a href="custom_package.php">Custom Package</a></li>
              <li><a href="design_request_view.php">View Requests</a></li>
            </ul>
          </li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container position-relative">
        <h1>Interior Options</h1>
        <!--form>
          <div class="form-group" style="background-color: white;border-radius: 25px;padding: 5px;">
            <button style="float: right;margin-right: 0;background: none;border: none;"><i class="bi bi-search"></i></button>
            <input style="border: none;width: 80%;" type="search" placeholder="Search specifications&hellip;" />
          </div>
        </form-->
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Interior</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container portfolio">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Classic</li>
            <li data-filter=".filter-product">Concept</li>
            <li data-filter=".filter-branding">Courtesy</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <?php
              $sqls = "SELECT id,package_name,sender,sender_pr,image,style,price,type,rank,state,lga,town,area,description FROM interior_options ORDER BY id DESC";
              $results = mysqli_query($link,$sqls);
              while($rows = mysqli_fetch_assoc($results)){
              echo "
              <div class='col-lg-4 col-md-6 portfolio-item isotope-item ";
              if($rows["style"] == "classic"){echo "filter-app";
              }elseif($rows["style"] == "concept"){echo "filter-product";
              }elseif($rows["style"] == "courtesy"){echo "filter-branding";} 
              echo"'>
                <a href='view-design.php?id=".$rows["id"]."'><img src='zdesign_image".$rows["image"]."' class='img-fluid' alt=''></a>
                <div class='portfolio-info'>
                  <h4>".$rows["package_name"]."</h4>
                  <p>".$rows["state"]."</p>
                  <a href='".$rows["image"]."' title='App 1' data-gallery='portfolio-gallery-app' class='glightbox preview-link'><i class='bi bi-zoom-in'></i></a>
                </div>
              </div><!-- End Portfolio Item -->";
              }
            ?>

          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section><!-- /Blog Posts Section -->

    
  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container">
      <h3 class="sitename">Uniproperties</h3>
      <p>Follow us @</p>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-whatsapp"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="container">
        <div class="copyright">
          <span><i class="bi bi-c-circle"></i></span> <strong class="px-1 sitename">Uniproperties</strong> <span>All Rights Reserved</span>
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
          <a href="bootstrapmade.com">credits</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>