<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <div class="header">

        <h1><a href="index.php">Khademni</a></h1>
        </div>
        <div class="container">
            <form method="post">
                <h1> Log In</h1>
                <label for="companyName">Company Name:</label>
			    <input type="text" id="companyName" name="companyName" required>
                <label for="password">Password:</label>
			    <input type="password" id="password" name="password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="company-sign-up.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php
// Start session
session_start();

// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khademni";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form has been submitted
if(isset($_POST['login'])) {
    // Get form data and sanitize it
    $companyName = $_POST['companyName'];
    $password = $_POST['password'];

    // Retrieve company data from the database
    $sql = "SELECT * FROM companies WHERE company_name='$companyName' AND password='$password'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if(mysqli_num_rows($result) == 1) {
        // The user exists, start the session and redirect to the dashboard page
        $_SESSION['companyName'] = $companyName;
        $_SESSION['company-password'] = $password;
        header("Location: company-index.php");
        exit();
    } else {
        // Invalid login, set the error message
        $errorMessage = "Invalid login credentials. Please try again.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
