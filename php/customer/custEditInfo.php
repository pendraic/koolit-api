<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);
    $customerName = stripslashes($_POST['name']);
    $customerContactNo = stripslashes($_POST['contactNumber']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){

        try{
            $sql = 
            "UPDATE customer
            SET customer.contactNumber = '{$customerContactNo}',
                customer.customer_name = '{$customerName}'
            WHERE customer.id = '{$customerId}'";
    
            if(!mysqli_query($dbConn, $sql))
                throw new Exception($responseDatabaseTaskError . " updating info");

            $response = $responseProfileUpdate . " info";

        }catch(Exception $e){
            $response = $e->getMessage();
        }
    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>