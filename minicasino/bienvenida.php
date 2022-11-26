<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>BIENVENIDO AL CASINO</h1>
    <p>Esta es su 1º visita.</p>
    <br>
    <p>Introduzca el dinero con el que va a jugar: </p>
    <form action="index.php" method="POST">
    <input type="number" name="dinero">
    <input type="submit" value="Entrar">
    </form>
    <p>VISITAS: <?= $_COOKIE['visitas']?></p>
    <?php 
    

    ?>
</body>
</html>