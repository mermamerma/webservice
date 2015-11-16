<?php

include('lib/nusoap.php');
$cliente = new nusoap_client("http://www.webservicex.net/CurrencyConvertor.asmx?WSDL", true);
$resultado = $cliente->call(
     "ConversionRate", 
      array(
            'FromCurrency' => "USD",
            'ToCurrency' => "EUR"
            )
);

echo 'Conversíon de USD a EUR: '.$resultado['ConversionRateResult'];