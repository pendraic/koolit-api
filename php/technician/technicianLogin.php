<?php
    
    include '../config.php';
    include '../messages.php';

    $technicianEmail = stripslashes($_POST['email']);
    $technicianPassword = hash($hashAlgo , ($_POST['password']));

    //Make sure property reflects object from xamarin app in resources
    $response = "Invalid login attempt";

    if($dbConn){
        $sql = 
           "SELECT technician.*, service_type.name AS serviceName
           FROM technician
           JOIN service_type
           ON service_type.id = technician.serviceTypeId
           WHERE technician.email = '{$technicianEmail}'
           AND technician.password = '{$technicianPassword}'";

        $sqlResult = mysqli_query($dbConn, $sql);

        if($sqlResult->num_rows == 1){
            $sqlRow = mysqli_fetch_assoc($sqlResult);
            
            //Put data here
            //Make sure property reflects object from xamarin app in resources
            $responseObject->Id = $sqlRow['id'];
            $responseObject->Name = $sqlRow['technician_name'];
            $responseObject->ServiceTypeId = $sqlRow['serviceTypeId'];
            $responseObject->Email = $sqlRow['email'];
            $responseObject->ServiceTypeName = $sqlRow['serviceName'];

            $response = json_encode($responseObject);
        }
    }

    echo $response;

    mysqli_close($dbConn);
?>