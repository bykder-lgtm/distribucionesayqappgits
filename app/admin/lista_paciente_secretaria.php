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
<a href="../admin/lista_paciente_buscar.php"><h4>Buscar Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_paciente.php">Registrar Paciente</h4></a>
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

$sql_cliente = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, 
tbl15_cliente.fecha_nac_time, tbl15_cliente.lugar_nac, tbl15_cliente.nombre_raza, tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_religion, tbl15_cliente.nombre_ocupacion, tbl15_cliente.nombre_estado_civil, 
tbl15_cliente.edad_anyo, tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.tel_contacto1, tbl15_cliente.nombre_contacto2, tbl15_cliente.tel_contacto2, tbl15_cliente.correo, 
tbl15_cliente.nombre_escolaridad, tbl15_cliente.fax, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, tbl15_entidad.nombre_entidad
FROM tbl15_entidad RIGHT JOIN tbl15_cliente ON tbl15_entidad.cod_entidad = tbl15_cliente.cod_entidad ORDER BY tbl15_cliente.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Crear</th>
<th>Cedula</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Entidad</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Correo</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_cliente = $info_cliente['cod_cliente'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$nombre_entidad = $info_cliente['nombre_entidad'];
$tel_cliente = $info_cliente['tel_cliente'];
$correo = $info_cliente['correo'];
$direccion = $info_cliente['direccion'];
?>
<tr>
<td align="center"><a href="../admin/reg_asignar_profesional_paciente_firma_tactil.php?cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/btn_hc_generica.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres?></td>
<td><?php echo $apellido1.' '.$apellido2?></td>
<td><?php echo $nombre_entidad?></td>
<td><?php echo $tel_cliente?></td>
<td><?php echo $direccion?></td>
<td><?php echo $correo?></td>
<td align="center"><a href="../admin/edit_paciente.php?cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/actualizar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php
}
?>
</tbody>
</table><!--End table table table-striped-->
</div><!--End div table-responsive-->
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