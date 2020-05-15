<?php
    error_reporting(0);

    $dbServer="localhost";
    
    //XAMPP
    $dbName = "koolit";
    $dbUid = "root";
    $dbPassword = "";

    //HostPapa
    // $dbName = "kooli631_koolit";
    // $dbUid = "kooli631_dbcomm";
    // $dbPassword = "9LFJM3PTZMISHDUQIB";

    $dbConn = mysqli_connect($dbServer, $dbUid, $dbPassword, $dbName);
    
	//Other configs
    $dateFormat = "Y-m-d";

    $hashAlgo = 'sha512';

    $smtpServer = "mail.koolit.xyz";
    $smtpPort = "467";
?>