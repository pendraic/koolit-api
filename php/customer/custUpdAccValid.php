<?php

    include '../config.php';
    include '../messages.php';

    //'user_account'
    $email = stripslashes($_POST['email']);

    //Make sure property reflects object from xamarin app in resources
    $response = $responseDatabaseTaskError;

    if($dbConn){
        
        try{

            //Change validated field of 'user_account' record equiv
            //to sent email
            $sqlUserAccount = 
            "UPDATE customer SET validated = 1 WHERE email = '{$email}' ";
    
            if(mysqli_query($dbConn, $sqlUserAccount))
                $response = $responseEmailValidated . $email;
            else
                throw new Exception($responseEmailValidationError . '{$email}');

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>