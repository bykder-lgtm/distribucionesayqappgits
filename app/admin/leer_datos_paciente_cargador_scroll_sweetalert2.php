<div class="table-responsive">
<table class="table table-striped jambo_table bulk_action">
	<thead>
		<tr class="headings">
			<th class="column-title">Cedula</th>
			<th class="column-title">Nombre</th>
			<th class="column-title">Telefono</th>
			<th class="column-title">Correo</th>
			<th class="column-title">Direccion</th>
			<th class="column-title">Cod</th>
			<th class="column-title">Edit</th>
		</tr>
	</thead>
        <tbody>
<?php
require_once '../conexiones/conexione.php';

//if(isset($_REQUEST["final_limite"], $_REQUEST["inicio_limite"])) {
//$inicio_limite              = intval($_REQUEST['inicio_limite']);
//$final_limite               = intval($_REQUEST['final_limite']);

if (isset($_REQUEST["inicio_limite"])) { $inicio_limite = intval($_REQUEST['inicio_limite']); } else { $inicio_limite = '0'; }
if (isset($_REQUEST["final_limite"])) { $final_limite = intval($_REQUEST['final_limite']); } else { $final_limite = '20'; }

$sql_lista_registro = "SELECT * FROM tbl15_tercero ORDER BY cod_tercero ASC LIMIT $inicio_limite, $final_limite";
$consultar_lista_registro = mysqli_query($conectar, $sql_lista_registro) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consultar_lista_registro);

if($total_reg > 0) {

while ($info_lista_registro = mysqli_fetch_assoc($consultar_lista_registro)) {
	$cod_tercero                         = $info_lista_registro['cod_tercero'];
	$identificacion_tercero              = $info_lista_registro['identificacion_tercero'];
	$nombre1_tercero                     = $info_lista_registro['nombre1_tercero'];
	$telefono1_tercero                   = $info_lista_registro['telefono1_tercero'];
	$correo_tercero                      = $info_lista_registro['correo_tercero'];
	$direccion_tercero                   = $info_lista_registro['direccion_tercero'];
?>
		<tr class="even pointer">
			<td><?php echo $identificacion_tercero?></td>
			<td><?php echo $nombre1_tercero ?></td>
			<td><?php echo $telefono1_tercero?></td>
			<td><?php echo $correo_tercero?></td>
			<td><?php echo $direccion_tercero?></td>
			<td><?php echo $cod_tercero?></td>
			<td style="text-align:center"><a id="info_ajax" data-id="<?php echo $cod_tercero.'|'.$nombre1_tercero.'|'.$identificacion_tercero; ?>" href="javascript:void(0)"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
		</tr>
<?php }	} else { ?> <tr><td colspan="3">No se encontraron registros</td></tr> <?php } ?>
	</tbody>
</table>
</div>