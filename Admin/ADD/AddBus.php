<!DOCTYPE html>
<html>
    <head>
        <title>Add Bus</title>
        <link rel="stylesheet" href="../../CSS/main.css">
        <script src="../../JS/addStaff.js"></script>
    </head>
    <body>

        <?php

        $BusNumberErr = $BusTypeErr = $FualTypeErr = $EngineNoErr = $InsuranceNoErr = $TotalSeatsErr = "";

        $BusNumber = $BusType = $FualType = $EngineNo = $InsuranceNo = $TotalSeats = "";

        //Input fields validation
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //String Validation
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
        }

        function input_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <div class="login-box">
            <h1>Add Bus</h1>
            <span class = "error">* required field </span><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            
                <label for="BusNumber">Bus Number: <span class="error">*</span></label>
                <input type="text" id="BusNumber" name="BusNumber" placeholder="ABC123" value="<?php echo $BusNumber; ?>" required>
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
                <input type="number" id="TotalSeats" name="TotalSeats" onkeypress="return onlyNumber(event)" style="padding: 12px 20px;border-radius: 4px;border: 1px solid #ccc;" value="<?php echo $TotalSeats; ?>" required>
                <span class="error"><?php echo $TotalSeatsErr; ?> </span>
                <br>

                <label for="EngineNo">EngineNo: <span class="error">*</span></label>
                <input type="text" id="EngineNo" name="EngineNo" placeholder="123456" value="<?php echo $EngineNo; ?>" required>
                <span class="error"><?php echo $EngineNoErr; ?> </span>
                <br>

                <label for="InsuranceNo">InsuranceNo: <span class="error">*</span></label>
                <input type="text" id="InsuranceNo" name="InsuranceNo" placeholder="INS123" value="<?php echo $InsuranceNo; ?>" required>
                <span class="error"><?php echo $InsuranceNoErr; ?> </span>
                <br>

                <input type="submit" name="submit" value="Submit"></input>
            </form>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require "../../includeFiles/connections.php";
                $BusNumber1 = $_POST['BusNumber'];
                $BusType1 = $_POST['BusType'];
                $FualType1 = $_POST['FualType'];
                $TotalSeats1 = $_POST['TotalSeats'];
                $EngineNo1 = $_POST['EngineNo'];
                $InsuranceNo1 = $_POST['InsuranceNo'];
                $sql = "INSERT INTO buses(BusNumber, `Type`,FualType,TotalSeats, EngineNo, InsuranceNo)values(?,?,?,?,?,?)";
                if ($pdo->prepare($sql)->execute([$BusNumber1,$BusType1,$FualType1,$TotalSeats1,$EngineNo1,$InsuranceNo1])) {
                    unset($pdo);
                    header("Location: ../adminHomepage.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
            }
        ?>
    </body>
</html>

