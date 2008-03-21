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

$hierparams = array("" => "");

//login
$loginResult = $proxy->login($loginparams);

//print the result
echo "<b>Login full response.</b><br />";		//formatting
print_r($loginResult);
echo "<br /><br />";					//formatting

//getHierarchy
$hierarchyResult = $proxy->getHierarchy($hierparams);

//print out the hierarchy full response
echo "<b>Hierarchy full response.</b><br />";
print_r($hierarchyResult);
echo "<br /><br />";					//formatting

//hierarchy array
$hierarchy = $hierarchyResult['aHierarchy'];

//nodes of the hierarchy
$nodes = $hierarchy["HIERARCHY"];
$numberofnodes = count($nodes);

echo "<b>Hierarchy on it's own.</b><br />";
print_r($hierarchy["HIERARCHY"]);
echo "<br /><br />";					//formatting

//now format the hierarchy
print_r("<b>" . "Formatted selection of hierarchy." . "</b>");
echo "<br />";					//formatting


echo "<table border =\"0\" cellspacing = \"5\">";
for ($iNodes = 0; $iNodes < $numberofnodes; $iNodes += 1)
{
	print_r("<tr>");
	print_r("<td>" . "Name: " . $nodes[$iNodes]["sName"] . "<br /></td>");
	print_r("<td>" . "Email: <a href=\"mailto:" . $nodes[$iNodes]["sEmail"] . "\">" . $nodes[$iNodes]["sEmail"] . "</a><br /></td>");
	print_r("<td>" . "Role: " . $nodes[$iNodes]["eType"]) . "</td>";
	print_r("</td>");
}
print_r("</table>");
?>