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
<!--
<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>
<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<a class="btn btn-warning" href="../admin/lista_cuentas_cobrar_alerta_historial_alquiler_inquilino_detalle.php">Reporte Alquiler Viejo</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="btn btn-success" href="../admin/lista_cuentas_cobrar_alerta_agrupado_historial_alquiler_inquilino_detalle.php">Reporte Alquiler Nuevo</a>
<?php } ?>
<br>
-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">

<?php 
$pagina = $_SERVER['PHP_SELF']; 
$cod_estado_pago = 0;
$buscar_por = 10;

if (isset($_GET['cod_estado_hoy'])) { $cod_estado_hoy = addslashes($_GET['cod_estado_hoy']); } else { $cod_estado_hoy = '1'; }
if (isset($_GET['cod_estado_pago'])) { $cod_estado_pago = addslashes($_GET['cod_estado_pago']); } else { $cod_estado_pago = '0'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'documento_nombre_inquilino'; }
if (isset($_GET['fecha_alerta_ini'])) { $fecha_alerta_ini = addslashes($_GET['fecha_alerta_ini']); } else { $fecha_alerta_ini = date("Y-m-d"); }
if (isset($_GET['fecha_alerta_fin'])) { $fecha_alerta_fin = addslashes($_GET['fecha_alerta_fin']); } else { $fecha_alerta_fin = date("Y-m-d"); }
?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->              
<!-- Form search -->
<form class="form-horizontal" role="form" id="ingresos">
<table class="table table-bordered table-hover table-sm">
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ALERTA COMISION A PAGAR A PROPIETARIO EXLUIDOS</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"></th>
    </tr>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">DIA PAGO PROP: <input type="date" name="fecha_alerta_ini" id="fecha_alerta_ini" class="form-control" value="<?php echo $fecha_alerta_ini ;?>" onchange='load(1);'></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><input type="hidden" name="fecha_alerta_fin" id="fecha_alerta_fin" class="form-control" value="<?php echo $fecha_alerta_fin ;?>" onchange='load(1);'></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px"><a href="../admin/lista_alerta_alquiler_comision_propietario.php">INCLUIDO PAGO PROP</a></th>
    </tr>
</table>
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
<!--
        <div class="col-md-4">
            <td bgcolor="#fff" align="center"><strong></strong>

            <select class="form-control" name="cod_estado_hoy" id="cod_estado_hoy" onchange="load(1)" style="width: 110px;">
            <?php if (isset($cod_estado_hoy)) { echo ""; } else { echo ""; }
            $consulta2_sql = ("SELECT cod_estado_hoy, nombre_estado_hoy FROM tbl15_estado_hoy WHERE (cod_estado = '1') ORDER BY cod_estado_hoy ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_estado_hoy) and $cod_estado_hoy == $datos2['cod_estado_hoy']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_estado_hoy'];
            $nombre = $datos2['nombre_estado_hoy'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>


            <select class="form-control" name="cod_estado_pago" id="cod_estado_pago" onchange="load(1)" style="width: 130px;">
            <?php if (isset($cod_estado_pago)) { echo "<option value='-1' selected >TODO</option>"; } else { echo "<option value='-1' selected >TODO</option>"; }
            $consulta2_sql = ("SELECT cod_estado_pago, nombre_estado_pago FROM tbl15_estado_pago WHERE (cod_estado = '1') ORDER BY cod_estado_pago ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_estado_pago) and $cod_estado_pago == $datos2['cod_estado_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_estado_pago'];
            $nombre = $datos2['nombre_estado_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

            <select class="form-control" name="buscar_por" id="buscar_por" onchange="load(1)" style="width: 180px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '3') AND (cod_estado = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
        </div>
-->

        <input type="hidden" id="tabla" value="tbl15_producto">
        <input type="hidden" name="cod_estado_hoy" id="cod_estado_hoy" value="1">
        <input type="hidden" name="cod_estado_pago" id="cod_estado_pago" value="0">
        <input type="hidden" name="buscar_por" id="buscar_por" value="documento_nombre_inquilino">

        <input type="hidden" id="pagina" value="<?php echo $pagina ?>">
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
<script type="text/javascript" src="../admin/busqueda_paginacion_alerta_alquiler_comision_propietario_exluido_ajax.js"></script>

</body>
</html>