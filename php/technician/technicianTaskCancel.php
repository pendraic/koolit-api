<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderId = stripslashes($_POST["serviceOrderId"]);
    $technicianId = stripslashes($_POST["technicianId"]);
    $reasonCancel = stripslashes($_POST["reasonCancel"]);

    $response = $logTitleTaskMarkUnsuccessful;

    if($dbConn){
        
        try{
            //Change service order status to cancelled
            $sqlService = 
            "UPDATE service_order SET
            service_order.status = '0',
            service_order.technicianNotes = '{$reasonCancel}'
            WHERE service_order.id = '{$serviceOrderId}'";
    
            if(!mysqli_query($dbConn, $sqlService))
                throw new Exception($responseDatabaseTaskError . " update status");

            $logMessage = 
            "Service order ID #" . $serviceOrderId . 
            " cancelled by technician ID #"  . $technicianId;  

            //Add new record to 'log'
            $sqlLog =
            "INSERT INTO log
            (title, description, level, technicianId) VALUES 
            ('{$logTitleTaskCancelled}', '{$logMessage}', '{$logTitleTaskMarkUnfinishedLevel}', '{$technicianId}') ";

            if(!mysqli_query($dbConn, $sqlLog))
                throw new Exception($responseDatabaseTaskError . " log recording");

            $response = $logTitleTaskCancelled . " #" . $serviceOrderId;
    
        }catch (Exception $e){
            $reponse = $e->getMessage();
        }
        
    }else{
        $response = $responseDatabaseConnectError;
    }

    echo $response;

    mysqli_close($dbConn);

?>