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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Inmueble</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_producto                  = intval($_GET['cod_producto']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra           = $matriz_consulta['cod_producto_barra'];
$nombre_producto              = $matriz_consulta['nombre_producto'];
$und_producto                 = $matriz_consulta['und_producto'];
$precio_compra_producto       = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto        = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];
$precio_venta_producto2       = $matriz_consulta['precio_venta_producto2'];
$precio_venta_producto3       = $matriz_consulta['precio_venta_producto3'];
$precio_venta_producto4       = $matriz_consulta['precio_venta_producto4'];
$precio_venta_producto5       = $matriz_consulta['precio_venta_producto5'];

$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida    = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion     = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta     = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                     = $matriz_consulta['tope_min'];
$iva_ptj                      = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1           = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1            = $matriz_consulta['vencimiento_lote1'];
$fecha_mantenimiento          = $matriz_consulta['fecha_mantenimiento'];
$comision_ptj                 = $matriz_consulta['comision_ptj'];
$cod_dependencia              = $matriz_consulta['cod_dependencia'];
$cod_producto_serial          = $matriz_consulta['cod_producto_serial'];

$cod_rodeo                    = $matriz_consulta['cod_rodeo'];
$nombre_rodeo                 = $matriz_consulta['nombre_rodeo'];
$nombre_sexo                  = $matriz_consulta['nombre_sexo'];
$de_monta                     = $matriz_consulta['de_monta'];
$nombre_estatus               = $matriz_consulta['nombre_estatus'];
$nombre_condicion_corporal    = $matriz_consulta['nombre_condicion_corporal'];
$nombre_categoria_ingreso     = $matriz_consulta['nombre_categoria_ingreso'];
$nombre_categoria_actual      = $matriz_consulta['nombre_categoria_actual'];
$nombre_categoria_futura      = $matriz_consulta['nombre_categoria_futura'];
$nombre_procedencia           = $matriz_consulta['nombre_procedencia'];
$nombre_tipo_monta            = $matriz_consulta['nombre_tipo_monta'];
$nombre_lote_categoria        = $matriz_consulta['nombre_lote_categoria'];
$nombre_prog_reproductivo     = $matriz_consulta['nombre_prog_reproductivo'];
$nombre_potrero               = $matriz_consulta['nombre_potrero'];
$nombre_lote                  = $matriz_consulta['nombre_lote'];
$nombre_calidad_animal        = $matriz_consulta['nombre_calidad_animal'];
$nombre_tipo_explotacion      = $matriz_consulta['nombre_tipo_explotacion'];
$peso_compra                  = $matriz_consulta['peso_compra'];
$precio_compra                = $matriz_consulta['precio_compra'];
$nombre_propietario           = $matriz_consulta['nombre_propietario'];
$fecha_nac                    = $matriz_consulta['fecha_nac'];
$fecha_compra                 = $matriz_consulta['fecha_compra'];
$fecha_castracion             = $matriz_consulta['fecha_castracion'];
$nro_hierros                  = $matriz_consulta['nro_hierros'];
$hierro_animal                = $matriz_consulta['hierro_animal'];
$numero_partos                = $matriz_consulta['numero_partos'];
$id_electronica               = $matriz_consulta['id_electronica'];
$nombre_raza                  = $matriz_consulta['nombre_raza'];
$nombre_raza1                 = $matriz_consulta['nombre_raza1'];
$nombre_raza2                 = $matriz_consulta['nombre_raza2'];
$nombre_raza3                 = $matriz_consulta['nombre_raza3'];
$nombre_raza4                 = $matriz_consulta['nombre_raza4'];
$ptj_raza1                    = $matriz_consulta['ptj_raza1'];
$ptj_raza2                    = $matriz_consulta['ptj_raza2'];
$ptj_raza3                    = $matriz_consulta['ptj_raza3'];
$ptj_raza4                    = $matriz_consulta['ptj_raza4'];
$id_padre                     = $matriz_consulta['id_padre'];
$raza_padre                   = $matriz_consulta['raza_padre'];
$id_madre                     = $matriz_consulta['id_madre'];
$raza_madre                   = $matriz_consulta['raza_madre'];
$partos_madre                 = $matriz_consulta['partos_madre'];
$id_abuelo_paterno                  = $matriz_consulta['id_abuelo_paterno'];
$id_abuelo_materno                  = $matriz_consulta['id_abuelo_materno'];
$nombre_abuelo_paterno              = $matriz_consulta['nombre_abuelo_paterno'];
$nombre_abuelo_materno              = $matriz_consulta['nombre_abuelo_materno'];
$raza_abuelo_paterno                = $matriz_consulta['raza_abuelo_paterno'];
$raza_abuelo_materno                = $matriz_consulta['raza_abuelo_materno'];
$id_abuela_paterno                  = $matriz_consulta['id_abuela_paterno'];
$id_abuela_materno                  = $matriz_consulta['id_abuela_materno'];
$nombre_abuela_paterno              = $matriz_consulta['nombre_abuela_paterno'];
$nombre_abuela_materno              = $matriz_consulta['nombre_abuela_materno'];
$raza_abuela_paterno                = $matriz_consulta['raza_abuela_paterno'];
$raza_abuela_materno                = $matriz_consulta['raza_abuela_materno'];
$nombre_tipo_concepcion             = $matriz_consulta['nombre_tipo_concepcion'];
$nombre_especie                     = $matriz_consulta['nombre_especie'];
$marcas_tatuado                     = $matriz_consulta['marcas_tatuado'];
$marcas_herrado                     = $matriz_consulta['marcas_herrado'];
$marcas_descornado                  = $matriz_consulta['marcas_descornado'];
$marcas_castrado                    = $matriz_consulta['marcas_castrado'];
$nombre_color                       = $matriz_consulta['nombre_color'];
$nombre_temperamento                = $matriz_consulta['nombre_temperamento'];
$peso_nacer                         = $matriz_consulta['peso_nacer'];
$aplomo_corvejon                    = $matriz_consulta['aplomo_corvejon'];
$aplomo_cuartilla                   = $matriz_consulta['aplomo_cuartilla'];
$aplomo_cascos                      = $matriz_consulta['aplomo_cascos'];
$genital_circun_escrotal            = $matriz_consulta['genital_circun_escrotal'];
$genital_prepusio                   = $matriz_consulta['genital_prepusio'];
$genital_potencia                   = $matriz_consulta['genital_potencia'];
$genital_semen                      = $matriz_consulta['genital_semen'];
$observacion_animal                 = $matriz_consulta['observacion_animal'];
$nombre_estado                      = $matriz_consulta['nombre_estado'];
$nombre_tipo_movimiento             = $matriz_consulta['nombre_tipo_movimiento'];
$nombre_categoria_animal_extern     = $matriz_consulta['nombre_categoria_animal_extern'];
$descripcion_producto               = $matriz_consulta['descripcion_producto'];
$und_producto_bodega                = $matriz_consulta['und_producto_bodega'];

