<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderRating = stripslashes($_POST['serviceOrderRating']);
    $serviceOrderId = stripslashes($_POST['serviceOrderId']);
    $servOrdRepSevRat = stripslashes($_POST['servOrdRepSevRat']);
    $servOrdRepMsg = stripslashes($_POST['servOrdRepMsg']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sqlServOrd = 
            "UPDATE service_order
            SET rating = '{$serviceOrderRating}' 
            WHERE service_order.id = {$serviceOrderId}";
    
            if(!mysqli_query($dbConn, $sqlServOrd))
                throw new Exception($responseDatabaseTaskError . " cannot update rating");

            $sqlServOrdRep = 
            "INSERT INTO service_order_report
            (id, description, severityRating, serviceOrderId) 
            VALUES (NULL, '{$servOrdRepMsg}', '{$servOrdRepSevRat}', '{$serviceOrderId}')";

            if(!mysqli_query($dbConn, $sqlServOrdRep))
                throw new Exception($responseDatabaseTaskError . " reporting problem");

            $response = $responseFeedbackSuccess . " #{$serviceOrderId}";

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>