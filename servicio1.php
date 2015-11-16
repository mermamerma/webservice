<?php

include('lib/nusoap.php');

$URL       = "http://172.27.38.66/nusoap/servicio1.php";
$namespace = $URL . '?wsdl';
//using soap_server to create server object
$server    = new soap_server;
$server->configureWSDL('MPPRE-MPPEUCT', $namespace);

//register a function that works on server
$server->register('ping');
$server->register('calculadora');
$server->register('MetodoConsulta',
    array('param_id' => 'xsd:string','param_txt' => 'xsd:string'),
    array('return' => 'xsd:string'),
    'urn:MetodoConsultawsdl',
    'urn:MetodoConsultawsdl#MetodoConsulta',
    'rpc',
    'encoded',
    'Retorna el datos'
);

function ping($param) {
    return 'OK';
}

$server->service('php://input');
