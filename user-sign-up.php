<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/sign-up.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h1><a href="index.php">Khademni</a></h1>
    </div>
    <div class="container">
        <h1> Sign Up</h1>
        <form method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="Job">Job:</label>
            <input type="text" id="job" name="job" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
<?php
// Start the session
session_start();

// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khademni";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the sign-up form has been submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize it
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
     $job = $_POST['job'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert the data into the users table
    $sql = "INSERT INTO users (first_name, last_name, phone, email, password, Job) VALUES ('$firstName', '$lastName', '$phone', '$email', '$password', '$job')";

    if ($conn->query($sql) === TRUE) {
         // Retrieve the auto-generated ID from the last insert operation
         $id = $conn->insert_id;

         // Store user information in session variables
         $_SESSION['id'] = $id;
        // Store user information in session variables
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['phone'] = $phone;

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        header("location: user-index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

</body>
</html>
