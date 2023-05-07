<?php
    require "../../includeFiles/connections.php";
    try{
        $sql1 = "DELETE FROM routestops WHERE TripId in (SELECT TripId from busschedule WHERE BusId=?)";
        $statement= $pdo->prepare($sql1);
        $statement->execute([$_REQUEST['id']]);

        $sql1 = "DELETE FROM busschedule WHERE BusId=?";
        $statement= $pdo->prepare($sql1);
        $statement->execute([$_REQUEST['id']]);
        
        $sql1 = "DELETE FROM buses WHERE Id=?";
        $statement= $pdo->prepare($sql1);
        if($statement->execute([$_REQUEST['id']])) {
            header("Location: ../adminHomepage.php");
        }
    }
    catch(PDOException $e){
        echo "Error : unable to execute the error".$e->getMessage();
    }
?>