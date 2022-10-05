<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Juego Dados</title>
</head>

<body>
    <?php
    define(1, "&#9856;");
    define(2, '&#9857;');
    define(3, '&#9858;');
    define(4, '&#9859;');
    define(5, '&#9860;');
    define(6, '&#9861;');

    $valores = [
        '1' => "&#9856;",
        '2' => "&#9857;",
        '3' => "&#9858;",
        '4' => "&#9859;",
        '5' => "&#9860;",
        '6' => "&#9861;"
    ];

    $arrayextra = [];

    function contarDado($valores)
    {
        $suma = array_sum($valores);
        $max = max($valores);
        $min = min($valores);
        return $suma - ($max + $min);
    }

    function tirarDado()
    {
        $random = rand(1, 6);
        return $random;
    }

    ?>

    <table style="border: 1px solid black;">
        <tr style="background-color:grey">
            <th>Jugador 1</th>
            <?php
            for ($i = 1; $i <= 6; $i++) {
                echo "<td>";
                $random = tirarDado();
                $arrayextra[$i] = $random;
                echo $valores[$random];
                echo "</td>";
            }
            ?>
            <th> <?php echo contarDado($arrayextra) . "PUNTOS"; ?> </th>

        </tr>

        <tr style="background-color:red ;">
            <th>Jugador 2</th>
            <?php
            for ($i = 1; $i <= 6; $i++) {
                echo "<td>";
                $random = tirarDado();
                $arrayextra[$i] = $random;
                echo $valores[$random];
                echo "</td>";
            }
            ?>
            <th> <?php echo contarDado($arrayextra) . "PUNTOS"; ?> </th>
        </tr>


    </table>
</body>

</html>