$cajas_sobre                        = $matriz_consulta['cajas_sobre'];
$und_sobre                          = $matriz_consulta['und_sobre'];

$meses_mantenimiento                = $matriz_consulta['meses_mantenimiento'];
$meses_garantia                     = $matriz_consulta['meses_garantia'];
$cod_factura                        = $matriz_consulta['cod_factura'];
$cod_marca                          = $matriz_consulta['cod_marca'];
$cod_tercero                        = $matriz_consulta['cod_tercero'];
$lote_compra                        = $matriz_consulta['lote_compra'];
$cod_categoria                      = $matriz_consulta['cod_categoria'];
$cod_origen_produccion              = $matriz_consulta['cod_origen_produccion'];
$cod_dependencia_sub                = $matriz_consulta['cod_dependencia_sub'];
$direccion_producto                 = $matriz_consulta['direccion_producto'];
$cod_estado_inmueble                = $matriz_consulta['cod_estado_inmueble'];
$referencia_catastral_inmueble      = $matriz_consulta['referencia_catastral_inmueble'];
$numero_matricula_inmueble          = $matriz_consulta['numero_matricula_inmueble'];
$deduccion_comision_ptj_inmueble    = $matriz_consulta['deduccion_comision_ptj_inmueble'];
$dia_pago_propietario_inmueble      = $matriz_consulta['dia_pago_propietario_inmueble'];
$nombre_tipo_cobro_propietario_inmueble      = $matriz_consulta['nombre_tipo_cobro_propietario_inmueble'];
$cod_tipo_forma_pago                = $matriz_consulta['cod_tipo_forma_pago'];

