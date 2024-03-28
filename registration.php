<?php
session_start();

// Check if the user is already logged in, redirect to index.php if they are
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit(); // Ensure no further code is executed after redirection
}

require_once "database.php";

if (isset($_POST["submit"])) {
   $fullName = $_POST["fullname"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $passwordRepeat = $_POST["repeat_password"];
   
   $passwordHash = password_hash($password, PASSWORD_DEFAULT);

   $errors = array();
   
   if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
      array_push($errors,"All fields are required");
   }
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Email is not valid");
   }
   if (strlen($password)<8) {
      array_push($errors,"Password must be at least 8 characters long");
   }
   if ($password !== $passwordRepeat) {
      array_push($errors,"Password does not match");
   }

   // Check if the email already exists in the database
   $sql = "SELECT * FROM user WHERE email = ?";
   $stmt = mysqli_stmt_init($conn);
   if (!mysqli_stmt_prepare($stmt, $sql)) {
      die("SQL statement failed");
   } else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if (mysqli_fetch_assoc($result)) {
         array_push($errors,"Email already exists!");
      }
   }

   if (count($errors) > 0) {
      foreach ($errors as $error) {
         echo "<div class='alert alert-danger'>$error</div>";
      }
   } else {
      $sql = "INSERT INTO user (full_name, email, password) VALUES (?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
         die("SQL statement failed");
      } else {
         mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
         mysqli_stmt_execute($stmt);
         
         // Set up session variable upon successful registration
         $_SESSION["user"] = "yes";
         
         // Redirect the user to index.php
         header("Location: index.php");
         exit(); // Ensure no further code is executed after redirection
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    outline: none;
    border-color: #4e89ae;
    box-shadow: 0 0 5px rgba(78, 137, 174, 0.5);
}

.form-btn {
    text-align: center;
}

.btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #fff;
    background-color: #4e89ae;
    transition: background-color 0.15s ease-in-out;
}

.btn:hover {
    background-color: #306080;
}

.alert {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}

a {
    color: #4e89ae;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO user (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="registration.php" method="post">
            
            <div class="form-group">
            <h3>SIGN UP FOR WORK</h3>
            <br><br>
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
                <br>
            </div>
        </form>
        <br>
        <div>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
      </div>
    </div>
</body>
</html>