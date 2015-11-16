<?php
//deshabilitar cache
#ini_set("soap.wsdl_cache_enabled", "0");
 
//iniciar cliente soap
//escribir la dirección donde se encuentra el servicio
#$cliente = new SoapClient("http://172.27.38.66/nusoap/servicio3.php?wsdl");
require_once('lib/nusoap.php');

ini_set("soap.wsdl_cache_enabled", "0");

try {
    
    $client = new nusoap_client("http://{$_SERVER['HTTP_HOST']}/nusoap/servicio4.php?wsdl",'wsdl'); 
    
    $result = $client->call('getUserInfo', array("userId" => 1));
    
    var_dump($result );    



    
}
catch (SoapFault $exp) {
	print_r($exp->getMessage());
}