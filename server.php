<?php

require_once('lib/nusoap.php');

$server = new soap_server;
 
//Namespace
$file = basename($_SERVER['PHP_SELF']);
$ns="http://{$_SERVER['HTTP_HOST']}/nusoap/server.php";
 
//asignamos el nombre y namespace al servicio
$server->configureWSDL("Web service 6",$ns);
$server->wsdl->schemaTargetNamespace = $ns;


function GetProductsByCode($param){
    $products = array();
    $products [] = array('name'=>'Key Cisa','product_number'=>'111','price'=>'100','quantity'=>'111');
    $products [] = array('name'=>'Door','product_number'=>'222','price'=>'200','quantity'=>'200');
    return $products;
    
}

$server->wsdl->addComplexType(
    'Product',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'Name' => array('name'=>'name','type'=>'xsd:string'),
        'Code' => array('name'=>'product_number','type'=>'xsd:string'),
	'Price' => array('name'=>'price','type'=>'xsd:string'),
        'Ammount' => array('name'=>'quantity','type'=>'xsd:string')
    )
);
$server->wsdl->addComplexType(
    'ProductArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Product[]')
    ),
    'tns:Product'
);

$server->register(
   'GetProductsByCode',
   array('param'=>'xsd:string'),
   array('return'=>'tns:ProductArray'),
   $ns);

//Establecer servicio       
if (isset($HTTP_RAW_POST_DATA)) { 
  $input = $HTTP_RAW_POST_DATA; 
}else{ 
  $input = implode("rn", file('php://input')); 
}
 
$server->service($input);
