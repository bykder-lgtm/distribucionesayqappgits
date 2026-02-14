<?php
$env                                     = 'PRODUCCION';
$dataico_account_id                      = '01867aec-4551-8985-9a93-a15111e8b07f';
$dataico_auth_token                      = "fa9f63014982b46e0f44974c1f4fbde4";
$invoice_type_code                       = 'FACTURA_VENTA';

echo "<br>dirname = ".basename(dirname(__FILE__))."<br>";
echo "<br>getcwd = ".basename(getcwd())."\n";

echo "<br>DOCUMENT_ROOT = ".$_SERVER['DOCUMENT_ROOT'];

echo "<br>dirname = ".dirname(__DIR__);
echo "<br>FILE = ".__FILE__;

echo "<br>basename__FILE__ = ".basename( __FILE__ );
echo "<br>dirname__FILE__ = ".dirname(__FILE__);

$directorio_certificado_seguridad = dirname(__FILE__);
$nombre_archivo_certificado_seguridad = "cacert.pem";
$ruta_certificado_seguridad_comilla = $directorio_certificado_seguridad.'\"'.$nombre_archivo_certificado_seguridad;
$ruta_certificado_seguridad = str_replace('"', '', $ruta_certificado_seguridad_comilla);

echo "<br>ruta_certificado_seguridad = ".$ruta_certificado_seguridad;

$headers = [ 'Content-Type: application/json', 'Auth-token: '.$dataico_auth_token ];

echo "<br>headers = ".print_r($headers);

?>