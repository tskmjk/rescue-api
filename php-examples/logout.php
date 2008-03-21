<?php
include("lib/nusoap.php");

//set up client connection
$soapclient = new soapclient("https://secure.logmeinrescue.com/API/API.asmx?WSDL", true);

// create a proxy so that WSDL methods can be accessed directly
$proxy = $soapclient->getProxy();

//log out
$logoutResult = $proxy->logout();

//print the result
echo "<b>Logout full response.</b><br />";		//formatting
print_r($logoutResult);
echo "<br /><br />";					//formatting

?>