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
//$username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = "";
$profile = "profile.png";

$id = $price = $count = 0;
$sender = $sender_pr = $image = $theme1 = $theme2 = $style = $type = $state = $lga = $town = $area = $description = $package_name = "";

if(isset($_GET["id"])){$id = $_GET["id"];}
$sqlu = "SELECT id,package_name,sender,sender_pr,theme1,theme2,image,price,type,style,state,lga,town,area,description FROM interior_options WHERE id = ".$id."";
    $resultu = mysqli_query($link,$sqlu);
    $rowu = mysqli_fetch_assoc($resultu);
    $id = $rowu["id"];
    $price = $rowu["price"];
    $package_name = $rowu["package_name"];
    $sender = $rowu["sender"];
    $sender_pr = "zprofile".$rowu["sender_pr"];
    $image = "zdesign_image".$rowu["image"];
    $theme1 = $rowu["theme1"];
    $theme2 = $rowu["theme2"];
    $type = $rowu["type"];
    $style = $rowu["style"];
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
    $ref_type = "design";
    
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
    $param_ref_id = $id;
    $param_des = trim($_POST["description"]);
    $param_ref_type = $ref_type;
    $param_tour = 0;
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Redirect user to home page
        //header("location: lodges.php");
        
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
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $package_name; ?> - uniproperties.com</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

<body class="portfolio-details-page">

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
          <li class="dropdown"><a href="interior.php"><span>Interior</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="interior.php" class="active">Designs</a></li>
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

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up">

        <div class="portfolio-details-slider swiper init-swiper">
          <div class="swiper-wrapper align-items-center" style="max-height: 400px;">

            <div class="swiper-slide">
              <a href="<?php echo $image ?>"><img src="<?php echo $image ?>" alt=""></a>
            </div>

          </div>
        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8" data-aos="fade-up">
            <div class="portfolio-description">
              <h2><?php echo $package_name ?></h2>
              <h3>₦<?php echo $price ?></h3>
              <h5>color</h5>
              <div style="height: 20px;width: 100%;border-radius: 10px;background-image: linear-gradient(45deg,<?php echo $theme1 ?>,<?php echo $theme2 ?>);box-shadow: 0 0 2px rgba(128, 128, 128, 0.548);"></div>
              <br />
              <h5>style name</h5>
              <p>
              <?php echo $style ?>
              </p>
              <h5>description</h5>
              <p>
              <?php echo $description ?>
              </p>
              <hr />
              <br />
              <h4 id="enquiry">make enquiry</h4>
              <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="php-email-form">
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
                    <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <br />
            </div>
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="portfolio-info">
              <div class="widgets-container">

                <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item">

              <div class="d-flex flex-column align-items-center">
                <img src="<?php echo $sender_pr ?>" class="rounded-circle flex-shrink-0" alt="">
                <h4><?php echo $sender ?></h4>
                <div class="social-links">
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                  <a href="#"><i class="bi bi-star"></i></a>
                </div>

                <!--p>
                  Get any lodge of your choice right here at Trinity homes network
                </p-->

              </div>
            </div><!--/Blog Author Widget -->
    
              </div>
    
            </div>
          </div>

        </div>

        <br />
      </div>

    </section><!-- /Portfolio Details Section -->

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