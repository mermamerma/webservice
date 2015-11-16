<?php

include('lib/nusoap.php');
$client = new nusoap_client('http://172.27.38.66/nusoap/servicio1.php?wsdl','wsdl');

$err = $client->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }
$param = array('nombre' => 'jesus');
$result = $client->call('ping', $param);

if ($client->fault) {
	echo '<b>Fallo: </b>';
	print_r($result);
} else {	// Chequea errores
        $err = $client->getError();
	if ($err) {		// Muestra el error
		echo '<b>Error: </b>' . $err ;
	} else {		// Muestra el resultado
		echo '<b>Resultado: </b>';
		print_r ($result);
	}
}