$url_img_orig_producto              = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto               = $matriz_consulta['url_img_min_producto'];

if ($url_img_min_producto == '') {
$url_img_orig_producto              = '../imagenes/img_no_disponible_grand.png';
$url_img_min_producto               = '../imagenes/img_no_disponible_grand.png';
} else {
$url_img_orig_producto              = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto               = $matriz_consulta['url_img_min_producto'];
}
if (isset($_GET['cod_tercero'])) { $cod_tercero_propietario_inmueble = intval($_GET['cod_tercero']); } else { $cod_tercero_propietario_inmueble = 0; }
$nombre_tipo_tercero                = 'PROPIETARIO';
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_producto_inmueble_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">COD INMUEBLE</th>
            <th style="text-align:center">NOMBRE INMUEBLE</th>
            <th style="text-align:center">PORCENTAJE DE COMISION DEL INMUEBLE</th>
            <th style="text-align:center">TIPO INMUEBLE</th>
            <th style="text-align:center">ESTADO</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="cod_producto_barra" type="text" value="<?php echo $cod_producto_barra ?>" size="30" id="cod_producto_barra" required/></td>
            <td style="text-align:center"><input class="input-block-level" name="nombre_producto" type="text" value="<?php echo $nombre_producto ?>" size="100" required/></td>
            <td style="text-align:center"><input class="input-block-level" style="width: 100px;" name="deduccion_comision_ptj_inmueble" type="number" value="<?php echo $deduccion_comision_ptj_inmueble ?>" min="0" size="10" required /></td>

            <td style="text-align:center">
                <select name="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                    <?php if (isset($nombre_tipo_producto)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY cod_tipo_producto ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_producto'];
                    $nombre = $datos2['nombre_tipo_producto'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>

            <td style="text-align:center">
                <select name="cod_estado_inmueble" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                    <?php if (isset($cod_estado_inmueble)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_estado_inmueble, nombre_estado_inmueble FROM tbl15_estado_inmueble WHERE (cod_estado = '1') ORDER BY cod_estado_inmueble DESC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_inmueble) and $cod_estado_inmueble == $datos2['cod_estado_inmueble']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado_inmueble'];
                    $nombre = $datos2['nombre_estado_inmueble'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>    
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DIRECCIÓN INMUEBLE</th>
            <th style="text-align:center">PRECIO ALQUILER</th>
            <th style="text-align:center">REFERENCIA CATASTRAL</th>
            <th style="text-align:center">NUMERO DE MATRICULA</th>
            <th style="text-align:center">PROPIETARIO INMUEBLE</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="direccion_producto" type="text" value="<?php echo $direccion_producto ?>" size="30" /></td>
            <td style="text-align:center"><input class="input-block-level" name="precio_venta_producto" type="number" value="<?php echo $precio_venta_producto ?>" size="10" step="any"/></td>
            <td style="text-align:center"><input class="input-block-level" name="referencia_catastral_inmueble" type="text" value="<?php echo $referencia_catastral_inmueble ?>"/></td>
            <td style="text-align:center"><input class="input-block-level" name="numero_matricula_inmueble" type="text" value="<?php echo $numero_matricula_inmueble ?>"/></td>
            <td style="text-align:left">
                <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                    <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tercero, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                    FROM tbl15_tercero WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'AMBOS')) ORDER BY cod_tercero ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_tercero'];
                    $nombre = $datos2['nombre1_tercero'];
                    $identificacion_tercero = $datos2['identificacion_tercero'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre.' - '.$identificacion_tercero."</option>"; } ?>
                </select>
            </td>
       
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DIA DE PAGO</th>
            <th style="text-align:center">TIPO</th>
            <th style="text-align:center">FORMA PAGO</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="dia_pago_propietario_inmueble" type="date" value="<?php echo $dia_pago_propietario_inmueble ?>"/></td>
            <td style="text-align:center">
                <select name="nombre_tipo_cobro_propietario_inmueble" class="input-block-level" data-show-subtext="true" data-live-search="true">
                <?php if (isset($nombre_tipo_cobro_propietario_inmueble)) { echo "<option value='' $seleccionado >Selecionar</option>"; } else { echo  "<option value='' $seleccionado >Selecionar</option>"; }
                $consulta2_sql = ("SELECT * FROM tbl15_tipo_cobro WHERE (nombre_tipo_cobro = 'MES VENCIDO') OR (nombre_tipo_cobro = 'MES ANTICIPADO')");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_cobro_propietario_inmueble) and $nombre_tipo_cobro_propietario_inmueble == $datos2['nombre_tipo_cobro']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_cobro'];
                $nombre = $datos2['nombre_tipo_cobro'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            </td>  
            <td style="text-align:center">
                <select name="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                    <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='' $seleccionado >Selecionar</option>"; } else { echo  "<option value='' $seleccionado >Selecionar</option>"; }
                    $consulta2_sql = ("SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago DESC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tipo_forma_pago) and $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_tipo_forma_pago'];
                    $nombre = $datos2['nombre_tipo_forma_pago'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>     
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <tr>
        <th style="text-align:center">DESCRIPCIÓN INMUEBLE</th>
    </tr>
    <tr>
        <td style="text-align:center"><textarea class="input-block-level" name="descripcion_producto" rows="2" cols="100"><?php echo $descripcion_producto ?></textarea></td>
    </tr>
  </thead>
</table>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DESCRIPCION DEL ARCHIVO</th>
        </tr>
<?PHP
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto WHERE (cod_producto = '$cod_producto') ORDER BY cod_archivo_adjunto DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_archivo_adjunto            = $datos_consulta['cod_archivo_adjunto'];
$cod_producto                   = $datos_consulta['cod_producto'];
$cod_producto_barra             = $datos_consulta['cod_producto_barra'];
$fecha_creacion                 = $datos_consulta['fecha_creacion'];
$fecha_hora                     = $datos_consulta['fecha_hora'];
$url_archivo_adjunto            = $datos_consulta['url_archivo_adjunto'];
$nombre_archivo_adjunto         = $datos_consulta['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto    = $datos_consulta['descripcion_archivo_adjunto'];
$formato                        = $datos_consulta['formato'];
?>
        <tr>
            <td style="text-align:center"><input style="font-size:12px" class="<?php echo $cod_archivo_adjunto ?>" name="descripcion_archivo_adjunto" id="descripcion_archivo_adjunto" type="text" value="<?php echo $descripcion_archivo_adjunto ?>" size="200" /></td>
        </tr>
<?php } ?>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<input type="hidden" name="cod_tercero_propietario_inmueble" value="<?php echo $cod_tercero_propietario_inmueble ?>"/>

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
</fieldset>
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
</body>
</html>

<script>
 $(document).ready(function(){  

  $('input[name="descripcion_archivo_adjunto"]').change(function(){ 
  var cod_estado = $(this).val();  
  var cod_archivo_adjunto = $(this).attr('class');

  var tab = "tbl15_archivo_adjunto";
  var tipo = "editar";
  var campo = "descripcion_archivo_adjunto";

  let ids = this.id;
    $.ajax({ url:"edit_archivo_adjunto_ajax_reg.php", method:"GET", data:{valor:cod_estado, campo:"cod_estado", tab:tab, tipo:tipo, campo:campo, id:cod_archivo_adjunto }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
    descripcion_producto = CKEDITOR.replace("descripcion_producto");
    CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
}
</script>