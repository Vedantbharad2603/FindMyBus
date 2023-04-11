<?php
    require("../../includeFiles/connections.php");
    try{
        $sql1 = "DELETE FROM busschedule WHERE DriverId=? or ConductorId=?";
        $statement= $pdo->prepare($sql1);
        $statement->execute([$_REQUEST['id'],$_REQUEST['id']]);
        
        $sql2 = "DELETE FROM staff WHERE Id=?";
        $statement= $pdo->prepare($sql2);
        if($statement->execute([$_REQUEST['id']])) {
            header("Location: ../adminHomepage.php");
        }
    }
    catch(PDOException $e){
        echo "Error : unable to execute the error".$e->getMessage();
    }
?>
