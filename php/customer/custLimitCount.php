<?php

    include '../config.php';
    include '../messages.php';

    $serviceOrderId = stripslashes($_POST['serviceOrderId']);

    //Make sure property reflects object from xamarin app in resources
    $response = "No result";

    if($dbConn){
        $sql =
        "SELECT service_order.reschedule_limit
        FROM service_order
        WHERE service_order.id = '{$serviceOrderId}'";

        $sqlResult = mysqli_query($dbConn, $sql);
    
        if($sqlResult->num_rows == 1){
            $sqlRow = mysqli_fetch_assoc($sqlResult);
                
            //Put data here
            //Make sure property reflects object from xamarin app in resources
            $response = $sqlRow['reschedule_limit'];
        }
    }

    echo $response;

    mysqli_close($dbConn);
    
?>