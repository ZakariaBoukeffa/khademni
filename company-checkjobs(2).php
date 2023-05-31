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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
	  
		<title>jobs</title>
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
        <h1 class="text-light"><a href="company-index.php"><span>KHADEMNI</span></a></h1>
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

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <main>

   <?php

class JobListing {
    private $conn;
    
    public function __construct($dbhost, $dbuser, $dbpass, $dbname) {
        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }
    
    public function searchJobs($searchTerm) {
        // Sanitize the search term to prevent SQL injection attacks
        $searchTerm = mysqli_real_escape_string($this->conn, $searchTerm);
        
        // If the search term is not empty, search for job listings that match the search term
        if (!empty($searchTerm)) {
            $sql = "SELECT * FROM jobs WHERE job_title LIKE '%$searchTerm%'";
            $result = mysqli_query($this->conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Search results:</h2>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $this->displayJobListing($row);
                }
            } else {
                echo "<p>No results found.</p>";
            }
        } else {
            $query = "SELECT * FROM jobs";
            
            if ($result = mysqli_query($this->conn, $query)) {
                while ($row = mysqli_fetch_row($result)) {
                    $this->displayJobListing($row);
                }
                mysqli_free_result($result);
            }
        }
    }
    
    private function displayJobListing($row) {
        $job_id = $row[5];
        $job_title = htmlspecialchars($row[0]);
        $job_salary = htmlspecialchars($row[4]);
        $jobloc = htmlspecialchars($row[2]);
        $jtype = htmlspecialchars($row[3]);
        
        echo '<div class="icon-box">';
        echo '<div class="icon"><i class="bx bx-file"></i></div>';
        echo '<h4 class="title"><a href="more-info.php?id=' . $job_id . '">' . $job_title . '</a></h4>';
        echo '<p class="salary"><strong>job salary: </strong>' . $job_salary . ' DA</p>';
        echo '<p class="location"><strong>job location: </strong>' . $jobloc . '</p>';
        echo '<p class="job-type"><strong>job type: </strong>' . $jtype . '</p>';
        echo '<a href="company-more-info.php?id=' . $job_id . '">see more</a>';
        echo '</div>';
    }
}

// Usage example
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'khademni';

$jobListing = new JobListing($dbhost, $dbuser, $dbpass, $dbname);
?>

<!-- ======= Services Section ======= -->
<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Job Offers</h2>
            <p>Check out all available job offers!</p>
        </div>
        <section id="form">
            <div class="job-form" style="justify-content:center">
                <h1>Job Search</h1>
                <form method="get" action="">
                    <label for="search">Search for a job:</label>
                    <input type="text" id="search" name="search">
                    <button type="submit">Search</button>
                </form>
            </div>
        </section>
    </div>
</section>

<?php
// Retrieve the search term from the GET request
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
} else {
    $searchTerm = '';
}

// Use the JobListing object to perform the job search
$jobListing->searchJobs($searchTerm);
?>

<!-- Display the job listing results here -->

<?php
// Close the database connection
mysqli_close($jobListing->conn);
  ?>

     </div> </div>
    </section><!-- End Services Section -->





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
				  <li><i class="bx bx-chevron-right"></i> <a href="company-index.php">Home</a></li>
				  <li><i class="bx bx-chevron-right"></i> <a href="company-company-index.php#about">About us</a></li>
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
