<?php
function generarNumero(){
    $random=random_int(0,100);
    if ($random%2==0){
        return 'par';
    } else {
        return 'impar';
    }
}


