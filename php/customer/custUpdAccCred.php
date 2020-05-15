<?php

    include '../config.php';
    include '../messages.php';

    //'technician'
    $customerId = stripslashes($_POST['customerId']);
    $customerPass = hash($hashAlgo , ($_POST['password']));

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sql = 
            "UPDATE customer
            SET customer.password = '{$customerPass}'
            WHERE customer.id = '{$customerId}'";
    
            if(mysqli_query($dbConn, $sql))
                $response = $responseAccUpdCred;
            else
                throw new Exception($responseAccUpdCredError);

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>