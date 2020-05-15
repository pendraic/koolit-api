<?php

    include '../config.php';
    include '../messages.php';

    //'customer'
    $customerId = stripslashes($_POST['customerId']);

    //'service_order'
    $serviceOrderId = stripslashes($_POST['serviceOrderId']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sqlUpd = 
            "UPDATE service_order SET service_order.quoteStatus = '1'
            WHERE service_order.id = '{$serviceOrderId}' ";
    
            if(!mysqli_query($dbConn, $sqlUpd))
                throw new Exception($responseServOrdAcceptErr);
                
            $response = $responseServOrdAcceptSuccess;

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>