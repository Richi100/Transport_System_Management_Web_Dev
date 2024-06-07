<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFF99; /* Yellowish background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #007BFF; /* Blue heading text */
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #007BFF; /* Blue label text */
        }

        input[type="password"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .g-recaptcha {
            display: flex;
            justify-content: center; /* Align the reCAPTCHA to the center */
            margin-top: 10px; /* Add spacing below reCAPTCHA */
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
            margin-top: 10px; /* Added spacing */
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Portal</h1>
        <form action="admin_form.php" method="post">
            <label for="security_code">Security Code:</label>
            <input type="password" id="security_code" name="security_code" required>
            <div class="g-recaptcha" data-sitekey="6LcU0vUoAAAAAOh6zXTGGl4a6YIEFJX2tDbywC-i"></div>
            <!-- Include the reCAPTCHA API script -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <button type="submit">Submit</button>
        </form>
    </div>
    <?php
    if(isset($_POST['security_code'])) {
        // Your reCAPTCHA verification code goes here
        $recaptchaSecretKey = "6LcU0vUoAAAAADBYGSGh1uoUFuLCSN0OO0fgHlJ6";
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        
        // Verify reCAPTCHA
        $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
        $recaptchaData = json_decode($recaptchaVerify);
        
        if ($recaptchaData->success) {
            if($_POST['security_code']=='123456') {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Login Successful",
                        text: "Welcome Admin!",
                    }).then(function () {
                        hideContainer(); // Call the function to hide the container
                        window.location.href = "admin_panel.php";
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Login Failed",
                        text: "Wrong Security Code!",
                    }).then(function () {
                        hideContainer(); // Call the function to hide the container
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "reCAPTCHA Verification Failed",
                    text: "Please complete the reCAPTCHA!",
                });
            </script>';
        }
    }
    ?>

    <script>
        // JavaScript to hide the container after displaying SweetAlert
        function hideContainer() {
            var container = document.querySelector(".container");
            container.hidden = true;
        }
    </script>
</body>

</html>
