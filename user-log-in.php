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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="user-sign-up.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php
// Start the session
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
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check the user's credentials
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any rows
    if(mysqli_num_rows($result) == 1) {
        // The user exists, set session variables and redirect to the dashboard page
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("Location: user-index.php");
        exit();
    } else {
        // Invalid login, show an error message
        echo "<h1>Invalid login credentials. Please try again.</h1>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
