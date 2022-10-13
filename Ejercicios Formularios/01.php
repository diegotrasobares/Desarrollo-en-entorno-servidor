<?php

$usuarios =  [
    'paco' => 'paco',
    'jose' => 'jose',
    'luis' => 'luis'
];
$nombre = $_POST['nombre'];
$contraseña = $_POST['contraseña'];

if ((empty($nombre)) && (empty($contraseña))) {

    echo "RELLENA TODOS LOS CAMPOS";
} else {
    foreach ($usuarios as $clave => $valor) {
        $login = false;
        if ($clave == $nombre && $valor == $contraseña) {
            echo "CORRECTO";
            $login = true;
            break;
        }
    }
    if (!$login) {
        echo "INCORRECTO";
        echo "<br>";
        echo '<input type="button" value="Volver a interlo" onclick="history.back()">';
    }
}
