<?php
include("../lib/nusoap.php");

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

//set up array for request
$delimiterparams = array(
""
);

$getDelimiterResponse = $proxy->getDelimiter($delimiterparams);

//print the delimiter results
print_r("<b>getDelimiter full response.</b><br />");
print_r($getDelimiterResponse);

?>