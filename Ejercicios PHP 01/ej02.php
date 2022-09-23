<html>
<?php
$numero=random_int(1,9);
echo "Numero generado: ".$numero;
echo "<br>";

for ($i=1; $i<=$numero; $i++) {
    
    for ($e=1;$e<=$i;$e++){
        if ($i % 2 == 0){
            echo '<span style="color:red">'. $i .'</span>';
        } else {
            echo '<span style="color:blue">'. $i .'</span>';
        }
        
    }
    echo "<br>";
}

?>

</html>