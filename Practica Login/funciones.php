<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <H1>FORO MADRID</H1>
    <HR>
    </HR>
    <?php


    if (isset($_POST['usuario'])) {
        if (isset($_POST['recordar'])) {
            setcookie("usuario", $_POST['usuario'], time() + 3600);
            setcookie("contraseña", $_POST['contraseña'], time() + 3600);
            setcookie("tiempo", time(), time() + 3600);
        } else {
            setcookie("tiempo", time(), time() + 3600);
        }
    }
    if (!isset($_COOKIE['tiempo'])) {
        include_once 'inicio.php';
    } else {

        include_once 'panelusuario.php';
    }
    if (isset($_POST['recordar'])) {
        echo "hola";
        setcookie("usuario", $_POST['usuario'], time() - 3600);
        setcookie("contraseña", $_POST['contraseña'], time() - 3600);
        setcookie("tiempo", time(), time() - 3600);
        include('funciones.php');
    }
    ?>
</body>

</html>