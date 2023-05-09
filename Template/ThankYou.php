<?php 
if(!isset($_SESSION)){session_start();}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thank YOU</title>
        <link rel="stylesheet" href="../CSS/main.css">
        <script src="../JS/addStaff.js"></script>
    </head>
    <body>
        <?php include '../includeFiles/header.php'; ?>
        <div style="width: 831px;" class="login-box">
            <h1>Thank you for booking :) </h1>
            <h1>Your Ticket ID is </h1>
            <h1>" <?php echo $_SESSION["SessTicketId"] ?> "</h1>
        </div>
    </body>
</html>

