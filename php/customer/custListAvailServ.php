<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);

    //Make sure property reflects object from xamarin app in resources
    $response = "No result";

    if($dbConn){
        $sql = 
        "SELECT service_order.id, service_order.schedule, service_type.name
        FROM service_order
        JOIN service_item
        ON service_order.serviceItemId = service_item.id
        JOIN service_type
        ON service_type.id = service_item.serviceTypeId
        AND service_order.customerId = '{$customerId}'
        WHERE service_order.schedule <= CURRENT_DATE
        AND service_order.status != '0'
        ORDER BY service_order.schedule DESC LIMIT 10";

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows > 0){
            $responseObject = array();

            //Put data here
            //Make sure property reflects object from xamarin app in resources
            while($sqlRow = mysqli_fetch_assoc($sqlResult)){

                $responseObjectItem->Id = $sqlRow['id'];
                $responseObjectItem->Schedule = $sqlRow['schedule'];
                $responseObjectItem->Name = $sqlRow['name'];

                $responseObject[] = $responseObjectItem;

                unset($responseObjectItem);
            }

            $response = json_encode($responseObject);
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>