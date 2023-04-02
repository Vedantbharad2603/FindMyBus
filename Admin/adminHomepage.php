<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Find My Bus</title>
        <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    </head>
    <body>
        <?php include '../includeFiles/header.php'; ?>
        <main>
            <input type="submit" id="showbuses" onclick="javaScript:showrouteAdmin()" class="searchbt" value="Buses" style="background-color:#182C61">
            <input type="submit" id="showbusschedule" onclick="javaScript:showbusscheduleAdmin()" class="searchbt" value="Busschedule">
            <input type="submit" id="showdepo" onclick="javaScript:showdepoAdmin()" class="searchbt" value="Depo">
            <input type="submit" id="showroutestop" onclick="javaScript:showroutestopAdmin()" class="searchbt" value="Routestop">
            <input type="submit" id="showstaff" onclick="javaScript:showstaffAdmin()" class="searchbt" value="Staff">
            <br><br>
            <div id="busesDiv" style="display: block">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM buses");
                if($result->rowCount()>0)
                {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Bus Number</th><th>Type</th><th>Total Seats</th><th>EngineNo</th><th>Insurance No</th><th>ACTION</th></tr>";
                    // <th>DELETE</th>
                    while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['BusNumber']; ?></td>
                            <td><?php echo $row['Type']; ?></td>
                            <td><?php echo $row['TotalSeats']; ?></td>
                            <td><?php echo $row['EngineNo']; ?></td>
                            <td><?php echo $row['InsuranceNo']; ?></td>
                            <td><a href="edit_cars.php?id=<?php echo $row['Id'];?>">Edit </a>  | <a href="delete_cars.php?id=<?php echo $row['Id'];?>" onclick="return confirm('Are you sure to delete it?');">DELETE </a></td>
                            
                        </tr>
                        <?php
                    }
                    echo "</table>";
                }
            ?>
            </div>
            <div id="busscheduleDiv" style="display:none">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM busschedule");
                if($result->rowCount()>0)
                {
                    echo "<table>";
                    echo "<tr><th>Trip ID</th><th>Name</th><th>Start Location</th><th>End Location</th><th>Distances(in KM)</th><th>Price (in ₹)</th></tr>";
                    // <th>DELETE</th>
                    while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $row['TripId']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['StartLocation']; ?></td>
                            <td><?php echo $row['EndLocation']; ?></td>
                            <td><?php echo $row['Distances']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                        </tr>
                        <?php
                    }
                    echo "</table>";
                }
            ?>
            </div>
            <div id="depoDiv" style="display:none">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM depo");
                if($result->rowCount()>0)
                {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Name</th><th>No of Platforms</th><th>Address</th><th>City</th><th>State</th><th>Pin Code</th><th>Work Phone No</th><th>Second Phone No</th></tr>";
                    // <th>DELETE</th>
                    while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['NoOfPlatforms']; ?></td>
                            <td><?php echo $row['Address1'].",".$row['Address2']; ?></td>
                            <td><?php echo $row['City']; ?></td>
                            <td><?php echo $row['State']; ?></td>
                            <td><?php echo $row['PinCode']; ?></td>
                            <td><?php echo $row['WorkPhoneNo']; ?></td>
                            <td><?php echo $row['SecondPhoneNo']; ?></td>
                        </tr>
                        <?php
                    }
                    echo "</table>";
                }
            ?>
            </div>
            <div id="routestopDiv" style="display:none">
            <h2>Working on that</h2>
            </div>
            <div id="staffDiv" style="display:none">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM staff");
                if($result->rowCount()>0)
                {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Type</th><th>Name</th><th>DOB</th><th>JoiningDate</th>><th>RetirementDate</th><th>Address</th><th>City</th><th>State</th><th>PinCode</th><th>AddarCardNo</th><th>LicenceNo</th><th>WorkMobileNo</th><th>HomeMobileNo</th></tr>";
                    while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['Type']; ?></td>
                            <td><?php echo $row['FirstName'].' '.$row['MiddleName'].' '.$row['LastName']; ?></td>
                            <td><?php echo $row['DOB']; ?></td>
                            <td><?php echo $row['JoiningDate']; ?></td>
                            <td><?php echo $row['RetirementDate']; ?></td>
                            <td><?php echo $row['Address1'].','.$row['Address2']; ?></td>
                            <td><?php echo $row['City']; ?></td>
                            <td><?php echo $row['State']; ?></td>
                            <td><?php echo $row['PinCode']; ?></td>
                            <td><?php echo $row['AddarCardNo']; ?></td>
                            <td><?php echo $row['LicenceNo']; ?></td>
                            <td><?php echo $row['WorkMobileNo']; ?></td>
                            <td><?php echo $row['HomeMobileNo']; ?></td>
                        </tr>
                        <?php
                    }
                    echo "</table>";
                }
            ?>
            </div>
        </main>
        <?php include '../includeFiles/footer.php'; ?>
    </body>
    <script src="../JS/main-script.js"></script>
</html>
