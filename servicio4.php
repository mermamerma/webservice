<?php

require_once('lib/nusoap.php');

$server = new soap_server;
 
//Namespace
$file = basename($_SERVER['PHP_SELF']);
$ns="http://{$_SERVER['HTTP_HOST']}/nusoap/servicio4.php";
 
//asignamos el nombre y namespace al servicio
$server->configureWSDL("Web service - {$file}",$ns);


function hello($nombre) {
	if ($nombre == 'jesus') {
		return "Welcome back, Boss";
	} else {
		return "Hello, $nombre";
	}
}

$server->register("hello",
    array("username" => "xsd:string"),
    array("return" => "xsd:string"),
    "{$ns}",
    "",
    "",
    "",
    "say hi to the caller"
);

function intCount($from, $to) {
    $out = array();
    for ($i = $from; $i <= $to; $i++) {
        $out[] = $i;
    }
    return $out;
}

$server->wsdl->addComplexType(
    'intArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'xsd:integer[]'
        )
    ),
    'xsd:integer'
);

$server->register("intCount",
    array("from" => "xsd:integer", "to" => "xsd:integer"),
    array("return" => "tns:intArray"),
    "{$ns}",
    "",
    "",
    "",
    "count from 'from' to 'to'"
);

function getUserInfo($userId) {
    if ($userId == 1) {
        return array(
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        );
    } else {
        return $arr = array();
        #return new soap_fault('SOAP-ENV:Server', '', 'Requested user not found', '');
    }
}

$server->wsdl->addComplexType(
    'userInfo',
    'complextType',
    'struct',
    'sequence',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:integer'),
        'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'email' => array('name' => 'email', 'type' => 'xsd:string')
    )
);
$server->register("getUserInfo",
    array("userId" => "xsd:integer"),
    array("return" => "tns:userInfo"),
    "{$ns}",
    "",
    "",
    "",
    "get info for user"
);

//Establecer servicio       
if (isset($HTTP_RAW_POST_DATA)) { 
  $input = $HTTP_RAW_POST_DATA; 
}else{ 
  $input = implode("rn", file('php://input')); 
}
 
$server->service($input);
