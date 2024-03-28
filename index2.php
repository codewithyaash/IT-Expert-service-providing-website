<?php
session_start();

// Check if the user is not logged in, redirect to registration.php if they are not
if (!isset($_SESSION["user"])) {
    header("Location: registration2.php");
    exit(); // Ensure no further code is executed after redirection
}

// Include database connection
require_once "database.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if all required fields are filled
  if (isset($_POST['organisation_name']) && isset($_POST['organisation_domain']) && isset($_POST['required_skills']) && isset($_POST['organisation_history']) && isset($_POST['organisation_country']) && isset($_POST['organisation_location'])) {
      // Store the form data in variables
      $organisation_name = $_POST['organisation_name'];
      $organisation_domain = $_POST['organisation_domain'];
      $required_skills = $_POST['required_skills'];
      $organisation_history = $_POST['organisation_history'];
      $organisation_country = $_POST['organisation_country'];
      $organisation_location = $_POST['organisation_location'];

      // Connect to your database (replace placeholders with actual database credentials)
      $servername = "localhost:3307"; // Change this to your servername
      $username = "root"; // Change this to your username
      $password = ""; // Change this to your password
      $dbname = "login-register"; // Change this to your database name

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Prepare SQL statement to insert data into the database
      $sql = "INSERT INTO infocl (organisation_name, organisation_domain, required_skills, organisation_history, organisation_country, organisation_location)
      VALUES (?, ?, ?, ?, ?, ?)";

      // Prepare and bind parameters
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssss", $organisation_name, $organisation_domain, $required_skills, $organisation_history, $organisation_country, $organisation_location);

      // Execute the SQL statement
      if ($stmt->execute()) {
          $message = "Your data is saved. Proceed to <a href='home.php'>home</a>.";
      } else {
          $message = "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close statement and connection
      $stmt->close();
      $conn->close();
  } else {
      $message = "All fields are required.";
  }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>



  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Information Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['organisation_name']) && isset($_POST['organisation_domain']) && isset($_POST['required_skills']) && isset($_POST['organisation_history']) && isset($_POST['organisation_country']) && isset($_POST['organisation_location'])) {
                // Your database connection and data insertion code here
                $message = "Your data is saved. Proceed to <a href='it.html'>home</a>.";
            } else {
                $message = "All fields are required.";
            }
            // Display the message
            echo "<div class='alert alert-success' role='alert'>$message</div>";
        }
        ?>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="#">IT Expert</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              
              
            <li class="nav-item">
                <a href="it.html" class="btn btn-outline-dark my-2 my-sm-0" type="button" >Home</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>




      <div class="container">
    <form action="index2.php" method="post" class="freelancer-form">
        <h1>Organisation Information</h1>
        <div class="form-group">
            <label for="organisation_name">Organisation Name</label>
            <input type="text" id="organisation_name" name="organisation_name" placeholder="Enter organisation name" required>
        </div>

        <div class="form-group">
            <label for="organisation_domain">Domain in which your organisation works</label>
            <input type="text" id="organisation_domain" name="organisation_domain" placeholder="Enter organisation domain" required>
        </div>

        <div class="form-group">
            <label for="required_skills">Skills which your organisations will need</label>
            <textarea id="required_skills" name="required_skills" placeholder="Enter required skills" required></textarea>
        </div>

        <div class="form-group">
            <label for="organisation_history">Organisation History</label>
            <textarea id="organisation_history" name="organisation_history" placeholder="Enter organisation history" required></textarea>
        </div>

        <div class="form-group">
            <label for="organisation_country">Country</label>
            <input type="text" id="organisation_country" name="organisation_country" placeholder="Enter organisation country" required>
        </div>

        <div class="form-group">
            <label for="organisation_location">Exact Location of company</label>
            <input type="text" id="organisation_location" name="organisation_location" placeholder="Enter organisation location" required>
        </div>

        <div class="social-buttons">
            <button class="linkedin-btn"><i class="fab fa-linkedin"></i> Add LinkedIn Account</button>
            <button class="github-btn"><i class="fab fa-github"></i> Add GitHub Account</button>
        </div>
        <br><br>
        <div class="form-group">
            <button   type="submit">Submit</button>
        </div>
    </form>
    <br><br>
    <a href="logout.php" class="btn btn-warning">Logout</a>
</div>

</body>
</html>
