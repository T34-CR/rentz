<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
$roll = "";


if(isset($_GET["username"])){
  $username = $_GET["username"];
  //Getting roll
  $sqlroll = "SELECT roll FROM users WHERE username=".$username;
  $resultroll = mysqli_query($link,$sqlroll);
  $rowroll = mysqli_fetch_assoc($resultroll);
  $roll  = $rowroll["roll"];
  if($roll = "agent"){
    echo "<script>alert('Oops,not your profession!');</script>";
    exit;
  }

} else{
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
}
  $sqlroll = "SELECT roll FROM users WHERE username='".htmlspecialchars($_SESSION["username"])."'";
  $resultroll = mysqli_query($link,$sqlroll);
  $rowroll = mysqli_fetch_assoc($resultroll);
  $roll  = $rowroll["roll"];
  if($roll = "agent"){
    echo "<script>alert('Sorry,not your profession!');</script>";
    header("location: index.php");
    exit;
  }

// Define variables and initialize with empty values
$username = htmlspecialchars($_SESSION["username"]);
$email = $gender = $area = "";
$profile = "profile.png";

    //design
    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $image = basename($_FILES["fileToUpload"]["name"]);
    $target_dir = "zdesign_image";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";









    $style = $design_des = $design_image = "";
    $price = $theme1 = $theme2 = 0;
    $state = $lga = $town = $area = $sender_pr = "";

        //Getting location
        $sqld = "SELECT state,lga,town,area,profile1 FROM users WHERE username = '".$username."'";
        $resultd = mysqli_query($link,$sqld);
        $rowd = mysqli_fetch_assoc($resultd);
        $state = $rowd["state"];
        $lga = $rowd["lga"];
        $town = $rowd["town"];
        $area = $rowd["area"];
        $sender_pr = $rowd["profile1"];

    //Getting id
    $sqld = "SELECT id FROM interior_options ORDER BY id DESC";
    $resultd = mysqli_query($link,$sqld);
    $rowd = mysqli_fetch_assoc($resultd);
    $id  = $rowd["id"]+1;

    // Prepare an insert statement
    $sql = "INSERT INTO interior_options (id,sender,sender_pr,package_name,style,type,description,image,price,theme1,theme2,state,lga,town,area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_id,$param_sender,$param_sender_pr,$param_package_name,$param_style,$param_type,$param_design_des,$param_design_image,$param_price,$param_theme1,$param_theme2,$param_state,$param_lga,$param_town,$param_area);
        
        // Set parameters
        $param_id = $id;
        $param_sender = $username;
        $param_sender_pr = $sender_pr;
        $param_package_name = trim($_POST["package_name"]);
        $param_style = trim($_POST["style"]);
        $param_type = trim($_POST["type"]);
        $param_design_des = trim($_POST["description"]);
        $param_design_image = $image;
        $param_price = trim($_POST["price"]);
        $param_theme1 = $_POST["theme1"];
        $param_theme2 = $_POST["theme2"];
        $param_type = trim($_POST["type"]);
        $param_state = $state;
        $param_lga = $lga;
        $param_town = $town;
        $param_area = $area;
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect user to home page
            header("location: interior.php");
            exit;
        } else{
            echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }

    } else {
        echo "<script>alert('Please upload a profile photo!');</script>";
        $profile_err = "please provide a profile photo";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interior decoration - Uniproperties.com</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

  <style>
    :root { 
      --background-color: #ffffff; /* Background color for the entire website, including individual sections */
      --default-color: #444444; /* Default color used for the majority of the text content across the entire website */
      --heading-color: #2a2c39; /* Color for headings, subheadings and title throughout the website */
      --accent-color: #ef6603; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
      --surface-color: #ffffff; /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
      --contrast-color: #ffffff; /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
    }

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
  </style>
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
              <li><a href="#" class="active">Post</a></li>
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

  <main>
    <div style="height: 60px;"></div>
    <div class="container form-container">
      <h2 class="mb-4">Post a Design</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-4">
            <label for="imageUpload" class="file-upload"><div class="image-preview">
              <img id="previewImage" src="" alt="Add a thumbnail image">
            </div></label>
            <input name="fileToUpload" type="file" class="form-control" id="imageUpload" hidden required>
          </div>

          <div class="col-lg-7">
            <div class="row mb-3">
              <label for="price" class="col-sm-2 col-form-label">Price</label>
              <div class="col-sm-10">
                <input name="price" type="number" class="form-control" id="price" placeholder="500000" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Package Name</label>
              <div class="col-sm-10">
                <input name="package_name" type="text" class="form-control" id="name" placeholder="Califonia" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="style" class="col-sm-2 col-form-label">Style</label>
              <div class="col-sm-10">
                <select name="style" class="form-select" id="style" required>
                  <option value="">Select Style</option>
                  <!-- head -->
                  <option value="classic">Classic</option>
                  <option value="concept">Concept</option>
                  <option value="courtesy">Courtesy</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="theme1" class="col-sm-2 col-form-label">Theme 1</label>
              <div class="col-sm-10">
                <input name="theme1" type="color" id="theme1" class="form-control" required />
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="theme2" class="col-sm-2 col-form-label">Theme 2</label>
              <div class="col-sm-10">
                <input name="theme2" type="color" id="theme2" class="form-control" required />
              </div>
            </div>

            <div class="row mb-3">
              <label for="description" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter a description" required></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                <button name="submit" type="submit" class="btn btn-warning">Create Post</button>
              </div>
            </div>
          </div>

      </form>
    </div>
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


  <script>
    const imageUpload = document.getElementById('imageUpload');
    const previewImage = document.getElementById('previewImage');

    imageUpload.addEventListener('change', (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        previewImage.src = "";
      }
    });
  </script>


</body>
</html>