<?php
$valor_original = 1194029.851;
$calculo = ceil($valor_original / 1000) * 1000;

$rounded_number = round($valor_original, -3);

echo "<br>valor_original = ".number_format($valor_original, 0, ",", ".");
echo "<br>calculo = ".number_format($calculo, 0, ",", ".");
echo "<br>rounded_number = ".number_format($rounded_number, 0, ",", ".");
?>