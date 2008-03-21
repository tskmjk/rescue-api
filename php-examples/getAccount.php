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
echo "<b>Login full response.</b><br />";	//formatting
print_r($loginResult);
echo "<br /><br />";				//formatting

//get account info
$accountParams = array("");
$accountResult = $proxy->getAccount($accountParams);

//print out the hierarchy full response
print_r("<b>getAccount full response.</b><br />");
print_r($accountResult);
echo "<br /><br />";				//formatting

//show the account info
$accountID = $accountResult["iAccountID"];
$organization = $accountResult["sOrganization"];
$adminID = $accountResult["iAdminID"];
$techID = $accountResult["iTechID"];
$email = $accountResult["sEmail"];

print_r("<b>Account Information.</b>");
print_r("<table border = \"0\">");
print_r("<tr><td>" . "Account ID: </td><td>" . $accountID . "</td></tr>");
print_r("<tr><td>" . "Organization: </td><td>" . $organization . "</td></tr>");
print_r("<tr><td>" . "Admin ID: </td><td>" . $adminID . "</td></tr>");
print_r("<tr><td>" . "Tech ID: </td><td>" . $techID . "</td></tr>");
print_r("<tr><td>" . "Email: </td><td>" . $email . "</td></tr>");
print_r("</table>");

?>