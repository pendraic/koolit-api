<?php

    include '../config.php';
    include '../messages.php';

    $customerId = $_POST['customerId'];
    $customerDate =  $_POST['customerDate'];
    $transactDisplay = $_POST['transactDisplay'];
    $sqlCond = "";

    $response = $responseDatabaseTaskError;

    //Editing the right hand values carelessly will create errors
    //!!Do not remove the single whitespace

    if($transactDisplay == "History"){
        $sqlAppend = " < ";
    }
    elseif($transactDisplay == "Pending"){
        $sqlAppend = " >= ";
        $sqlCond = " AND service_order.status = '0' AND service_order.quoteStatus != '2'";
        //Pending tasks are orders that has not yet been declined by the customer and not has yet been
        //marked cancelled or finished by technicians
    }

    $sqlAppend .= $customerDate;

    if($dbConn){

        $sql = 
        "SELECT service_order.id, service_order.schedule, 
        service_order.quoteStatus, service_order.status, 
        service_order.timestamp, service_order.totalValue,
        service_type.name, service_item.imageUrl, service_item.quantity
        FROM service_order
        JOIN customer
        ON service_order.customerId = customer.id
        JOIN service_item
        ON service_order.serviceItemId = service_item.id
        JOIN service_type
        ON service_type.id = service_item.serviceTypeId
        WHERE service_order.customerId = '{$customerId}'
        AND service_order.schedule {$sqlAppend} {$sqlCond}
        ORDER BY service_order.schedule DESC";

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows > 0){
            
            $responseObject = array();

            //Put data here
            //Make sure property reflects object from xamarin app in resources
            while($sqlRow = mysqli_fetch_assoc($sqlResult)){

                $responseObjectItem->Id = $sqlRow['id'];
                $responseObjectItem->Schedule = $sqlRow['schedule'];
                $responseObjectItem->Timestamp = $sqlRow['timestamp'];
                $responseObjectItem->TotalValue = $sqlRow['totalValue'];
                $responseObjectItem->Name = $sqlRow['name'];
                $responseObjectItem->ImageUrl = $sqlRow['imageUrl'];
                $responseObjectItem->QuoteStatus = $sqlRow['quoteStatus'];
                $responseObjectItem->Status = $sqlRow['status'];
                $responseObjectItem->Quantity = $sqlRow['quantity'];

                $responseObject[] = $responseObjectItem;

                unset($responseObjectItem);
            }

            $response = json_encode($responseObject);
        }
    }else
        $response = $responseDatabaseConnectError;

    echo $response;

    mysqli_close($dbConn);
    
?>