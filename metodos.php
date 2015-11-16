<?php

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

function hello($name) {
    return 'Hello, ' . $name;
}