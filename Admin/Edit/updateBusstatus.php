<!DOCTYPE html>
<html>
    <head>
        <title>Edit Depo</title>
        <link rel="stylesheet" href="../../CSS/main.css">
        <script src="../../JS/addStaff.js"></script>
    </head>
    <body>
        <?php
        require "../../includeFiles/connections.php";
        try{
            $sql = "SELECT * FROM busstatus WHERE busid=:busid";
            $res = $pdo->prepare($sql);
            $res->bindValue(':busid',$_REQUEST['busid']);
            $res->execute();
            if($res->rowCount() == 1){
                $row = $res->fetch();
            }
        }
        catch(PDOException $e){
            echo "Error : unable to execute the error".$e->getMessage();
        }
        //Input fields validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // $start = strtotime('12:01:00');
            // $end = strtotime('12:10:00');
            
            $time1=strtotime($_REQUEST['newArrivalTime'].':00');
            $time2=strtotime($_REQUEST['atime']);

            $delay = ($time1 - $time2) / 60;
            $sql = "UPDATE busstatus SET currentDepo=?, delaytimeInminutes=? WHERE busid=?";
            $statement = $pdo->prepare($sql);
            if($statement->execute([$_REQUEST['currentDepo'], $delay,$_REQUEST['busid']])) {
                header("Location: ../depoHomepage.php");
            }
        }
        ?>
        <div class="login-box">
            <h1>Busstatus</h1>
            <span class = "error">* required field </span><br><br>
            <form method="post" action="" >
                <label for="currentDepo">current Depo ID : <span class="error">*</span></label>
                <input type="number" id="currentDepo" name="currentDepo" value="<?php echo $_REQUEST['depoID'];?>" readonly>
                <br>

                <label for="newArrivalTime">Actual Arrival Time <?php echo $_REQUEST['atime'];?> <br> (Write Your Arrival Time) : <span class="error">*</span></label>
                <input type="time" id="newArrivalTime" name="newArrivalTime" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;" required>
                <br>

                <label for="newDepatureTime">Actual Depature Time <?php echo $_REQUEST['dtime'];?> <br> (Write Your Depature Time) : <span class="error">*</span></label>
                <input type="time" id="newDepatureTime" name="newDepatureTime" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;" required>
                <br>

                <input type="submit" name="submit" value="Submit"></input>
            </form>
        </div>
    </body>
</html>

