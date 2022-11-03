<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria</title>
</head>

<body>
    <h1>La Frutería del siglo XXI</h1>

    <?php
    session_start();
    if (isset($_GET['nombrecliente']) && !isset($_POST['fruta'])) {
        $_SESSION['nombrecliente'] = $_GET['nombrecliente'];
        include 'realizar-compra.php';
    }
    if (!isset($_SESSION['nombrecliente'])) {
        include 'nuevocliente.php';
    }

    if (isset($_POST['anotar'])) {
        if (empty($_SESSION['pedido'][$_POST['fruta']])) {
            $_SESSION['pedido'][$_POST['fruta']] = $_POST['cantidad'];
        } else {
            $_SESSION['pedido'][$_POST['fruta']] += $_POST['cantidad'];
        }
        include 'imprimir.php';
        include 'realizar-compra.php';
    }
    if (isset($_POST['terminar'])) {
        include 'imprimir.php';
        include 'terminar.php';
    }
    ?>
</body>

</html>