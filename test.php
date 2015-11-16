<?php
function getListUsers($param) {
     $users = array();
     $users [] = array('id' => 1,'username' => 'testuser','email' => 'testuser@example.com');
     $users [] = array('id' => 2,'username' => 'asasasasasa','email' => 'asasasasasasa@example.com');
     return $users;
 }

function intCount($from, $to) {
    $out = array();
    for ($i = $from; $i <= $to; $i++) {
        $out[] = $i;
    }
    return $out;
}   

function listUsers($to) {
    $out = array();
    for ($i = 0; $i <= $to; $i++) {
        $out[] = array('id'=> 'id_usuario_'.$i,"User $i");
    }
    return $out;
}  
function GetProductsByCode($param){
    $productos = array();
    
    /*
    $productos [1] ['Name']= array('name'=>'Llave de Tubo');
    $productos [1] ['Code']= array('product_number'=>'111');
    $productos [1] ['Price']= array('price'=>'111');
    $productos [1] ['Ammount']= array('quantity'=>'111');    
    * 
    */
    $productos [] = array('name'=>'Tubo','product_number'=>'2222','price'=>'200','quantity'=>'222');
    return $productos;
    
}

#$r = getListUsers($users = '') ;
#$r = intCount(0,10) ;
#$r = listUsers(2) ;
$r = GetProductsByCode($param = 1) ;
var_dump($r);