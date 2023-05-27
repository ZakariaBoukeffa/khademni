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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
	  
		<title>job application</title>
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
		<!--<link href="jobposting.css" rel="stylesheet">-->
		<!--Main CSS File -->
		<link href="assets/css/style.css" rel="stylesheet">
	  
	  </head>
<body>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="user-index.php"><span>KHEDEMNI</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="user-index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="user-index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="user-index.php#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="user-index.php#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>find a job</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
            <li><a href="jobposting.php">Post a job</a></li>
              <li><a href="jobpostings.php">check jobs</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
		  <a href="logout.php" class="logout-btn">Log Out <i class="bx bx-chevron-right"></i></a>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

	<main id="new_main">
		<section id="form" >
		<div class="job-form" style="justify-content:center">
			<form  method="post">
			<h2>apply to the Job</h2>
			<br>
					<label for="lname">last name</label> <br>
					<input type="text" id="lname" name="lname">
				<br>
				<label for="fname">first name</label>
				<br>
				<input type="text" id="fname" name="fname"  >
				<br>
				<label for="email">email</label>
				<br>
				<input type="text" id="email" name="email" >
				<br>
                <label for="resume">resume</label>
				<br>
				<input type="file" id="resume" name="resume" >
				<br>
				<label for="location">Location</label>
				<br>
				<input type="text" id="location" name="location" >
				<br><label for="phone_num">phone number</label>
				<br><input type="text" id="phone_num" name="phone_num" >
				<br><label for="description">describe your skills</label>
				<br><textarea id="description" name="description" ></textarea>
				<br>
                <button class="submit-btn" type="submit"  name="apply_job">Submit</button>
			</form>
		</div> </section>
        <?php 
//CODE TO INSERT DATA INTO THE DATA BASE
// Connect to the database
$servername = 'localhost';
$username = 'root';
$password ='';
$dbname = 'khademni';

$conn = new mysqli($servername, $username, $password, $dbname);
$job_id=$_GET['id'];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_job'])) {

    // Get form data
    $lname= $_POST['lname'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $resume = $_POST['resume'];
    $user_location= $_POST['location'];
    $phone_num = $_POST['phone_num'];
    $description = $_POST['description'];
  
    // Insert data into database
    $sql = "INSERT INTO job_applications (job_id, fname, lname, email, resumee, user_id , phone_num, user_description)
            VALUES ('$job_id', '$fname','$lname', '$email', '$resume',' ','$phone_num','$description')";
  
    if ($conn->query($sql) === TRUE) {
      // Upload resume file to server
      /*$target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES['resume']['name']);
      move_uploaded_file($_FILES['resume']['tmp_name'], $target_file);*/
      echo "Application submitted successfully";} 
      else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
  }
  
  // Close database connection
  $conn->close();
  
  ?>
	</main>
	 <!-- ======= Footer ======= -->
	 <footer id="footer">
		<div class="footer-top">
		  <div class="container">
			<div class="row">
	
			  <div class="col-lg-3 col-md-6 footer-contact">
				<h3>KHEDEMNI</h3>
				<p>
				  national higher school of artificial intelligence <br>
				  sidi abdellah<br>
				  Algeria <br><br>
				  <strong>Phone:</strong> +213 1111111111<br>
				  <strong>Email:</strong> khedemni@ensia.edu.dz<br>
				</p>
			  </div>
	
			  <div class="col-lg-3 col-md-6 footer-links">
				<h4>Useful Links</h4>
				<ul>
				  <li><i class="bx bx-chevron-right"></i> <a href="user-index.php">Home</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="user-index.php#about">About us</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="user-index.php#services">Services</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
				</ul>
			  </div>
			  <div class="col-lg-3 col-md-6 footer-links">
				<h4>Our Social Networks</h4>
				<div class="social-links mt-3">
				  <p>you can find us too on social media!</p>
				  <a href="https://twitter.com" class="twitter"><i class="bx bxl-twitter"></i></a>
				  <a href="https://facebook.com" class="facebook"><i class="bx bxl-facebook"></i></a>
				  <a href="https://instagram.com" class="instagram"><i class="bx bxl-instagram"></i></a>
				  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
				  <a href="https://linkedin.com" class="linkedin"><i class="bx bxl-linkedin"></i></a>
				</div>
			  </div>
	
			</div>
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
