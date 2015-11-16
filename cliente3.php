<?php
//deshabilitar cache
#ini_set("soap.wsdl_cache_enabled", "0");
 
//iniciar cliente soap
//escribir la dirección donde se encuentra el servicio
#$cliente = new SoapClient("http://172.27.38.66/nusoap/servicio3.php?wsdl");
require_once('lib/nusoap.php');

ini_set("soap.wsdl_cache_enabled", "0");

try {
    $client = new nusoap_client('http://172.27.38.66/nusoap/servicio3.php?wsdl','wsdl');

 
    //establecer parametros de envío
    $params = array("num" => 4);
 
    //llamar a la función raiz cuadrada
    //y guardar el resultado
    #$result = $cliente->__SoapCall('raiz_cuadrada', $params);
    #$result = $client->call('raiz_cuadrada', $params);
    $result = $client->call('intCount', array("from" => 1, "to" => 10));



    //imprimir primer resultado
    
    echo "Respuesta del Servicio: ".var_dump($result)."<br/>";
    #echo "Raíz cuadrada de ". $params['num']. " es: ".$result."<br/>";

    /*
    //llamar a la función elevar al cuadrado
    //y guardar el resultado
    $result = $cliente->__SoapCall('elevar_cuadrado', $params);

    //imprimir segundo resultado
    echo $params['num']." elevado al cuadrado es: ".$result."<br/>"; 
    */
}
catch (SoapFault $exp) {
	print_r($exp->getMessage());
}