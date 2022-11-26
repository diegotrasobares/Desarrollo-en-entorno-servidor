<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Dispone de <?=$_SESSION['dinero']?> para jugar</p>
   
    <form action="index.php" method="POST">
    <label for="apuesta">Cantidad a apostar: </label>
    <input type="number" name="apuesta">
    <br>
    Tipo de apuesta: <input type="radio" name="tipo-apuesta" value="par">Par <input type="radio" name="tipo-apuesta" value="impar">Impar
    <br>
    <input type="submit" name="apostar" value="Apostar cantidad">
    <input type="submit" name="abandonar" value="Abandonar el Casino">

    </form>
    
</body>
</html>