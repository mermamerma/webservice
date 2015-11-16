<?php

require_once('lib/nusoap.php');

ini_set("soap.wsdl_cache_enabled", "0"); 

    
    $client = new nusoap_client("http://{$_SERVER['HTTP_HOST']}/nusoap/servicio6.php?wsdl",'wsdl'); 
    
    $result = $client->call('hello', array("username" => 'admin'));
    #$result = $client->call('intCount', array("from" => 1, 'to' => 10));
    #$result = $client->call('getUserInfo', array('userId' => '1'));
    #$result = $client->call('consultaPersonas', array('param'=>'pepa'));
    #$result = $client->call('getListUsers', array('param'=>'pepa'));
    $result = $client->call('GetProductsByCode', array("param" => 'pepa'));



if ($client->fault) {
	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		echo '<h2>Resultado</h2><pre>'; 
                var_dump($result); echo '</pre>';
	}
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';