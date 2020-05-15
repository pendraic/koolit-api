<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);
    $addrLatitude = stripslashes($_POST['latitude']);
    $addrLongitude = stripslashes($_POST['longitude']);
    $addrText = stripslashes($_POST['address']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sql = 
            "INSERT INTO address (id, latitude, longitude, address, customerId)
            VALUES (NULL, '{$addrLatitude}', '{$addrLongitude}', '{$addrText}', '{$customerId}') ";
    
            if(!mysqli_query($dbConn, $sql))
                throw new Exception($responseDatabaseTaskError . "cannot add address");

            $response = $responseAddressAdd;

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>