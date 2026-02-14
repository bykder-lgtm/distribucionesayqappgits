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
<div class="breadcrumbs"><a href="#"><h4>Remisión</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
 	 	 	
$sql_cliente = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.cod_tipo_historia_clinica, tbl15_historia_clinica.cod_estado_facturacion, 
tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.motivo, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_historia_clinica.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.url_img_firma, tbl15_cliente.url_img_foto, 
tbl15_cliente.apellido2, tbl15_administrador.cuenta, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof 
FROM (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) WHERE (tbl15_historia_clinica.cod_estado_facturacion = '1') ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
?>
<div class="table-responsive">
<table id="tabla_clase_datatable" class="table table-bordered">
<thead>
<tr>
<th>Cedula</th>
<th>Nombre Paciente</th>
<th>Motivo</th>
<th>Nombre Profesional</th>
<th>Fecha</th>
<th>Hora</th>
<th>Imp</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_historia_clinica              = $info_cliente['cod_historia_clinica'];
$cod_cliente                       = $info_cliente['cod_cliente'];
$cod_administrador_hist            = $info_cliente['cod_administrador'];
$cedula                            = $info_cliente['cedula'];
$nombres                           = $info_cliente['nombres'];
$apellido1                         = $info_cliente['apellido1'];
$apellido2                         = $info_cliente['apellido2'];
$motivo                            = $info_cliente['motivo'];
$nombre_prof                       = $info_cliente['nombre_prof'];
$apellidos_prof                    = $info_cliente['apellidos_prof'];
$url_img_firma_min                 = $info_cliente['url_img_firma_min'];
$url_img_firma_orig                = $info_cliente['url_img_firma_orig'];
$url_img_foto_min                  = $info_cliente['url_img_foto_min'];
$url_img_foto_orig                 = $info_cliente['url_img_foto_orig'];
$url_img_firma                     = $info_cliente['url_img_firma'];
$url_img_foto                      = $info_cliente['url_img_foto'];
$fecha_time                        = $info_cliente['fecha_time'];
$fecha_dmy                         = date("Y/m/d", $fecha_time);
$hora                              = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
<td align="center"><a href="../admin/ver_remision_version_pdf.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<td align="center"><a href="../admin/reg_remision.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#tabla_clase_datatable').DataTable( {
    	"lengthMenu": [[5, 10, 25, 50, 100, 200, 300, -1], [5, 10, 25, 50, 100, 200, 300, "Todo"]],
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