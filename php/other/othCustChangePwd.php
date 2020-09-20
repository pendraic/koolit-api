<?php

    include '../config.php';
    include '../messages.php';

    $userEmail = stripslashes($_POST['email']);
    $userPwd = hash($hashAlgo , ($_POST['password']));

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            $sql = 
            "UPDATE customer
            SET customer.password = '{$userPwd}'
            WHERE customer.email = '{$userEmail}'";
    
            if(mysqli_query($dbConn, $sql))
                $response = $responseAccResetPwd;
            else
                throw new Exception($responseAccResetPwdErr);

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

        $response .= $userEmail;

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>