<?php
session_start();

// Check if the user is not logged in, redirect to registration.php if they are not
if (!isset($_SESSION["user"])) {
   header("Location: registration.php");
   exit(); // Ensure no further code is executed after redirection
}

// Database connection
$servername = "localhost:3307"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "login-register"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    // Handle file uploads
    $profilePhoto = $_FILES['profilePhoto']['name'];
    $portfolio = $_FILES['portfolio']['name'];
    $licenses = $_FILES['licenses']['name'];
    $certifications = $_FILES['certifications']['name'];
    // Additional form fields
    $domain = $_POST['domain'];
    $skills = $_POST['skills'];
    $workHistory = $_POST['workHistory'];
    $education = $_POST['education'];
    $location = $_POST['location'];
    
    // Move uploaded files to a directory
    $targetDirectory = "uploads/"; // Create this directory in your project
    move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetDirectory . $profilePhoto);
    move_uploaded_file($_FILES["portfolio"]["tmp_name"], $targetDirectory . $portfolio);
    move_uploaded_file($_FILES["licenses"]["tmp_name"], $targetDirectory . $licenses);
    move_uploaded_file($_FILES["certifications"]["tmp_name"], $targetDirectory . $certifications);

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO info (full_name, profile_photo, portfolio_resume, licenses, certifications, domain, skills, work_history, education, location)
    VALUES ('$fullName', '$profilePhoto', '$portfolio', '$licenses', '$certifications', '$domain', '$skills', '$workHistory', '$education', '$location')";

if ($conn->query($sql) === TRUE) {
  // Redirect to dashboard.php upon successful data insertion
  header("Location: dashboard.php");
  exit(); // Ensure no further code is executed after redirection
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Freelancer Information Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

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
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="freelancer-form" enctype="multipart/form-data">
    <h1>Freelancer Information</h1>
    <div class="form-group">
      <label for="fullName">Full Name</label>
      <input type="text" id="fullName" name="fullName" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
      <label for="profilePhoto">Profile Photo</label>
      <input type="file" id="profilePhoto" name="profilePhoto">
    </div>
    <div class="form-group">
      <label for="domain">Domain</label>
      <input type="text" id="domain" name="domain" placeholder="Enter your domain" required>
    </div>
    <div class="form-group">
      <label for="portfolio">Portfolio/Resume</label>
      <input type="file" id="portfolio" name="portfolio">
    </div>
    <div class="form-group">
      <label for="skills">Skills</label>
      <textarea id="skills" name="skills" placeholder="Enter your skills" required></textarea>
    </div>
    <div class="form-group">
      <label for="workHistory">Work History</label>
      <textarea id="workHistory" name="workHistory" placeholder="Enter your work history" required></textarea>
    </div>
    <div class="form-group">
      <label for="licenses">Licenses</label>
      <input type="file" id="licenses" name="licenses">
    </div>
    <div class="form-group">
      <label for="education">Education/Testimonials</label>
      <textarea id="education" name="education" placeholder="Enter your education/testimonials" required></textarea>
    </div>
    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" id="location" name="location" placeholder="Enter your location" required>
    </div>
    <div class="form-group">
      <label for="certifications">Certifications</label>
      <input type="file" id="certifications" name="certifications">
    </div>
    <div class="social-buttons">
      <button class="linkedin-btn"><i class="fab fa-linkedin"></i> Add LinkedIn Account</button>
      <button class="github-btn"><i class="fab fa-github"></i> Add GitHub Account</button>
    </div>
    <br><br>
    <div class="form-group">
      <button type="submit">Submit</button>
    </div>
  </form>
  <br><br>
  
</div>

</body>
