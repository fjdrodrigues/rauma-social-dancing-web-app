<?php

// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Europe/Berlin');
 
// variables used for jwt
$key = "8334857394520392348230482";
$iss = "http://amordkizomba.c1.biz/";
$aud = "http://amordkizomba.c1.biz/";
$iat = time();
$nbf = $iat + 3;
$exp = $nbf + 600000;

?>