<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- add title -->
    <title>Find My Bus</title>
    <!-- add main style -->
    <link rel="stylesheet" type="text/css" href="../CSS/main.css?ved">

    <!-- this is for data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- add main script -->
    <script src="../JS/main-script.js"></script>
</head>

<body>
    <!-- include header -->
    <?php include '../includeFiles/header.php'; ?>
    <main>
        <div>
            <!-- set choice in php variables -->
            <?php 
                $tmppickup="";
                $tmpdrop="";
                $tmptype="";
                $tmpfual="";
                if (isset($_POST["pickupcity"])){
                    $tmppickup=$_POST["pickupcity"];
                }
                if (isset($_POST["dropcity"])){
                    $tmpdrop=$_POST["dropcity"];
                }
                if (isset($_POST["SeatType"])){
                    $tmptype=$_POST["SeatType"];
                }
                if (isset($_POST["Fual"])){
                    $tmpfual=$_POST["Fual"];
                }
            ?>
            <!-- add all choice for search bus -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="searchdiv">
                    <!-- <input type="hidden" id="form" name="form" value="show_route" > -->
                    <label for="pickupcity">Select Your Current Location</label>
                    <select style="width: 15%;padding: 6px 10px;" name="pickupcity" id="pickupcity">
                        <option value="">SELECT pickupcity</option>
                        <?php
                            $qrysl="SELECT distinct City FROM depo ORDER BY City";
                            $resultsl = $pdo->query($qrysl);
                            if($resultsl->rowCount()>0){
                                while ($row = $resultsl->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["City"] ?>"  <?php if($row["City"]==$tmppickup) echo " SELECTED"; ?>  ><?php echo $row["City"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <label for="dropcity">Select Your Destination Location</label>
                    <select style="width: 15%;padding: 6px 10px;" name="dropcity" id="dropcity">
                        <option value="">SELECT dropcity</option>
                        <?php
                            $qrysl="SELECT distinct City FROM depo ORDER BY City";
                            $resultsl = $pdo->query($qrysl);
                            if($resultsl->rowCount()>0){
                                while ($row = $resultsl->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["City"] ?>"  <?php if($row["City"]==$tmpdrop) echo " SELECTED"; ?>  ><?php echo $row["City"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <label for="SeatType">Select Seat Type</label>
                    <select style="width: 15%;padding: 6px 10px;" name="SeatType" id="SeatType">
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
                    <label for="Fual">Select Fual Type</label>
                    <select style="width: 15%;padding: 6px 10px;" name="Fual" id="Fual">
                        <option value="">ANY</option>
                        <?php
                            $qrysl="SELECT distinct fualType FROM buses WHERE Id in (SELECT BusId FROM busschedule)";
                            $resultst = $pdo->query($qrysl);
                            if($resultst->rowCount()>0){
                                while ($row = $resultst->fetch()) {
                                    ?>
                                    <option value="<?php echo $row["fualType"] ?>" <?php if($row["fualType"]==$tmpfual) echo " SELECTED"; ?> ><?php echo $row["fualType"] ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <input type="submit" id="SubmitButton" class="searchbt" value="Show">
                </div>
            </form>
        </div>
        <!-- this div containes result Routes -->
        <div class="showdata adminTable"  id="datatable" style="display: none;">
            <h2>Routes</h2>
            <table id="routTable" style="color: black;" class="display">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    require "../includeFiles/connections.php";
                    $qrySeatFual="";
                    if((!empty($_POST["SeatType"])) && (!empty($_POST["Fual"]))){
                        $qrySeatFual=" BusId IN(SELECT Id FROM buses WHERE `Type` ='".$_POST["SeatType"]."' AND FualType='".$_POST["Fual"]."') AND ";
                    }
                    if((!empty($_POST["SeatType"]))){
                        $qrySeatFual=" BusId IN(SELECT Id FROM buses WHERE `Type` ='".$_POST["SeatType"]."') AND ";
                    }
                    if((!empty($_POST["Fual"]))){
                        $qrySeatFual=" BusId IN(SELECT Id FROM buses WHERE FualType='".$_POST["Fual"]."') AND ";
                    }
                    if((!empty($_POST["pickupcity"]) && (!empty($_POST["dropcity"]))))
                    {
                        $qry=("SELECT Id FROM depo WHERE DepoName like '".$_POST["pickupcity"].'%'."'");
                        $result = $pdo->query($qry);
                        $startdepoId = $result->fetch();

                        $qry=("SELECT Id FROM depo WHERE DepoName like '".$_POST["dropcity"].'%'."'");
                        $result = $pdo->query($qry);
                        $enddepoId = $result->fetch();

                        $qry="SELECT *,buses.FualType,buses.Type
                            FROM busschedule 
                            inner join buses on busschedule.BusId = buses.Id
                            WHERE ".$qrySeatFual."
                            TripId IN 
                            (SELECT distinct A.TripId
                            FROM routestops A, routestops B
                            WHERE A.TripId = B.TripId
                            AND A.DepoId=$startdepoId[0] 
                            AND B.DepoId=$enddepoId[0]
                            AND A.StopIndex<B.StopIndex)";
                        $result = $pdo->query($qry);
                        if($result->rowCount()>0){
                            echo " <thead> <tr><th>Name</th><th>ID</th><th>Start Location</th><th>End Location </th><th>Distances </th><th>Price(in ₹)</th><th>SeatType</th> <th>fualType</th></tr> </thead> <tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr><td>" . $row["TripName"] . "</td><td>" . $row["TripId"] . "</td><td>" . $row["StartLocation"] . "</td><td>" . $row["EndLocation"]."</td><td>" . $row["Distances"]."</td><td>" . $row["Price"] ."</td><td>" . $row["Type"] ."</td><td>" . $row["FualType"] ."</td></tr>";
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
                }
                ?>
            </table>
        </div>
    </main>
    <!-- include footer -->
    <?php include '../includeFiles/footer.php'; ?>

    <!-- this script will automatically add table data to jquery.dataTables -->
    <script>
        $(document).ready( function () {
            $('#routTable').DataTable();
        } );
    </script>
</body>

</html>