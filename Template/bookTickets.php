<?php
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book Your Tickets</title>
        <link rel="stylesheet" href="../CSS/main.css">
        <script src="../JS/addStaff.js"></script>
    </head>
    <body>
        <?php include '../includeFiles/header.php'; ?>
        <?php require "../includeFiles/connections.php"; ?>
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
        <?php
        $NameErr = $userMobileErr = $AddarCardNoErr  ="";
        $userName =$userMobileNo=$AddarCardNo="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            function input_data($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if (empty($_POST["userName"])) {
                $NameErr = "First Name is required";
            } else {
                $userName = input_data($_POST["userName"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z]*$/", $userName)) {
                    $NameErr = "Only alphabets are allowed";
                }
            }

            if (empty($_POST["userMobileNo"])) {
                $userMobileErr = "Mobile no is required";
            } else {
                $userMobileNo = input_data($_POST["userMobileNo"]);
                // check if mobile no is well-formed
                if (!preg_match("/^[0-9]*$/", $userMobileNo)) {
                    $userMobileErr = "Only numeric value is allowed.";
                }
                //check mobile no length should not be less and greator than 10
                if (strlen($userMobileNo) != 10) {
                    $userMobileErr = "Mobile no must contain 10 digits.";
                }
            }

            if (empty($_POST["AddarCardNo"])) {
                $AddarCardNoErr = "Aadhar Card number is required";
            } else {
                $AddarCardNo = input_data($_POST["AddarCardNo"]);
                // check if Aadhar Card number is a 12-digit number
                if (!preg_match("/^[0-9]{12}$/", $AddarCardNo)) {
                    $AddarCardNoErr = "Aadhar Card number should be a 12-digit number";
                }
            }
        }
        ?>
        <div class="login-box">
            <h1>Book Your Tickets</h1>
            <span class = "error">* required field </span><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

                <label for="userName">Enter Your Name: <span class="error">*</span></label>
                <input type="text" id="userName" name="userName" value="<?php echo $userName; ?>" required>
                <span class="error"><?php echo $NameErr; ?> </span>
                <br>

                <label for="userMobileNo">Enter Mobile No: <span class="error">*</span></label>
                <input type="number" id="userMobileNo" name="userMobileNo" onkeypress="return onlyNumber(event)" value="<?php echo $userMobileNo; ?>" required>
                <span class="error"><?php echo $userMobileErr; ?> </span>
                <br>

                <label for="AddarCardNo">Enter Your AddarCardNo (For Your validity): <span class="error">*</span></label>
                <input type="number" id="AddarCardNo" name="AddarCardNo" onkeypress="return onlyNumber(event)" value="<?php echo $AddarCardNo; ?>" required>
                <span class="error"><?php echo $AddarCardNoErr; ?> </span>
                <br>

                <label for="numberOfperson">Number Of Person: <span class="error">*</span></label>
                <input type="number" id="numberOfperson" name="numberOfperson" required>
                <br>
                
                <label for="pickupcity">Select Your Current Location</label>
                <select name="pickupcity" id="pickupcity">
                    <option value="">SELECT pickupcity</option>
                    <?php
                        $qrysl="SELECT distinct City FROM depo ORDER BY City";
                        $resultsl = $pdo->query($qrysl);
                        if($resultsl->rowCount()>0){
                            while ($row = $resultsl->fetch()) {
                                ?>
                                <option value="<?php echo $row["City"] ?>" ><?php echo $row["City"] ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
                <label for="dropcity">Select Your Destination Location</label>
                <select name="dropcity" id="dropcity">
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
                <label for="Fual">Select Fual Type</label>
                <select name="Fual" id="Fual">
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
                <input type="submit" id="SubmitButton" class="searchbt" value="BOOK">
            </form>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $uname = $_POST['userName'];
                $uMobileNo = $_POST['userMobileNo'];
                $uAddarCardNo = $_POST['AddarCardNo'];
                $numberOfperson = $_POST['numberOfperson'];
                $startlocation = $_POST['pickupcity'];
                $endlocation = $_POST['dropcity'];
                $TicketId="";
                $TicketId=$uname.Strval(rand(1,99999));

                $qry=("SELECT Id FROM depo WHERE DepoName like '".$_POST["pickupcity"].'%'."'");
                $result = $pdo->query($qry);
                $startdepoId = $result->fetch();

                $qry=("SELECT Id FROM depo WHERE DepoName like '".$_POST["dropcity"].'%'."'");
                $result = $pdo->query($qry);
                $enddepoId = $result->fetch();
                
                $qrySeatFual="";

                $qry="SELECT TripId,buses.Id
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
                // busstatus
                if($result->rowCount()>0){
                    $row = $result->fetch();

                    $sql3 = "SELECT availableSeat FROM busstatus WHERE busid = ". $row['Id'];
                    $forseat = $pdo->query($sql3);
                    $availableSeat = $forseat->fetch();

                    $availableSeat['availableSeat']-= $numberOfperson;

                    $sql2 = "UPDATE busstatus SET availableSeat=? WHERE busid = ". $row['Id'];
                    $statement2 = $pdo->prepare($sql2);
                    if($statement2->execute([$availableSeat['availableSeat']])) {

                    }
                    else{
                        echo "Error: Something went wrong";
                    }
                    $sql = "INSERT INTO Tickets(TicketId,username,userPhoneNo,userAddarCardNo, bookedSeats, startlocation,endlocation,TripId)values(?,?,?,?,?,?,?,?)";
                    if ($pdo->prepare($sql)->execute([$TicketId,$uname,$uMobileNo,$uAddarCardNo,$numberOfperson,$startlocation,$endlocation,$row['TripId']])) {
                        unset($pdo);
                        $_SESSION["SessTicketId"]=$TicketId;
                        echo '<script>
                            location.replace("ThankYou.php");
                            </script>';
                        // header("Location: ThankYou.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                else{
                    echo "Error: WE don't have any routes";
            }
            }
        ?>
    </body>
</html>

