<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
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

$sql_cliente = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, 
tbl15_cliente.fecha_nac_time, tbl15_cliente.lugar_nac, tbl15_cliente.nombre_raza, tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_religion, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.nombre_estado_civil, 
tbl15_cliente.edad_anyo, tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.tel_contacto1, tbl15_cliente.nombre_contacto2, 
tbl15_cliente.tel_contacto2, tbl15_cliente.correo, 
tbl15_cliente.nombre_escolaridad, tbl15_cliente.fax, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_entidad.nombre_entidad, tbl15_cliente.fecha_time,
tbl15_cliente.nombre_contacto1, tbl15_cliente.parentesco_contacto1, tbl15_cliente.direccion_contacto1
FROM tbl15_entidad RIGHT JOIN tbl15_cliente ON tbl15_entidad.cod_entidad = tbl15_cliente.cod_entidad WHERE tbl15_cliente.fax = '0' ORDER BY tbl15_cliente.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table id="tabla_clase_datatable" class="table table-bordered">
<thead>
<tr>
<th>Cedula</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Fecha Nacimiento</th>
<th>Fecha Registro</th>
<th>Telefono Paciente</th>
<th>Nombre Contacto</th>
<th>Telefono Contacto</th>
<th>Parentesco Contacto</th>
<th>Direccion Contacto</th>
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
$fecha_nac_ymd = $info_cliente['fecha_nac_ymd'];
$fecha_time = $info_cliente['fecha_time'];
$fecha_reg = date("Y/m/d", $fecha_time);
$nombre_contacto1 = $info_cliente['nombre_contacto1'];
$tel_contacto1 = $info_cliente['tel_contacto1'];
$parentesco_contacto1 = $info_cliente['parentesco_contacto1'];
$direccion_contacto1 = $info_cliente['direccion_contacto1'];
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres?></td>
<td><?php echo $apellido1.' '.$apellido2 ?></td>
<td align="center"><?php echo $fecha_nac_ymd?></td>
<td align="center"><?php echo $fecha_reg?></td>
<td align="center"><?php echo $tel_cliente?></td>
<td align="center"><?php echo $nombre_contacto1?></td>
<td align="center"><?php echo $tel_contacto1?></td>
<td align="center"><?php echo $parentesco_contacto1?></td>
<td align="center"><?php echo $direccion_contacto1?></td>

</tr>
<?php } ?>
</tbody>
</table><!--End table table table-striped-->
</div><!--End div table-responsive-->

<script type="text/javascript">
$(document).ready(function() {
    $('#tabla_clase_datatable').DataTable( {
    	"lengthMenu": [[10, 40, 50, 60, 70, 80, 100, 200, 300, 400, 500, 600, 700, 800, -1], [10, 40, 50, 60, 70, 80, 100, 200, 300, 400, 500, 600, 700, 800, "Todo"]],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "order": [[ 6, "desc" ]],
        "pagingType": "full_numbers",
         stateSave: true

    } );

 $('#tabla_clase_datatable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );


} );
</script>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>