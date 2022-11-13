<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahocado</title>
</head>

<body>
    <h1>Juego Ahorcado!</h1>
    <hr>

    <?php
    session_start();
    if (isset($_GET['letra'])) {
        $_SESSION['letrasusuario'] .= $_GET['letra'];
        comprobarLetra($_GET['letra'], $_SESSION['palabrasecreta']);
    }
    if (!isset($_SESSION['palabrasecreta'])) {
        $_SESSION['palabrasecreta'] = elegirPalabra();
        $_SESSION['letrasusuario'] = ""; // Inicialmente no tiene ninguna letra  
        $_SESSION['fallos'] = 0; // Inicialmente no hay ningún fallo
        echo "PALABRA: " . generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']) . '<br>';
        echo "Has cometido " .  $_SESSION['fallos'] . " fallos <br>";
        echo " <form action='index.php' method='GET'>
        <label for='letra' value='Introduzca una letra'>
        <input type=text name='letra'> 
        </form>
        ";
    } else {
        if ($_SESSION['fallos'] >= 5) {
            echo "GAME OVER, Has tenido más de 5 fallos";
        } else if (strpos(generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']), '-') !== false) {
            echo "PALABRA: " . generaPalabraconHuecos($_SESSION['letrasusuario'], $_SESSION['palabrasecreta']) . '<br>';
            echo "Has cometido " .  $_SESSION['fallos'] . " fallos <br>";
            echo " <form action='index.php' method='GET'>
            <label for='letra' value='Introduzca una letra'>
            <input type=text name='letra'> 
            </form>
            ";
        } else {
            echo "HAS ACERTADO, felicidades!" . "<br>";
        }
    }

    function elegirPalabra()
    {
        static $tpalabras = ["Madrid", "Sevilla", "Murcia", "Málaga", "Mallorca", "Menorca"];

        return $tpalabras[random_int(0, count($tpalabras) - 1)]; // Devuelve una palabra al azar    
    }

    function comprobarLetra($letra, $cadena)
    {
        $check = true;
        if (strlen($letra) > 0) {
            if (strpos($cadena, $letra) == false) {
                $check = false;
                $_SESSION['fallos'] += 1;
            }
        }
        return $check; // Devuelve true o false si la letra esta en la cadena  
    }
    /*
 * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición    si cada letra se encuentra en la cadenaletras
 * 
 * Ej  generaPalabraconHuecos("aeiou"     ,"hola pepe") -->"-o-a--e-e"
 *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
 * 
 */

    function generaPalabraconHuecos($cadenaletras, $cadenapalabra)
    {
        // Genero una cadena resultado inicialmente con todas las posiciones con -
        $resu = $cadenapalabra;
        for ($i = 0; $i < strlen($resu); $i++) {
            $resu[$i] = '-';
        }
        for ($i = 0; $i < strlen($resu); $i++) {
            for ($e = 0; $e < strlen($cadenaletras); $e++) {
                if ($cadenapalabra[$i] == $cadenaletras[$e]) {
                    $resu[$i] = $cadenaletras[$e];
                }
            }
            // COMPLETAR rellenado la cadena resu
        }
        return $resu;
    }




    ?>
</body>

</html>