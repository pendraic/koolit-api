<?php

    include '../config.php';
    include '../messages.php'; 

    //'customer'
    $customerName = stripslashes($_POST['customer_name']);
    $customerContactNumber = stripslashes($_POST['contactNumber']);
    $customerEmail = stripslashes($_POST['email']);
    $customerPassword = hash($hashAlgo , ($_POST['password']));
    $customerId;

    //'address'
    $addressLatitude = stripslashes($_POST['latitude']);
    $addressLongitude = stripslashes($_POST['longitude']);
    $addressText = stripslashes($_POST['address']);
    $customerId;

    //Make sure property reflects object from xamarin app in resources
    $response = $responseSignupErr;

    if($dbConn){
        
        try{

            //Insert to 'customer'
            $sqlCustomer = 
            "INSERT INTO customer (id, customer_name, email, password,  contactNumber, validated) 
             VALUES (NULL, '{$customerName}', '{$customerEmail}', '{$customerPassword}', '{$customerContactNumber}', '0') ";
    
            if(mysqli_query($dbConn, $sqlCustomer))
                $customerId = mysqli_insert_id($dbConn);
            else
                throw new Exception($responseInsertErrorCustomer);
    
            //Insert to 'address' and attach foreign key of 'customer'
            $sqlAddress = 
            "INSERT INTO address (id, latitude, longitude, address, customerId) 
             VALUES (NULL, '{$addressLatitude}', '{$addressLongitude}', '{$addressText}', '{$customerId}') ";
    
            if(!mysqli_query($dbConn, $sqlAddress))
                throw new Exception($responseInsertErrorAddress);

            $response = $responseSignupSuccess;

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }

    echo $response;

    mysqli_close($dbConn);
    
?>