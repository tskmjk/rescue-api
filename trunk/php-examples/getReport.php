<?php
include("../lib/nusoap.php");

//define variables
$sEmail = "someEmail@domain.com";
$sPassword = "secretPassword";
$sBeginDate = "05/09/2007";				//define this with your own data
$sEndDate = "07/01/2007";			//define this appropraitely based on your data
$eReportArea = "SESSION";
$iNodeID = "718535";
$eNodeRef = "NODE";

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

/*******uncomment for debug
//print the result
echo "<b>Login full response.</b><br />";		//formatting
print_r($loginResult);
echo "<br /><br />";					//formatting
*******/
//set the report area
//define parameters
$reportareaarams = array (
'eReportArea' => $eReportArea
);

$setReportAreaResponse = $proxy->setReportArea($reportareaparams);

/*******uncomment for debug
print_r("<b>setReportArea Full response.</b> <br />");
print_r($setReportAreaResponse);
echo "<br /><br />";					//formatting
*******/

//set the time frame
$reportDateParams= array(
'sBeginDate' => $sBeginDate,
'sEndDate' => $sEndDate
);

$setReportDateResponse = $proxy->setReportDate($reportDateParams);

/******** uncomment for debug
print_r("<b>setReportDate Full response.</b> <br />");
print_r($setReportDateResponse);
echo "<br /><br />";					//formatting
********/

//finally, get the report
//set up array
$getReportParams = array(
'iNodeID' => $iNodeID,
'eNodeRef' => $eNodeRef
);

$getReportResponse = $proxy->getReport($getReportParams);

/******** uncomment for debug
print_r("<b>getReport Full response (need to parse.).</b> <br />");
print_r($getReportResponse);
echo "<br /><br />";					//formatting
********/

//parse results into an array (NuSOAP stinks at multilevel XML
$reportdata = explode("\n",$getReportResponse['sReport']);
foreach($reportdata as $key => $val) {
    if($key == 0) {
    $COLUMN = explode ("|",$val);
}
$COLDATA = explode("|",$val);
foreach($COLDATA as $ckey => $val) { 
    if(empty($COLUMN[$ckey])) {
    $COLUMN[$ckey] = $ckey;
} else {
    $COLUMN[$ckey] = str_replace( " ","",$COLUMN[$ckey]);
}
  $REPORT[$key][$COLUMN[$ckey]] = $val;
 }
}

/******uncomment for debug
//print array to browser
print_r("<b>results parsed into an array.</b><br />");
print_r($REPORT);
print_r("<br /><br />");
******/

$reportdata = $REPORT;
//get just the report data, and number off nodes in it
$reportentries = count($REPORT);
print_r("<b>Number of report lines:" .  $reportentries . "</b><br /><br />");


//format report nicely
print_r("<b>formatted report.</b><br />");
print_r("<table frame = \"border\" border = \"0\">");
for ($i = 0; $i < $reportentries; $i += 1)
{
	print_r("<tr>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["SessionID"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["StartTime"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["EndTime"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["TechnicianID"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["CustomerIP"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["ComputerID"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["Status"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["Name"] . "</td");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["PhoneNumber"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["EmailAddress"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["Product"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["OrderID"] . "</td>");
	print_r("<td style=white-space: nowrap>" . $reportdata[$i]["ChannelID"] . "</td>");
	print_r("</tr>");
}
print_r("</table");

?>