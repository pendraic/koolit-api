<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderId = stripslashes($_POST['serviceOrderId']);
    $serviceOrderRating = stripslashes($_POST['serviceOrderRating']);
    $servOrdRepMsg = stripslashes($_POST['servOrdRepMsg']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sql = 
            "INSERT INTO service_order_report
            (id, description, severityRating, serviceOrderId) 
            VALUES (NULL, '{$servOrdRepMsg}', '{$serviceOrderRating}', '{$serviceOrderId}')";

            if(!mysqli_query($dbConn, $sql))
                throw new Exception($responseDatabaseTaskError . " reporting problem");

            $response = $responseFeedbackReportSuccess . " #{$serviceOrderId}";

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>