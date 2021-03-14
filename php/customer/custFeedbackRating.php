<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderRating = stripslashes($_POST['serviceOrderRating']);
    $serviceOrderId = stripslashes($_POST['serviceOrderId']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sql = 
            "UPDATE service_order
            SET rating = '{$serviceOrderRating}' 
            WHERE service_order.id = {$serviceOrderId}";
    
            if(!mysqli_query($dbConn, $sql))
                throw new Exception($responseDatabaseTaskError . " cannot update rating");

            $response = $responseFeedbackRatingSuccess . " #{$serviceOrderId}";

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>