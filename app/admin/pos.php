<?php
require_once('../conexiones/conexione.php'); 

$precio_compra_producto = "123456";

$cantidad_digitos       = strlen($precio_compra_producto);
$matriz_digitos         = str_split($precio_compra_producto);
$nombre_letra_numero    = "";

for ($i=0; $i < $cantidad_digitos; $i++) { 

$cod_letra_numero = $matriz_digitos[$i];

$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero '";
$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

$nombre_letra_numero        = $nombre_letra_numero.$datos_letra_numero['nombre_letra_numero'];
}
echo "<br>nombre_letra_numero - ".$nombre_letra_numero;
?>