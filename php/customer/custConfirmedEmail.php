<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);
    $customerEmail = stripslashes($_POST['email']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sql = 
            "SELECT COUNT(*) AS userCount
            FROM customer
            WHERE 
            customer.email = '{$customerEmail}' AND
            customer.id = '{$customerId}' AND
            customer.validated = '1'";

            $sqlResult = mysqli_query($dbConn, $sql);

            $sqlRow = mysqli_fetch_assoc($sqlResult);
            
            //Put data here
            //Make sure property reflects object from xamarin app in resources
            $response = $sqlRow['userCount'];

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>