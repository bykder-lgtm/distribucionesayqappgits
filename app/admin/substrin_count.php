<?php
include_once('../conexiones/conexione.php');
$precio_compra_producto             = "25007100";

$cantidad_digitos_compra            = strlen($precio_compra_producto);
$matriz_digitos_compra              = str_split($precio_compra_producto);
$codif_letra_precio_compra          = "";
$contar_ceros_compra                = 0;
$cod_letra_numero_compra_cero       = "";
$cantidad_contadores                = substr_count($precio_compra_producto, '0');
$contar_palabra                     = str_word_count($precio_compra_producto, 1, '0');
$cantidad_separaciones              = count($contar_palabra);
$contar_ceros_compra1               = 0;
$contar_ceros_compra2               = 0;
$contar_ceros_venta                 = 0;
$nombre_letra_numero_compra         = "";

echo "<br>precio_compra_producto - ".$precio_compra_producto;
echo "<br>";

//foreach ($contar_palabra as $key => $palabra) {
//echo "<br>palabra = ".$palabra." key = ".$key;
//}
echo "<br>";

for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
$cod_letra_numero_compra    = ($matriz_digitos_compra[$i]);

$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

if ($cod_letra_numero_compra == '0') {

$nombre_letra_numero_compra = $contar_ceros_compra++;
} else {
$nombre_letra_numero_compra = $datos_letra_numero['nombre_letra_numero'];
}
$codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
}

echo "<br><br>codif_letra_precio_compra - ".$codif_letra_precio_compra;
echo "<br><br>contar_ceros_compra - ".$contar_ceros_compra;

echo "<br>";
echo "<br>";
echo "<br>cantidad_separaciones - ".$cantidad_separaciones;
echo "<br>";

$frag = explode('0', $precio_compra_producto);
$explode_count = count(explode('0', $precio_compra_producto));

echo "<br>cantidad_digitos_compra - ".$cantidad_digitos_compra;
echo "<br>matriz_digitos_compra - ".$matriz_digitos_compra;
echo "<br>codif_letra_precio_compra - ".$codif_letra_precio_compra;

echo "<br>explode_count - ".$explode_count;

echo "<br>".$frag[0];
echo "<br>".$frag[1];
echo "<br>";

echo "<br>substr_count - ".substr_count($precio_compra_producto, '0');
echo "<br>mb_substr_count - ".mb_substr_count($precio_compra_producto, '0');
echo "<br>mb_stripos - ".mb_stripos($precio_compra_producto, '0');
echo "<br>mb_strlen - ".mb_strlen($precio_compra_producto);

echo "<br>iconv_strlen - ".iconv_strlen($precio_compra_producto);

?>