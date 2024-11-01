<?php
// Initialize the session
session_start();
 
// Include configs file
require_once "config.php";

$username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = $acc_number = "";
$profile = "profile.png";
$likes = $comments = $liked = $commented = $views = $clicks = $listings = $stock = $id = 0;
$balance = $sales = $referals = $regis_refs = $sub_refs = $top_refs = $ratings = $rating = $rated = 0;
$star1 = $star2 = $star3 = $star4 = $star5 = $stars = 0;

$percent = 3;

if(isset($_GET["username"])){
    $username = $_GET["username"];
} else{
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
}

//Getting profile photo, email and department
$sqlep = "SELECT profile1,email,phone,gender,views,clicks,sales,listings,referrals,sub_refs,regis_refs,top_refs,items,likes,liked,comments,commented,ratings,rated,star1,star2,star3,star4,star5,state,lga,town,balance,acc_number FROM users WHERE username = '".$username."'";
    $resultep = mysqli_query($link,$sqlep);
    while($rowep = mysqli_fetch_assoc($resultep)){
    $profile = "zprofile".$rowep["profile1"];
    $email = $rowep["email"];
    $phone = $rowep["phone"];
    $gender = $rowep["gender"];
    $state = $rowep["state"];
    $lga = $rowep["lga"];
    $town = $rowep["town"];
    //$area = $rowep["area"];
    $balance = $rowep["balance"];
    $acc_number = $rowep["acc_number"];
    $likes = $rowep["likes"];
    $comments = $rowep["comments"];
    $liked = $rowep["liked"];
    $commented = $rowep["commented"];
    $views = $rowep["views"];
    $clicks = $rowep["clicks"];
    $listings = $rowep["listings"];
    $stock = $rowep["items"];
    $sales = $rowep["sales"];
    $referals = $rowep["referrals"];
    $regis_refs = $rowep["regis_refs"];
    $sub_refs = $rowep["sub_refs"];
    $top_refs = $rowep["top_refs"];
    $rated = $rowep["rated"];
    $star1 = $rowep["star1"];
    $star2 = $rowep["star2"];
    $star3 = $rowep["star3"];
    $star4 = $rowep["star4"];
    $star5 = $rowep["star5"];
     } 
