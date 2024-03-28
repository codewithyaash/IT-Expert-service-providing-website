<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <nav class="navbar">
        <h1>IT Expert</h1>
    </nav>
    <br><br><br><br>
    <div class="container">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "your_username"; // Change this to your database username
        $password = "your_password"; // Change this to your database password
        $dbname = "login-register";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database
        $sql = "SELECT * FROM info"; // Change the table name if it's different
        $result = $conn->query($sql);

        // Check if there is data in the database
        if ($result->num_rows > 0) {
            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="profile-section">';
                echo '<img src="' . $row["profile_photo"] . '" alt="Profile Picture" class="profile-img">';
                echo '<div class="profile-info">';
                echo '<h2>' . $row["full_name"] . '</h2>';
                echo '<p>Education: ' . $row["education"] . '</p>';
                echo '<p>Location: ' . $row["location"] . '</p>';
                echo '<p>Domain: ' . $row["domain"] . '</p>';
                // Output other fields similarly
                echo '</div>';
                echo '</div>';
                echo '<div class="profile-actions">';
                echo '<a href="' . $row["resume_link"] . '">Resume</a>'; // Assuming you have a resume link in your database
                echo '</div>';
            }
        } else {
            echo "No data found in the database.";
        }

        // Close connection
        $conn->close();
        ?>
        <div class="container">
        <div class="profile-section">
            <img src="t4 2.jpg" alt="Profile Picture" class="profile-img">
            <div class="profile-info">
                <h2>Billie Matthew</h2>
                <p>Education: Bachelor's in Computer Science</p>
                <p>Location: New York, USA</p>
                <p>Domain: Project manager</p>
            </div>
        </div>
        <div class="profile-actions">
            <a href="YashDavkhar_InternshalaResume (4).pdf">Resume</a>
        </div>
        <br>
        <hr>
        <h2 class="section-heading">Skills</h2>
        <ul class="skills-list">
            <li>Data Visualization</li> <!-- Added Data Visualization skill -->
            <li>Project Management</li> <!-- Added Project Management skill -->
        </ul>
        <hr>
        <h2 class="section-heading">Work History</h2>
        <p>Description: Highlight your foundational skills in developing end-to-end web applications. <br>
            Achievement: Mention your contribution to a project that increased website traffic by 20%. <br>
            Adaptability: Showcase your quick learning abilities, such as mastering new programming languages within weeks. <br>
            Teamwork: Emphasize your experience working with agile development teams1.</p>
        <br><br>
        <h2 class="section-heading">Licences</h2>
        <div class="certification-images">
            <img src="8.jpg" alt="Certification 1">
            <img src="11.jpg" alt="Certification 2">
            <img src="10.jpg" alt="Certification 3">
        </div>
        <br><br><br>
        <h2 class="section-heading">Certifications</h2>
        <div class="certification-images">
            <img src="Dashboard 1.png" alt="Certification 1">
            <img src="1.jpg" alt="Certification 2">
            <img src="3.jpg" alt="Certification 3">
        </div>
        <a href="sk.html" class="appointment-button">Make Appointment</a>
    </div>
    </div>
</body>
</html>
