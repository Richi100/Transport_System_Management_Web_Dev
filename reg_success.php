<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Heritage Bus Booking Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background-color: #f7f7c2; /* Light yellow background */
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #00437e; /* College official color */
            color: white;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff; /* White background for the table */
            border: 1px solid #00437e; /* College official color for table border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #00437e; /* College official color for table header */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #00437e; /* College official color for links */
            font-weight: bold;
        }

        a:hover {
            color: #ff9900; /* Hover color for links */
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            color: whitesmoke; /* College official color for links */
            font-weight: bold;
            text-decoration: none;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>

<body>
    <a class="logout" href="index.php">Logout</a>
    <h1>Heritage Bus Booking Chart</h1>

    <div class="container">
        <?php
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

        // SQL query to retrieve data from the "bus" table
        $sql = "SELECT name, id, point1, point2, pickup, dropoff, fare FROM bus";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the data in a table
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Bus Name</th>";
            echo "<th>Point 1</th>";
            echo "<th>Point 2</th>";
            echo "<th>Pickup</th>";
            echo "<th>Drop Off</th>";
            echo "<th>Monthly Fare</th>";
            echo "<th>Book Now</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                // Remove microseconds from the timestamp
                $pickup = substr($row["pickup"], 0, strlen($row["pickup"]) - 6);
                $dropoff = substr($row["dropoff"], 0, strlen($row["dropoff"]) - 6);

                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["point1"] . "</td>";
                echo "<td>" . $row["point2"] . "</td>";
                echo "<td>" . $pickup . "</td>";
                echo "<td>" . $dropoff . "</td>";
                echo "<td>" . $row["fare"] . "</td>";
                echo "<td><a href='book_pay.php?id=" . $row["id"] . "'>Book Now</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No data found in the 'bus' table.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
    <script>history.forward();</script>
</body>

</html>
