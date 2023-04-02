<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Find My Bus</title>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css?ved">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script src="../JS/main-script.js"></script>
</head>

<body>
    <?php include '../includeFiles/header.php'; ?>
    <main>
        <div>
            <?php 
                $tmppickup="";
                $tmpdrop="";
                $tmptype="";
                if (isset($_POST["pickupcity"])){
                    $tmppickup=$_POST["pickupcity"];
                }
                if (isset($_POST["dropcity"])){
                    $tmpdrop=$_POST["dropcity"];
                }
                if (isset($_POST["SeatType"])){
                    $tmptype=$_POST["SeatType"];
                }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="searchdiv">
                    <input type="hidden" id="form" name="form" value="show_route" >
                    <select name="pickupcity" id="pickupcity">
                        <option value="">ANY</option>
                        <?php
                            $qrysl="SELECT distinct StartLocation FROM busschedule ORDER BY StartLocation";
                            $resultsl = $pdo->query($qrysl);
                            if($resultsl->rowCount()>0){
                                while ($row = $resultsl->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["StartLocation"] ?>"  <?php if($row["StartLocation"]==$tmppickup) echo " SELECTED"; ?>  ><?php echo $row["StartLocation"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <!-- <input class="searchcity" type="text" id="pickupcity" name="pickupcity" placeholder="Pickup city"> -->
                    <!-- <input class="searchcity" type="text" id="dropcity" name="dropcity" placeholder="Drop city"> -->
                    <select name="dropcity" id="dropcity">
                        <option value="">ANY</option>
                        <?php
                            $qrysl="SELECT distinct EndLocation FROM busschedule ORDER BY EndLocation";
                            $resultel = $pdo->query($qrysl);
                            if($resultel->rowCount()>0){
                                while ($row = $resultel->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["EndLocation"] ?>" <?php if($row["EndLocation"]==$tmpdrop) echo " SELECTED"; ?> ><?php echo $row["EndLocation"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <select name="SeatType" id="SeatType">
                        <option value="">ANY</option>
                        <?php
                            $qrysl="SELECT distinct Type FROM buses WHERE Id in (SELECT BusId FROM busschedule)";
                            $resultst = $pdo->query($qrysl);
                            if($resultst->rowCount()>0){
                                while ($row = $resultst->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["Type"] ?>"  <?php if($row["Type"]==$tmptype) echo " SELECTED"; ?>  ><?php echo $row["Type"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <input type="submit" id="SubmitButton" class="searchbt" value="Show">
                </div>
            </form>
        </div>
        <div class="showdata"  id="datatable">
            <h2>Routes</h2>
            <table id="routTable" class="display">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    require "../includeFiles/connections.php";
                    $qry="SELECT *,(SELECT `Type` From Buses WHERE Id=busschedule.BusId ) as `seatType`  FROM busschedule WHERE 1=1 ";
                    if(!empty($_POST["pickupcity"]))
                    {
                        $qry=$qry." AND StartLocation = '".$_POST["pickupcity"] ."' ";
                    }
                    if(!empty($_POST["dropcity"]))
                    {
                        $qry=$qry." AND EndLocation = '".$_POST["dropcity"] ."'";
                    }
                    if(!empty($_POST["SeatType"]))
                    {
                        $qry = $qry." AND BusId in (SELECT Id FROM buses WHERE Type='". $tmptype ."')";
                    }
                    $result = $pdo->query($qry);
                    if($result->rowCount()>0){
                        echo " <thead> <tr><th>ID</th><th>Name</th><th>Start Location</th><th>End Location </th><th>Distances </th><th>Price(in ₹)</th><th>SeatType</th></tr> </thead> <tbody>";
                        while ($row = $result->fetch()) {
                            echo "<tr><td>" . $row["TripId"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["StartLocation"] . "</td><td>" . $row["EndLocation"]."</td><td>" . $row["Distances"]."</td><td>" . $row["Price"] ."</td><td>" . $row["seatType"] ."</td></tr>";
                        }
                        echo "<tbody>";
                        echo '<script>
                                    showroute();
                                </script>';
                    } 
                    else {
                        echo "No routes found.";
                    }
                }
                ?>
            </table>
        </div>
    </main>
    <?php include '../includeFiles/footer.php'; ?>
    <script>
        $(document).ready( function () {
            $('#routTable').DataTable();
        } );
    </script>
</body>

</html>