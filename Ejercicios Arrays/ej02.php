<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ej02</title>
</head>

<body>
    <?php
    $periodicos = [
        "Elpais" => "elpais.com",
        "ElMundo" => "elmundo.com",
        "Marca" => "marca.com",
        "NewYorkTimes" => "newyorktimes.com",
        "HuffingtonPost" => "https://www.huffingtonpost.es/"
    ];
    ?>
    <ul>
        <?php
        foreach ($periodicos as $nombre => $url) {
            echo "<li> 
            <a href='$url'> $nombre </a> 
            </li>";
        }



        ?>
    </ul>


</body>

</html>