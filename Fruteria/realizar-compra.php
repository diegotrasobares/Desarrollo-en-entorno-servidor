<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h3><b>REALICE SU COMPRA <?php echo $_SESSION['nombrecliente']; ?></b></h3>


    <form action="" method="POST">
        <label for="fruta">Selecciona la fruta:</label>
        <select name="fruta">
            <option value="Platano">Platano</option>
            <option value="Limón">Limon</option>
            <option value="Naranja">Naranja</option>
            <option value="Manzana">Manzana</option>
        </select>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad">
        <input type="submit" name="anotar" value="Anotar">
        <input type="submit" name="terminar" value="Terminar">

    </form>

</body>

</html>