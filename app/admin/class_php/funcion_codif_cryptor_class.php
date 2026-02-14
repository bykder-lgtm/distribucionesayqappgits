<?php
include_once('../conexiones/conexione_cryp.php');

$sql_cryptor = "SELECT cod_cryptor, method, secret_key, secret_iv FROM tbl15_cryptor WHERE cod_cryptor = '1'";
$consulta_cryptor = mysqli_query($conectar3, $sql_cryptor) or die(mysqli_error($conectar3));
$datos_cryptor = mysqli_fetch_assoc($consulta_cryptor);

$method                      = $datos_cryptor['method'];
$secret_key                  = $datos_cryptor['secret_key'];
$secret_iv                   = $datos_cryptor['secret_iv'];

define('METHOD', $method);
define('SECRET_KEY', $secret_key);
define('SECRET_IV', $secret_iv);
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
class DAXCODIFCRYPTOR {
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
public static function encriptardax($valor_recib){
$salida                      = FALSE;
$key                         = hash('sha256', SECRET_KEY);
$iv                          = substr(hash('sha256', SECRET_IV), 0, 16);
$salida                      = openssl_encrypt($valor_recib, METHOD, $key, 0, $iv);
$salida                      = base64_encode($salida);
return $salida;
}
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
public static function descriptardax($valor_recib){
$key                         = hash('sha256', SECRET_KEY);
$iv                          = substr(hash('sha256', SECRET_IV), 0, 16);
$salida                      = openssl_decrypt(base64_decode($valor_recib), METHOD, $key, 0, $iv);
return $salida;
}
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
public static function encodifdax($valor_recib){
$salida                      = FALSE;
$random_codif_pos4_ini       = rand(1000, 9999);
$random_codif_pos4_fin       = rand(1000, 9999);
$cantidad_digito1            = strlen($valor_recib);
$codificacion_dax            = $cantidad_digito1.$random_codif_pos4_ini.$valor_recib.$random_codif_pos4_fin;
$salida_encodif              = str_pad($codificacion_dax, 15, $random_codif_pos4_ini, STR_PAD_RIGHT);
$salida                      = ($salida_encodif);

return $salida;
}
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
public static function descodifdax($valor_recib){
$salida_descrycodif          = 0;
$fragcodif                   = str_split($valor_recib);
$numero_de_digitos           = $fragcodif[0];

if ($numero_de_digitos == 1) { $salida_descrycodif = $fragcodif[5]; } 
if ($numero_de_digitos == 2) { $salida_descrycodif = $fragcodif[5].$fragcodif[6]; } 
if ($numero_de_digitos == 3) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7]; } 
if ($numero_de_digitos == 4) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8]; } 
if ($numero_de_digitos == 5) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8].$fragcodif[9]; } 
if ($numero_de_digitos == 6) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8].$fragcodif[9].$fragcodif[10]; } 
if ($numero_de_digitos == 7) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8].$fragcodif[9].$fragcodif[10].$fragcodif[11]; }
if ($numero_de_digitos == 8) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8].$fragcodif[9].$fragcodif[10].$fragcodif[11].$fragcodif[12]; }
if ($numero_de_digitos == 9) { $salida_descrycodif = $fragcodif[5].$fragcodif[6].$fragcodif[7].$fragcodif[8].$fragcodif[9].$fragcodif[10].$fragcodif[11].$fragcodif[12].$fragcodif[13]; }
$salida                      = $salida_descrycodif;

return $salida;
}
public static function encodiftextodax($valor_recib){
$salida                      = FALSE;
$random_codif_pos4_ini       = rand(1000, 9999);
$random_codif_pos4_fin       = rand(1000, 9999);
$pagina_codif                = $random_codif_pos4_ini.'|'.$valor_recib.'|'.$random_codif_pos4_fin;
$salida                      = ($pagina_codif);

return $salida;
}
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
public static function descodiftextodax($valor_recib){
$salida_descrycodif          = 0;
$pagina_codif                = ($valor_recib);
$frag_pag                    = explode('|', $pagina_codif);
$pagina                      = $frag_pag[1];
$salida                      = $pagina;

return $salida;
}
//***************************************************************************************************************************************//
//***************************************************************************************************************************************//
}

class DAXCRYPTOR {
public static function encriptardax($string){
	$output = FALSE;
	$key    = hash('sha256', SECRET_KEY);
	$iv     = substr(hash('sha256', SECRET_IV), 0, 16);
	$output = openssl_encrypt($string, METHOD, $key, 0, $iv);
	$output = base64_encode($output);
	return $output;
}
public static function descriptardax($string){
	$key    = hash('sha256', SECRET_KEY);
	$iv     = substr(hash('sha256', SECRET_IV), 0, 16);
	$output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
	return $output;
}
}
?>