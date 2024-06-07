<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFF99; /* Yellowish background color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px; /* Wider container */
            padding: 25px;
            background-color: #fff;
            border: 2px solid #007BFF; /* Blue border */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .container h2 {
            text-align: center; /* Center the "Bus Booking Form" text */
            color: #007BFF; /* Blue heading text */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #007BFF; /* Blue label text */
        }

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="time"],
        select {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 2px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .back-button {
        display: inline-block;
        background-color: #007BFF;
        color: #fff;
        padding: 4px 8px;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        text-decoration: none;
        margin-top: 18px; /* Adjust the margin as needed */
        font-size: small;
    }

    .back-button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
    </style>
</head>
<body>

    <?php
    $id = $_GET["id"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bus";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize busName variable to store the bus name
    $busName = "";

    // SQL query to retrieve data from the "bus" table
    $sql = sprintf("SELECT name, id, point1, point2, pickup, dropoff, fare FROM bus where id=%s", $id);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the data in a table
        echo "<div class='container' id='hideable'>";
        echo "<h2>Bus Booking Form</h2>";

        while ($row = $result->fetch_assoc()) {
            // Remove microseconds from the timestamp
            $pickup = substr($row["pickup"], 0, strlen($row["pickup"]) - 6);
            $dropoff = substr($row["dropoff"], 0, strlen($row["dropoff"]) - 6);

            // Store the bus name in the variable
            $busName = $row["name"];

            echo "<div class='form-group'>";
            echo "<label for='bus-details'>Bus Details:</label>";
            echo "<p>Bus Name: " . $row["name"] . "</p>";
            echo "<p>Point 1: " . $row["point1"] . "</p>";
            echo "<p>Point 2: " . $row["point2"] . "</p>";
            echo "<p>Pickup: " . $pickup . "</p>";
            echo "<p>Drop Off: " . $dropoff . "</p>";
            echo "<p>Fare: " . $row["fare"] . "</p>"; // Added Fare
            echo "</div>";
        }

        echo "<form action='#' method='post' >";
        echo "<div class='form-group'>";
        echo "<label for='name'>Name:</label>";
        echo "<span id='name'>".$_SESSION['name']."</span>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='roll'>Roll no.:</label>";
        echo "<span id='roll'>".$_SESSION['id']."</span>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='phone'>Phone Number:</label>";
        echo "<input type='tel' id='phone' name='phone' required pattern='\\d{10}' title='Please enter a 10-digit phone number'>";
        echo "</div>";
        
        echo "<button type='submit'>Book Now</button>";
        echo "<a href='reg_success.php' class='back-button'>Back</a>";// Back button
        echo "</div>";
        echo "</form>";

        echo "</div>";
    } else {
        echo "No data found in the 'bus' table.";
    }

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $passengerName = $_SESSION["name"]; // Retrieve the name from the user
        $roll = $_SESSION["id"]; // Retrieve the roll from the user
        $phone = $_POST["phone"]; // Retrieve the phone from the user
        $sql="SELECT * from seat where name='$busName' and roll='$roll'";
        $r=$conn->query($sql);
        $sql="SELECT * from bus where name='$busName'";
        $res=$conn->query($sql);
        if($res->fetch_assoc()['seat_count']>0 and $r->num_rows==0) {
        // SQL query to insert data into the "seat" table
        $insertSql = "INSERT INTO seat (name, identity, roll, ph) VALUES ('$busName', '$passengerName', '$roll', '$phone')";

        if ($conn->query($insertSql) === TRUE) {
            
        $sql="UPDATE bus set seat_count=seat_count-1 where name='$busName'";
        $res=$conn->query($sql);
            echo '<script>
            document.getElementById("hideable").style.display="none";
            Swal.fire({
                icon: "success",
                title: "Booking Confirmed!",
                text: "Payment successful , Congratulations!",
            }).then(function() { document.getElementById("hideable").style.display="block";});
        </script>';
            } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
    else {
        echo '<script>
        document.getElementById("hideable").style.display="none";
                Swal.fire({
                    icon: "error",
                    title: "Booking Failed!",
                    text: "Seats not available!",
                }).then(function() { document.getElementById("hideable").style.display="block";});
            </script>';
    }
    }

    // Close the database connection
    $conn->close();
    ?>
   <script>history.forward();</script> 
</body>
</html>
