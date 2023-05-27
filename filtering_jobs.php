//<?php
//session_start();

//if (!isset($_SESSION['companyName']) && !isset($_SESSION['company-password'])) {
//    header('Location: index.php');
  //  exit();
//}
//if (isset($_POST['logout'])) {
 //   session_destroy();
   // header('Location: index.php');
    //exit();
//}
//?>

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

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="company-checkjobs.php" class="get-started-btn scrollto">My Jobs</a>
      <form method="post" class="form-inline">
          <button type="submit" name="logout" class="btn btn-primary">Logout</button>
      </form>
    </div>
</header><!-- End Header -->
<main id="main">

    <!-- ======= Job Postings Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Job Postings</h2>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">

                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="form-row">
                                    <div class="col-md-3 mb-2">
                                        <input type="text" class="form-control" name="job_title" placeholder="job_title">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <input type="text" class="form-control" name="location" placeholder="Location">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <input type="text" class="form-control" name="Salary" placeholder="Salary">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <input type="text" class="form-control" name="job_experience" placeholder="job_experience">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

              <?php

class DatabaseConnection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "khedemni";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function filterJobListings($job_title, $location, $Salary, $job_experience)
    {
        $filter = array();

        if (!empty($job_title)) {
            $filter[] = "job_title LIKE '%$job_title%'";
        }
        if (!empty($location)) {
            $filter[] = "location LIKE '%$location%'";
        }
        if (!empty($Salary)) {
            $filter[] = "Salary LIKE '%$Salary'";
        }
        if (!empty($job_experience)) {
            $filter[] = "job_experience LIKE '%$job_experience%'";
        }

        $sql = "SELECT * FROM job_listings WHERE 1=1";

        if (!empty($filter)) {
            $sql .= " AND " . implode(' AND ', $filter);
        }

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-6">
                    <div class="icon-box">
                        <h4 class="title"><a href="job-details.php?id=' . $row['job_id'] . '">' . $row['job_title'] . '</a></h4>
                        <p class="description">Location: ' . $row['location'] . '</p>
                        <p class="description">Salary: ' . $row['Salary'] . '</p>
                        <p class="description">Experience: ' . $row['job_experience'] . ' years</p>
                        <p class="name">Name: ' . $row['name'] . '</p>
                        <p class="email">Email: ' . $row['email'] . '</p>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No job postings found.</p>";
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Create an instance of the DatabaseConnection class
$dbConnection = new DatabaseConnection();

// Check if form is submitted
if (isset($_POST['job_title']) || isset($_POST['location']) || isset($_POST['Salary']) || isset($_POST['job_experience'])) {
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $Salary = $_POST['Salary'];
    $job_experience = $_POST['job_experience'];

    // Filter job listings
    $dbConnection->filterJobListings($job_title, $location, $Salary, $job_experience);
}

// Close the database connection
$dbConnection->closeConnection();
?>

                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Job Postings Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Khademni</h3>
                    <p>
                        Somewhere in Tunisia<br>
                        Tunis<br>
                        Tunisia <br><br>
                        <strong>Email:</strong> info@khademni.com<br>
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Subscribe to our newsletter to stay up to date with our latest job postings.</p>
                <form action="" method="post">
                    <input type="email" name="email" placeholder="Enter your email">
                    <input type="submit" value="Subscribe">
                </form>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="social-links">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>
