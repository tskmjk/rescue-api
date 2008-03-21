<?php
include("lib/nusoap.php");

//define variables
$sEmail = "someEmail@domain.com";
$sPassword = "secretPassword";

//set up client connection
$soapclient = new soapclient("https://secure.logmeinrescue.com/API/API.asmx?WSDL", true);

// Check for an error
$err = $soapclient->getError();
if ($err) {
    // Display the error
    echo '<p><b>Constructor error: ' . $err . '</b></p>';
    // At this point, you know the call that follows will fail
}

// create a proxy so that WSDL methods can be accessed directly
$proxy = $soapclient->getProxy();

//define parameters
$loginparams = array (
'sEmail' => $sEmail,
'sPassword' => $sPassword);

//login
$loginResult = $proxy->login($loginparams);

//print the result
echo "<b>Login full response.</b><br />";		//formatting
print_r($loginResult);
echo "<br /><br />";					//formatting

//switch to XML for easier formatting of output
$output = array(
'eOutput' => "XML"
);

$outputResponse = $proxy->setOutput($output);
print_r("<b>setOutput Full response.</b> <br />");
print_r($outputResponse);
echo "<br /><br />";					//formatting

?>