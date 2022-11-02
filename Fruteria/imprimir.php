<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <table border="1px" <?php
                        foreach ($_SESSION['pedido'] as $value => $key) {
                            echo "Esta es su compra: ";
                            echo "<tr> <td>";
                            echo $value . " " . $key;
                            echo "</td> </tr>";
                        }
                        ?> </table>
</body>

</html>