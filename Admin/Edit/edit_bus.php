<?php
    require "../../includeFiles/connections.php";
    $BusNumberErr = $BusTypeErr = $FualTypeErr = $EngineNoErr = $InsuranceNoErr = $TotalSeatsErr = "";

        $BusNumber = $BusType = $FualType = $EngineNo = $InsuranceNo = $TotalSeats = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        function input_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (empty($_POST["BusNumber"])) {
            $BusNumberErr = "Number plate is required";
        } else {
            $BusNumber = input_data($_POST["BusNumber"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[A-Z]{2}\s[0-9]{2}\s[A-Z]{2}\s[0-9]{4}$/", $BusNumber)) {
                $BusNumberErr = "Invalid number plate format";
            }
        }

        if (empty($_POST["BusType"])) {
            $BusTypeErr = "Bus Type is required";
        }
        // else {
        //     $BusType = input_data($_POST["BusType"]);
        //     // check if name only contains letters and whitespace
        //     if (!preg_match("/^[a-zA-Z]*$/", $BusType)) {
        //         $BusTypeErr = "Only alphabets are allowed";
        //     }
        // }

        if (empty($_POST["FualType"])) {
            $FualTypeErr = "Fual Type is required";
        }
        // else {
        //     $FualType = input_data($_POST["FualType"]);
        //     // check if name only contains letters and whitespace
        //     if (!preg_match("/^[a-zA-Z]*$/", $FualType)) {
        //         $FualTypeErr = "Only alphabets are allowed";
        //     }
        // }

        if (empty($_POST["TotalSeats"])) {
            $TotalSeatsErr = "Total Seats is required";
        } else {
            $TotalSeats = input_data($_POST["TotalSeats"]);
            // check if TotalSeats contains only numbers and is of length 6
            if (!preg_match("/^[0-9]{2}$/", $TotalSeats)) {
                $TotalSeatsErr = "Invalid Total Seats";
            }
        }

        if (empty($_POST["EngineNo"])) {
            $EngineNoErr = "Engine Number is required";
        } else {
            $EngineNo = input_data($_POST["EngineNo"]);
            if (!preg_match("/^[a-zA-Z0-9]*$/", $EngineNo)) {
                $EngineNoErr = "Only alphanumeric characters are allowed";
            }
            // check if engine number has 10 or 12 characters
            elseif (strlen($EngineNo) != 10 && strlen($EngineNo) != 12) {
                $EngineNoErr = "Engine Number should have 10 or 12 characters";
            }
        }

        if (empty($_POST["InsuranceNo"])) {
            $InsuranceNoErr = "Insurance Number is required";
        } else {
            $InsuranceNo = input_data($_POST["InsuranceNo"]);
            if (!preg_match("/^[A-Z]{2}-[0-9]{2}-[0-9]{4}$/", $InsuranceNo)) {
                $InsuranceNoErr = "Invalid Insurance Number format";
            }
        }
        $sql = "UPDATE buses SET BusNumber=?, Type=? ,FualType=? ,TotalSeats=? ,EngineNo=?,InsuranceNo=? WHERE Id=?";
        $statement = $pdo->prepare($sql);
        if($statement->execute([$_REQUEST['BusNumber'], $_REQUEST['BusType'], $_REQUEST['FualType'], $_REQUEST['TotalSeats'],$_REQUEST['EngineNo'],$_REQUEST['InsuranceNo'],$_REQUEST['id']])) {
            header("Location: ../adminHomepage.php");
        }
    }
    try{
        $sql = "SELECT * FROM buses WHERE Id=:id";
        $res = $pdo->prepare($sql);
        $res->bindValue(':id',$_REQUEST['id']);
        $res->execute();
        if($res->rowCount() == 1){
            $row = $res->fetch();
        }   
    }
    catch(PDOException $e){
        echo "Error : unable to execute the error".$e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Bus</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <script src="../../JS/addStaff.js"></script>
</head>
<body>
    <div class="login-box">
        <h1>Edit Bus</h1>
        <span class = "error">* required field </span><br><br>
        <form method="post" action="" >
            <label for="BusNumber">Bus Number: <span class="error">*</span></label>
            <input type="text" id="BusNumber" name="BusNumber" value="<?php if(isset($row['Id'])){echo $row['BusNumber'];}?>" required>
            <span class="error"><?php echo $BusNumberErr; ?> </span>
            <br>

            <label for="BusType">BusType: <span class="error">*</span></label>
            <select name="BusType" id="BusType" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;">
                <option value="Seater">Seater</option>
                <option value="Sleeper">Sleeper</option>
            </select>
            <span class="error"><?php echo $BusTypeErr; ?> </span>
            <br>

            <label for="FualType">FualType: <span class="error">*</span></label>
            <select name="FualType" id="FualType" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;">
                <option value="Electric">Electric</option>
                <option value="Diesel">Diesel</option>
            </select>
            <span class="error"><?php echo $FualTypeErr; ?> </span>
            <br>

            <label for="TotalSeats">TotalSeats: <span class="error">*</span></label>
            <input type="number" id="TotalSeats" name="TotalSeats" onkeypress="return onlyNumber(event)" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;" value="<?php if(isset($row['Id'])){echo $row['TotalSeats'];}?>" required>
            <span class="error"><?php echo $TotalSeatsErr; ?> </span>
            <br>

            <label for="EngineNo">EngineNo: <span class="error">*</span></label>
            <input type="text" id="EngineNo" name="EngineNo" value="<?php if(isset($row['Id'])){echo $row['EngineNo'];}?>" required>
            <span class="error"><?php echo $EngineNoErr; ?> </span>
            <br>

            <label for="InsuranceNo">InsuranceNo: <span class="error">*</span></label>
            <input type="text" id="InsuranceNo" name="InsuranceNo" value="<?php if(isset($row['Id'])){echo $row['InsuranceNo'];}?>" required>
            <span class="error"><?php echo $InsuranceNoErr; ?> </span>
            <br>

            <input type="submit" name="submit" value="Submit"></input>
        </form>
    </div>
</body>
</html>