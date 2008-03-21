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
echo "<br /><br />";				//formatting

//get account info
$sCField0 = "some customer";
$sCField1 = "first custom field";
$sCField2 = "second custom field";
$sCField3 = "third custom field";
$sCField4 = "fourth custom field";
$sCField5 = "fifth custom field";
$sTracking0 = $sCField0 . date("c");		//to ensure unique 

//create params array for SOAP request
$requestPINCodeParams = array(
'sCField0' => $sCField0,
'sCField1' => $sCField1,
'sCField2' => $sCField2,
'sCField3' => $sCField3,
'sCField4' => $sCField4,
'sCField5' => $sCField5,
'sTracking0' => $sTracking0
);

$requestPINCodeResult = $proxy->requestPINCode($requestPINCodeParams);

//print out the PIN Code full response
print_r("<b>requestPINCode full response.</b><br />");
print_r($requestPINCodeResult);
echo "<br /><br />";			//formatting

//show the PIN code only
$PINCode = $requestPINCodeResult["iPINCode"];

//print PIN Code
print_r("<b>PIN Code.</b><br />");
print_r($PINCode);

?>