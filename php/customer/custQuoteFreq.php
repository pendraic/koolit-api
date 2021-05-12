<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);

    //Make sure property reflects object from xamarin app in resources
    $response = "Could not retrieve service type frequency!";

    if($dbConn){

        $sql = 
        "SELECT service_type.name as name, COUNT(name) as frequency
        FROM service_order 
        JOIN service_item
        ON serviceItemId = service_item.id
        JOIN service_type
        ON service_item.serviceTypeId = service_type.id
        WHERE customerId = '{$customerId}'
        GROUP BY name";

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows > 0){
                
            $responseObject = array();

            //Put data here
            //Make sure property reflects object from xamarin app in resources
            while($sqlRow = mysqli_fetch_assoc($sqlResult)){

                $responseObjectItem->Name = $sqlRow['name'];
                $responseObjectItem->Frequency = $sqlRow['frequency'];

                $responseObject[] = $responseObjectItem;

                unset($responseObjectItem);
            }

            $response = json_encode($responseObject);
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>