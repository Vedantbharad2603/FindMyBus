<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Find My Bus</title>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css?ved">
    <script src="../JS/main-script.js"></script>
</head>

<body>
    <header>
        <h1>Find My Bus</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="routes.php">Routes</a></li>
                <li><a href="#">Tickets</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="searchdiv">
            <input class="searchcity" type="text" id="pickupcity" name="pickupcity" placeholder="Pickup city">
            <input class="searchcity" type="text" id="dropcity" name="dropcity" placeholder="Drop city">
            <button type="submit" id="SubmitButton" class="searchbt" placeholder="GO">Submit</button>
        </div>
            <!-- onclick="javaScript:showroute()" -->
            <!-- <input type="button" name="answer" value="Show Div" onclick="showroute()" /> -->
        </form>
        <div class="showdata" style="border:2px solid black" id="datatable">
            <h2>Routes</h2>
            <table>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!(empty($_POST["pickupcity"]) && empty($_POST["dropcity"]))) {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "findmybus";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } else {
                            $pickupPoint = $_POST['pickupcity'];
                            $dropPoint = $_POST['dropcity'];
                            $sql = "SELECT * FROM route WHERE route_start_location = '$pickupPoint' AND route_end_location = '$dropPoint'";
                            $result = $conn->query($sql);
                            // Generate HTML to display the routes data
                            if ($result->num_rows > 0) {
                                echo "<tr><th>ID</th><th>Name</th><th>Start Location</th><th>End Location</th><th>Price</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["route_id"] . "</td><td>" . $row["route_name"] . "</td><td>" . $row["route_start_location"] . "</td><td>" . $row["route_end_location"] . "</td><td>" . $row["price"] . "</td></tr>";
                                }
                                echo '<script>
                                            showroute();
                                        </script>';
                            } else {
                                echo "No routes found.";
                            }
                        }
                    }
                }
                ?>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Bus Transport System. All rights reserved.</p>
    </footer>
</body>

</html>