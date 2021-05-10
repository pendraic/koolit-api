<?php

    include '../config.php';
    include '../messages.php';

    $customerEmail = stripslashes($_POST['email']);
    $customerPassword = hash($hashAlgo , ($_POST['password']));

    //Make sure property reflects object from xamarin app in resources
    $response = "Invalid login attempt";

    if($dbConn){

        $sql = 
        "SELECT *
        FROM customer
        WHERE customer.email = '{$customerEmail}'
        AND customer.password = '{$customerPassword}'";
    
        $sqlResult = mysqli_query($dbConn, $sql);
    
        if($sqlResult->num_rows == 1){
            $sqlRow = mysqli_fetch_assoc($sqlResult);
                
            //Put data here
            //Make sure property reflects object from xamarin app in resources
            $responseObject->Id = $sqlRow['id'];
            $responseObject->Name = $sqlRow['customer_name'];
            $responseObject->ContactNumber = $sqlRow['contactNumber'];
            $responseObject->Email = $sqlRow['email'];
            $responseObject->Validated = $sqlRow['validated'];
    
            $response = json_encode($responseObject);
        }
        
    }

    echo $response;

    mysqli_close($dbConn);
    
?>