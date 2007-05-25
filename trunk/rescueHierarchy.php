 <?php
/*** For login connectivity to the LogMeIn Rescue API
 *
 * @author Paul
 * @package defaultPackage
 */
 
//error_reporting(E_ALL);

//functions
function login($email,$pwd){
//url for the post to login
$request = 'https://secure.logmeinrescue.com/API/login.aspx?';
//concat email
$request.="email=" . $email;
//concast pwd
$request.='&pwd=' . $pwd;
$output = $_POST["OUTPUT"];
return $output;
};


if ((login("youremail","yourpassword")) != "OK") 
{
	?>
	<form method="post" action="https://secure.logmeinrescue.com/API/getHierarchy.aspx">
	<form action="submit"></form>
	
<?php
}
?>