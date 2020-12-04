<?php

    include '../config.php';
    include '../messages.php'; 

    //'service_item'
    $itemImgUrl = stripslashes($_POST['serviceItemImageUrl']);
    $itemQuantity = stripslashes($_POST['serviceItemQuantity']);
    $itemServTypeId = stripslashes($_POST['serviceTypeId']);
    $itemId;

    //'service_order'
    $orderSchedule = stripslashes($_POST['serviceOrderSchedule']);
    $orderAddress = stripslashes($_POST['addressId']);
    $orderCustomer = stripslashes($_POST['customerId']);
    $orderId;

    $response = $responseGetQuoteError;

    if($dbConn){
        
        try{

            //Insert to 'service_item'
            $sqlItem = 
            "INSERT INTO service_item (id, imageUrl, quantity, serviceTypeId)
             VALUES (NULL, '{$itemImgUrl}', '{$itemQuantity}', '{$itemServTypeId}')";
    
            if(mysqli_query($dbConn, $sqlItem))
                $itemId = mysqli_insert_id($dbConn);
            else
                throw new Exception($responseDatabaseTaskError . " service item");
    
            //Insert to 'customer' and attach foreign key to 'user_account'
            $sqlOrder = 
            "INSERT INTO service_order 
            (
             id, 
             totalValue,
             status,
             schedule,
             timestamp,
             rating,
             serviceItemId,
             employeeId,
             technicianId,
             addressId,
             customerId,
             quoteStatus,
             technicianNotes
            ) VALUES 
            (
             NULL,
             '0',
             '0', 
             '{$orderSchedule}',
             CURRENT_TIMESTAMP,
             '0',
             '{$itemId}',
             (SELECT id FROM employee WHERE employee.user_type = '{$enumEmployeeTypeManager}' LIMIT 1),
             '0',
             '{$orderAddress}',
             '{$orderCustomer}',
             '0',
             ''
            )";

            //Value for $enumEmployeeTypeManager can be found in ../messages.php at line 61
    
            if(mysqli_query($dbConn, $sqlOrder))
                $orderId = mysqli_insert_id($dbConn);
            else
                throw new Exception($responseDatabaseTaskError . " service order");

            //Proper response
            $response = $responseGetQuoteSuccessPre . $orderId . $responseGetQuoteSuccessPost;

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>