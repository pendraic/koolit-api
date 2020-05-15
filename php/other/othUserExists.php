<?php

    include '../config.php';
    include '../messages.php';

    $userEmail = stripslashes($_POST['email']);

    if($dbConn){
        $sql = 
        "SELECT COUNT(*) AS userCount
        FROM user_account
        WHERE user_account.email = '{$userEmail}'";

        $sqlResult = mysqli_query($dbConn, $sql);

        $sqlRow = mysqli_fetch_assoc($sqlResult);
            
        //Put data here
        //Make sure property reflects object from xamarin app in resources
        $response = $sqlRow['userCount'];
    }

    echo $response;

    mysqli_close($dbConn);
?>