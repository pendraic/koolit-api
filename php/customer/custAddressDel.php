<?php

    include '../config.php';
    include '../messages.php';

    //Make sure property reflects object from xamarin app in resources
    //??Maybe customerId is no longer needed since only address record is deleted
    //??however it adds another level of certainty that that is the record to be removed
    //??also you can make the query more complex
    $customerId = stripslashes($_POST['customerId']);
    $addressId = stripslashes($_POST['addressId']);

    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sql = 
            "DELETE FROM address WHERE 
             address.customerId = '{$customerId}' AND
             address.id = '{$addressId}'";
    
            if(mysqli_query($dbConn, $sql))
                $response = $responseAddressDeleted;
            else
                throw new Exception($responseAddressDeleteError);

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>