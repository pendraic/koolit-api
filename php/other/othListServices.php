<?php

    include '../config.php';
    include '../messages.php';

    $customerId = stripslashes($_POST['customerId']);

    //Make sure property reflects object from xamarin app in resources
    $response = "No result";

    if($dbConn){
        $sql = 
        "SELECT *
        FROM service_type
        WHERE id > 0
        ORDER BY name";

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows > 0){
            $responseObject = array();

            //Put data here
            //Make sure property reflects object from xamarin app in resources
            while($sqlRow = mysqli_fetch_assoc($sqlResult)){

                $responseObjectItem->Id = $sqlRow['id'];
                $responseObjectItem->Name = $sqlRow['name'];
                $responseObjectItem->Description = $sqlRow['description'];

                $responseObject[] = $responseObjectItem;

                unset($responseObjectItem);
            }

            $response = json_encode($responseObject);
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>