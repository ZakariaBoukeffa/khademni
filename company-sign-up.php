<html>
<head>
	<title>Company Sign Up Page</title>
	<link href="assets/css/sign-up.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<div class="header">
		<h1><a href="index.php">KHADEMNI</a></h1>
	</div>
	<div class="container">
		<h1>Sign Up</h1>
		<form method="post">
			<label for="companyName">Company Name:</label>
			<input type="text" id="companyName" name="companyName" required>

			<label for="headName">Head Name:</label>
			<input type="text" id="headName" name="headName" required>

			<label for="email">email:</label>
			<input type="text" id="email" name="email" required>

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>

			<label for="fields">Field:</label>
				<select id="fields" name="fields" >
					<option value="Technology">Technology</option>
					<option value="Healthcare">Healthcare</option>
					<option value="Education">Education</option>
					<option value="Fashion and Apparel">Fashion and Apparel</option>
					<option value="Media and Entertainment">Media and Entertainment</option>
					<option value="Manufacturing">Manufacturing</option>
					<option value="Transportation">Transportation</option>
					<option value="Sports and Fitness">Sports and Fitness</option>
					<option value="Other">Other</option>
				</select>
	<br><br>
			<button type="submit" name="submit">Sign Up</button>
		</form>
	</div>
</body>
</html>
<?php
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

// Start session
session_start();

// Check if the company sign-up form has been submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize it
    $companyName = $_POST['companyName'];
    $headName = $_POST['headName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $field = $_POST['fields'];

    // Insert the data into the companies table
    $sql = "INSERT INTO companies (company_name, head_name, email, password, field) VALUES ('$companyName', '$headName', '$email', '$password', '$field')";

    if ($conn->query($sql) === TRUE) {
        // Set session variables
        $_SESSION['companyName'] = $companyName;
        $_SESSION['headName'] = $headName;
        $_SESSION['email'] = $email;
        $_SESSION['company-password'] = $password;
        $_SESSION['field'] = $field;

        // Redirect to company dashboard
        header("location: company-index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();


// Close the database connection
?>
