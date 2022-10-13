<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>

    <h1>Mini Calculadora</h1>
    <form action="02.php" method="POST">
        <label for="num1">Nº1:</label>
        <input type="number" name="num1" id="num1"><br>
        <label for="num2">Nº2:</label>
        <input type="number" name="num2" id="num2">
        <br><br>
        <fieldset>
            <div>
                <input type="button" name="operador" value="+">
                <input type="button" name="operador" value="-">
                <input type="button" name="operador" value="*">
                <input type="button" name="operador" value="/">
            </div>
        </fieldset>
        <br><br>
        <div>
            <label><input type="radio" name="resultado" value="decimal" checked>Decimal</label>
            <label><input type="radio" name="resultado" value="binario">Binario</label>
            <label><input type="radio" name="resultado" value="hexa">Hexademinal</label>
        </div>
        <input type="reset" value="borrar con reset">
    </form>
    <?php
    if ($_POST) {
        $numero1 = $_POST['num1'];
        $numero2 = $_POST['num2'];
        $operador = $_POST['operador'];
        $resultado = 0;
        echo "El OPERADOR ES: " . $numero2;
    }

    if (!empty($numero1) || !empty($numero2)) {
        switch ($operador) {
            case '+':
                $resultado = $numero1 + $numero2;
                break;
            case '-':
                $resultado = $numero1 - $numero2;
                break;
            case '*':
                $resultado = $numero1 * $numero2;
                break;
            case '/':
                $resultado = $numero1 / $numero2;
                break;
        }
    }
    echo "El resultado es: " . $resultado;
    ?>

</body>

</html>