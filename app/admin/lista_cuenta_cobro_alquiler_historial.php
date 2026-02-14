<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<h4><a href="#">Cuentas de cobro por mes</a></h4>
</div>

<div class="row-fluid">
<div class="span12" id="divMain">

<?php 
$pagina                                    = $_SERVER['PHP_SELF']; 
$nombre_tabla_anyo                         = date("Y");

if (isset($_GET['cod_estado_hoy'])) { $cod_estado_hoy = addslashes($_GET['cod_estado_hoy']); } else { $cod_estado_hoy = '1'; }
if (isset($_GET['cod_estado_pago'])) { $cod_estado_pago = addslashes($_GET['cod_estado_pago']); } else { $cod_estado_pago = '-1'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }
if (isset($_GET['cod_estado_envio_correo_cuenta_cobro'])) { $cod_estado_envio_correo_cuenta_cobro = addslashes($_GET['cod_estado_envio_correo_cuenta_cobro']); } else { $cod_estado_envio_correo_cuenta_cobro = '0'; }

?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->              
<!-- Form search -->
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4">
            <td bgcolor="#fff" align="center"><strong></strong>AÑO: 
                <select class="form-control" name="nombre_tabla_anyo" id="nombre_tabla_anyo" onchange="load(1)" style="width: 70px;">
                    <?php if (isset($nombre_tabla_anyo)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tabla_anyo, nombre_tabla_anyo FROM tbl15_tabla_anyo ORDER BY nombre_tabla_anyo ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tabla_anyo) and $nombre_tabla_anyo == $datos2['nombre_tabla_anyo']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tabla_anyo'];
                    $nombre = $datos2['nombre_tabla_anyo'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select> ESTADO PAGO: 
                <select class="form-control" name="cod_estado_pago" id="cod_estado_pago" onchange="load(1)" style="width: 130px;">
                    <?php if (isset($cod_estado_pago)) { echo "<option value='-1' selected >TODO</option>"; } else { echo "<option value='-1' selected >TODO</option>"; }
                    $consulta2_sql = ("SELECT cod_estado_pago, nombre_estado_pago FROM tbl15_estado_pago WHERE (cod_estado = '1') ORDER BY cod_estado_pago ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_pago) and $cod_estado_pago == $datos2['cod_estado_pago']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado_pago'];
                    $nombre = $datos2['nombre_estado_pago'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select> ESTADO CORREO: 
                <select class="form-control" name="cod_estado_envio_correo_cuenta_cobro" id="cod_estado_envio_correo_cuenta_cobro" onchange="load(1)" style="width: 130px;">
                    <?php if (isset($cod_estado_envio_correo_cuenta_cobro)) { echo "<option value='-1' selected >TODO</option>"; } else { echo "<option value='-1' selected >TODO</option>"; }
                    $consulta2_sql = ("SELECT cod_estado_envio_correo, nombre_estado_envio_correo, cod_estado FROM tbl15_estado_envio_correo WHERE (cod_estado = '1') ORDER BY cod_estado_envio_correo ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_envio_correo_cuenta_cobro) and $cod_estado_envio_correo_cuenta_cobro == $datos2['cod_estado_envio_correo']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado_envio_correo'];
                    $nombre = $datos2['nombre_estado_envio_correo'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
        </div>
        <input type="hidden" id="tabla" Value="tbl15_producto">
        <input type="hidden" id="pagina" Value="<?php echo $pagina ?>">
        <input type="hidden" id="cod_estado_hoy" Value="<?php echo $cod_estado_hoy ?>">
        <input type="hidden" id="cod_estado_pago" Value="<?php echo $cod_estado_pago ?>">
        <input type="hidden" id="buscar_por" Value="<?php echo $buscar_por ?>">
        <input type="hidden" id="cod_estado_envio_correo_cuenta_cobro" Value="<?php echo $cod_estado_envio_correo_cuenta_cobro ?>">
</form>
<!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
    </div><!-- /page content -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>
<script type="text/javascript" src="../admin/busqueda_paginacion_cuenta_cobro_alquiler_historial_ajax.js"></script>

</body>
</html>