<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>

<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){
// Set up the number formatting.
$('#abonado_number').on('change',function(){
//console.log('Change event.');
var abonado_number = $('#abonado_number').val();
$('#the_number').text( abonado_number !== '' ? abonado_number : '(empty)' );
});
//$('#abonado').change(function(){ console.log('Second change event...'); });
$('#abonado_number').number( true, 0 );

$("#abonado_number").keyup(function () {
    var abonado = $(this).val();
    $("#abonado").val(abonado);
});

});
</script>

</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
$pagina                         = $_SERVER['PHP_SELF'];
$cod_administrador_sesion       = $cod_administrador;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_egreso                                           = intval($_GET['cod_egreso']);
$fecha_dmy_ini                                        = addslashes($_GET['fecha_dmy_ini']);
$fecha_dmy_fin                                        = addslashes($_GET['fecha_dmy_fin']);
$cod_tipo_forma_pago                                  = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                                      = intval($_GET['cod_dependencia']);
$nombre_tipo_puc                                      = addslashes($_GET['nombre_tipo_puc']);
$pagina                                               = addslashes($_GET['pagina']);

$palabra                                              = '';
$pagina_redirect                                      = $pagina.'?fecha_dmy_ini='.$fecha_dmy_ini.'&fecha_dmy_fin='.$fecha_dmy_fin.'&cod_tipo_forma_pago='.$cod_tipo_forma_pago.'&cod_dependencia='.$cod_dependencia.'&nombre_tipo_puc='.$nombre_tipo_puc;
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="breadcrumbs">
<a class="btn btn-primary" href="<?php echo $pagina_redirect;?>">Regresar</a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_ingreso = "SELECT * FROM tbl15_egreso WHERE (cod_egreso = '$cod_egreso')";
$resultado_ingreso = mysqli_query($conectar, $sql_ingreso) or die(mysqli_error($conectar));
$total_ingreso = mysqli_num_rows($resultado_ingreso);
$info_ingreso = mysqli_fetch_assoc($resultado_ingreso);

$cod_egreso                             = $info_ingreso['cod_egreso'];
$conceptos                              = $info_ingreso['conceptos'];
$costo                                  = $info_ingreso['costo'];
$comentario                             = $info_ingreso['comentario'];
$cod_concepto_movimiento_caja           = $info_ingreso['cod_concepto_movimiento_caja'];
$nombre_concepto_movimiento_caja        = $info_ingreso['nombre_concepto_movimiento_caja'];
$cod_tipo_puc                           = $info_ingreso['cod_tipo_puc'];
$nombre_tipo_puc                        = $info_ingreso['nombre_tipo_puc'];
$simbolo_tipo_operacion                 = $info_ingreso['simbolo_tipo_operacion'];
$cod_tipo_forma_pago                    = $info_ingreso['cod_tipo_forma_pago'];
$fecha_dmy                              = $info_ingreso['fecha_dmy'];
$cod_cuentas_pagar                      = $info_ingreso['cod_cuentas_pagar'];
$cod_tercero                            = $info_ingreso['cod_tercero'];
$cod_dependencia                        = $info_ingreso['cod_dependencia'];
$url_img_orig_producto                  = $info_ingreso['url_img_orig_producto'];
$url_img_min_producto                   = $info_ingreso['url_img_min_producto'];
?>
<div class="table-responsive">

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria_archivo_adjunto_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL <?php echo $nombre_tipo_puc ?> - CARGAR SOPORTE</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CONCEPTO</th>
            <th style="text-align:center">VALOR</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">FECHA</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_concepto_movimiento_caja ?></td>
            <td style="text-align:center"><?php echo number_format($costo, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $comentario ?></td>
            <td style="text-align:center"><?php echo $fecha_dmy ?></td>
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR SOPORTE PAGO</th>
			<?php if ($url_img_orig_producto) { ?><th style="text-align:center">VER SOPORTE PAGO</th><?php } ?>
			<th style="text-align:center">GUARDAR</th>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required></td>
			<?php if ($url_img_orig_producto) { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } ?>
			<td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
        </tr>
    </thead>
</table>
</fieldset>

<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_egreso" value="<?php echo $cod_egreso; ?>">
<input type="hidden" name="fecha_dmy_ini" value="<?php echo $fecha_dmy_ini; ?>">
<input type="hidden" name="fecha_dmy_fin" value="<?php echo $fecha_dmy_fin; ?>">
<input type="hidden" name="cod_tipo_forma_pago" value="<?php echo $cod_tipo_forma_pago; ?>">
<input type="hidden" name="cod_dependencia" value="<?php echo $cod_dependencia; ?>">
<input type="hidden" name="nombre_tipo_puc" value="<?php echo $nombre_tipo_puc; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
<input type="hidden" name="insertar_datos" value="formulario">
</form>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>