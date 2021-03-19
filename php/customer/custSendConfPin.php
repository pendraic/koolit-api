<?php
    include '../config.php';
    include '../messages.php';

    //'user_account'
    $emailTo = stripslashes($_POST['email']);
    $emailHeader = "From:verify@koolit.online";

    //Make sure property reflects object from xamarin app in resources
    $response = $mailSendError;

    if($dbConn){
        try{
            //You can make this string more complex by adding more of
            //the user's details to minimize chances of collission
            $userContent = $emailTo . time();

            //Response is an 8-char length string that serves as 
            //the email's confirmation PIN
            $response = substr(strtoupper(hash($hashAlgo, $userContent)), 0, 8);

            //Content of email containing confirmation PIN
            $emailMessage = "This email serves as your confirmation\n\n" . "PIN: " . $response;

            //Send Email
            mail($emailTo, $mailTitleConfirm, $emailMessage, $emailHeader);
        }catch(Exception $e){
            $reponse = $e->getMessage();
        }
    }

    echo $response;

    mysqli_close($dbConn);
?>