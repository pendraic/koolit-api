<?php

    include '../config.php';
    include '../messages.php';

    //'user_account'
    $email = stripslashes($_POST['email']);

    //Make sure property reflects object from xamarin app in resources
    $response = $mailSendError;

    if($dbConn){
        
        try{
            //Configure to use Gmail SMTP server
            ini_set('SMTP', $smtpServer);
            ini_set('smtp_port', $smtpPort);

            //You can make this string more complex by adding more of
            //the user's details to minimize chances of collission
            $userContent = $email . time();

            //Response is an 8-char length string that serves as 
            //the email's confirmation PIN
            $response = substr(strtoupper(hash($hashAlgo, $userContent)), 0, 8);

            //Content of email containing confirmation PIN
            $mailMsg = "This email was sent because you attempted to reset your password. If not, ignore this email\n\n" . "PIN: " . $response;

            //Send Email
            mail($email, $mailTitleResetPwd, $mailMsg);

        }catch(Exception $e){
            $reponse = $e->getMessage();
        }

    }

    echo $response;

    mysqli_close($dbConn);
    
?>