<?php
include("lib/nusoap.php");

//set up client connection
$soapclient = new soapclient("https://secure.logmeinrescue.com/API/API.asmx?WSDL", true);

// create a proxy so that WSDL methods can be accessed directly
$proxy = $soapclient->getProxy();

//define parameters
$loginparams = array (
'sEmail' => 'someEmail@domain.com',
'sPassword' => 'secretPassword'
);

//login
$loginResult = $proxy->login($loginparams);

//print the result
echo "<b>Login full response.</b><br />";		//formatting
print_r($loginResult);
echo "<br /><br />";					//formatting

//set up array for SOAP request

$timezone = -240;  //UTC -4 hours = = -240 minutes (EST during Daylight Savings)
$setTimezoneParams = array(
'sTimezone' => $timezone
);

$setTimezoneResult = $proxy->setTimezone($setTimezoneParams);

//print out the setTimeZone full response
print_r("<b>setTimeZone full response.</b><br />");
print_r($setTimezoneResult);
echo "<br /><br />";					//formatting

?>