 <?php
/*** For login connectivity to the LogMeIn Rescue API
 *
 * @author Paul
 * @package defaultPackage
 */
 
//error_reporting(E_ALL);


if ((login("paul.mcgurn@gmail.com","Promot1on")) == "OK") 
{
	?>
	<form method="post" action="https://secure.logmeinrescue.com/API/getHierarchy.aspx">
	<input type="submit"></form>
	
<?php
}


//functions
function login($email,$pwd){

	?>
	<form method="POST" action="https://secure.logmeinrescue.com/API/login.aspx">
	<input name=email value="<?php $email ?>" >
	<input name=pwd value="<?php $pwd ?>">
	<form action="submit">
	</form>
	<?php

$output = $_POST["OUTPUT"];
return $output;
};

?>