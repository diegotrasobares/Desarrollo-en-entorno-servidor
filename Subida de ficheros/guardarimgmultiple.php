<?php
if (count($_FILES['archivos']['name']) > 0) {
    foreach ($_FILES['archivos']['name'] as $key => $tmp_name) {
        $nombre = $_FILES['archivos']['name'][$key];
        $temp_dir = $_FILES['archivos']['tmp_name'][$key];
        $tipo = $_FILES['archivos']['type'][$key];
        $time = time();
        $dir = "imgusers/" . $time . "-" . $nombre;
        $tamaño = $_FILES['archivos']['size'][$key];
        $extensiones = ['png', 'jpeg', 'jpg'];
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);

        echo "NOMBRE ARCHIVO: " . $nombre . "<br>";
        if (calcularTamaño() < 300000 && $tamaño < 200000) {
            echo "TAMAÑO: " . $tamaño . "<br>";
            if (in_array($ext, $extensiones)) {
                echo "FORMATO: " . $tipo . "<br>";
                if (move_uploaded_file($temp_dir, $dir)) {
                    echo "ARCHIVO SUBIDO CORRECTAMENTE!" . "<br>" . "<hr>";
                } else {
                    echo "ERROR AL SUBIR EL ARCHIVO" . "<br>";
                }
            } else {
                echo "ERROR: FORMATO DE ARCHIVO INCOMPATIBLE";
            }
        } else {
            echo "ERROR: TAMAÑO MAXIMO DE FICHERO SUPERADO";
        }
    }
}
function calcularTamaño()
{
    $tamaño = 0;
    foreach ($_FILES['archivos']['name'] as $key => $name) {
        $tamaño += $_FILES['archivos']['size'][$key];
    }
}
