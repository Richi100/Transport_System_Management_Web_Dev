<?php session_start();?>\<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background: url('faclog.jpg')  center center fixed ; /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
            opacity: 87%;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-group label {
            font-weight: bold;
            color: #555;
        }

        .input-group input[type="text"],
        .input-group input[type="password"] {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 2px;
            transition: border-color 0.2s;
            margin-bottom: 10px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #007BFF;
        }

        .recaptcha-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px; /* Add space below reCAPTCHA */
        }

        .login-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container" id="hideable">
        <h2>Faculty Login</h2>
        <form action='faculty_login.php' method='post'>
            <div class="input-group">
                <label for="faculty_id">Faculty ID:</label>
                <input type="text" id="faculty_id" name="faculty_id" required>
            </div>
            <div class="input-group">
                <label for="faculty_password">Password:</label>
                <input type="password" id="faculty_password" name="faculty_password" required>
            </div>
            
            <div class="recaptcha-container">
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LcU0vUoAAAAAOh6zXTGGl4a6YIEFJX2tDbywC-i"></div>
            </div>
            <!-- Include the reCAPTCHA API script -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bus";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    // Verify the reCAPTCHA response
    $recaptchaSecretKey = "6LcU0vUoAAAAADBYGSGh1uoUFuLCSN0OO0fgHlJ6";
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $recaptchaData = json_decode($recaptchaVerify);

    if (!$recaptchaData->success) {
        echo '<script>
        document.getElementById("hideable").style.display="none";
            Swal.fire({
                icon: "error",
                title: "reCAPTCHA Verification Failed",
                text: "Please complete the reCAPTCHA.",
            }).then(function() { document.getElementById("hideable").style.display="block";});
        </script>';
        exit();
    }
        $id = $_POST["faculty_id"];
        $pass = $_POST["faculty_password"];
        $sql = "select * from faculty where FacultyID='$id'";
        $res = $conn->query($sql);
        $ar=$res->fetch_assoc();
        if ($res->num_rows != 1 or $ar['Password'] != $pass) {
            echo '<script>
            document.getElementById("hideable").style.display="none";

                Swal.fire({
                    icon: "error",
                    title: "Login Failed",
                    text: "Wrong Credentials!",
                }).then(function() { document.getElementById("hideable").style.display="block";});
            </script>';
        } else {
            $_SESSION['id']=$id;
            $_SESSION['name']=$ar['Username'];
            echo '<script>
            document.getElementById("hideable").style.display="none";

                Swal.fire({
                    icon: "success",
                    title: "Login Successful",
                    text: "Welcome!",
                }).then(function () {
                    window.location.href = "reg_success.php";
                });
            </script>';
        }
    }
    ?>
    <script>
        // Prevent body scrolling when SweetAlert is open
        Swal.mixin({
            onOpen: () => {
                // You can leave this part empty or remove it
            },
            onClose: () => {
                // You can leave this part empty or remove it
            }
        });
    </script>
</body>
</html>
