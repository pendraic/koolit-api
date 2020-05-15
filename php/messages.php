<?php

    #Store strings here and add an "include 'php/messages.php'" on the file
    #using any of the following variables
    $responseDatabaseConnectError = "Connection error!";
    $responseDatabaseTaskError = "Task error";

    $responseAddressAdd = "New address created!";
    $responseAddressDeleted = "Address deleted!";
    $responseAddressDeleteError = "Cannot delete address";

    $responseGetQuoteError = "Get quote error";
    $responseGetQuoteSuccessPre = "Service ID #";
    $responseGetQuoteSuccessPost = " requested. Review is available in pending services";

    $responseTaskMarkedRecorded = "Service marked and recorded!";
    $responseProfileUpdate = "Succesfully updated";

    $responseInsertErrorUserAccount = "Create account error!";
    $responseInsertErrorCustomer = "Customer record error!";
    $responseInsertErrorAddress = "Address record error!";

    $responseLogError = "Cannot log your action!";

    $responseFeedbackSuccess = "Feedback submitted for service order";

    $responseIsValidated = " is validated!";
    $responseIsNotValidated = " is not validated!";

    $responseAccUpdCred = "Updated password!";
    $responseAccUpdCredError = "Cannot update password!";

    $responseServOrdAcceptErr = "Error in accepting service order";
    $responseServOrdAcceptSuccess = "Accepted service order!";
    $responseServOrdCancelErr = "Error in cancelling service order";
    $responseServOrdCancelSuccess = "Cancelled service order!";
    $responseServOrdEditErr = "Error in rescheduling service order";
    $responseServOrdEditSuccess = "Rescheduled service order!";

    $responseEmailValidated = "Validated email "; 
    $responseEmailValidationError = "Cannot validate email";

    $responseSignupSuccess = "Account created! Please login and confirm your account";
    $responseSignupErr = "Account not created!";

    $logTitleTaskFinished = "Finished task";
    $logTitleTaskCancelled = "Cancelled task";
    $logTitleServOrdCustAccept = "Customer accepted";
    $logTitleServOrdCustCancel = "Customer cancelled";
    $logTitleServOrdCustEdit = "Customer rescheduled";

    $logTitleTaskMarkUnsuccessful = "Error in modifying service order status";

    $logTitleTaskMarkFinishedLevel = "1"; //Lowest value
    $logTitleTaskMarkUnfinishedLevel = "3"; //Highest value
    $logLvlServOrdCustAccept = "1";
    $logLvlServOrdCustCancel = "1";
    $logLvlServOrdCustEdit = "1";

    //If database values are changed, change all $enum values accordingly too.
    $enumEmployeeTypeManager = "2";

    $taskMarkCancelledReasonHeader = "Task cancelled due to: ";

    $mailTitle = "Kool-IT Confirm account";
    $mailSendError = "Sending mail error";
    
?>