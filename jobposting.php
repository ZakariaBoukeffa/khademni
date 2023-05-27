<?php
session_start();

if (!isset($_SESSION['companyName']) && !isset($_SESSION['company-password'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<?php
//CODE TO INSERT DATA INTO THE DATABASE
// Connect to the database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'khademni';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$error_message = "";

// Handle job posting form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_job'])) {

  // Get form data
  $job_title = $_POST['job-title'];
  $job_description = $_POST['job-description'];
  $job_location = $_POST['location'];
  $job_type = $_POST['job-type'];
  $job_salary = $_POST['salary'];
  $worker_type = $_POST['worker-type'];

  // Validate form data
  if (empty($job_title) || empty($job_description) || empty($job_location) || empty($job_type) || empty($job_salary) || empty($worker_type)) {
    $error_message = "Please fill in all the required fields.";
  } else {
    // Insert data into database
    $sql = "INSERT INTO jobs (job_title, job_description, job_location, job_type, job_salary, worker_type)
    VALUES ('$job_title', '$job_description', '$job_location', '$job_type', '$job_salary', '$worker_type')";

    if ($conn->query($sql) === TRUE) {
      header("Location: company-checkjobs.php");
      exit();
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
	  
		<title>job posting</title>
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
        <h1 class="text-light"><a href="company-index.php"><span>KHEDEMNI</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="company-index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="company-index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="company-index.php#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="company-index.php#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>find a job</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="jobposting.php">Post a job</a></li>
              <li><a href="company-checkjobs.php">check jobs</a></li>
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
			<form method="post">
			<h2>Post a Job</h2>
			<br>
			
				<label for="worker-type">Are you a freelancer?</label>
				<br>
				<select id="worker-type" name="worker-type" style="max-width:60%">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
				<br>  <br>
				<div id="company-name-container" style="display:none;">
					<label for="company-name">Company Name</label>
					<input type="text" id="company-name" name="company-name">
				</div>
				<label for="job-title">Job Title</label>
				<br>
				<input type="text" id="job-title" name="job-title" style=" max-width:60%" >
				<br>
				<label for="salary">Salary</label>
				<br>
				<input type="text" id="salary" name="salary" style="max-width:60%">
				<br>
				<label for="location">Location</label>
				<br>
				<input type="text" id="location" name="location" style="max-width:60%">
				<br><label for="job-type">Job Type</label>
				<br><input type="text" id="job-type" name="job-type" style="max-width:60%">
				<br><label for="job-description">Job Description</label>
				<br><textarea id="job-description" name="job-description" style="max-width:60%;max-length:60px"></textarea>
				<br>
                <button class="submit-btn" type="submit" style="max-width:60%" name="post_job">Submit</button>
			</form>
		

</div> </section>
	</main>
	 <!-- ======= Footer ======= -->
	 <footer id="footer">
		<div class="footer-top">
		  <div class="container">
			<div class="row">
	
			  <div class="col-lg-3 col-md-6 footer-contact">
				<h3>khademni</h3>
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
				  <li><i class="bx bx-chevron-right"></i> <a href="company-index.php">Home</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="company-index.php#about">About us</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="company-index.php#services">Services</a></li>
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
