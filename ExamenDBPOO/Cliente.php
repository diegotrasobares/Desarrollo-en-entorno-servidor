<?php


class Cliente
{
    public $cod_cliente;
    public $nombre;
    public $clave;
    public $veces;
    
    // Métodos mágicos para setter y getter
    
    public function __set($nombre,$clave){
        $class = get_class($this);
        $nombre= strtolower($nombre); // Campo esta en mayusculas 
        if ( property_exists($class, $nombre)){
            $this->$nombre = $valor; // Ojo $nombre
        }
    }
    
    public function __get($nombre){
        $class = get_class($this);
        $nombre= strtolower($nombre);
        if ( property_exists($class, $nombre)){
            return  $this->$nombre;
        }
    }

}