<?php
    error_reporting(0);

    $dbServer="localhost";
    
    //XAMPP
    // $dbName = "koolit";
    // $dbUid = "root";
    // $dbPassword = "";

    //HostPapa
    // $dbName = "kooli631_koolit3";
    // $dbUid = "kooli631_dbcomm";
    // $dbPassword = "9LFJM3PTZMISHDUQIB";

    //Hostinger.ph
    $dbName = "u337776481_kooli631_kooli";
    $dbUid = "u337776481_kooli631_dbcom";
    $dbPassword = "t^4n/4n=cH1";

    $dbConn = mysqli_connect($dbServer, $dbUid, $dbPassword, $dbName);
    
	//Other configs
    $dateFormat = "Y-m-d";

    $hashAlgo = 'sha512';
?>