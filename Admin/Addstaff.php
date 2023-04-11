<!DOCTYPE html>
<html>
  <head>
    <title>Add staff</title>
    <link rel="stylesheet" href="../CSS/main.css">
    <script src="../JS/addStaff.js"></script>
  </head>
  <body>

  <?php

$FirstNameErr = $MiddleNameErr = $LastNameErr = $DOBErr = $JoiningDateErr = $RetirementDateErr = $Address1Err = $Address2Err = $CityErr = $StateErr = $PinCodeErr = $AddarCardNoErr = $AddarCardURLErr = $ProfilePhotoURLErr = $LicenceNoErr = $LicenceURLErr = $WorkMobileNoErr = $SecondPhoneNoErr = "";

$FirstName = $MiddleName = $LastName = $DOB = $JoiningDate = $RetirementDate = $Address1 = $Address2 = $City = $State = $PinCode = $AddarCardNo = $AddarCardURL = $ProfilePhotoURL = $LicenceNo = $LicenceURL = $WorkMobileNo = $SecondPhoneNo = "";

//Input fields validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //String Validation
    if (empty($_POST["FirstName"])) {
        $FirstNameErr = "First Name is required";
    } else {
        $FirstName = input_data($_POST["FirstName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $FirstName)) {
            $FirstNameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["MiddleName"])) {
        $MiddleNameErr = "First Name is required";
    } else {
        $MiddleName = input_data($_POST["MiddleName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $MiddleName)) {
            $MiddleNameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["LastName"])) {
        $LastNameErr = "First Name is required";
    } else {
        $LastName = input_data($_POST["LastName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/", $LastName)) {
            $LastNameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["DOB"]) || $_POST["DOB"] == "dd-mm-yyyy") {
        $DOBErr = "Date of Birth is required";
    } else {
        $DOB = input_data($_POST["DOB"]);
        // check if date is in valid format
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $DOB)) {
            $DOBErr = "Invalid date format";
        }
    }

    if (empty($_POST["JoiningDate"]) || $_POST["JoiningDate"] == "dd-mm-yyyy") {
        $JoiningDateErr = "Joining Date is required";
    } else {
        $JoiningDate = input_data($_POST["JoiningDate"]);
        // check if date is in valid format
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $JoiningDate)) {
            $JoiningDateErr = "Invalid date format";
        }
    }

    if (empty($_POST["RetirementDate"]) || $_POST["RetirementDate"] == "dd-mm-yyyy") {
        // $RetirementDateErr = "Retirement Date is required";
    } else {
        $RetirementDate = input_data($_POST["RetirementDate"]);
        // check if date is in valid format
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $RetirementDate)) {
            $RetirementDateErr = "Invalid date format";
        }
    }

    if (empty($_POST["Address1"])) {
        $LastNameErr = "Address1 is required";
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

    if (empty($_POST["AddarCardNo"])) {
        $AddarCardNoErr = "Aadhar Card number is required";
    } else {
        $AddarCardNo = input_data($_POST["AddarCardNo"]);
        // check if Aadhar Card number is a 12-digit number
        if (!preg_match("/^[0-9]{12}$/", $AddarCardNo)) {
            $AddarCardNoErr = "Aadhar Card number should be a 12-digit number";
        }
    }

    if (empty($_POST["LicenceNo"])) {
        $LicenceNoErr = "License Number is required";
    } else {
        $LicenceNo = input_data($_POST["LicenceNo"]);
        // check if license number matches the required format
        if (!preg_match("/^[A-Z]{2}[0-9]{2}\s[0-9]{4}\s[0-9]{7}$/", $LicenceNo)) {
            $LicenceNoErr = "License Number should be in the format SSRR YYYYNNNNNNN";
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
        <h1>Add staff</h1>
        <span class = "error">* required field </span><br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
        
          <label for="FirstName">FirstName: <span class="error">*</span></label>
          <input type="text" id="FirstName" name="FirstName" value="<?php echo $FirstName; ?>" required>
          <span class="error"><?php echo $FirstNameErr; ?> </span>
          <br>

          <label for="MiddleName">MiddleName: <span class="error">*</span></label>
          <input type="text" id="MiddleName" name="MiddleName" value="<?php echo $MiddleName; ?>" required>
          <span class="error"><?php echo $MiddleNameErr; ?> </span>
          <br>

          <label for="LastName">LastName: <span class="error">*</span></label>
          <input type="text" id="LastName" name="LastName" value="<?php echo $LastName; ?>" required>
          <span class="error"><?php echo $LastNameErr; ?> </span>
          <br>

          <label for="DOB">DOB: <span class="error">*</span></label>
          <input type="date" id="DOB" name="DOB" value="<?php echo $DOB; ?>" required>
          <span class="error"><?php echo $DOBErr; ?> </span>
          <br>

          <label for="JoiningDate">JoiningDate: <span class="error">*</span></label>
          <input type="date" id="JoiningDate" name="JoiningDate" value="<?php echo $JoiningDate; ?>" required>
          <span class="error"><?php echo $JoiningDateErr; ?> </span>
          <br>

          <label for="RetirementDate">RetirementDate:</label>
          <input type="date" id="RetirementDate" name="RetirementDate" value="<?php echo $RetirementDate; ?>">
          <span class="error"><?php echo $RetirementDateErr; ?> </span>
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

          <label for="AddarCardNo">AddarCardNo: <span class="error">*</span></label>
          <input type="text" id="AddarCardNo" name="AddarCardNo" onkeypress="return onlyNumber(event)" value="<?php echo $AddarCardNo; ?>" required>
          <span class="error"><?php echo $AddarCardNoErr; ?> </span>
          <br>

          <label for="AddarCardURL">Upload Aadhar card Photo: <span class="error">*</span></label>
          <input type="file" id="AddarCardURL" name="AddarCardURL" value="<?php echo $AddarCardURL; ?>" accept="image/*" required>
          <span class="error"><?php echo $AddarCardURLErr; ?> </span>
          <br>

          <label for="ProfilePhotoURL">Upload Profile Photo: <span class="error">*</span></label>
          <input type="file" id="ProfilePhotoURL" name="ProfilePhotoURL" value="<?php echo $ProfilePhotoURL; ?>" accept="image/*" required>
          <span class="error"><?php echo $ProfilePhotoURLErr; ?> </span>
          <br>

          <label for="LicenceNo">LicenceNo: <span class="error">*</span></label>
          <input type="text" id="LicenceNo" name="LicenceNo" value="<?php echo $LicenceNo; ?>" required>
          <span class="error"><?php echo $LicenceNoErr; ?> </span>
          <br>

          <label for="LicenceURL">Upload Licence Photo: <span class="error">*</span></label>
          <input type="file" id="LicenceURL" name="LicenceURL" value="<?php echo $LicenceURL; ?>" accept="image/*" required>
          <span class="error"><?php echo $LicenceURLErr; ?> </span>
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

