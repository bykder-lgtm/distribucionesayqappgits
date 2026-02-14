<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Clientes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
//-----------------------------------------------------------------------------------------------------------------//
if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else { 
        $condicional_consulta_tercero = 'AND cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_tercero_rel = 'WHERE cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_cuenta_cobrar = 'WHERE cod_administrador = "'.$cod_administrador.'"';
    }

} else { 
$condicional_consulta_tercero = ''; 
$condicional_consulta_tercero_rel = '';
$condicional_consulta_cuenta_cobrar = '';
}
//-----------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">
<table class="table table-striped">
	<thead>
		<tr>
			<th style="text-align:center"><a href="../admin/lista_tercero.php">Total Terceros</a></th>
			<th style="text-align:center"><a href="../admin/lista_tercero_cliente.php">Total Clientes</a></th>
			<th style="text-align:center"><a href="../admin/lista_tercero_proveedor.php">Total Proveedores</a></th>
		</tr>
	</thead>
	<tbody>
<?php
$sql_tercero_total = "SELECT * FROM tbl15_tercero";
$resultado_tercero_total = mysqli_query($conectar, $sql_tercero_total);
$total_reg = mysqli_num_rows($resultado_tercero_total);

$sql_tercero_cliente = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'CLIENTE')";
$resultado_tercero_cliente = mysqli_query($conectar, $sql_tercero_cliente);
$total_reg_cliente = mysqli_num_rows($resultado_tercero_cliente);

$sql_tercero_proveedor = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'PROVEEDOR')";
$resultado_tercero_proveedor = mysqli_query($conectar, $sql_tercero_proveedor);
$total_reg_proveedor = mysqli_num_rows($resultado_tercero_proveedor);
?>
		<tr>
			<td style="text-align:center"><?php echo number_format($total_reg, 0, ",", ".")?></td>
			<td style="text-align:center"><?php echo number_format($total_reg_cliente, 0, ",", ".")?></td>
			<td style="text-align:center"><?php echo number_format($total_reg_proveedor, 0, ",", ".")?></td>
		</tr>
	</tbody>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Tipo</th>
<th style="text-align:center">T.Doc</th>
<th style="text-align:center">Documento</th>
<th style="text-align:center">Nombre Tercero</th>
<th style="text-align:center">Direccion</th>
<th style="text-align:center">Telefono</th>
<th style="text-align:center">Ciudad</th>
<th style="text-align:center">Usuario</th>
<th style="text-align:center">Cod</th>
<?php if ($cod_estado_tercero_editar == '1') { ?>
<th style="text-align:center">Edit</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'CLIENTE') ORDER BY cod_tercero DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
 
	$cod_tercero                   = $info_cliente['cod_tercero'];
	$nombre_tipo_tercero           = $info_cliente['nombre_tipo_tercero'];
	$nombre_tipo_identificacion    = $info_cliente['nombre_tipo_identificacion'];
	$identificacion_tercero        = $info_cliente['identificacion_tercero'];
	$digito_tercero                = $info_cliente['digito_tercero'];
	$nombre1_tercero               = $info_cliente['nombre1_tercero'];
	$nombre2_tercero               = $info_cliente['nombre2_tercero'];
	$apellido1_tercero             = $info_cliente['apellido1_tercero'];
	$apellido2_tercero             = $info_cliente['apellido2_tercero'];
	$direccion_tercero             = $info_cliente['direccion_tercero'];
	$telefono1_tercero             = $info_cliente['telefono1_tercero'];
	$telefono2_tercero             = $info_cliente['telefono2_tercero'];
	$correo_tercero                = $info_cliente['correo_tercero'];
	$nombre_pais                   = $info_cliente['nombre_pais'];
	$nombre_departamento           = $info_cliente['nombre_departamento'];
	$nombre_ciudad                 = $info_cliente['nombre_ciudad'];
	$nombre_tipo_cliente           = $info_cliente['nombre_tipo_cliente'];
	$nombre_tipo_regimen           = $info_cliente['nombre_tipo_regimen'];
	$nombre_tipo_impuesto          = $info_cliente['nombre_tipo_impuesto'];
	$contacto_tercero              = $info_cliente['contacto_tercero'];
	$fax_tercero                   = $info_cliente['fax_tercero'];
	$cod_administrador             = $info_cliente['cod_administrador'];

	$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
	$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
	$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
	 	
	$cedula                        = $info_usuario_admin['cedula'];
	$nombres                       = $info_usuario_admin['nombres'];
	$apellidos                     = $info_usuario_admin['apellidos'];
	$cuenta                        = $info_usuario_admin['cuenta'];
	$usuario                       = $nombres.' '.$apellidos.' | '.$cuenta;
?>
<tr>
<td style="text-align:center"><?php echo $nombre_tipo_tercero?></td>
<td style="text-align:center"><?php echo $nombre_tipo_identificacion?></td>
<td style="text-align:center"><?php echo $identificacion_tercero?></td>
<td style="text-align:left"><?php echo $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero?></td>
<td style="text-align:left"><?php echo $direccion_tercero?></td>
<td style="text-align:center"><?php echo $telefono1_tercero?></td>
<td style="text-align:center"><?php echo $nombre_ciudad?></td>
<td style="text-align:center"><?php echo $usuario?></td>
<td style="text-align:center"><?php echo $cod_tercero?></td>
<?php if ($cod_estado_tercero_editar == '1') { ?>
<td style="text-align:center"><a href="../admin/edit_tercero.php?cod_tercero=<?php echo $cod_tercero?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>