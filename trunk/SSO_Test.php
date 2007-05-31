<?php
/****************************************************************************
This script will make a call to the LogMeIn Rescue Single Sign On service 
and if login is successful, a link to enter the Rescue account will show, 
otherwise, status is shown.
****************************************************************************/

//define login details
$SSO_Url = "https://secure.logmeinrescue.com/SSO/GetLoginTicket.aspx?";
$SSO_CompanyID = ""; //indicated in code from Rescue Admin Center Settings tab
$SSO_Password = "";  //set in Rescue Admin Center Settings tab

//if using static SSOID
$SSOID = 'Some ID';
//if using web server auth, ie, company intranet auth
//$SSOID= $_SERVER['PHP_AUTH_USER']

//////////don't edit below unless you know what you are doing//////////
//set up array for http request
$url = array( 'SSOID' => $SSOID,
			  'Password' => $SSO_Password,
			  'CompanyID' => $SSO_CompanyID)
			  ;

//build the url
$url = $SSO_Url . http_build_query($url);

//uncomment for debugging
//print $url . "\n" ;

//get the response from the server
$return = file_get_contents($url);
$loginstatus = substr($return,0,3);
$loginurl = substr($return,3);

if ($loginstatus == "OK:"){ 
	//uncomment for debugging
	//print "\n" . $loginurl;
	
	//create link to login
	?>
	<a href="<?php echo $loginurl ?>">LogMeIn Rescue</a>
	<?php
}
else {
	echo $return;
}
?>
