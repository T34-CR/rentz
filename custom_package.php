<?php
// Initialize the session
session_start();

// Include configs file
require_once "config.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    

$image = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "zreq_design_image";
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
} else {
    echo "<script>alert('Please upload a profile photo!');</script>";
    $profile_err = "please provide a profile photo";
        }
    }









        $item_name = $type = $item_des = $item_image = "";
        $item_price = 0;

        $lodge_name = $room_id = $power_source = $water_source = $type = $room_des = $room_image = "";
        $room_price = $room_rent = $distance = $room_size = $room_count = $room_floor = $id = 0;
        $style_err = $design_des_err = $design_image_err = "";

        //Getting id
        $sqld = "SELECT id FROM design_requests ORDER BY id DESC";
        $resultd = mysqli_query($link,$sqld);
        $rowd = mysqli_fetch_assoc($resultd);
        if(!empty($rowd["id"])){$id  = $rowd["id"]+1;}

        // Prepare an insert statement
        $sql = "INSERT INTO design_requests (id,sender,phone,email,lodge_name,room_id,type,description,image,room_size,rooms,room_floor,theme1,theme2,state,landmark,town,area,street) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $param_id,$param_sender,$param_phone,$param_email,$param_lodge_name,$param_room_id,$param_type,$param_description,$param_room_image,$param_room_size,$param_rooms,$param_room_floor,$param_theme1,$param_theme2,$param_state,$param_landmark,$param_town,$param_area,$param_street);
            
            // Set parameters
            $param_id = $id;
            $param_sender = trim($_POST["sender"]);
            $param_phone = $_POST["phone"];
            $param_email = trim($_POST["email"]);
            $param_lodge_name = trim($_POST["lodge_name"]);
            $param_room_id = trim($_POST["room_id"]);
            $param_type = trim($_POST["type"]);
            $param_description = trim($_POST["room_des"]);
            $param_room_image = $image;
            $param_room_size = trim($_POST["room_size"]);
            $param_rooms = trim($_POST["room_count"]);
            $param_room_floor = trim($_POST["room_floor"]);
            $param_theme1 = $_POST["theme1"];
            $param_theme2 = $_POST["theme2"];
            $param_state = trim($_POST["state"]);
            $param_landmark = trim($_POST["landmark"]);
            $param_town = trim($_POST["town"]);
            $param_area = trim($_POST["area"]);
            $param_street = trim($_POST["street"]);
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
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Custom Design - Uniproperties</title>
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

<body class="index-page">

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
          <li class="dropdown"><a href="interior".php><span>Interior</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="interior.php">Designs</a></li>
              <li><a href="post-design.php">Post</a></li>
              <li><a href="#" class="active">Custom Package</a></li>
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

    
    
    
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Request Custom Design</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">


          <div class="col-lg-8">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

              <div class="col-md-12">
                  <input name="sender" type="text" class="form-control" placeholder="Full Name&hellip;" required>
                </div>

                <div class="col-md-6 ">
                  <input name="phone" type="phone" class="form-control" placeholder="Phone&hellip;" required>
                </div>

                <div class="col-md-6">
                  <input name="email" type="text" class="form-control" placeholder="Email&hellip;" required>
                </div>

                <div class="col-md-6">
                  <input name="lodge_name" type="text" class="form-control" placeholder="Lodge Name&hellip;" required>
                </div>

                <div class="col-md-6 ">
                  <input name="room_id" type="text" class="form-control" placeholder="Room ID&hellip;" required>
                </div>

                <!--div class="col-md-6">
                  <input name="room_size" type="number" class="form-control" placeholder="Size in square feet&hellip;">
                </div-->

                <div class="col-md-6">
                  <select name="room_count" id="sl-count" class="form-select" required>
                    <option value="1">1 bed room/Self con</option>
                    <option value="2">2 bed rooms</option>
                    <option value="3">3 bed rooms</option>
                    <option value="4">4 bed rooms</option>
                    <option value="5">5 bed rooms</option>
                    <option value="6">6 bed rooms</option>
                  </select>
                </div>

                <div class="col-md-6 ">
                  <select name="room_floor" id="sl-floor" class="form-select" required>
                    <option value="0">Ground Floor</option>
                    <option value="1">1st Floor</option>
                    <option value="2">2nd Floor</option>
                    <option value="3">3rd Floor</option>
                    <option value="4">4th Floor</option>
                    <option value="5">5th Floor</option>
                    <option value="6">6th Floor</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <select name="type" id="sl-type" class="form-select" required>
                    <option value="self_con">Self con</option>
                    <option value="mini_self_con">Mini self con</option>
                    <option value="apartment">Apartment</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <select class="form-select" id="state" name="state" required>
                    <option value="">Select Institution</option>
                    <!-- Add options for Nigerian universitiess -->
                    <option value="">Select a University</option> 
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
                    <option>University of Nigeria	Nsukka</option>
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
                    <!-- ... add other institutions -->
                  </select>
                </div>

                <div class="col-md-6 ">
                  <input name="land-mark" type="text" class="form-control" placeholder="Land mark&hellip;" required>
                </div>

                <div class="col-md-6">
                  <input name="area" type="text" class="form-control" placeholder="District&hellip;" required>
                </div>

                <div class="col-md-6 ">
                  <input name="theme1" type="color" class="form-control" placeholder="Theme1" required />
                </div>

                <div class="col-md-6">
                  <input name="theme2" type="color" class="form-control" placeholder="Theme2" required />
                </div>

                <div class="col-md-12">
                  <input name="fileToUpload" type="file" class="form-control" placeholder="Take a photo of your room" required />
                </div>

                <div class="col-md-12">
                  <textarea name="room_des" type="text" class="form-control" placeholder="Description&hellip;" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Request</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

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