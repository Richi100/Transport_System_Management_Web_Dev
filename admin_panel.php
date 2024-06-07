<?php session_start();?><!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #87CEEB; /* Light Blue background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .admin-container {
            display: flex;
            overflow: auto; /* Add scroll if content overflows */
        }

        .admin-panel {
            background-color: #f7dc6f; /* Light Yellow panel */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 20px;
            flex: 1;
            border-right: 1px solid #333;
            display: none;
            overflow: auto; /* Add scroll to the panel */
            max-height: 70vh; /* Limit the panel height to 70% of the viewport height */
        }

        .admin-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(135, 206, 235, 0.2);
            backdrop-filter: blur(10px);
            z-index: -1;
            border-radius: 10px;
        }

        .admin-panel h1 {
            color: #333;
            text-align: center;
            font-size: 36px;
            font-family: 'Arial', sans-serif;
            margin: 0 0 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 20px; /* Increase text and button size */
            text-align: center;
            font-size: 18px; /* Increase text size */
        }

        th {
            background-color: #f7dc6f; /* Light Yellow header */
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #87CEEB; /* Light Blue alternate rows */
        }

        .hover-options {
            text-align: center;
            margin-bottom: 20px;
        }

        .hover-option {
            background-color: #ffee58; /* Light Yellow button */
            color: #333;
            cursor: pointer;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            display: inline-block;
            transition: background-color 0.3s;
            font-size: 24px; /* Increase button text size */
        }

        .hover-option:hover {
            background-color: #fff; /* On hover, make it white */
            color: #333;
        }

        .admin-heading {
            font-size: 48px; /* Increase heading size */
            color: #ffee58; /* Light Yellow heading */
            font-weight: bold;
            margin: 20px 0;
        }

        .home-button {
            position: absolute;
            top: 8px;
            right: 9px;
            font-size: 18px; /* Increase button text size */
            background-color: #ffee58; /* Light Yellow button */
            padding: 10px 20px; /* Increase button size */
            border-radius: 7px;
            text-decoration: none;
            color: #333;
        }

        .no-data-image {
            text-align: center;
        }
    </style>
</head>

<body>
    <a href="index.php" class="home-button">Home</a>

    <div class="admin-heading">Admin Panel</div>

    <div class="admin-container">
        <!-- Student Panel -->
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'bus');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $check = $conn->prepare('select * from student');
            try {
                $check->execute();
                $res = $check->get_result();
                ?>
                <div class="admin-panel" id="student-table">
                    <a href="index.php" class="home-button">Home</a>
                    <h1>Manage Students</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>User ID</th>
                                <th>Email ID</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($res->num_rows == 0) {
                                echo ("<tr class='no-data-image'><td colspan='4'><img src='box.jpg'></td></tr>");
                            } else {
                                while ($row = mysqli_fetch_row($res)) {
                                    echo ('<tr>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[0] . '</td>
                        <td class="col" style="background-color:#f3c06f; color:#fff; border: 2px solid black;">' . $row[5] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[3] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[6] . '</td>
                        <td class="col" style="background-color:#f3c06f; border: 2px solid black;"><form action="admin_panel.php" method="post"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="deleteStud" value=' . $row[5] . '>Delete</button></form></td>
                    </tr>');
                                }
                            }
                            $check->close();

                        } catch (Exception $ex) {
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Faculty Panel -->
        <?php
        $check = $conn->prepare('select * from faculty');
        try {
            $check->execute();
            $res = $check->get_result();
            ?>
            <div class="admin-panel" id="faculty-table">
                <a href="index.php" class="home-button">Home</a>
                <h1>Manage Faculty</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>User ID</th>
                            <th>Email ID</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($res->num_rows == 0) {
                            echo ("<tr class='no-data-image'><td colspan='4'><img src='box.jpg'></td></tr>");
                        } else {
                            while ($row = mysqli_fetch_row($res)) {
                                echo ('<tr>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[0] . '</td>
                        <td class="col" style="background-color:#f3c06f; color:#fff; border: 2px solid black;">' . $row[5] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[3] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[6] . '</td>
                        <td class="col" style="background-color:#f3c06f; border: 2px solid black;"><form action="admin_panel.php" method="post"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="deleteFac" value=' . $row[5] . '>Delete</button></form></td>
                    </tr>');
                            }
                        }
                        $check->close();
                    } catch (Exception $ex) {
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Bus Panel -->
        <?php
        $check = $conn->prepare('select * from bus');
        try {
            $check->execute();
            $res = $check->get_result();
            ?>
            <div class="admin-panel" id="bus-table">
                <a href="index.php" class="home-button">Home</a>
                <h1>Manage Bus Details</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Point 1</th>
                            <th>Point 2</th>
                            <th>Fare</th>
                            <th>Pickup</th>
                            <th>Dropoff</th>
                            <th>Seat Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($res->num_rows == 0) {
                            echo ("<tr class='no-data-image'><td colspan='8'><img src='box.jpg'></td></tr>");
                        } else {
                            while ($row = mysqli_fetch_row($res)) {
                                echo ('<tr>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[0] . '</td>
                        <td class="col" style="background-color:#f3c06f; color:#fff; border: 2px solid black;">' . $row[1] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[2] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[3] . '</td>
                        <td class="col" style="background-color:#f3c06f; border: 2px solid black;">' . $row[4] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[5] . '</td>
                        <td class="col" style="background-color:#ffff99; border: 2px solid black;">' . $row[6] . '</td>
                        <td class="col" style="background-color:#f3c06f; color: #fff; border: 2px solid black;">' . $row[7] . '</td> <!-- Display the actual seat count -->
                    </tr>');
                            }
                        }
                        $check->close();
                    } catch (Exception $ex) {
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if(isset($_POST['deleteStud'])) {
            $stmt=$conn->prepare('delete from student where StudentID=?');
            $stmt->bind_param("i", $_POST['deleteStud']);
            $stmt->execute();
            $stmt->close();
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Student Deleted"
                }).then(function() {location.href="admin_panel.php";});
            </script>';
        }
        if(isset($_POST['deleteFac'])) {
            $stmt=$conn->prepare('delete from faculty where FacultyID=?');
            $stmt->bind_param("i", $_POST['deleteFac']);
            $stmt->execute();
            $stmt->close();
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Faculty Deleted"
                }).then(function() {location.href="admin_panel.php";});
            </script>';
        }
        mysqli_close($conn);
                }
        ?>
    </div>
    <hr>

    <div class="hover-options">
        <div class="hover-option" onclick="showTable('student-table')">Students</div>
        <div class="hover-option" onclick="showTable('faculty-table')">Faculty</div>
        <div class="hover-option" onclick="showTable('bus-table')">Bus Details</div>
    </div>

    <script type='text/javascript'>
   history.forward();
        function showTable(tableId) {
            var tables = document.querySelectorAll('.admin-panel');
            tables.forEach(function (table) {
                table.style.display = 'none';
            });

            var selectedTable = document.getElementById(tableId);
            if (selectedTable) {
                selectedTable.style.display = 'block';
            }
        }
   
   </script>

</body>

</html>
