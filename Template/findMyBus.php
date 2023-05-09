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
            <!-- add all choice for search bus -->
            <form method="POST" action="">
                <div class="searchdiv">
                    <!-- <input type="hidden" id="form" name="form" value="show_route" > -->
                    <label for="TicketId">ENTER YOUR TicketId to find bus</label>
                    <input type="text" name="TicketId" id="TicketId" placeholder="NAME12345">
                    
                    <input type="submit" id="SubmitButton" class="searchbt" value="Show">
                </div>
            </form>
        </div>
        <!-- this div containes result Routes -->
        <div class="showdata adminTable"  id="datatable" style="display: none;">
            <h2>YOUR BUS</h2>
            <table id="routTable" style="color: black;" class="display">
                <?php
                echo '<script>
                    showroute();
                </script>';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    require "../includeFiles/connections.php";
                    if((!empty($_POST["TicketId"]))){
                        $qry=("SELECT TripId,startlocation FROM Tickets WHERE TicketId='".$_POST["TicketId"])."'";
                        $result = $pdo->query($qry);
                        $row = $result->fetch();
                        
                        $qry=("SELECT Id FROM depo WHERE DepoName like '".$row["startlocation"].'%'."'");
                        $result = $pdo->query($qry);
                        $startdepoId = $result->fetch();
                        $MYTripId=$row["TripId"];
                        $MYstartdepoId = $startdepoId['Id'];
                        $qry=("SELECT ArrivalTime FROM routestops WHERE TripId='" .$MYTripId ."' AND DepoId =$MYstartdepoId");
                        
                        $result = $pdo->query($qry);
                        $ArrivalTime = $result->fetch();
                        // echo $row["TripId"];
                        $qry=("SELECT BusId FROM busschedule WHERE TripId='".$row["TripId"])."'";
                        $result = $pdo->query($qry);
                        $busid = $result->fetch();

                        $qry=("SELECT currentDepo,delaytimeInminutes FROM busstatus WHERE busid='".$busid["BusId"])."'";
                        $about = $pdo->query($qry);
                        $row = $about->fetch();

                        $qry=("SELECT City FROM depo WHERE Id='".$row["currentDepo"]."'");
                        $result = $pdo->query($qry);
                        $temp = $result->fetch();
                        
                        $nowDeo=$temp['City'];
                        $nowdelay=$row['delaytimeInminutes'];
                        // print_r ($row);
                        $time = strtotime($ArrivalTime['ArrivalTime']);
                        $NewArrivalTime = date("H:i", strtotime('+'.$row['delaytimeInminutes'].' minutes', $time));
                        // $about = $result->fetch();
                        if($about->rowCount()>0){
                            echo " <thead> <tr><th>Current Depo</th><th>Delay Time In Minutes</th><th>ArrivalTime</th></tr> </thead> <tbody>";
                            echo "<tr><td>" . $nowDeo . "</td><td>" . $row["delaytimeInminutes"] . "</td><td>" . $NewArrivalTime . "</td></tr>";
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