<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderId = stripslashes($_POST["serviceOrderId"]);
    $technicianId = stripslashes($_POST["technicianId"]);

    $response = $logTitleTaskMarkUnsuccessful;

    if($dbConn){
        
        try{
            //Add a 
            $sqlService = 
            "UPDATE service_order
            SET service_order.status = '1'
            WHERE service_order.id = '{$serviceOrderId}'";
    
            if(!mysqli_query($dbConn, $sqlService))
                throw new Exception($responseDatabaseTaskError . " #1");

            $logMessage = 
            "Service order ID #" . $serviceOrderId . 
            " finished by technician ID #"  . $technicianId;  

            //Add new record log
            $sqlLog =
            "INSERT INTO log
            (title, description, level, technicianId) VALUES 
            ('{$logTitleTaskFinished}', '{$logMessage}', '{$logTitleTaskMarkFinishedLevel}', '{$technicianId}') ";

            if(!mysqli_query($dbConn, $sqlLog)){
                throw new Exception($responseDatabaseTaskError . " #2");
            }
    
            $response = $logTitleTaskFinished . " #" . $serviceOrderId;
    
        }catch (Exception $e){
            $reponse = $e->getMessage();
        }

    }else{
        $response = $responseDatabaseConnectError;
    }

    echo $response;

    mysqli_close($dbConn);

?>