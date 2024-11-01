<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $firstname = $middlename = $lastname = $email = $password = $confirm_password = $roll = "";
$phone = 0;
$lga = $town = $area = $street = "";
$phone_err = "";
$lga_err = $town_err = $area_err = $street_err = "";
$username_err = $firstname_err = $middlename_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";
$phone_err = $profile_err = $profile1_err = $profile2_err = $profile3_err = $mother_ref = $referal_link = "";
$id = 0;

if(isset($_GET["ref"])){
    $mother_ref = $_GET["ref"];
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $image = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "zprofile";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<script>alert('File is an image - " . $check["mime"] . ".');</script>";
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



    

    //Enter text values
    //Getting id
    $sqld = "SELECT username FROM users";
    //$sqld = "SELECT COUNT(*) FROM comments";
    $resultd = mysqli_query($link,$sqld);
    //$row_count = mysqli_fetch_row($resultd)[0];
    while($rowu = mysqli_fetch_assoc($resultd)){
        $id = $id+1;
    }

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please your surname.";
    } elseif(strlen(trim($_POST["firstname"])) < 3){
        $firstname_err = "Incorrect surname";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate middlename
    if(empty(trim($_POST["middlename"]))){
        $middlename_err = "Please your middlename.";
    } elseif(strlen(trim($_POST["middlename"])) < 3){
        $middlename_err = "Incorrect middlename";
    } else {
        $middlename = trim($_POST["middlename"]);
    }

    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please your lastname.";
    } elseif(strlen(trim($_POST["lastname"])) < 3){
        $lastname_err = "Incorrect lastname";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";     
    } elseif(strlen(trim($_POST["email"])) < 10){
        $email_err = "Invalid email";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your call number.";     
    } elseif(trim($_POST["phone"]) < 11 || trim($_POST["phone"]) > 15){
        $phone_err = "Invalid phone number";
    } else{
        $phone = trim($_POST["phone"]);
    }
   
    // Validate district
    if(empty(trim($_POST["area"]))){
        $area_err = "Please enter your area.";     
    } elseif(strlen(trim($_POST["area"])) < 3){
        $area_err = "Incorrect area";
    } else{
        $area = trim($_POST["area"]);
    }

    // Validate street
    if(empty(trim($_POST["street"]))){
        $street_err = "Please enter your street.";     
    } elseif(strlen(trim($_POST["street"])) < 10){
        $street_err = "Incorrect street";
    } else{
        $street = trim($_POST["street"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($firstname_err) && empty($middlename_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($lga_err) && empty($town_err) && empty($area_err) && empty($street_err)){
        //add referals
        //$referals = "";
        //$sqlep = "SELECT referrals FROM users WHERE username = '".$username."'";
        //$resultep = mysqli_query($link,$sqlep);
        //while($rowep = mysqli_fetch_assoc($resultep)){
        //    $referals = $rowep["referrals"];
        //}

        //$refsum = intval($referals)+1;
        //$sql = "UPDATE users SET referals=".$refsum." WHERE username = '".$username."'";
        //if ($conn->query($sql) === TRUE) {
        ////    echo "Record updated successfully";
        //    } else {
        //    echo "Error updating record: " . $conn->error;
        //        }
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (id,profile1,username,firstname,middlename,lastname, email, password, phone,roll,gender,state,lga,town,area,street,mother_ref) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $param_id, $param_profile, $param_username,$param_firstname,$param_middlename,$param_lastname, $param_email, $param_password, $param_phone, $param_roll,$param_gender,$param_state,$param_lga,$param_town,$param_area,$param_street,$param_ref_link);
            
            // Set parameters
            $param_id = $id;
            $param_profile = $image;
            $param_username = $username;
            $param_firstname = $firstname;
            $param_middlename = $middlename;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone = $phone;
            $param_roll = trim($_POST["roll"]);
            $param_gender = trim($_POST["gender"]);
            $param_state = trim($_POST["state"]);
            $param_lga = str_replace(" ","_",$lga);
            $param_town = str_replace(" ","_",$town);
            $param_area = str_replace(" ","_",$area);
            $param_street = str_replace(" ","_",$street);
            if(empty(trim($_POST["ref"]))){
                $param_ref_link = trim($_POST["referal_link"]);
            }else{
                $param_ref_link = trim($_POST["ref"]);
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password is correct, so start a new session
                session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;                            
                
                // Redirect user to home page
                header("location: lodges.php");
            } else{
                echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }



        
  } else {
     echo "<script>alert('".$username_err.$firstname_err.$middlename_err.$lastname_err.$password_err.$confirm_password_err.$phone_err.$email_err.$lga_err.$town_err.$area_err.$street_err."');</script>";
  }


} else {
    echo "<script>alert('Please upload a profile photo!');</script>";
    $profile_err = "please provide a profile photo";
  }
}

     }
    
    // Close connection
    mysqli_close($link);
  
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

  <style>
    .image-preview {
      width: 200px;
      height: 200px;
      background-color: rgba(65, 64, 64, 0.1);
      margin-bottom: 20px;
      overflow: hidden;
      border-radius: 50%;
      border: 2px grey solid;
    }

    .image-preview img {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }
  </style>

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

  <main style="padding-bottom: 100px;">
    <div class="container mt-5">
      <h1 class="text-center mb-4">Rentz - Agency Registration</h1>

      <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
          <div class="col-12" style="text-align: center;">
          <label for="imageUpload" class="file-upload"><div class="image-preview">
            <img id="previewImage" src="" alt="Profile">
          </div></label>
          <input name="fileToUpload" type="file" class="form-control" id="imageUpload" hidden required>
          </div>
          <div class="col-md-4">
            <label for="firstName" class="form-label">First Name</label>
            <input name="firstname" type="text" class="form-control" id="firstName" placeholder="Enter First Name" required>
          </div>
          <div class="col-md-4">
            <label for="middleName" class="form-label">Middle Name</label>
            <input name="middlename" type="text" class="form-control" id="middleName" placeholder="Enter Middle Name" required>
          </div>
          <div class="col-md-4">
            <label for="lastName" class="form-label">Last Name</label>
            <input name="lastname" type="text" class="form-control" id="lastName" placeholder="Enter Last Name" required>
          </div>
          <div class="col-md-4">
            <label for="username" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username" required>
          </div>
          <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Enter Email" required>
          </div>
          <div class="col-md-4">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input name="phone" type="tel" class="form-control" id="phoneNumber" placeholder="Enter Phone Number" required>
          </div>
          <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password" required>
          </div>
          <div class="col-md-6">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input name="confirm_password" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
          </div>
          <div class="col-md-4">
            <label for="state" class="form-label">University</label>
            <select class="form-select" id="state" name="state" required>
              <option value="">Select Institution</option>
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
              <!-- ... add other institutions -->
            </select>
          </div>
          <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <input name="area" type="text" class="form-control" id="district" placeholder="Enter District">
          </div>
          <div class="col-md-4">
            <label for="street" class="form-label">Street</label>
            <input name="street" type="text" class="form-control" id="street" placeholder="Enter Street" required>
          </div>
          <div class="col-md-4">
            <label for="roll" class="form-label">Roll</label>
            <select name="roll" class="form-select" id="roll" required>
              <option value="">Select Your Roll</option>
              <!-- Add options for Nigerian states -->
              <option value="agent">Lodge Agent</option>
              <option value="decorator">Interior Decorator</option>
              <!-- ... add other states -->
            </select>
          </div>
          <div class="col-md-4">
            <label for="slogan" class="form-label">Slogan (Optional)</label>
            <input name="slogan" type="text" class="form-control" id="slogan" placeholder="Enter Slogan">
          </div>
          <div class="col-md-4">
            <label for="ref_link" class="form-label">Refferal link (Optional)</label>
            <input name="ref_link" type="text" class="form-control" id="ref_link" placeholder="Enter Refferal link here if any">
          </div>
          <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description" rows="6" placeholder="Message" required></textarea>
          </div>
          <div class="col-12">
            <button name="submit" type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrM7uT8R0iFwvfc7EMDNr1+s8S7huB+cyi4l/7L+aEtH3u6H" crossorigin="anonymous"></script>
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
</body>

</html>