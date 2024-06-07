<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      background-image: url('stureg6.jpg');
      background-size: cover;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      width: 400px;
      margin-bottom: 20px;
      opacity: 87%;
    }

    .container h2 {
      margin-bottom: 10px;
    }

    .form-group {
      margin-bottom: 5px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 6px;
      border: 2px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 5px;
      cursor: pointer;
    }

    button1 {
      background-color: #f1f3f5;
      color: white;
      border: none;
      padding: 9px 18px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .login-message {
      background-color: #f5f8fb;
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
      color: #3d0580;
      padding: 8px;
      border-radius: 10px;
    }

    .login-link {
      color: #2d91f4;
      text-decoration: none;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert library -->
</head>
<body>
  <div class="container">
    <h2>Student Registration Form</h2>
    <form action="Student_REG.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required pattern="[a-zA-Z0-9_]+" title="Only letters, numbers, and underscores are allowed">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" required>
      </div>
      <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" id="contact" name="contact" required pattern="[0-9]+" title="Only numbers are allowed">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Please enter a valid email address">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long">
      </div>
      <div class="form-group">
        <label for="studentId">Student ID</label>
        <input type="text" id="studentId" name="studentId" required>
      </div>
      <div class="form-group">
        <label for="department">Department</label>
        <select id="department" name="department" required>
          <option value="Choose">Choose</option>
          <option value="B.Tech">B.Tech</option>
          <option value="MCA">MCA</option>
          <option value="MBA">MBA</option>
          <option value="Law">LAW</option>
          <option value="Academy">Academy</option>
          <option value="College">College</option>
        </select>
      </div>
      <!-- Google reCAPTCHA -->
      <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LcU0vUoAAAAAOh6zXTGGl4a6YIEFJX2tDbywC-i"></div>
      </div>
      <!-- Include the reCAPTCHA API script -->
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <button type="submit">Register</button>
      <button1 type="BACK"><a STYLE="text-decoration:none "href="Index.php">BACK</a></button1>
    </form>
  </div>
  <div class="login-message">
    Already have an account? <a class="login-link" href="student_login.php"><b>Log in</b></a>
  </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; // Change to your MySQL server
    $username = "root";
    $password = "";
    $dbname = "bus";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Verify the reCAPTCHA response
    $recaptchaSecretKey = "6LcU0vUoAAAAADBYGSGh1uoUFuLCSN0OO0fgHlJ6";
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $recaptchaData = json_decode($recaptchaVerify);

    if (!$recaptchaData->success) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'reCAPTCHA Verification Failed',
                text: 'Please complete the reCAPTCHA.',
            });
        </script>";
        exit();
    }

    // Retrieve data from the form
    $username = $conn->real_escape_string($_POST["username"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $contact = $conn->real_escape_string($_POST["contact"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $studentId = $conn->real_escape_string($_POST["studentId"]);
    $department = $conn->real_escape_string($_POST["department"]);

    // SQL query to insert data into the "student" table
    $sql = "INSERT INTO student (username, address, contact, email, password, studentId, department)
            VALUES ('$username', '$address', '$contact', '$email', '$password', '$studentId', '$department')";

    try {
        if ($conn->query($sql) === TRUE) {
          echo "<script>
          Swal.fire({
              icon: 'success',
              title: 'Registration Successful',
              text: 'You have successfully registered! Now login!',
              onClose: function() {
                  // Redirect to 'reg_success.php' after success
                  window.location.href = 'student_login.php';
              }
          }).then(function() {location.href='reg_success.php';});
      </script>";
     
      exit(); // Terminate the script
        } else {
            // Check for duplicate entry manually
            if (strpos($conn->error, "Duplicate entry") !== false) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Error',
                        text: 'Already registered! The username or email is already registered.',
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Error',
                        text: 'An error occurred during registration: " . $conn->error . "',
                    });
                </script>";
            }
        }
    } catch (Exception $e) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Registration Error',
                text: 'An error occurred during registration: " . $e->getMessage() . "',
            });
        </script>";
    }

    // Close the database connection
    $conn->close();
}
?>
