<?php
function usuarioOk($usuario, $contraseña): bool
{
   $sesion = false;
   $alreves = strrev($usuario);
   if (strlen($usuario) > 8 && $alreves == $contraseña) {
      $sesion = true;
   }
   return ($sesion);
}
function limpiarCadena($cadena)
{
   $cleanCadena = trim(htmlspecialchars($cadena, ENT_QUOTES, "UTF-8"));
   return $cleanCadena;
}


function letraRepetida($comentario)
{
   $letra = " ";
   $contador = 1;
   $max = 0;
   $letras = str_split($comentario);
   $tamaño = count($letras) - 1;
   for ($i = 0; $i <  $tamaño; $i++) {
      $contador = substr_count($comentario, $letras[$i]);
      if ($contador > $max) {
         $letra = $letras[$i];
         $max = $contador;
         $contador = 0;
      }
   }
   return $letra;
}

function palabraRepetida($comentario)
{
   $palabra = " ";
   $contador = 1;
   $max = 0;
   $palabras = explode(" ", $comentario);
   $tamaño = count($palabras) - 1;
   for ($i = 0; $i <  $tamaño; $i++) {
      $contador = substr_count($comentario, $palabras[$i]);
      if ($contador > $max) {
         $palabra = $palabras[$i];
         $max = $contador;
         $contador = 0;
      }
   }
   return $palabra;
}

function contadorPalabras($comentario)
{
   return (str_word_count($comentario));
}
