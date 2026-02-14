<?php 
//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "hlaboral"; 
  $bd_password = "e114b6edc3c893b3092f564dfbd3203a"; 
  $bd_base = "hlaboral"; 
 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
 
//variables POST
  $nom=$_POST['nombre'];
  $ape=$_POST['apellido'];
  $web=$_POST['web'];
 
//registra los datos del empleados
  $sql="INSERT INTO empleados (nombre, apellido, web) VALUES ('$nom', '$ape', '$web')";
mysql_query($sql,$con) or die('Error. '.mysql_error());
 
include('consulta.php');
?>