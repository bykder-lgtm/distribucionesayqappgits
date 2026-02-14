<?php
  $bd_host = "localhost"; 
  $bd_usuario = "hlaboral"; 
  $bd_password = "e114b6edc3c893b3092f564dfbd3203a"; 
  $bd_base = "hlaboral"; 
 
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
	mysql_select_db($bd_base, $con); 
 ?>
<html>
  <head>
  <title>Registro de empleados</title>
  <script language="JavaScript" type="text/javascript" src="ajax.js"></script>
  </head>
  <body>
		<form name="nuevo_empleado" action="" onsubmit="enviarDatosEmpleado(); return false">
			<h2>Nuevo empleado</h2>
				<table>
                <tr>
                	<td>Nombres</td><td><label><input name="nombre" type="text" /></label></td>
               	</tr>
                <tr>
					<td>Apellido</td><td><label><input type="text" name="apellido"></label></td>
				</tr>
                <tr>
                    <td>Web</td><td><label><input name="web" type="text" /></label></td>
				</tr>
                <tr>
                   	<td>&nbsp;</td><td><label><input type="submit" name="Submit" value="Grabar" /></label></td>
                </tr>
                </table>
		</form>
 
		<div id="resultado">
<?php 
$sql=mysql_query("SELECT * FROM empleados",$con);
?>
<table style="color:#000099;width:400px;">
	<tr style="background:#9BB;">
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Web</td>
	</tr>
<?php
  while($row = mysql_fetch_array($sql)){
  echo "<tr>";
  	echo "<td>".$row['nombre']."</td>";
  	echo "<td>".$row['apellido']."</td>";
  	echo "<td>".$row['web']."</td>";
  	echo "</tr>";
  }
?>
</table>
<?php include('consulta.php'); ?>
		</div>
 
    </body>
</html>