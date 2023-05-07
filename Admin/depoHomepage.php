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
            <div id="busesDiv" class="adminTable" style="display: block">
            <p>The current time is: <span id="clock"></span></p>
            <table id="busestable" class="display">
            <?php
                require "../includeFiles/connections.php";
                $deponame=$_SESSION["Sessdeponame"].'%';
                // echo ("SELECT * from routestops where DepoId=(SELECT id from depo where DepoName like '".$deponame."')");
                $result = $pdo->query("SELECT * from routestops where DepoId=(SELECT id from depo where DepoName like '".$deponame."')");
                if($result->rowCount()>0)
                {
                    echo " <thead> <tr><th>TripId</th><th>StopIndex</th><th>DepoId</th><th>ArrivalTime</th><th>DepatureTime</th><th>Arrived</th></tr> </thead> <tbody>";
                    // <th>DELETE</th>
                    while($row = $result->fetch()){
                        ?>
                        <tr>
                            <td><?php echo $row['TripId']; ?></td>
                            <td><?php echo $row['StopIndex']; ?></td>
                            <td><?php echo $row['DepoId']; ?></td>
                            <td><?php echo $row['ArrivalTime']; ?></td>
                            <td><?php echo $row['DepatureTime']; ?></td>
                            <td><a href="">Arrived </a></td>
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
    <script src="../JS/main-script.js"></script>
    <!-- this script will automatically add table data to jquery.dataTables -->
    <script>
        $(document).ready( function () {
            $('#busestable').DataTable();
            $('#busscheduletable').DataTable();
            $('#depotable').DataTable();
            $('#stafftable').DataTable();
            
        } );
        showcurrentTime();
    </script>
    <!-- add main script -->
    <script src="../JS/main-script.js"></script>
</html>
