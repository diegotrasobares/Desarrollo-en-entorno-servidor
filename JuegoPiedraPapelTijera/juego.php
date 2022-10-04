<<<<<<< HEAD <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Juego Piedra papel tijera</title>
        <!-- DIEGO TRASOBARES -->
    </head>

    <body>
        <?php
        define('PIEDRA',  "&#x1F91C;");
        define('PAPEL',    "&#x1F91A;");
        define('TIJERAS',  "&#x1F596;");
        define('PIEDRA2',  "&#x1F91B;");
        $valores = [PIEDRA, PAPEL, TIJERAS];
        $jugador1 = $valores[rand(0, 2)];
        $jugador2 = $valores[rand(0, 2)];

        $msg = ['Empate', 'Ganador Jugador 1', 'Ganador Jugador 2'];
        function calcularGanador($jugador1, $jugador2)
        {
            $ganador = 0;
            if ($jugador1 == $jugador2) {
                return $ganador;
            }

            switch ($jugador1) {
                case PIEDRA:
                    if ($jugador2 == TIJERAS) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }
                case PAPEL:
                    if ($jugador2 == PIEDRA) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }


                case TIJERAS:
                    if ($jugador2 == PAPEL) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }
            }

            return $ganador;
        }
        ?>

        <table>
            <tr>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
            </tr>
            <td>
                <?php
                echo $jugador1;
                ?>
            </td>
            <td>
                <?php
                if ($jugador2 == PIEDRA) {
                    echo PIEDRA2;
                } else {
                    echo $jugador2;
                }


                ?>
            </td>
            <tr>
            </tr>
        </table>
        <p><?php echo $msg[calcularGanador($jugador1, $jugador2)] ?> </p>






    </body>

    =======
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Juego Piedra papel tijera</title>
        <!-- DIEGO TRASOBARES -->
    </head>

    <body>
        <?php
        define('PIEDRA',  "&#x1F91C;");
        define('PAPEL',    "&#x1F91A;");
        define('TIJERAS',  "&#x1F596;");
        define('PIEDRA2',  "&#x1F91B;");
        $valores = [PIEDRA, PAPEL, TIJERAS];
        $jugador1 = $valores[rand(0, 2)];
        $jugador2 = $valores[rand(0, 2)];

        $msg = ['Empate', 'Ganador Jugador 1', 'Ganador Jugador 2'];
        function calcularGanador($jugador1, $jugador2)
        {
            $ganador = 0;
            if ($jugador1 == $jugador2) {
                return $ganador;
            }

            switch ($jugador1) {
                case PIEDRA:
                    if ($jugador2 == TIJERAS) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }
                case PAPEL:
                    if ($jugador2 == PIEDRA) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }
                case TIJERAS:
                    if ($jugador2 == PAPEL) {
                        $ganador = 1;
                        break;
                    } else {
                        $ganador = 2;
                        break;
                    }
            }

            return $ganador;
        }
        ?>

        <table>
            <tr>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
            </tr>
            <td>
                <?php
                echo $jugador1;
                ?>
            </td>
            <td>
                <?php
                if ($jugador2 == PIEDRA) {
                    echo PIEDRA2;
                } else {
                    echo $jugador2;
                }


                ?>
            </td>
            <tr>
            </tr>
        </table>
        <p><?php echo $msg[calcularGanador($jugador1, $jugador2)] ?> </p>






    </body>

    >>>>>>> 4c4f3da5fab348bfb6c59c9c17bfec3f85e75630

    </html>