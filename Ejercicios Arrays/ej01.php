<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $array = [];
    for ($i = 0; $i <= 20; $i++) {
        $array[$i] = random_int(1, 10);
    }
    function mostrarArray($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            echo "<td>" . $array[$i] . "<td>";
        }
    }

    function maxNumero($array)
    {
        $max = $array[0];
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] > $max) {
                $max = $array[$i];
            }
        }
        return $max;
    }

    function minNumero($array)
    {
        $min = $array[0];
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] < $min) {
                $min = $array[$i];
            }
        }
        return $min;
    }

    ?>
    <table border="1px">
        <tr>
            <?php
            mostrarArray($array);
            ?>
        </tr>
        <tr>
            <?php
            echo "El numero maximo es: " . maxNumero($array);
            ?>
        </tr>
        <tr>
            <?php
            echo "El numero minimo es: " . minNumero($array);
            ?>



    </table>
</body>

</html>