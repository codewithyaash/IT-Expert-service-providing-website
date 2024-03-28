

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: white;
            color: black;
            padding: 10px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
            object-fit: cover;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h2 {
            margin-bottom: 5px;
            color: #333;
        }

        .profile-info p {
            margin-bottom: 10px;
            color: #555;
        }

        .profile-actions {
            margin-top: 20px;
        }

        .profile-actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .profile-actions a:hover {
            text-decoration: underline;
        }

        .section-heading {
            margin-bottom: 10px;
            color: #333;
        }

        .resume-link {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .resume-link:hover {
            text-decoration: underline;
        }

        .skills-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .skills-list li {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .certification-images {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .certification-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .appointment-button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        .appointment-button:hover {
            background-color: #0056b3;
        }
    </style>



</head>
<body>
    <div class="container">
        <!-- Display user information -->
        <h2>Welcome to the Dashboard</h2>
        <?php

session_start();

// Check if the user is not logged in, redirect to registration.php if they are not
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit(); // Ensure no further code is executed after redirection
}

// Check if submitted data is stored in the session
if (isset($_SESSION['submitted_data'])) {
    $data = $_SESSION['submitted_data'];

    // Display the submitted data
    echo "<h2>Submitted Data</h2>";
    echo "<p>Name: " . $data['fullName'] . "</p>";
    echo "<p>Domain: " . $data['domain'] . "</p>";
    echo "<p>Skills: " . $data['skills'] . "</p>";
    echo "<p>Work History: " . $data['workHistory'] . "</p>";
    echo "<p>Education: " . $data['education'] . "</p>";
    echo "<p>Location: " . $data['location'] . "</p>";

    // Display file names
    echo "<p>Profile Photo: " . $data['profilePhoto']['name'] . "</p>";
    echo "<p>Portfolio/Resume: " . $data['portfolio']['name'] . "</p>";
    echo "<p>Licenses: " . $data['licenses']['name'] . "</p>";
    echo "<p>Certifications: " . $data['certifications']['name'] . "</p>";

} else {
    echo "No data submitted.";
}
?>
<br><br><br><br>
<a href="logout.php" class="btn btn-warning">Logout</a>
<br><br>
<li class="nav-item">
                <a href="it.html" class="btn btn-warning" type="button" >home</a>
              </li>
    </div>
</body>
</html>
