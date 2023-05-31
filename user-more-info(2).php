<?php
session_start();

class JobDetailsPage
{
    private $conn;
    private $user_id;
    private $job_id;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'khademni');

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (!isset($_SESSION['id']) && !isset($_SESSION['password'])) {
            header('Location: index.php');
            exit();
        }

        if (isset($_POST['logout'])) {
            session_destroy();
            header('Location: index.php');
            exit();
        }

        $this->user_id = $_SESSION['id'];

        $this->job_id = isset($_GET['id']) ? $_GET['id'] : null;
    }

    public function renderPage()
    {
        $this->renderHeader();
        $this->renderJobDetails();
        $this->renderFooter();
    }

    private function renderHeader()
    {
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: center;
        }

        .rating > span {
            display: inline-block;
            position: relative;
            width: 1.1em;
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .rating > span:hover:before,
        .rating > span:hover ~ span:before {
            content: "\2605";
            position: absolute;
            color: #ffbf00;
        }

        .rating > input:checked ~ span:before {
            content: "\2605";
            position: absolute;
            color: #ffbf00;
        }
    </style>
  <title>job details</title>
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
       <?php
    }

    private function renderJobDetails()
    {
        $query = "SELECT * FROM jobs WHERE job_id = $this->job_id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);

        ?>
        <main id="main">
            <!-- Breadcrumbs Section -->
            <!-- Breadcrumbs HTML code -->
            <!-- Portfolio Details Section -->
            <!-- Job details HTML code -->
            <!-- Apply to job HTML code -->
            <!-- Comments and rating HTML code -->
        </main>
        <?php
    }

    private function renderFooter()
    {
        $query = "SELECT * FROM comments WHERE job_id = $this->job_id";
        $result = mysqli_query($this->conn, $query);

        ?>
        <footer id="footer">
            <!-- Footer HTML code -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>apply to this job</h4>
            <p>don't miss the opportunity!</p>
            
              <a href="jobaplication.php?id=<?php echo $job_id;?>">apply</a>
            
          </div>
        </div>
      </div>
    </div>
 <!-- ======= Breadcrumbs Section ======= -->
 <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>comments and rating</h2>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->
<section id="portfolio-details" class="portfolio-details">
  <div class="container">
    <div class="row gy-4">
      <div class="portfolio-info">
        <h3 style="color:#eb5d1e;">Post a comment</h3>
        <form method="POST" action="user-more-info.php?id=<?php echo $job_id;?>">
          <br>
          <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br><br>
          <label for="rating">Rating:</label><br>
          <div class="rating">
            <input type="radio" id="star5" name="rating" value="5" required/><span></span>
            <input type="radio" id="star4" name="rating" value="4" required/><span></span>
            <input type="radio" id="star3" name="rating" value="3" required/><span></span>
            <input type="radio" id="star2" name="rating" value="2" required/><span></span>
            <input type="radio" id="star1" name="rating" value="1" required/><span></span>
          </div><br><br>
          <button class="submit-btn" type="submit"  name="commentt">post a new comment</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');

  ratingInputs.forEach(input => {
    input.addEventListener('change', () => {
      const selectedRating = input.value;
      console.log(selectedRating);
    });
  });
</script>

</footer>

 <?php

        // Fetch comments
        while ($row = mysqli_fetch_assoc($result)) {
            // Render comment HTML code
        }

        mysqli_free_result($result);
        mysqli_close($this->conn);
    }
}

// Create instance of JobDetailsPage and render the page
$jobDetailsPage = new JobDetailsPage();
$jobDetailsPage->renderPage();
?>
