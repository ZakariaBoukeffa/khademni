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
        <h1 class="text-light"><a href="user-index.php"><span>KHADEMNI</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="user-index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>Find a Job</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="user-checkjobs.php">Find a Job</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="user-profile-index.php">Profile</a></li>
          <a href="logout.php" class="logout-btn">Log Out <i class="bx bx-chevron-right"></i></a>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

	<main>
	<?php 
                          $dbhost = 'localhost';
                          $dbuser = 'root';
                          $dbpass = '';
                          $dbname = 'khademni';     
                          $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); ?>
	<!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>job offers</h2>
          <p>Check out all all the available job offers!</p>
        </div>
		<section id="form" >
		<div class="job-form" style="justify-content:center">
 <h1>Job Search</h1>
        <form method="get" action="">
                <label for="search">Search for a job:</label>
                <input type="text" id="search" name="search">
                <button type="submit">Search</button>
        </form>
        <div >
        <?php 
// Retrieve the search term from the GET request
if (isset($_GET['search'])) {
	$search_term = $_GET['search'];
} else {
	$search_term = '';
}

// Sanitize the search term to prevent SQL injection attacks
$search_term = mysqli_real_escape_string($conn, $search_term);

// If the search term is not empty, search for job listings that match the search term
if (!empty($search_term)) {
	$sql = "SELECT * FROM jobs WHERE job_title LIKE '%$search_term%'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
			echo "<h2>Search results:</h2>";
			while ($row = mysqli_fetch_assoc($result)) { 
				          ?>
					
                       
						  
          
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="more-info.php?id=<?php echo $row['job_id'];?>"><?php echo htmlspecialchars($row['job_title']); ?></a></h4>
              <p class="salary"><strong>job salary: </strong><?php echo htmlspecialchars($row['job_salary']); ?> DA</p>
              <p class="location"><strong>job location: </strong><?php echo htmlspecialchars($row['job_location']); ?></p>
              <p class="job-type"><strong>job type: </strong><?php echo htmlspecialchars($row['job_type']); ?></p>
              <a href="user-more-info.php?id=<?php echo $row['job_id'];?>">see more</a>
            </div>
          
					
<?php
				}
	} else {
			echo "<p>No results found.</p>";
	}
}
else {
                          $query = "SELECT* FROM jobs";
                          

                          if ($result=mysqli_query($conn,$query))
                          {
                          // Fetch one and one row
                          while ($row=mysqli_fetch_row($result))
                          {
                          $job_title = $row[0];
                          $job_description = $row[1];                          
                          $jobloc = $row[2];
                          $jtype =  $row[3];
						  $job_salary = $row[4];
                          $job_id = $row[5];                          
                          $workertype = $row[6];  
                       ?>
          
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="more-info.php?id=<?php echo $job_id;?>"><?php echo htmlspecialchars($job_title); ?></a></h4>
              <p class="salary"><strong>job salary: </strong><?php echo htmlspecialchars($job_salary); ?> DA</p>
              <p class="location"><strong>job location: </strong><?php echo htmlspecialchars($jobloc); ?></p>
              <p class="job-type"><strong>job type: </strong><?php echo htmlspecialchars($jtype); ?></p>
              <a href="user-more-info.php?id=<?php echo $job_id;?>">see more</a>
            </div>
          


  

        <?php
                     }//end while
                          // Free result set
                          mysqli_free_result($result);
                          }// end if
						}
                          mysqli_close($conn);        
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
