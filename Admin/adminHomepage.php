<!DOCTYPE html>
<html>
    <head>
        <!-- add title -->
    <title>Find My Bus</title>
    <!-- add main style -->
    <link rel="stylesheet" type="text/css" href="../CSS/main.css?ved">

    <!-- this is for data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
            <div id="busesDiv" class="adminTable" style="display: block">
            <table id="busestable" class="display">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM buses");
                if($result->rowCount()>0)
                {
                    echo " <thead> <tr><th>ID</th><th>Bus Number</th><th>SeatType</th><th>Total Seats</th><th>EngineNo</th><th>Insurance No</th><th>Fual Type</th><th>ACTION</th></tr> </thead> <tbody>";
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
                            <td><?php echo $row['fualType']; ?></td>
                            <td><a href="edit_buses.php?id=<?php echo $row['Id'];?>">Edit </a>  | <a href="delete_cars.php?id=<?php echo $row['Id'];?>" onclick="return confirm('Are you sure to delete it?');">DELETE </a></td>
                            
                        </tr>
                        <?php
                    }
                    echo "<tbody>";
                    echo "</table>";
                }
            ?>
            </div>
            <div id="busscheduleDiv" class="adminTable" style="display:none">
            <table id="busscheduletable" class="display">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM busschedule");
                if($result->rowCount()>0)
                {
                    echo " <thead> <tr><th>Trip ID</th><th>Name</th><th>Start Location</th><th>End Location</th><th>Distances(in KM)</th><th>Price (in ₹)</th></tr> </thead> <tbody>";
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
                    echo "<tbody>";
                    echo "</table>";
                }
            ?>
            </div>
            <div id="depoDiv" style="display:none" class="adminTable">
            <table id="depotable" class="display">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM depo");
                if($result->rowCount()>0)
                {
                    echo "<thead> <tr><th>ID</th><th>Name</th><th>No of Platforms</th><th>Address</th><th>City</th><th>State</th><th>Pin Code</th><th>Work Phone No</th><th>Second Phone No</th></tr> </thead> <tbody>";
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
                    echo "<tbody>";
                    echo "</table>";
                }
            ?>
            </div>
            <div id="routestopDiv" style="display:none" class="adminTable">
            <h2>Working on that</h2>
            </div>
            <div id="staffDiv" style="display:none" class="adminTable">
            <table id="stafftable" class="display">
            <?php
                require "../includeFiles/connections.php";
                $result = $pdo->query("SELECT * FROM staff");
                if($result->rowCount()>0)
                {
                    echo "<thead> <tr><th>Id</th> <th>Type</th> <th>Name</th> <th>DOB</th> <th>JoiningDate</th> <th>RetirementDate</th> <th>Address</th> <th>City</th> <th>State</th> <th>PinCode</th> <th>AddarCardNo</th> <th>LicenceNo</th> <th>WorkMobileNo</th> <th>HomeMobileNo</th> <th>Actions</th> </tr> </thead> <tbody>";
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
                            <td><a href="Edit/Editstaff.php?id=<?php echo $row['Id'];?>">Edit </a>  | <a href="Delete/Deletestaff.php?id=<?php echo $row['Id'];?>" onclick="return confirm('Are you sure to delete it? It will effect on Busschedule Data Table');">DELETE </a></td>
                        </tr>
                        <?php
                    }
                    echo "<tbody>";
                    echo "</table>";
                }
            ?>
            </div>
        </main>
        <?php include '../includeFiles/footer.php'; ?>
    </body>
    <!-- this script will automatically add table data to jquery.dataTables -->
    <script>
        $(document).ready( function () {
            $('#busestable').DataTable();
            $('#busscheduletable').DataTable();
            $('#depotable').DataTable();
            $('#stafftable').DataTable();
            
        } );
    </script>
    <!-- add main script -->
    <script src="../JS/main-script.js"></script>
</html>
