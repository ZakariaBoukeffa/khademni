<?php
session_start();

if (!isset($_SESSION['id']) && !isset($_SESSION['password'])) {
  header('Location: index.php');
  exit();
}

if (isset($_POST['logout'])) {
session_destroy();
header('Location: index.php');
exit();
}

$email = $_SESSION["email"];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khademni";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Updating part
if (isset($_POST["about"])) {
  $about = $_POST["about"];

  // Update the user's about field in the database
  $update_sql = "UPDATE users SET about='$about' WHERE email='$email'";

  // Execute the update query
  if (mysqli_query($conn, $update_sql)) {
      header("Location: user-profile-index.php");
      exit; // Exit the script to prevent further execution
  } else {
      echo "Error updating about section: " . mysqli_error($conn);
  }
}



// Fetch user data from database based on email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $fname = $row["first_name"];
    $lname = $row["last_name"];
    $phone = $row["phone"];
    $job = $row["Job"];
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KHADEMNI Profile page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!--Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- profile style -->
  <style>
    .gradient-custom {
      background: #f6d365;
      background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
      background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
      }

  </style>

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="user-index.php"><span>KHADEMNI</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="user-index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="user-index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="user-index.php#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="user-index.php#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>Find a Job</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="user-checkjobs.php">Find a Job</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="user-index.php#contact" >Contact</a></li>
          <li><a  href="user-profile-index.php">Profile</a></li>
          <a href="logout.php" class="logout-btn">Log Out <i class="bx bx-chevron-right"></i></a>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

<!-- ============================================================================================================== -->
<!-- ============================================================================================================== -->
<!-- ============================================================================================================== -->
<!-- profile html page-->
<section class="vh-500" style="background-color: #f4f5f7;">
  <div class="container py-200 h-200" >
    <div class="row d-flex justify-content-center align-items-center h-200">
      <div class="col col-lg-50 mb-50 mb-lg-50">
        <div class="card mb-5" style="border-radius: .5rem;">
          <div class="row g-0">
          <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="user.png" alt="Avatar" class="img-fluid my-5" style="width: 200px; height:200px ;" />
              <h2><?php echo $fname . " " . $lname?></h2>
              <p><?php echo $job ?></p>
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <form action="user-edit-profile.php" method="post">
                    <label for="about">About:</label>
                    <br>
                    <textarea id="about" name="about" rows="4"  placeholder="Updates? ..." style="width: 600px;"></textarea>
                    <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-light btn-sm">Save</button>
               </form>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ==========================================================================================================================-->
<!-- ==========================================================================================================================-->
<!-- ==========================================================================================================================-->



  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Ninestars</h3>
            <p>
              national higher school of artificial intelligence <br>
              sidi abdellah<br>
              Algeria <br><br>
              <strong>Phone:</strong> +213 1111111111<br>
              <strong>Email:</strong> KHADEMNI@ensia.edu.dz<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <div class="social-links mt-3">
              <p>you can find us too on social media!</p>
              <a href="https://twitter.com" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Ninestars</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
