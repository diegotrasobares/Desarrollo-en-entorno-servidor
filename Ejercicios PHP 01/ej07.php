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
        function numerorandom()
        {
            $numero=random_int(100,500);
            return $numero;
        }
    
    for ($i=1;$i<=3;$i++){
        echo "
        <table id=$i>
            <tr>
                <td>" <?php echo numerorandom(); ?>"</td>
            </tr>
        </table>
        <style>
            table {
                background:green;
                width: "<?php numerorandom(); ?>;"   "
                
            }
        </style>
";
    }
    ?>


</body>
</html>    