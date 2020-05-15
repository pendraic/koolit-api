<?php

    include '../config.php';
    include '../messages.php';

    //'customer'
    $customerId = stripslashes($_POST['customerId']);

    //'service_order'
    $serviceOrderSched = stripslashes($_POST['serviceOrderSchedule']);
    $serviceOrderId = stripslashes($_POST['serviceOrderId']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sqlUpd = 
            "UPDATE service_order SET schedule = '{$serviceOrderSched}'
            WHERE service_order.id = '{$serviceOrderId}' ";
    
            if(!mysqli_query($dbConn, $sqlUpd))
                throw new Exception($responseServOrdEditErr);
                
            $response = $responseServOrdEditSuccess;

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>