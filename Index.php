<?php session_start();?><!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Position the navbar container at the bottom of the image */
        .container {
            position: absolute;
            bottom: 10%;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 20px 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Styling for the text */
        .overlay-text {
            font-size: 32px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 40px;
        }

        /* The navbar */
        .topnav {
            overflow: hidden;
            background-color: #333;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        /* Navbar links */
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 10px 12px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Position Faculty, Admin, and Student options */
        .topnav a.faculty,
        .topnav a.admin,
        .topnav a.student {
            float: right;
            background-color: #4CAF50;
            color: white;
        }

        .topnav a.faculty:hover,
        .topnav a.admin:hover,
        .topnav a.student:hover {
            background-color: #45a049;
            border: 2px solid white;
            transition: all 0.5s ease-in-out;
        }

        .bg-img {
            background-image: url("indexbg.jpg");
            min-height: 380px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .img-1 {
            border: 10px solid #ebf770;
            border-color: #f1fc79;
            padding-left: 10px;
            text-shadow: #313130;
            text-size-adjust: 600px;
            font-size: larger;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 300;
        }

        .img-1 img {
            display: block;
            margin: 0 auto; /* Center-align the image horizontally */
            max-width: 70%;
        }

        /* Styling for the colorful section */
        .colorful-section {
            background-color: #e9ee7c;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            text-decoration: none;
        }

        /* Hover effect for boxes */
        .colorful-box {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f2f6d0;
            border: 1px solid #f8dada;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .colorful-box:hover {
            background-color: #e0e0e0;
        }

        a {
            text-decoration: none;
        }

        p1 {
            font-size: 30px;
        }

        footer {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 10px;
            opacity: 40%;
        }

        .footer-links {
            margin-top: 10px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }
    </style>
</head>

<body>

    <div class="bg-img">
        <div class="container">
            <div class="overlay-text">
                Heritage Institute Of Technology
            </div>
        </div>
        <div class="topnav">
            <a href="#Home">Home</a>
            <a href="News.php">News</a>
            <a href="Contactspage.php">Contact</a>
            <a href="Aboutus.php">About</a>
            <a href="Faculty_REG.php" class="faculty">Faculty</a>
            <a href="Student_REG.php" class="student">Student</a>
            <a href="Admin_form.php" class="admin">Admin</a>
        </div>
    </div>

    <div>
        <div>
            <div class="img-1">
                <p1 style="color: rgb(241, 154, 23)">Welcome To The Student Transport Service Of Our College.</p1>
                <img src="busgif.gif"
                    alt="Student Transport System" style="max-width: 70%;">
            </div>
        </div>

    </div>

    <div class="colorful-section">
        <div class="colorful-box">
            <h2 style="color: #45a049"><a href="transportinfo.php"> Transport Information</a></h2>
            <p>Our college provides a convenient and reliable student transport system to ensure safe commuting for our students.</p>
        </div>

        <div class="colorful-box">
            <h3 style="color: #45a049"><a href="routesandschedules.php"> Routes & Schedules </a></h3>
            <p>We offer multiple routes covering various parts of the city. Our schedules are designed to accommodate class timings.</p>
        </div>

        <div class="colorful-box">
            <h3 style="color: #45a049"><a href="benefits.php"> Benefits</a></h3>
            The Benefits of taking our service.
        </div>

        <div class="colorful-box">
            <h3 style="color: #45a049"><a href="howtoavail.php"> How to Avail ?</a></h3>
            <p>To avail of our transport services, students can register and choose the appropriate route during the enrollment
                process.</p>
        </div>

        <div class "colorful-box">
            <h3 style="color: #45a049">Contact Information</h3>
            <p>If you have any queries or concerns regarding the student transport system, please contact our transportation
                department.</p>
            <p>Transport Department: +123-456-7890</p>
            <p>Email: transport@heritagecollege.edu</p>
        </div>
    </div>

    <!-- Footer with links -->
    <footer>
        <div class="footer-links">
            <!-- Heritage Institute Website link with an icon -->
            <a href="https://www.heritageit.edu/" target="_blank">
                <i class="fas fa-globe"></i> Visit Heritage Institute Website
            </a>

            <!-- YouTube channel link with an icon -->
            <a href="https://www.youtube.com/user/HeritageInstitute" target="_blank">
                <i class="fab fa-youtube"></i> Heritage Institute YouTube Channel
            </a>

            <!-- Google Maps link with an icon -->
            <a href="https://goo.gl/maps/zExnnnTtZvkhpuGX9" target="_blank">
                <i class="fas fa-map-marker-alt"></i> Heritage Institute on Google Maps
            </a>

            <!-- LinkedIn link with an icon -->
            <a href="https://www.linkedin.com/company/heritage-institute-of-technology" target="_blank">
                <i class="fab fa-linkedin"></i> Heritage Institute on LinkedIn
            </a>
        </div>
        <p>&copy; 2023 Heritage Institute of Technology</p>
    </footer>
</body>

</html>
