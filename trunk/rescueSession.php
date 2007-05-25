<?php

/**
 * For login connectivity to the LogMeIn Rescue API
 *
 * @author Paul
 * @package defaultPackage
 */

//define connectivity
$wsdl_url = 'https://secure.logmeinrescue.com/API/API.asmx';
$WSDL = new SoapClient($wsdl_url);
$client = $WSDL->getProxy();


?>