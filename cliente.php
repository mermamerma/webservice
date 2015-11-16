<?php
/*
require_once('lib/nusoap.php');
$cliente = new nusoap_client('http://172.27.38.66/nusoap/servicio.php');
$resultado = $cliente->call('calculadora', array('x' => '3', 'y' => 4, 'operacion' => 'multiplica'));
echo $resultado;  
 */

require_once('lib/nusoap.php');




// Create the client instance
#$client = new soapclient('http://172.27.38.66/nusoap/servicio.php?wsdl');
$wsdl = 'http://172.27.38.66/nusoap/servicio.php?wsdl' ;
#$client = new nusoap_client($wsdl, 'wsdl');
$client = new nusoap_client($wsdl, 'wsdl');

$err = $client->getError();
if ($err) { echo 'Error en Constructor' . $err ; }

// Call the SOAP method

#$functions = $client->__getFunctions ();
#var_dump ($functions);
#$result = $client->call('hello', array('name' => 'John'));        
$result = $client->call('hello', array('name' => 'John')); 
/*
if ($client->fault) {
	echo 'Fallo';
	print_r($result);
} else {	// Chequea errores
	$err = $client->getError();
	if ($err) {		// Muestra el error
		echo 'Error' . $err ;
	} else {		// Muestra el resultado
		echo 'Resultado: ';
		print_r ($result);
	}
}
 */
// Display the result
print_r($result); 
