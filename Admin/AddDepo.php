<!DOCTYPE html>
<html>
  <head>
    <title>Add Depo</title>
    <link rel="stylesheet" href="../CSS/main.css">
    <script src="../JS/addStaff.js"></script>
  </head>
  <body>

  <?php
$DepoNameErr = $NoOfPlatformsErr = $Address1Err = $Address2Err = $CityErr = $StateErr = $PinCodeErr = $WorkPhoneNoErr = $SecondPhoneNoErr = "";

$DepoName = $NoOfPlatforms = $Address1 = $Address2 = $City = $State = $PinCode = $WorkPhoneNo = $SecondPhoneNo = "";

//Input fields validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //String Validation
    if (empty($_POST["DepoName"])) {
        $DepoNameErr = "Depo Name is required";
    } else {
        $DepoName = input_data($_POST["DepoName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $DepoName)) {
            $DepoNameErr = "Invalid Depo Name";
        }
    }

    if (empty($_POST["NoOfPlatforms"])) {
        $NoOfPlatformsErr = "Total Platforms is required";
    } else {
        $NoOfPlatforms = input_data($_POST["NoOfPlatforms"]);
        if (!preg_match("/^[0-9]{2}$/", $NoOfPlatforms)) {
            $NoOfPlatformsErr = "Invalid Total Platforms";
        }
    }

    if (empty($_POST["Address1"])) {
        $Address1Err = "Address1 is required";
    }

    if (empty($_POST["City"])) {
        $CityErr = "City is required";
    } else {
        $City = input_data($_POST["City"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $City)) {
            $CityErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["State"])) {
        $StateErr = "State is required";
    } else {
        $State = input_data($_POST["State"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $State)) {
            $StateErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["PinCode"])) {
        $PinCodeErr = "PinCode is required";
    } else {
        $PinCode = input_data($_POST["PinCode"]);
        // check if PinCode contains only numbers and is of length 6
        if (!preg_match("/^[0-9]{6}$/", $PinCode)) {
            $PinCodeErr = "Invalid PinCode";
        }
    }

    if (empty($_POST["WorkMobileNo"])) {
        $WorkMobileNoErr = "Mobile no is required";
    } else {
        $WorkMobileNo = input_data($_POST["WorkMobileNo"]);
        // check if mobile no is well-formed
        if (!preg_match("/^[0-9]*$/", $WorkMobileNo)) {
            $WorkMobileNoErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10
        if (strlen($WorkMobileNo) != 10) {
            $WorkMobileNoErr = "Mobile no must contain 10 digits.";
        }
    }

    if (empty($_POST["SecondPhoneNo"])) {
        // $SecondPhoneNoErr = "Mobile no is required";
    } else {
        $SecondPhoneNo = input_data($_POST["SecondPhoneNo"]);
        // check if mobile no is well-formed
        if (!preg_match("/^[0-9]*$/", $SecondPhoneNo)) {
            $SecondPhoneNoErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10
        if (strlen($SecondPhoneNo) != 10) {
            $SecondPhoneNoErr = "Mobile no must contain 10 digits.";
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

          <label for="DepoName">Depo Name: <span class="error">*</span></label>
          <input type="text" id="DepoName" name="DepoName" value="<?php echo $DepoName; ?>" required>
          <span class="error"><?php echo $DepoNameErr; ?> </span>
          <br>

          <label for="NoOfPlatforms">NoOfPlatforms: <span class="error">*</span></label>
          <input type="text" id="NoOfPlatforms" name="NoOfPlatforms" onkeypress="return onlyNumber(event)" value="<?php echo $NoOfPlatforms; ?>" required>
          <span class="error"><?php echo $NoOfPlatformsErr; ?> </span>
          <br>

          <label for="Address1">Address1: <span class="error">*</span></label>
          <input type="text" id="Address1" name="Address1" value="<?php echo $Address1; ?>" required>
          <span class="error"><?php echo $Address1Err; ?> </span>
          <br>

          <label for="Address2">Address2:</label>
          <input type="text" id="Address2" name="Address2" value="<?php echo $Address2; ?>">
          <span class="error"><?php echo $Address2Err; ?> </span>
          <br>

          <label for="City">City: <span class="error">*</span></label>
          <input type="text" id="City" name="City" value="<?php echo $City; ?>" required>
          <span class="error"><?php echo $CityErr; ?> </span>
          <br>

          <label for="State">State: <span class="error">*</span></label>
          <input type="text" id="State" name="State" value="<?php echo $State; ?>" required>
          <span class="error"><?php echo $StateErr; ?> </span>
          <br>

          <label for="PinCode">PinCode: <span class="error">*</span></label>
          <input type="text" id="PinCode" name="PinCode" onkeypress="return onlyNumber(event)" value="<?php echo $PinCode; ?>" required>
          <span class="error"><?php echo $PinCodeErr; ?> </span>
          <br>

          <label for="WorkMobileNo">Work Mobile No: <span class="error">*</span></label>
          <input type="text" id="WorkMobileNo" name="WorkMobileNo" onkeypress="return onlyNumber(event)" value="<?php echo $WorkMobileNo; ?>" required>
          <span class="error"><?php echo $WorkMobileNoErr; ?> </span>
          <br>

          <label for="SecondPhoneNo">Home Mobile No (Optional):</label>
          <input type="text" id="SecondPhoneNo" name="SecondPhoneNo" onkeypress="return onlyNumber(event)" value="<?php echo $SecondPhoneNo; ?>">
          <span class="error"><?php echo $SecondPhoneNoErr; ?> </span>
          <br>

          <input type="submit" name="submit" value="Submit"></input>
        </form>
    </div>
  </body>
</html>

