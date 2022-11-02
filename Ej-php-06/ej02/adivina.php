<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina</title>
</head>

<body>


    <form action="adivina.php" name="formulario" method="$_GET">
        <input type="number" name="respuesta" min="0" max="20">
        <input type="submit" name="borrar" value="BORRAR">

        <input type="submit" name="enviar" value="ENVIAR">
    </form>
    <?php
    session_start();
    $intentos = 5;
    $num = random_int(0, 20);
    if (isset($_SESSION['intentos']) && isset($_SESSION['num'])) {
        $intentos = $_SESSION['intentos'];
        $num = $_SESSION['num'];
    } else {
        $_SESSION['intentos'] = $intentos;
        $_SESSION['num'] = $num;
    }
    if (isset($_GET["enviar"])) {
        if ($_SESSION['intentos'] != 0) {
            $respuesta = $_GET['respuesta'];
            if ($respuesta > $num) {
                echo ("EL NUMERO ES MENOR");
                $_SESSION['intentos']--;
            }
            if ($respuesta < $num) {
                echo ("EL NUMERO ES MAYOR");
                $_SESSION['intentos']--;
            }
            if ($respuesta === $num) {
                echo ("ACERTASTE!");
            }
        } else {
            echo ("NO TIENES MÁS INTENTOS");
        }
    }

    isset($_GET['borrar']) ? session_destroy() : "";
    echo ("<br>");
    echo ("Intentos: " . $_SESSION["intentos"]);


    ?>
</body>

</html>