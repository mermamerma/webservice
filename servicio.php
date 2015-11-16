<?php
/*
require_once('lib/nusoap.php');
require_once('calculadora.php');

$server = new nusoap_server();
$server->register('calculadora');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
*/

//call library
require_once('lib/nusoap.php');

$URL       = "http://172.27.38.66/nusoap/servicio.php";
$namespace = $URL . '?wsdl';
//using soap_server to create server object
$server    = new soap_server;
$server->configureWSDL('MPPRE-MPPEUCT', $namespace);

//register a function that works on server
$server->register('hello');
$server->register('calculadora');

// create the function

function hello($name){   
    if (!$name) {
        return new soap_fault('Client', '', 'Put your name!');
    }
    $result = "Hello, " . $name;
    return $result;  
}

 function calculadora($x, $y, $operacion){
        if($operacion == "suma")
            return $x + $y;
        else if($operacion == "suma")
            return $x + $y;
        else if($operacion == "resta")
            return $x - $y;
        else if($operacion == "multiplica")
            return $x * $y;
        else if($operacion == "divide")
            return $x / $y;
        return 0;
 }

// create HTTP listener
#$server->service($HTTP_RAW_POST_DATA);
$server->service('php://input');
exit();
