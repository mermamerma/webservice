<?php

//librería nusoap
require_once('lib/nusoap.php');
 
//funcion para obtener raíz cuadrada
function raiz_cuadrada ( $num ) {
  $resultado=sqrt($num);
  return $resultado;
}
 
//funcion para elevar al cuadrado
function elevar_cuadrado ( $num ) {
  $resultado=pow($num, 2);
  return $resultado;
}

function consultar_persona() {
    $User   = 'postgres';
    $Passwd = 'postgres';
    $Db     = 'webservices';
    $Port   = '5432';
    $Host   = 'localhost';
    $Str_conn = "host=$Host port=$Port dbname=$Db user=$User password=$Passwd";
    $Dbconn = pg_connect($Str_conn) or die ("Error de conexion. ". pg_last_error());
    $expresion = "/^([0-9]+)$/i";
    if(!preg_match($expresion, $vec[0])) {
            return 1;
    }

    $query = "SELECT * FROM webservices WHERE cedula = '".$vec[0]."'";
    #$query = "SELECT * FROM webservices";
    $result = pg_query($Dbconn,$query);
    $arr = array();
    if($result){
            while ($row = pg_fetch_row($result)) {
                    $arr = array(   "cedula" => $row[0],
                                    "nombres$vec" => $row[1],
                                    "apellidos" => $row[2],
                                    "sexo" => $row[3],
                                    "fecha_nacimiento" => $row[4] );
            }
            return $arr;
    }else{
            return $arr;
    }
    
}

function ping() {
    return 'OK';
} 
//instanciamos un nuevo servidor soap
$server = new soap_server;
 
//Namespace
$ns="http://{$_SERVER['HTTP_HOST']}/nusoap/servicio3.php?WSDL";
 
//asignamos el nombre y namespace al servicio
$server->configureWSDL("Garabatos Linux - SOAP",$ns);

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

$server->register("intCount",
    array("from" => "xsd:integer", "to" => "xsd:integer"),
    array("return" => "tns:intArray"),
    "http://www.example.com",
    "",
    "",
    "",
    "count from 'from' to 'to'"
);

function hello($username) {
	if ($username == 'admin') {
		return "Welcome back, Boss";
	} else {
		return "Hello, $username";
	}
}
$server->register("hello",
    array("username" => "xsd:string"),
    array("return" => "xsd:string"),
    "http://www.example.com",
    "",
    "",
    "",
    "say hi to the caller"
);

//registramos la primera función
$server->register('raiz_cuadrada',
  array('num' => 'xsd:decimal' ), //tipo de dato recibido
  array('return' => 'xsd:decimal'), //tipo de dato a enviar
  $ns, false,
  'rpc', //tipo documento
  'literal', //tipo codificación
  'Documentacion de raiz_cuadrada') ; //documentación
 
//Ver más tipos de datos
//http://dcx.sybase.com/1200/en/dbprogramming/datatypes-http.html
 
//Ver más sobre documento/codificación
//http://www.ibm.com/developerworks/webservices/library/ws-whichwsdl/
 
//registramos la segunda función
$server->register('elevar_cuadrado',
  array('num' => 'xsd:decimal' ), 
  array('return' => 'xsd:decimal'), 
  $ns, false,
  'rpc',
  'literal',
  'Documentacion de elevar_cuadrado') ;

$server->register('ping', array('input' => 'xsd:string' ), array('return' => 'xsd:string'), $ns, false,'rpc','literal','Metodo para probar si el servicio esta activo.') ; 


//Establecer servicio       
if (isset($HTTP_RAW_POST_DATA)) { 
  $input = $HTTP_RAW_POST_DATA; 
}else{ 
  $input = implode("rn", file('php://input')); 
}
 
$server->service($input);

