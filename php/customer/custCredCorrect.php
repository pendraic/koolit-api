<?php

    include '../config.php';
    include '../messages.php';

    //'user_account'
    $customerId = stripslashes($_POST['customerId']);
    $customerPass = hash($hashAlgo , ($_POST['password']));

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sql = 
            "SELECT COUNT(*) AS userCount
            FROM customer
            WHERE customer.password = '{$customerPass}' AND
            customer.id = '{$customerId}'";
    
            $sqlResult = mysqli_query($dbConn, $sql);

            $sqlRow = mysqli_fetch_assoc($sqlResult);
                
            $response = $sqlRow['userCount'];

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>