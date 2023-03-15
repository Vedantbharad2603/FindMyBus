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
                <input type="submit" id="SubmitButton" class="searchbt" value="Show">
                <input type="submit" id="Showall" class="searchbt" value="Show All">
            </div>
        </form>
        <div class="showdata" style="display: none;" id="datatable">
            <h2>Routes</h2>
            <table>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include_once "../includeFiles/connections.php";
                    if(isset($_POST["Showall"])){
                        $result = $pdo->query("SELECT * FROM busschedule");
                        if($result->rowCount()>0){
                            echo "<tr><th>ID</th><th>Name</th><th>Start Location</th><th>End Location </th><th>Distances </th><th>Price(in ₹)</th></tr>";
                            while ($row = $result->fetch()) {
                                echo "<tr><td>" . $row["TripId"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["StartLocation"] . "</td><td>" . $row["EndLocation"]."</td><td>" . $row["Distances"]."</td><td>" . $row["Price"] ."</td></tr>";
                            }
                            echo '<script>
                                        showroute();
                                    </script>';
                        } else {
                            echo "No routes found.";
                        }
                    }
                    if (!(empty($_POST["pickupcity"]) && empty($_POST["dropcity"]))) {
                        $pickupPoint = $_POST['pickupcity'];
                        $dropPoint = $_POST['dropcity'];
                        $result = $pdo->query("SELECT * FROM busschedule WHERE StartLocation = '$pickupPoint' AND EndLocation = '$dropPoint'");
                        if($result->rowCount()>0){
                            echo "<tr><th>ID</th><th>Name</th><th>Start Location</th><th>End Location </th><th>Distances </th><th>Price(in ₹)</th></tr>";
                            while ($row = $result->fetch()) {
                                echo "<tr><td>" . $row["TripId"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["StartLocation"] . "</td><td>" . $row["EndLocation"]."</td><td>" . $row["Distances"]."</td><td>" . $row["Price"] ."</td></tr>";
                            }
                            echo '<script>
                                        showroute();
                                    </script>';
                        } else {
                            echo "No routes found.";
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