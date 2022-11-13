<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>

<body>
    <h3> Bienvenido <b><?= $_COOKIE['usuario']   ?> </b> </h3>
    <h2>Su última visita fue el <b><?= date("m.d.Y") ?></b> a las <b><?= date("g:i a") ?></b></h2>
    <form action="funciones.php">
        <input type="submit" name="salir" value="Salir">
    </form>
</body>

</html>