<!DOCTYPE html>
<html>
  <head>
    <title>Add Bus Schedule</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <script src="../../JS/addStaff.js"></script>
  </head>
  <body>

  <?php

$TripIdErr = $TripNameErr = $StartLocationErr = $EndLocationErr = $DistancesErr = $PriceErr = $DriverIdErr = $ConductorIdErr = $BusIdErr = "";

$TripId = $TripName = $StartLocation = $EndLocation = $Distances = $Price = $DriverId = $ConductorId = $BusId = "";

//Input fields validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["TripId"])) {
        $TripIdErr = "Trip ID is required";
    } else {
        $TripId = input_data($_POST["TripId"]);
        if (!preg_match("/^[a-zA-Z]*$/", $TripId)) {
            $TripIdErr = "Invalid Trip ID";
        }
    }

    if (empty($_POST["TripName"])) {
        $TripNameErr = "Trip Name is required";
    } else {+
        $TripName = input_data($_POST["TripName"]);
        if (!preg_match("/^[a-zA-Z]*$/", $TripName)) {
            $TripNameErr = "Invalid Trip Name";
        }
    }

    if (empty($_POST["StartLocation"])) {
        $StartLocationErr = "Start Location is required";
    } else {+
        $StartLocation = input_data($_POST["StartLocation"]);
        if (!preg_match("/^[a-zA-Z]*$/", $StartLocation)) {
            $StartLocationErr = "Invalid Start Location";
        }
    }

    if (empty($_POST["EndLocation"])) {
        $EndLocationErr = "End Location is required";
    } else {+
        $EndLocation = input_data($_POST["EndLocation"]);
        if (!preg_match("/^[a-zA-Z]*$/", $EndLocation)) {
            $EndLocationErr = "Invalid End Location";
        }
    }

    if (empty($_POST["Distances"])) {
        $DistancesErr = "Total Distance is required";
    } else {
        $Distances = input_data($_POST["Distances"]);
        if (!preg_match("/^[0-9]{4}$/", $Distances)) {
            $DistancesErr = "Invalid Total Distance";
        }
    }

    if (empty($_POST["Price"])) {
        $PriceErr = "Price is required";
    } else {
        $Price = input_data($_POST["Price"]);
        if (!preg_match("/^[0-9]$/", $Price)) {
            $PriceErr = "Invalid Price";
        }
    }

    if (empty($_POST["DriverId"])) {
        $DriverIdErr = "Driver ID is required";
    } else {
        $DriverId = input_data($_POST["DriverId"]);
        if (!preg_match("/^[0-9]$/", $DriverId)) {
            $DriverIdErr = "Invalid Driver ID";
        }
    }
    
    if (empty($_POST["ConductorId"])) {
        $ConductorIdErr = "Conductor ID is required";
    } else {
        $ConductorId = input_data($_POST["ConductorId"]);
        if (!preg_match("/^[0-9]$/", $ConductorId)) {
            $ConductorIdErr = "Invalid Conductor ID";
        }
    }

    if (empty($_POST["BusId"])) {
        $BusIdErr = "Bus ID is required";
    } else {
        $BusId = input_data($_POST["BusId"]);
        if (!preg_match("/^[0-9]$/", $BusId)) {
            $BusIdErr = "Invalid Bus ID";
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
        <h1>Add Depo</h1>
        <span class = "error">* required field </span><br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

          <label for="TripId">Trip ID: <span class="error">*</span></label>
          <input type="text" id="TripId" name="TripId" value="<?php echo $TripId; ?>" required>
          <span class="error"><?php echo $TripIdErr; ?> </span>
          <br>

          <label for="TripName">Trip Name: <span class="error">*</span></label>
          <input type="text" id="TripName" name="TripName" value="<?php echo $TripName; ?>" required>
          <span class="error"><?php echo $TripNameErr; ?> </span>
          <br>

          <label for="StartLocation">Start Location Name: <span class="error">*</span></label>
          <input type="text" id="StartLocation" name="StartLocation" value="<?php echo $StartLocation; ?>" required>
          <span class="error"><?php echo $StartLocationErr; ?> </span>
          <br>

          <label for="EndLocation">End Location Name: <span class="error">*</span></label>
          <input type="text" id="EndLocation" name="EndLocation" value="<?php echo $EndLocation; ?>" required>
          <span class="error"><?php echo $EndLocationErr; ?> </span>
          <br>

          <label for="Distances">Distances: <span class="error">*</span></label>
          <input type="text" id="Distances" name="Distances" onkeypress="return onlyNumber(event)" value="<?php echo $Distances; ?>" required>
          <span class="error"><?php echo $DistancesErr; ?> </span>
          <br>

          <label for="Price">Price: <span class="error">*</span></label>
          <input type="text" id="Price" name="Price" onkeypress="return onlyNumber(event)" value="<?php echo $Price; ?>" required>
          <span class="error"><?php echo $PriceErr; ?> </span>
          <br>

          <label for="DriverId">Driver Id: <span class="error">*</span></label>
          <input type="text" id="DriverId" name="DriverId" onkeypress="return onlyNumber(event)" value="<?php echo $DriverId; ?>" required>
          <span class="error"><?php echo $DriverIdErr; ?> </span>
          <br>

          <label for="ConductorId">Conductor Id: <span class="error">*</span></label>
          <input type="text" id="ConductorId" name="ConductorId" onkeypress="return onlyNumber(event)" value="<?php echo $ConductorId; ?>" required>
          <span class="error"><?php echo $ConductorIdErr; ?> </span>
          <br>

          <label for="BusId">Bus Id: <span class="error">*</span></label>
          <input type="text" id="BusId" name="BusId" onkeypress="return onlyNumber(event)" value="<?php echo $BusId; ?>" required>
          <span class="error"><?php echo $BusIdErr; ?> </span>
          <br>

          <input type="submit" name="submit" value="Submit"></input>
        </form>
    </div>
  </body>
</html>

