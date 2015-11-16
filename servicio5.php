<?php

require_once('lib/nusoap.php');

$server = new soap_server;
 
//Namespace
$file = basename($_SERVER['PHP_SELF']);
$ns="http://{$_SERVER['HTTP_HOST']}/nusoap/servicio5.php";
 
//asignamos el nombre y namespace al servicio
$server->configureWSDL("Web service 5",$ns);
$server->wsdl->schemaTargetNamespace = $ns;

// Example "hello" function
function hello($username) {
	if ($username == 'admin') {
		return "Welcome back, Boss";
	} else {
		return "Hello, $username";
	}
}
$server->register("hello",
    array("username" => "xsd:string"),
    array("return" => "xsd:string"));

// Example "intCount" function (return array)
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
    array("return" => "tns:intArray"));

// Example "getUserInfo" function (return struct and fault)
function getUserInfo($userId) {
    if ($userId == 1) {
        return array(
            'id' => 1,
            'username' => 'testuser',
            'email' => 'testuser@example.com'
        );
    } else {
        return new soap_fault('SOAP-ENV:Server', '', 'Requested user not found', '');
    }
}

function getListUsers($param) {
   $users = array() ;
   $users [] = array('id' => 1,'username' => 'testuser','email' => 'testuser@example.com');
   $users [] = array('id' => 2,'username' => 'asasasaa','email' => 'asasasasa@example.com');  
   return $users;
   
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

$servidor->wsdl->addComplexType(
        'listUsersInfo',
        'complexType',
        'array',
        'sequence',
        'SOAP-ENV:Server',
        array(),
        array(array('ref' => 'SOAP-ENV:Server',
         'wsdl:arrayType' => 'tns:userInfo[]')
        ),
        'tns:userInfo'  
);

$server->register("getUserInfo",
    array("userId" => "xsd:integer"),
    array("return" => "tns:userInfo"));

$server->register("getListUsers",
    array('param'=> 'xyz'),
    array("return" => "tns:listUserInfo"));

//Establecer servicio       
if (isset($HTTP_RAW_POST_DATA)) { 
  $input = $HTTP_RAW_POST_DATA; 
}else{ 
  $input = implode("rn", file('php://input')); 
}
 
$server->service($input);