if(empty($profile)){
    $profile = "profile.png";
}

    $ratings = $star1+$star2+$star3+$star4+$star5;
    $stars = $star1+$star2*2+$star3*3+$star4*4+$star5*5;
    $rating = 0;
    if($ratings > 0){
        $rating = $stars/$ratings;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $username; ?> - uniproperties.com</title>
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
              <li><a href="interior.php">Designs</a></li>
              <li><a href="post-design.php">Post</a></li>
              <li><a href="custom_package.php">Custom Package</a></li>
              <li><a href="design_request_view.php">View Requests</a></li>
            </ul>
          </li>
          <li><a href="#" class="active">Profile</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container">
        <div class="container row gy-4">

          <div class="widgets-container col-lg-6">

            <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item">

              <div class="d-flex flex-column align-items-center">
                <img src="<?php echo $profile; ?>" class="rounded-circle flex-shrink-0" alt="">
                <h4><?php echo $username; ?></h4>
                <p><?php echo $email; ?></p>
                <div class="social-links">
                  <a href="rate.php?rate=1"><i class="bi bi-star"></i></a>
                  <a href="rate.php?rate=2"><i class="bi bi-star"></i></a>
                  <a href="rate.php?rate=3"><i class="bi bi-star"></i></a>
                  <a href="rate.php?rate=4"><i class="bi bi-star"></i></a>
                  <a href="rate.php?rate=5"><i class="bi bi-star"></i></a>
                </div>

                <p><b>Copy referral link</b></p>
                <p>http://uniproperties.com/register.php?ref=<?php echo $username; ?></p>

              </div>
            </div><!--/Blog Author Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Stats</h3>
              <h2>₦<?php echo $balance; ?></h2>
              <?php if($balance > 10000){
                echo "<button class='btn btn-warning' style='border-radius: 25px;color: white;'>cash out <i class='bi bi-wallet'></i></button>";
              }
              ?>
              <hr />

              <ul>
                <li><a href="#"><i class="bi bi-cart"></i> <?php echo $sales; ?></a></li>
                <li><a href="#"><i class="bi bi-eye"></i> <?php echo $views; ?></a></li>
                <li><a href="#"><i class="bi bi-hand-thumbs-up"></i> <?php echo $clicks; ?></a></li>
                <li><a href="#"><i class="bi bi-house"></i> <?php echo $listings; ?></a></li>
                <li><a href="#"><i class="bi bi-person"></i>Referrals :<?php echo $referals; ?></a></li>
                <li><a href="#"><i class="bi bi-person-plus"></i> Sub- Referrals: <?php echo $sub_refs; ?></a></li>
                <li><a href="#"><i class="bi bi-person-check"></i> Registered Referrals: <?php echo $regis_refs; ?></a></li>
                <li><a href="#"><i class="bi bi-award"></i> Top Referrals: <?php echo $top_refs; ?></a></li>
              </ul>

              <!--div style="margin-top: 20px;background-image:linear-gradient(225deg,rgba(255, 100, 0, 0.2)5%,rgba(250, 175, 75, 0) 75%,rgba(255, 100, 0, 0.2));border: 1px solid;border-color: orange;padding: 20px;border-radius: 10px;">
                <div class="card-body">
                  <h3 class="card-title" style="float: right;color: red;font-style: italic;text-shadow: 0 0 5px red;"><b>UBA</b></h3>
                  <p class="card-text">credit</p>
                  <h4 class="card-text">?php echo $acc_number; ?></h4>
                  <p class="card-text">?php echo $username; ?></p>
                </div>
              </div-->

            </div><!--/Tags Widget -->

          </div>
          <div class="widgets-container col-lg-6">
            <!-- Search Widget ->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!-/Search Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item" style="font-size: 12px;">

              <h3 class="widget-title">Recent Posts</h3>

        <?php
        
        $sqlr = "SELECT id,room_id,lodge_name,sender,sender_pr,image1,first_payment,rent,type,rooms,floor_size,distance,room_floor,water_source,power,state,lga,town,area,description,time FROM listings WHERE sender = '".$username."' ORDER BY id DESC";
        $resultr = mysqli_query($link,$sqlr);
        while($rowr = mysqli_fetch_assoc($resultr)){
          $cut = 100/$percent;
          $gain = $rowr["first_payment"]/$cut;
          $pricel = $rowr["first_payment"]+$gain;
          echo "<a href='view.php?id=".$rowr["id"]."'><div class='thumbnail' style='border-radius: 6px;border: 1px solid rgba(128, 128, 128, 0.404);background-color: white;position: relative;height: 100px;margin-bottom: 20px;'>
                <img src='zlodge_image".$rowr["image1"]."' style='height: 100%;width: 30%;border-top-left-radius: 5px;border-bottom-left-radius: 5px;float: left;' />
                <div style='float: left;width: 70%;padding: 5px;'' class='container>'
                  <b>₦".$pricel."</b>
                  <sub>₦".$rowr["rent"]."/year</sub>
                  <p>Self con at odim</p>
                  <div class='meta-top'>
                    <div>
                      <div style='float: left;width: 33%;'><i class='bi bi-person-walking'></i> ".$rowr["distance"]."</div>
                      <div style='float: left;width: 33%;'><i class='bi bi-rulers'></i> ".$rowr["floor_size"]."</div>
                      <div style='float: left;width: 33%;'><i class='bi bi-arrow-up-circle'></i> ".$rowr["room_floor"]."</div>
                    </div>
                  </div><!-- End meta top -->
                </div>
              </div></a>";
          }
        
        $sqlr = "SELECT id,package_name,style,price,image,time FROM interior_options WHERE sender = '".$username."' ORDER BY id DESC";
        $resultr = mysqli_query($link,$sqlr);
        while($rowr = mysqli_fetch_assoc($resultr)){
          echo "    <a href='view-design.php?id=".$rowr["id"]."'><div class='thumbnail style' style='border: 1px solid rgba(248, 182, 39, 0.404);background-color: white;position: relative;height: 100px;margin-bottom: 20px;'>
                <img src='zdesign_image".$rowr["image"]."' style='height: 100%;width: 30%;float: left;' />
                <div style='float: left;width: 70%;padding: 5px;' class='container'>
                  <b>₦".$rowr["price"]."</b>
                  <p>".$rowr["package_name"]."</p>
                  <p>".$rowr["style"]."</p>
                </div>
              </div></a>";
        }
        ?>

              
            </div><!--/Recent Posts Widget -->

            
          </div>

        </div>

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