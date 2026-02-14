<?php 
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');

$cod_caja_virtual                      = 2;
$cod_caja_virtual_codif                = DAXCODIFCRYPTOR::encodifdax($cod_caja_virtual);

echo "<br>cod_caja_virtual = ".$cod_caja_virtual;
echo "<br>cod_caja_virtual_codif = ".$cod_caja_virtual_codif;

echo "<br>";
echo "<br>cod_caja_virtual_codif = ".$cod_caja_virtual_codif;
echo "<br>cod_caja_virtual = ".$cod_caja_virtual;
?>