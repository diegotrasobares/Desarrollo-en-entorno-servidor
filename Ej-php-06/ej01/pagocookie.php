<html>
<?php
if (isset($_COOKIE["nuevatarjeta"])){
    $tarjeta=$_COOKIE["nuevatarjeta"];
} else

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Forma de pago</title>
</head>

<body>
    <center>
        <H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>
        <img src='imagenes/visa1.gif' /></a>
        <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
        <a href='pagocookie.php?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' /></a>&ensp;
        <a href='pagocookie.php?><img src='imagenes/dinersclub.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' /></a>

    </center>
</body>

</html>