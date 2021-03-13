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
            "UPDATE customer
            SET 
            customer.email = '{$customerEmail}',
            customer.validated = '0'
            WHERE 
            customer.id = '{$customerId}'";
    
            if(!mysqli_query($dbConn, $sql))
                throw new Exception($responseDatabaseTaskError . " updating email");

            $response = $responseProfileUpdate . " email. Please confirm account!";

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>