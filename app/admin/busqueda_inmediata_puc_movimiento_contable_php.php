<?php
include_once('../conexiones/conexione.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);
$cod_seguridad                      = ($_SESSION['cod_seguridad']);
//----------------------------------------------------------------------------------------------------------------//
$buscar                                                            = addslashes($_POST['buscar']);
$nombre_modulo_puc                                                 = addslashes($_POST['nombre_modulo_puc']);
$cod_tipo_forma_pago                                               = addslashes($_POST['cod_tipo_forma_pago']);
$pagina                                                            = addslashes($_POST['pagina']);

$tab                      = 'tbl15_puc';
$campo                    = 'cod_puc';
$tipo                     = 'insertar';
$foco                     = 'busqueda';

if($buscar <> NULL) {
		$mostrar_datos_sql = "SELECT * FROM tbl15_puc WHERE (codigo_puc LIKE '$buscar') OR (nombre_puc LIKE '%$buscar%') ORDER BY nombre_puc ASC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);

	echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
?>
	<br>
	<table class="table table-striped">
		<tr>
			<th style="text-align:center;">CODIGO</th>
			<th style="text-align:left;">NOMBRE</th>
			<th style="text-align:center;">TIPO</th>
		</tr>
	<?php
	while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

		$cod_puc                         = $matriz_consulta['cod_puc'];
		$codigo_puc                      = $matriz_consulta['codigo_puc'];
		$nombre_puc                      = $matriz_consulta['nombre_puc'];
		$tipo_puc                        = $matriz_consulta['tipo_puc'];
	?>
		<tr>
			<td style="text-align:center;"><?php echo $codigo_puc; ?></td>
			<td style="text-align:left;"><a href="../admin/reg_parametrizacion_puc_movimiento_contable_reg.php?cod_puc=<?php echo $cod_puc?>&codigo_puc=<?php echo $codigo_puc?>&nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&pagina=<?php echo $pagina?>"><?php echo $nombre_puc ?></a></td>
			<td style="text-align:center;"><?php echo $tipo_puc; ?></td>
		</tr>
	<?php } ?>
	</table>
<?php } else { } ?>