<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Find My Bus</title>
        <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    </head>
    <body>
        <header>
        <h1>Find My Bus</h1>
        <nav>
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Routes</a></li>
            <li><a href="#">Tickets</a></li>
            <li><a href="#">About Us</a></li>
            </ul>
        </nav>
        </header>
        <main>
            <h2>Today's Routes</h2>
            <div>
                <?php
                    // Connect to the database
                    $servername = "localhost:4090";
                    $username = "root";
                    $password = "vedant2603";
                    $dbname = "findmybus";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }

                    // Retrieve the routes data from the database
                    $sql = "SELECT * FROM route";
                    $result = $conn->query($sql);

                    // Generate HTML to display the routes data
                    if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Name</th><th>Start Location</th><th>End Location</th><th>Price</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["route_id"] . "</td><td>" . $row["route_name"] . "</td><td>" . $row["route_start_location"] . "</td><td>" . $row["route_end_location"] . "</td><td>" . $row["price"] . "</td></tr>";
                    }
                    echo "</table>";
                    } else {
                    echo "No routes found.";
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </div>
        </main>
        <footer>
        <p>&copy; 2023 Bus Transport System. All rights reserved.</p>
        </footer>
    </body>
</html>
