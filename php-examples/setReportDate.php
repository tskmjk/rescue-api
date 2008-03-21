<?php
include("lib/nusoap.php");

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
'sEmail' => 'someemail@domain.com',
'sPassword' => 'secretPassword'
);

//login
$loginResult = $proxy->login($loginparams);

//print the result
echo "<b>Login full response.</b><br />";		//formatting
print_r($loginResult);
echo "<br /><br />";					//formatting

//define parameters
$reportdateparams = array (
'sBeginDate' => '01/01/2007',
'sEndDate' => '06/30/2007'
);

//set the report date
$setReportDateResult = $proxy->setReportDate($reportdateparams);

//print the result
echo "<b>setReportDate full response.</b><br />";	//formatting
print_r($setReportDateResult);
echo "<br /><br />";					//formatting

?>