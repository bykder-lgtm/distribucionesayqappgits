<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); 
$fecha_hoy = date("d/m/Y");
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$cod_cliente = intval($_GET['cod_cliente']);

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$sql_historia_clinica = "SELECT motivo, total_terapia, fecha_time FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$sql_evolucion = "SELECT COUNT(cod_evolucion) AS conteo_evoluciones FROM tbl15_evolucion WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_evolucion = mysqli_query($conectar, $sql_evolucion) or die(mysqli_error($conectar));
$datos_evolucion = mysqli_fetch_assoc($consulta_evolucion);

$sql_tipo_historia_clinica = "SELECT estructura_evolucion  FROM tbl15_tipo_historia_clinica WHERE cod_tipo_historia_clinica = '$cod_tipo_historia_clinica'";
$consulta_tipo_historia_clinica = mysqli_query($conectar, $sql_tipo_historia_clinica) or die(mysqli_error($conectar));
$datos_tipo_historia_clinica = mysqli_fetch_assoc($consulta_tipo_historia_clinica);

$motivo = $datos_historia_clinica['motivo'];
$total_terapia = $datos_historia_clinica['total_terapia'];
$conteo_evoluciones_ini = $datos_evolucion['conteo_evoluciones'];
$conteo_evoluciones = $datos_evolucion['conteo_evoluciones'] + 1;
$fecha_time = $datos_historia_clinica['fecha_time'];
$fecha_ymd_hora = date("Y/m/d H:i:s", $fecha_time);
$estructura_evolucion = $datos_tipo_historia_clinica['estructura_evolucion'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_evolucion.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>"><h4>Ver Evoluciones (<?php echo $conteo_evoluciones_ini ?>)</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cedula = $datos_cliente['cedula'];
$nombre_tipo_doc = $datos_cliente['nombre_tipo_doc'];
$fecha_nac_time = $datos_cliente['fecha_nac_time'];
$fecha_nac_ymd = date("Y/m/d", $fecha_nac_time);
$diferencia_edad = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo = floor($diferencia_edad / (365*60*60*24));
$direccion = $datos_cliente['direccion'];
$cod_entidad = $datos_cliente['cod_entidad'];
$nombre_sexo = $datos_cliente['nombre_sexo'];
$nombre_contacto1 = $datos_cliente['nombre_contacto1'];
$parentesco_contacto1 = $datos_cliente['parentesco_contacto1'];
$tel_contacto1 = $datos_cliente['tel_contacto1'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad = $info_entidad['nombre_entidad'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/reg_evolucion_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr><th>EVOLUCIÓN No.</th><td><?php echo $conteo_evoluciones ?> </td><td>DE</td><td><?php echo $total_terapia ?></td></tr></thead><tbody></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th valign="middle">MOTIVO DE LA CONSULTA: <?php echo $motivo ?></th></tr></thead></table>
<table border="1" class="table table-responsive"><thead><tr><th valign="middle">1.1 DATOS DE IDENTIFICACIÓN DEL PACIENTE</th></tr></thead></table>
<table border="1" class="table table-responsive">
	<thead><tr><th>PRIMER APELLIDO</th><th>SEGUNDO APELLIDO</th><th>NOMBRES COMPLETOS </th></tr></thead>
    <tbody><tr><td><?php echo ($apellido1) ?></td><td><?php echo ($apellido2) ?></td><td><?php echo ($nombres) ?></td></tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr><th>TIPO DE IDENTIFICACIÓN</th><th>NUMERO</th></tr></thead>
    <tbody><tr><td><?php echo ($nombre_tipo_doc) ?></td><td><?php echo ($cedula) ?></td></tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr><th>FECHA DE NACIMIENTO</th><th>EDAD</th><th>SEXO</th><th>CARNET DE SALUD</th><th>DOMICILIO</th></tr></thead>
    <tbody><tr><td><?php echo ($fecha_nac_ymd) ?></td><td><?php echo ($edad_anyo) ?> Años</td><td><?php echo ($nombre_sexo) ?></td><td><?php echo ($nombre_entidad) ?></td><td><?php echo ($direccion) ?></td></tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr><th>FECHA Y HORA:</th><td><div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_ymd_hora ?>" readonly></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>
</td></tr></thead><tbody></tbody>
</table>


<table border="1" class="table table-responsive"><thead><tr><th valign="middle"><a href="#">EVOLUCIÓN</a></th></tr></thead></table>

<table border="1" class="table table-responsive">
<thead><td><textarea rows="11" name="nombre_evolucion" class="input-block-level"><?php echo ($estructura_evolucion) ?></textarea></td></thead>
</table>

<div class="modal fade" id="ventana_modal_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--<h4 class="modal-title">Listado Cie - 10</h4>-->
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script>
$('.openBtn').on('click',function(){
    $('.modal-body').load('cie10_ventana_modal_buscador.php?id=2',function(){
        $('#ventana_modal_id').modal({show:true});
    });
});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="fecha_dmy" value="<?php echo $fecha_hoy ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>
<!--
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>
-->
<!-- <script src="../js/jquery-1.12.4.js"></script>-->
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script>
$( function() {
$( "#fecha_dmy" ).datepicker();
} );
</script>
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
nombre_evolucion = CKEDITOR.replace("nombre_evolucion");
CKFinder.setupCKEditor(nombre_evolucion, 'ckeditor/ckfinder');
}
</script>

</body>
</html>