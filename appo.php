<?php
$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost:3307"; // Change this if your database is hosted on a different server
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "login-register"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO appo (fullName, email, phone, problem, appointmentDate, appointmentTime) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullName, $email, $phone, $problem, $appointmentDate, $appointmentTime);

    // Set parameters and execute
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $problem = $_POST["problem"];
    $appointmentDate = $_POST["appointmentDate"];
    $appointmentTime = $_POST["appointmentTime"];

    if ($stmt->execute()) {
        $message = "Your appointment is booked proceed to home.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Request Form</title>
  <link rel="stylesheet" href="appo.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
              <a class="navbar-brand" href="#">IT Expert</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <button  ><a href="it.html">home</a></button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  
                  
                 
                </ul>
              </div>
            </div>
          </nav>

  <div class="container">
    <?php if (!empty($message)) { ?>
      <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>
    <form action="#" method="post" class="appointment-form">
      <h2>Appointment Form</h2>
      <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
      </div>
      <div class="form-group">
        <label for="problem">Problem Statement</label>
        <textarea id="problem" name="problem" placeholder="Describe your problem statement" required></textarea>
      </div>
      <div class="form-group">
        <label for="appointmentDate">Preferred Appointment Date</label>
        <input type="date" id="appointmentDate" name="appointmentDate" required>
      </div>
      <div class="form-group">
        <label for="appointmentTime">Preferred Appointment Time</label>
        <input type="time" id="appointmentTime" name="appointmentTime" required>
      </div>
      <div class="form-group">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>
