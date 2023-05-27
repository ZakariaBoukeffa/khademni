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

$user_id=$_SESSION['id'];

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

  <main id="main">
  <?php 
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'khademni';
  
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$job_id=$_GET['id'];
$query= "select * from jobs where job_id = $job_id";
$result= mysqli_query($conn,$query);
$row= mysqli_fetch_assoc($result);
?>
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="user-index.php">Home</a></li>
            <li><a href="jobpostings.php">jobs</a></li>
            <li>job Details</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

        

          
            <div class="portfolio-info">
              <h3 style="color:#eb5d1e;">job information</h3>
              <ul>
                <li><strong style="color:#eb5d1e;">job title: </strong> <?php echo $row['job_title'] ?></li>
                <li><strong style="color:#eb5d1e;">job salary: </strong> <?php echo $row['job_salary'] ?></li>
                <li><strong style="color:#eb5d1e;">job location: </strong><?php echo $row['job_location'] ?></li>
                <li><strong style="color:#eb5d1e;">job type: </strong> <?php echo $row['job_type'] ?></li>
                <li><a href="user-jobposter.php?poster_id=<?php echo $row['job_poster']; ?>" style="text-decoration: none; text-align: center;">See Company's Profile</a></li>

              </ul>
            </div>
            <div class="portfolio-description">
              <h2 style="color:#eb5d1e;">job description and skills required</h2>
              <hr>
              <p>
              <?php echo $row['job_description'] ?>
              </p>
            </div>
          </div>

        </div>

      
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentt'])) {
    // Get form data
    $comment_content = $_POST['comment'];
    $rating = $_POST['rating'];
    // Insert data into database
    $sql = "INSERT INTO comments (comment_date, user_id, job_id, comment_content, rating)
     VALUES (CURRENT_DATE, '$user_id', '$job_id', '$comment_content', '$rating')";
    $result2 = mysqli_query($conn, $sql);
    if ($result2) {
        header("location: user-more-info.php?id=<?php echo $job_id;?>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$query = "select * from comments where job_id = $job_id";
$query4 = "SELECT users.first_name AS user_name
FROM users
JOIN comments ON users.id = comments.user_id
WHERE comments.user_id = $user_id;
";

$result4 = mysqli_query($conn, $query4);
$ROW= mysqli_fetch_assoc($result4);
$user_name = $ROW['user_name'];
if ($result = mysqli_query($conn, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_assoc($result)) {
        $comment_id = $row['comment_id'];
        $comment_date = $row['comment_date'];
        $user_id = $row['user_id'];
        $job_id = $row['job_id'];
        $comment_contentt = $row['comment_content'];
        $ratingg = $row['rating'];

?>

<section id="portfolio-details" class="portfolio-details">
  <div class="container">
    <div class="row gy-4">
      <div class="portfolio-info">
        <h3 style="color:#eb5d1e;"><?php echo htmlspecialchars($user_name); ?></h3>
        <ul>
          <li><strong style="color:#eb5d1e;">date: </strong><?php echo htmlspecialchars($comment_date); ?></li>
          <li><strong style="color:#eb5d1e;">comment: </strong><?php echo htmlspecialchars($comment_contentt); ?></li>
          <li><strong style="color:#eb5d1e;">rate: </strong>
            <?php
            $filledStars = $ratingg;
            $emptyStars = 5 - $ratingg;
            for ($i = 1; $i <= $filledStars; $i++) {
              echo '<i class="fas fa-star"></i>';
            }
            for ($i = 1; $i <= $emptyStars; $i++) {
              echo '<i class="far fa-star"></i>';
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php
    } //end while
    // Free result set
    mysqli_free_result($result);
}
mysqli_close($conn);
?>

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
              <strong>Email:</strong> khademni@ensia.edu.dz<br>
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
