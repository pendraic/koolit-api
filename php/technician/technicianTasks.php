<?php

    include '../config.php';
    include '../messages.php';

    $isToday = $_POST['isToday'];
    $technicianId = $_POST['technicianId'];

    $response = "No result";

    if($dbConn){

        //Editing the right hand values carelessly will create errors
        //!!Do not remove the single whitespace
        if($isToday == "True")
            $sqlAppend = " = ";
        elseif($isToday == "False")
            $sqlAppend = " > ";

        $sqlAppend .= "CURRENT_DATE";

        $sql = 
        "SELECT service_order.id, customer.name,
		address.latitude, address.longitude, address.address,
        service_item.imageUrl, service_item.quantity, service_order.totalValue
        FROM service_order
        JOIN customer
        ON service_order.customerId = customer.id
        JOIN address
        ON service_order.addressId = address.id
        JOIN service_item
        ON service_order.serviceItemId = service_item.id
        WHERE service_item.serviceTypeId = 
        (
            SELECT technician.serviceTypeId FROM technician WHERE technician.id = '{$technicianId}'
        ) 
        AND service_order.status = '0'
        AND service_order.quoteStatus = '1'
        AND service_order.technicianId = '{$technicianId}'
        AND service_order.schedule" . $sqlAppend;

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows > 0){
            
            $responseObject = array();

            //Put data here
            //Make sure property reflects object from xamarin app in resources
            while($sqlRow = mysqli_fetch_assoc($sqlResult)){

                $responseObjectItem->Id = $sqlRow['id'];
                $responseObjectItem->CustomerName = $sqlRow['name'];
                $responseObjectItem->AddressLatitude = $sqlRow['latitude'];
                $responseObjectItem->AddressLongitude = $sqlRow['longitude'];
                $responseObjectItem->Address = $sqlRow['address'];
                $responseObjectItem->ImageUrl = $sqlRow['imageUrl'];
                $responseObjectItem->Quantity = $sqlRow['quantity'];
                $responseObjectItem->TotalValue = $sqlRow['totalValue'];

                $responseObject[] = $responseObjectItem;

                unset($responseObjectItem);
            }

            $response = json_encode($responseObject);
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>