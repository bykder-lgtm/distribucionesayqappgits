<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Movimiento Contable</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                             = $_SERVER['PHP_SELF'];
$pagina_local                       = $_SERVER['PHP_SELF'];
$pagina_manual                      = '../admin/lista_movimiento_contable.php';

$tab                                = 'tbl15_puc';
$tipo                               = 'eliminar';
$campo                              = 'cod_puc';
//$fecha_dmy                          = date("Y-m-d");
$origen                             = '';

if (isset($_GET['cod_movimiento_contable'])) {
  $cod_movimiento_contable                               = intval($_GET['cod_movimiento_contable']);

  $obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
  $resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
  $total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
  $info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

  $cod_factura                                          = $info_ingre_operacional['cod_factura'];
  $doc_modifica                                         = $info_ingre_operacional['doc_modifica'];
  $nombre_tipo_documento                                = $info_ingre_operacional['nombre_tipo_documento'];
  $nombre_tipo_documento_db                             = $info_ingre_operacional['nombre_tipo_documento'];
  $descripcion_movimiento                               = $info_ingre_operacional['descripcion_movimiento'];
  $total_costo_movimiento_contable                      = $info_ingre_operacional['total_costo_movimiento_contable'];
  $total_venta_movimiento_contable                      = $info_ingre_operacional['total_venta_movimiento_contable'];
  $cod_clientes                                         = $info_ingre_operacional['cod_clientes'];
  $cod_tercero                                          = $info_ingre_operacional['cod_tercero'];
  $nombres_clientes                                     = $info_ingre_operacional['nombres_clientes'];
  $nit_cliente                                          = $info_ingre_operacional['nit_cliente'];
  $digito                                               = $info_ingre_operacional['digito'];
  $estado_devol                                         = $info_ingre_operacional['estado_devol'];
  $motivo_devol                                         = $info_ingre_operacional['motivo_devol'];
  $direccion                                            = $info_ingre_operacional['direccion'];
  $no_cuenta                                            = $info_ingre_operacional['no_cuenta'];
  $elaborada                                            = $info_ingre_operacional['elaborada'];
  $revisada                                             = $info_ingre_operacional['revisada'];
  $autorizada                                           = $info_ingre_operacional['autorizada'];
  $contabilizada                                        = $info_ingre_operacional['contabilizada'];
  $motivo_modificacion                                  = $info_ingre_operacional['motivo_modificacion'];
  $fecha_anyo                                           = $info_ingre_operacional['fecha_anyo'];
  $fecha_ymd                                            = $info_ingre_operacional['fecha_ymd'];
  $fecha_mes                                            = $info_ingre_operacional['fecha_mes'];
  $anyo                                                 = $info_ingre_operacional['anyo'];
  $fecha_seg                                            = $info_ingre_operacional['fecha_seg'];
  $fecha_factura                                        = $info_ingre_operacional['fecha_factura'];
  $cuenta                                               = $info_ingre_operacional['cuenta'];
  $cod_caja_virtual                                     = $info_ingre_operacional['cod_caja_virtual'];
  $observacion                                          = $info_ingre_operacional['observacion'];
  $cod_tipo_pago                                        = $info_ingre_operacional['cod_tipo_pago'];
  $cod_tipo_forma_pago                                  = $info_ingre_operacional['cod_tipo_forma_pago'];
  $nombre_tipo_forma_pago                               = $info_ingre_operacional['nombre_tipo_forma_pago'];
  $descripcion_tipo_forma_pago                          = $info_ingre_operacional['descripcion_tipo_forma_pago'];
  $cod_guia                                             = $info_ingre_operacional['cod_guia'];
  $url_img_orig_producto                                = $info_ingre_operacional['url_img_orig_producto'];

  $cod_tipo_nota_observacion                            = $info_ingre_operacional['cod_tipo_nota_observacion'];
  $cod_info_factura_venta                               = $info_ingre_operacional['cod_info_factura_venta'];
  $cod_info_factura_compra                              = $info_ingre_operacional['cod_info_factura_compra'];
  $cod_info_cotizacion_factura_compra                   = $info_ingre_operacional['cod_info_cotizacion_factura_compra'];
  $cod_info_cotizacion_factura_venta                    = $info_ingre_operacional['cod_info_cotizacion_factura_venta'];
  $cod_info_factura_auditoria                           = $info_ingre_operacional['cod_info_factura_auditoria'];
  $cod_info_factura_transferencia                       = $info_ingre_operacional['cod_info_factura_transferencia'];
  $cod_info_factura_transferencia_bodega_entrada        = $info_ingre_operacional['cod_info_factura_transferencia_bodega_entrada'];
  $cod_info_factura_transferencia_bodega                = $info_ingre_operacional['cod_info_factura_transferencia_bodega'];
  $cod_egreso                                           = $info_ingre_operacional['cod_egreso'];
  $cod_movimiento_contable_cuenta_personal_entrada      = $info_ingre_operacional['cod_movimiento_contable_cuenta_personal_entrada'];
  $cod_movimiento_contable_cuenta_personal_salida       = $info_ingre_operacional['cod_movimiento_contable_cuenta_personal_salida'];
  $cod_dependencia                                      = $info_ingre_operacional['cod_dependencia'];
  $nombre_ccosto                                        = $info_ingre_operacional['nombre_ccosto'];

  $tab1                                                 = 'tbl15_movimiento_contable_concepto';
  $campo1                                               = 'cod_movimiento_contable_concepto';
  $tipo1                                                = 'eliminar';
  $tab2                                                 = 'tbl15_movimiento_contable_codigo';
  $campo2                                               = 'cod_movimiento_contable_codigo';
  $tipo2                                                = 'eliminar';

  $nombre_tab_mad1                                      = 'tbl15_movimiento_contable';
  $nombre_tab_mad2                                      = 'tbl15_movimiento_contable';

  $nombre_campo_key1                                    = 'cod_movimiento_contable';
  $nombre_campo_key2                                    = 'cod_movimiento_contable';

  $nombre_campo_calc1                                   = 'total_costo_movimiento_contable';
  $nombre_campo_calc2                                   = 'total_costo_movimiento_contable';

  $nombre_campo_update1                                 = 'total_costo_movimiento_contable';
  $nombre_campo_update2                                 = 'total_costo_movimiento_contable';

  $total_costo_movimiento_contable_debito               = 0;
  $total_costo_movimiento_contable_credito              = 0;
  $total_datos_debitos                                  = 0;
  $total_datos_creditos                                 = 0;


  $sql_mov_contable_debito = "SELECT * FROM tbl15_movimiento_contable_concepto 
  WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
  $consulta_mov_contable_debito = mysqli_query($conectar, $sql_mov_contable_debito) or die(mysqli_error($conectar));
  $total_datos_debitos = mysqli_num_rows($consulta_mov_contable_debito);

  $sql_mov_contable_credito = "SELECT * FROM tbl15_movimiento_contable_concepto 
  WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'CREDITOS')";
  $consulta_mov_contable_credito = mysqli_query($conectar, $sql_mov_contable_credito) or die(mysqli_error($conectar));
  $total_datos_creditos = mysqli_num_rows($consulta_mov_contable_credito);

  if ($total_datos_debitos > $total_datos_creditos) {
    $repetir_movimiento_debitos = 0;
    $repetir_movimiento_creditos = $total_datos_debitos - $total_datos_creditos;
  } elseif ($total_datos_debitos < $total_datos_creditos) {
    $repetir_movimiento_debitos = $total_datos_creditos - $total_datos_debitos;
    $repetir_movimiento_creditos = 0;
  } else {
    $repetir_movimiento_debitos = 0;
    $repetir_movimiento_creditos = 0;
  }

  if ($nombre_tipo_documento_db == 'RECIBO DE CAJA') {
    $titulo_documento = 'DEBE';
  } elseif ($nombre_tipo_documento_db == 'COMPROBANTE DE EGRESO') {
    $titulo_documento = 'PAGADO A';
  } else {
    $titulo_documento = 'CLIENTE';
  }
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_movimiento_contable_reg.php">
<table class="table table-striped">
  <tr>
    <th style="text-align:center"><?php echo $nombre_tipo_documento ?>: [<?php echo $cod_movimiento_contable ?>]</th>
<input type="hidden" name="nombre_tipo_documento" value="<?php echo $nombre_tipo_documento ?>" size="20" required>
  </tr>
</table>

<table class="table table-striped">
  <tr>
    <th style="text-align:left; width:250px">FECHA MOVIMIENTO: </th>
    <td style="text-align:left; width:450px;"><input type="date" name="fecha_ymd" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $fecha_ymd ?>" size="20" required></td>
    <th style="text-align:left; width:400px">DOCUMENTO QUE MODIFICA
      <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="" data-show-subtext="true" data-live-search="true" style="width: 150px;" tabindex="1">
          <?php if (isset($cod_tipo_nota_observacion)) { echo "<option value='0' selected >Selecione</option>"; } else { echo "<option value='0' selected >Selecione</option>"; }
          $consulta2_sql = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_estado_movimiento_contable = '1')";
          $consulta2 = mysqli_query($conectar, $consulta2_sql);
          while ($datos2 = mysqli_fetch_assoc($consulta2)) {
          if(isset($cod_tipo_nota_observacion) AND $cod_tipo_nota_observacion == $datos2['cod_tipo_nota_observacion']) {
          $seleccionado = "selected"; } else { $seleccionado = ""; }
          $codigo = $datos2['cod_tipo_nota_observacion'];
          $nombre = $datos2['subnombre_tipo_nota_observacion'];
          echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
      </select>:
    </th>
    <td><input type="text" name="doc_modifica" class="doc_modifica" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $doc_modifica ?>" style="width:450px;"></td>
  </tr>
  <tr>
    <th style="text-align:left; width:250px">PAGADO A:</th>

    <td style="text-align:left; width:450px;">
      <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
      <?php if (isset($cod_tercero)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
      $consulta2_sql = ("SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, nombre_tipo_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC");
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo                = $datos2['cod_tercero'];
      $cedula                = $datos2['identificacion_tercero'];
      $nombre                = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'].'|'.$cedula.'|'.$datos2['nombre_tipo_tercero'];
      ?>
      <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?>><?php echo $nombre ?></option>
      <?php } ?>
      </select>
      <a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a>
    </td>
    <th style="text-align:left; width:450px;">FACTURA #:</th>
    <td><input type="text" name="cod_factura" class="cod_factura" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $cod_factura ?>" size="10"></td>
  </tr>
  <tr>
    <th style="text-align:left; width:250px">DESCRIPCION DEL MOVIMIENTO: </th>
    <td style="text-align:left; width:450px;"><input type="text" name="descripcion_movimiento" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $descripcion_movimiento ?>" style="width:450px;"></td>
    <th style="text-align:left; width:450px;">FECHA:</th>
    <td style="text-align:left"><input type="date" name="fecha_factura" class="fecha_factura" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $fecha_factura ?>" size="10"></td>
  </tr>

  <tr>
    <th style="text-align:left; width:250px">FORMA DE PAGO: </th>
    <td style="text-align:left; width:450px;">
      <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" data-show-subtext="true" data-live-search="true" required>
      <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
      $consulta2_sql = ("SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY nombre_tipo_forma_pago ASC");
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo                = $datos2['cod_tipo_forma_pago'];
      $nombre                = $datos2['nombre_tipo_forma_pago'];
      ?>
      <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?>><?php echo $nombre ?></option>
      <?php } ?>
      </select>
      <input type="text" name="descripcion_tipo_forma_pago" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $descripcion_tipo_forma_pago ?>" size="15">
    </td>
    <th style="text-align:left; width:450px;"></th>
    <td style="text-align:left; width:450px;"></td>
  </tr>
</table>


<table class="table table-striped" style="text-align:center;">
  <tr>
<?php if ($cod_estado_dependencia_global == '1') { ?>
    <th style="text-align:right; width:250px">DEPENDENCIA: </th>
    <td style="text-align:left; width:250px;">
      <select name="cod_dependencia" id="cod_dependencia" data-show-subtext="true" data-live-search="true" >
      <?php if (isset($cod_dependencia)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
      $consulta2_sql = ("SELECT * FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC");
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo                = $datos2['cod_dependencia'];
      $nombre                = $datos2['nombre_dependencia'];
      ?>
      <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?>><?php echo $nombre ?></option>
      <?php } ?>
      </select>
    </td>
<?php } ?>

    <th style="text-align:right; width:250px">CENTRO COSTO: </th>
    <td style="text-align:left; width:250px;">
      <select name="nombre_ccosto" id="nombre_ccosto" data-show-subtext="true" data-live-search="true" >
      <?php if (isset($nombre_ccosto)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
      $consulta2_sql = ("SELECT * FROM tbl15_ccosto ORDER BY nombre_ccosto ASC");
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($nombre_ccosto) AND $nombre_ccosto == $datos2['nombre_ccosto']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo                = $datos2['nombre_ccosto'];
      $nombre                = $datos2['nombre_ccosto'];
      ?>
      <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?>><?php echo $nombre ?></option>
      <?php } ?>
      </select>
    </td>
  </tr>
</table>



<?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
<br>
<table class="table table-striped">
  <tr> 
    <td style="text-align:center"><a href="<?php echo $url_img_orig_producto?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""><a/><br>
    <a href="../admin/cargar_soporte_archivo_adjunto_movimiento_contable_nota_observacion.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable ?>&pagina=<?php echo $pagina_local ?>">CARGAR SOPORTE</a></td>
  </tr>
</table>
<?php } ?>


<table border="0" cellspacing="10" cellpadding="10" style="text-align:center; font-family:mono; font-size:12pt; width:99%">
  <tr> 
    <td align="center">
<?php
$incre                                        = 0;
$und_vendida                                  = 0;
$costo_movimiento_diario                      = 0;
$total_costo_movimiento_diario                = 0;
$nombre_tabla                                 = "tbl15_movimiento_diario_venta";
$nombre_llave                                 = "cod_movimiento_diario_venta";
$id_campo_total                               = "total_costo_movimiento_diario_venta";
$nombre_campo_class_sumar                     = "costo_movimiento_diario_venta";
?>
    <table border="1" style="text-align:center; font-family:mono; font-size:12pt; width:99%"><tr><th style="text-align:center">DEBITOS<a href="../admin/reg_movimiento_contable_concepto_reg.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>&nombre_tipo_documento=<?php echo $nombre_tipo_documento?>&nombre_tipo_movimiento=DEBITOS"><img src=../imagenes/mas.png alt="mas"></a></th></tr></table>

      <table class="table table-striped">
        <tr> 
          <th style="text-align:center">Elim</th>
          <th style="text-align:center">Codigo</th>
          <th style="text-align:center">Nombre</th>
          <th style="text-align:center">Comentario</th>
          <th style="text-align:center">Valor</th>
        </tr>
<?php
//include_once("../admin/modal_registrar_tercero_movimiento_contable_temporal.php");

$incre = 0;
$obtener_info_movimiento_contable_concepto = "SELECT * FROM tbl15_movimiento_contable_concepto 
WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
$resultado_info_movimiento_contable_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto) or die(mysqli_error($conectar));
$total_datos_debitos = mysqli_num_rows($resultado_info_movimiento_contable_concepto);
while ($info_movimiento_contable_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto)) {

$cod_movimiento_contable_concepto               = $info_movimiento_contable_concepto['cod_movimiento_contable_concepto'];
$nombre_tipo_movimiento                         = $info_movimiento_contable_concepto['nombre_tipo_movimiento'];
$nombre_tipo_documento                          = $info_movimiento_contable_concepto['nombre_tipo_documento'];
$codigo_puc                                     = $info_movimiento_contable_concepto['codigo_puc'];
$nombre_puc                                     = $info_movimiento_contable_concepto['nombre_puc'];
$tipo_puc                                       = $info_movimiento_contable_concepto['tipo_puc'];
$und_vendida                                    = $info_movimiento_contable_concepto['und_vendida'];
$costo_movimiento_contable                      = $info_movimiento_contable_concepto['costo_movimiento_contable'];
$venta_movimiento_contable                      = $info_movimiento_contable_concepto['venta_movimiento_contable'];
$total_costo_movimiento_contable                = $info_movimiento_contable_concepto['total_costo_movimiento_contable'];
$total_venta_movimiento_contable                = $info_movimiento_contable_concepto['total_venta_movimiento_contable'];
$total_costo_movimiento_contable_debito        += $total_costo_movimiento_contable;
$comentario                                     = $info_movimiento_contable_concepto['comentario'];

$incre++;
?>
  <tr id="tr<?php echo $cod_movimiento_contable_concepto;?>">
    <td style="text-align:center" class="service_list" id="cod_movimiento_contable_concepto<?php echo $cod_movimiento_contable_concepto ?>" data="<?php echo $cod_movimiento_contable_concepto ?>"><a class="eliminar_movimiento_contable_concepto" id="cod_movimiento_contable_concepto<?php echo $cod_movimiento_contable_concepto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid"></a></td>
    <td style="text-align:center"><input type="text" name="codigo_puc[]" class="codigo_puc" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $codigo_puc ?>" style="text-align: center; font-size:18px; width:100px;"></td>
    <td style="text-align:left"><input type="text" name="nombre_puc[]" class="nombre_puc_<?php echo $cod_movimiento_contable_concepto ?>" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $nombre_puc ?>" style="text-align: left; font-size:18px; width:250px;"></td>
    <td style="text-align:center"><input type="text" name="comentario[]" class="costo_movimiento_contable_creditos<?php echo $incre ?>" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $comentario ?>" style="text-align: left; font-size:18px; width:250px;"></td>
    <td style="text-align:center"><input type="text" name="costo_movimiento_contable[]" class="costo_movimiento_contable_debitos<?php echo $incre ?>" data="DEBITOS" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $costo_movimiento_contable ?>" style="text-align: center; font-size:18px; width:100px;"></td>
    <input type="hidden" name="und_vendida[]" value="<?php echo $und_vendida ?>">
    <input type="hidden" name="cod_movimiento_contable_concepto[]" value="<?php echo $cod_movimiento_contable_concepto ?>">
    <input type="hidden" name="cod_puc[]" class="cod_puc_<?php echo $cod_movimiento_contable_concepto ?>">
  </tr id="tr<?php echo $cod_movimiento_contable_concepto;?>">
<?php } ?>
        </table>

        <table class="table table-striped">
          <?php for ($i=0; $i < $repetir_movimiento_debitos; $i++) { ?>
          <tr><td style="text-align:center"><img src="../imagenes/eliminar_vacio.png"></td></tr>
          <?php } ?>
        </table>    
    </td>

    <td align="center">
<?php
$incre                                        = 0;
$und_vendida                                  = 0;
$costo_movimiento_diario                      = 0;
$total_costo_movimiento_diario                = 0;
$nombre_tabla                                 = "tbl15_movimiento_diario_pago";
$nombre_llave                                 = "cod_movimiento_diario_pago";
$id_campo_total                               = "total_costo_movimiento_diario_pago";
$nombre_campo_class_sumar                     = "costo_movimiento_diario_pago";
?>
    <table border="1" style="text-align:center; font-family:mono; font-size:12pt; width:99%"><tr><th style="text-align:center">CREDITOS<a href="../admin/reg_movimiento_contable_concepto_reg.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>&nombre_tipo_documento=<?php echo $nombre_tipo_documento?>&nombre_tipo_movimiento=CREDITOS"><img src=../imagenes/mas.png alt="mas"></a></th></tr></table>

      <table class="table table-striped">
        <tr> 
          <th style="text-align:center">Elim</th>
          <th style="text-align:center">Codigo</th>
          <th style="text-align:center">Nombre</th>
          <th style="text-align:center">Comentario</th>
          <th style="text-align:center">Valor</th>
        </tr> 
<?php
$incres = 0;
$obtener_info_movimiento_contable_concepto = "SELECT * FROM tbl15_movimiento_contable_concepto 
WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'CREDITOS')";
$resultado_info_movimiento_contable_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto) or die(mysqli_error($conectar));
$total_datos_creditos = mysqli_num_rows($resultado_info_movimiento_contable_concepto);
while ($info_movimiento_contable_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto)) {

$cod_movimiento_contable_concepto               = $info_movimiento_contable_concepto['cod_movimiento_contable_concepto'];
$nombre_tipo_movimiento                         = $info_movimiento_contable_concepto['nombre_tipo_movimiento'];
$nombre_tipo_documento                          = $info_movimiento_contable_concepto['nombre_tipo_documento'];
$codigo_puc                                     = $info_movimiento_contable_concepto['codigo_puc'];
$nombre_puc                                     = $info_movimiento_contable_concepto['nombre_puc'];
$tipo_puc                                       = $info_movimiento_contable_concepto['tipo_puc'];
$und_vendida                                    = $info_movimiento_contable_concepto['und_vendida'];
$costo_movimiento_contable                      = $info_movimiento_contable_concepto['costo_movimiento_contable'];
$venta_movimiento_contable                      = $info_movimiento_contable_concepto['venta_movimiento_contable'];
$total_costo_movimiento_contable                = $info_movimiento_contable_concepto['total_costo_movimiento_contable'];
$total_venta_movimiento_contable                = $info_movimiento_contable_concepto['total_venta_movimiento_contable'];
$total_costo_movimiento_contable_credito       += $total_costo_movimiento_contable;
$comentario                                     = $info_movimiento_contable_concepto['comentario'];

$incres++;
?>
  <tr id="tr<?php echo $cod_movimiento_contable_concepto;?>">
    <td style="text-align:center" class="service_list" id="cod_movimiento_contable_concepto<?php echo $cod_movimiento_contable_concepto ?>" data="<?php echo $cod_movimiento_contable_concepto ?>"><a class="eliminar_movimiento_contable_concepto" id="cod_movimiento_contable_concepto<?php echo $cod_movimiento_contable_concepto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid"></a></td>
    <td style="text-align:center"><input type="text" name="codigo_puc[]" class="codigo_puc" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $codigo_puc ?>" style="text-align: center; font-size:18px; width:100px;"></td>
    <td style="text-align:left"><input type="text" name="nombre_puc[]" class="nombre_puc_<?php echo $cod_movimiento_contable_concepto ?>" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $nombre_puc ?>" style="text-align: left; font-size:18px; width:250px;"></td>
    <td style="text-align:center"><input type="text" name="comentario[]" class="costo_movimiento_contable_creditos<?php echo $incres ?>" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $comentario ?>" style="text-align: left; font-size:18px; width:250px;"></td>
    <td style="text-align:center"><input type="text" name="costo_movimiento_contable[]" class="costo_movimiento_contable_creditos<?php echo $incres ?>" data="CREDITOS" id="<?php echo $cod_movimiento_contable_concepto ?>" value="<?php echo $costo_movimiento_contable ?>" style="text-align: center; font-size:18px; width:100px;"></td>
    <input type="hidden" name="und_vendida[]" value="<?php echo $und_vendida ?>">
    <input type="hidden" name="cod_movimiento_contable_concepto[]" value="<?php echo $cod_movimiento_contable_concepto ?>">
    <input type="hidden" name="cod_puc[]" class="cod_puc_<?php echo $cod_movimiento_contable_concepto ?>">
  </tr id="tr<?php echo $cod_movimiento_contable_concepto;?>">
<?php } ?>
        </table>

        <table class="table table-striped">
          <?php for ($i=0; $i < $repetir_movimiento_creditos ; $i++) { ?>
          <tr><td style="text-align:center"><img src="../imagenes/eliminar_vacio.png"></td></tr>
          <?php } ?>
        </table>   
    </td> 
</tr>
</table>

<br>
<?php 
if ($total_costo_movimiento_contable_debito > $total_costo_movimiento_contable_credito) { $mensaje = "> Las cuentas no suman igual valor >"; } 
elseif ($total_costo_movimiento_contable_credito > $total_costo_movimiento_contable_debito) { $mensaje = "< Las cuentas no suman igual valor <"; } 
else { $mensaje = "< Iguales >"; }
?>
<table class="table table-striped">
  <tr>
    <th style="text-align:center; width:33%" id="total_costo_movimiento_contable_debitos"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></th>
    <th style="text-align:center; width:33%" id="total_movimiento_contable_mensaje"><?php echo $mensaje; ?></th>
    <th style="text-align:center; width:33%" id="total_costo_movimiento_contable_creditos"><?php echo number_format($total_costo_movimiento_contable_credito, 0, ",", ".");?></th>
  </tr>
</table>

<br>

<table class="table table-striped">
  <tr height="20">
    <th  style="text-align:left" rowspan="3">MOTIVOS DE MODIFICACION:</th>
    <td  style="text-align:left" rowspan="3"><input type="text" name="motivo_modificacion" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $motivo_modificacion ?>" size="60"></td>
    <th  style="text-align:left">SUB TOTAL</th>
    <td style="text-align:right" id="subtotal_total_movimiento_contable_temporal">$<?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></td>
  </tr>
  <tr>
    <th style="text-align:left">IVA 0%</th>
    <td style="text-align:right">0</td>
  </tr>
  <tr>
    <th style="text-align:left">TOTAL</th>
    <td style="text-align:right" id="total_movimiento_contable_temporal">$<?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></td>
  </tr>
</table>

<hr>
<input type="hidden" name="cod_movimiento_contable" value="<?php echo $cod_movimiento_contable ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina_manual ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<div id="btn_guardar">
<?php 
if ($total_costo_movimiento_contable_debito > $total_costo_movimiento_contable_credito) { 
$mensaje = "> Las cuentas no suman igual valor >"; ?>
<input type="hidden" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
<?php } 
elseif ($total_costo_movimiento_contable_credito > $total_costo_movimiento_contable_debito) { 
$mensaje = "< Las cuentas no suman igual valor <"; ?>
<input type="hidden" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
<?php } 
else { ?>
<input type="submit" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
<?php } ?>
</div>
</div>
</form>
<?php } else { } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script type="text/javascript">
$(function() {
  $(".codigo_puc").autocomplete({
    source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
    minLength: 1,

    select: function(event, ui) {
      event.preventDefault();
      let id = this.id;
      var valor = $(this).val();
      var campo = $(this).attr("name");
      var jqui = "jqui";


      $('#'+id).val(ui.item.codigo_puc);
      $('.nombre_puc'+'_'+id).val(ui.item.nombre_puc);
      $('.cod_puc'+'_'+id).val(ui.item.cod_puc);

      var cod_puc = $('.cod_puc'+'_'+id).val();
      var codigo_puc = $('#'+id).val();
      var nombre_puc = $('.nombre_puc'+'_'+id).val();

      $.ajax({  
            url:"../admin/guardar_movimiento_contable_ajax.php",  
            method:"POST", 
            data:{id:id, valor:valor, campo:campo, cod_puc:cod_puc, codigo_puc:codigo_puc, nombre_puc:nombre_puc, jqui:jqui},  
            success:function(data){  
                 $('#result').html(data);  
            }  
       });
    }
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar_movimiento_contable_concepto').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_movimiento_contable_concepto = $(this).parent().attr('data');
        var dataString = 'llave='+cod_movimiento_contable_concepto+'&'+'tab='+'<?php echo $tab1 ?>'+'&'+'campo='+'<?php echo $campo1 ?>'+'&'+'tipo='+'<?php echo $tipo1 ?>'+'&'+'nombre_tab_mad='+'<?php echo $nombre_tab_mad1 ?>'+'&'+'nombre_campo_key='+'<?php echo $nombre_campo_key1 ?>'+'&'+'nombre_campo_calc='+'<?php echo $nombre_campo_calc1 ?>'+'&'+'nombre_campo_update='+'<?php echo $nombre_campo_update1 ?>'+'&'+'cod_nota='+'<?php echo $cod_movimiento_contable ?>';
        
        $.ajax({
            type: "POST",
            url: "../admin/eliminar_movimiento_contable_concepto.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el producto con codigo = '+cod_movimiento_contable_concepto+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#'+cod_movimiento_contable_concepto).fadeOut("slow");
                $('#'+cod_movimiento_contable_concepto).fadeOut("slow");
                $('#'+cod_movimiento_contable_concepto).fadeOut("slow");
                $('#tr'+cod_movimiento_contable_concepto).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

    $('.eliminar_movimiento_contable_codigo').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_movimiento_contable_codigo = $(this).parent().attr('data');
        var dataString = 'llave='+cod_movimiento_contable_codigo+'&'+'tab='+'<?php echo $tab2 ?>'+'&'+'campo='+'<?php echo $campo2 ?>'+'&'+'tipo='+'<?php echo $tipo2 ?>'+'&'+'nombre_tab_mad='+'<?php echo $nombre_tab_mad2 ?>'+'&'+'nombre_campo_key='+'<?php echo $nombre_campo_key2 ?>'+'&'+'nombre_campo_calc='+'<?php echo $nombre_campo_calc1 ?>'+'&'+'nombre_campo_update='+'<?php echo $nombre_campo_update2 ?>'+'&'+'cod_nota='+'<?php echo $cod_movimiento_contable ?>';
        
        $.ajax({
            type: "POST",
            url: "../admin/eliminar.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el producto con codigo = '+cod_movimiento_contable_codigo+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#'+cod_movimiento_contable_codigo).fadeOut("slow");
                $('#'+cod_movimiento_contable_codigo).fadeOut("slow");
                $('#'+cod_movimiento_contable_codigo).fadeOut("slow");
                $('#tr'+cod_movimiento_contable_codigo).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });


});
</script>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
 <script>  
 $(document).ready(function(){  

         $('select[name="cod_tipo_nota_observacion"]').change(function(){  
           var cod_tipo_nota_observacion = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:cod_tipo_nota_observacion, campo:"cod_tipo_nota_observacion", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

         $('select[name="cod_tercero"]').change(function(){  
           var cod_tercero = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:cod_tercero, campo:"cod_tercero", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('select[name="cod_tipo_forma_pago"]').change(function(){  
           var cod_tipo_forma_pago = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:cod_tipo_forma_pago, campo:"cod_tipo_forma_pago", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('select[name="cod_movimiento_contable_cuenta_personal_salida"]').change(function(){  
           var cod_movimiento_contable_cuenta_personal_salida = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:cod_movimiento_contable_cuenta_personal_salida, campo:"cod_movimiento_contable_cuenta_personal_salida", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
       });

         $('select[name="cod_movimiento_contable_cuenta_personal_entrada"]').change(function(){  
           var cod_movimiento_contable_cuenta_personal_entrada = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:cod_movimiento_contable_cuenta_personal_entrada, campo:"cod_movimiento_contable_cuenta_personal_entrada", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
       });

         $('select[name="cod_dependencia"]').change(function(){  
           var cod_dependencia = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:cod_dependencia, campo:"cod_dependencia", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
       });

         $('select[name="nombre_ccosto"]').change(function(){  
           var nombre_ccosto = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_ccosto, campo:"nombre_ccosto", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
       });


      $(".doc_modifica").keyup(function(){ 
        var cod_tipo_nota_observacion_val = document.getElementById("cod_tipo_nota_observacion");
        var cod_tipo_nota_observacion = cod_tipo_nota_observacion_val.options[cod_tipo_nota_observacion_val.selectedIndex].value;

        $(".doc_modifica").autocomplete({
        source: "../admin/autocompletar_tipo_soporte_documento_que_modifica_ajax.php?cod_tipo_nota_observacion="+cod_tipo_nota_observacion,
        minLength: 1,

        select: function(event, ui) {
        event.preventDefault();
        let id = this.id;
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var jqui = "jqui";

        var cod_tipo_nota_observacion = ui.item.cod_tipo_nota_observacion;
        var cod_factura = ui.item.cod_factura;
        var llave = ui.item.llave;
        var fecha_factura = ui.item.fecha_anyo;
        var doc_modifica = ui.item.doc_modifica;


        $('.doc_modifica').val(doc_modifica);
        $('.cod_factura').val(cod_factura);
        $('.fecha_factura').val(fecha_factura);

          $.ajax({  
                url:"../admin/guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST", 
                data:{ id:id, valor:valor, campo:campo, jqui:jqui, cod_tipo_nota_observacion:cod_tipo_nota_observacion, cod_factura:cod_factura, llave:llave, fecha_factura:fecha_factura, doc_modifica:doc_modifica },  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });
        }
        });
      });


         $('input[name="descripcion_movimiento"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"descripcion_movimiento", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('input[name="cod_factura"]').change(function(){  
           var nombre_empresa_movimiento_contable = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable, campo:"cod_factura", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('input[name="fecha_factura"]').change(function(){  
           var nombre_empresa_movimiento_contable = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable, campo:"fecha_factura", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });



         $('input[name="motivo_modificacion"]').change(function(){  
           var nombre_empresa_movimiento_contable = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable, campo:"motivo_modificacion", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });


        $('input[name="fecha_ymd"]').change(function(){  
           var fecha_ymd = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:fecha_ymd, campo:"fecha_ymd", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

         $('input[name="descripcion_tipo_forma_pago"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"descripcion_tipo_forma_pago", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

        $('input[name="no_cuenta"]').change(function(){  
           var no_cuenta_movimiento_contable = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:no_cuenta_movimiento_contable, campo:"no_cuenta_movimiento_contable", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

        $('input[name="und_vendida[]"]').change(function(){  
           var und_vendida = $(this).val();
           var campo = $(this).attr("name");
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:und_vendida, campo:campo, id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

        $('input[name="comentario[]"]').change(function(){  
           var comentario = $(this).val();
           var campo = $(this).attr("name");
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:comentario, campo:campo, id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
        });

        $('input[name="costo_movimiento_contable[]"]').change(function(){  
           var costo_movimiento_contable_concepto = $(this).val();
           var campo = $(this).attr("name");
           var nombre_tipo_movimiento = $(this).attr("data");
           let id = this.id;
           var total_datos_debitos = <?php echo $total_datos_debitos ?>;
           var total_datos_creditos = <?php echo $total_datos_creditos ?>;
           var total_costo_movimiento_contable_debitos = 0;
           var total_costo_movimiento_contable_creditos = 0;
           var total_costo_movimiento_contable_debitos_msj = 0;
           var total_costo_movimiento_contable_creditos_msj = 0;
           var total_movimiento_contable_mensaje = "";
           var submitButton = document.getElementById("submitButton");
           console.log("costo_movimiento_contable");

           if (nombre_tipo_movimiento == 'DEBITOS') {

              for (i=1; i<=total_datos_debitos; i++){
                costo_movimiento_contable_debitos = parseInt(document.getElementsByClassName("costo_movimiento_contable_debitos"+i)[0].value);
                total_costo_movimiento_contable_debitos += costo_movimiento_contable_debitos;
              }
                document.getElementById("total_costo_movimiento_contable_debitos").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
                document.getElementById("subtotal_total_movimiento_contable_temporal").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
                document.getElementById("total_movimiento_contable_temporal").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
                total_costo_movimiento_contable_debitos_msj = document.getElementById("total_costo_movimiento_contable_debitos").innerHTML;
                total_costo_movimiento_contable_creditos_msj = document.getElementById("total_costo_movimiento_contable_creditos").innerHTML;

                if (total_costo_movimiento_contable_debitos_msj > total_costo_movimiento_contable_creditos_msj) {
                  total_movimiento_contable_mensaje = "> Las cuentas no suman igual valor >";
                  document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                  submitButton.parentNode.removeChild(submitButton)
                }
                if (total_costo_movimiento_contable_creditos_msj > total_costo_movimiento_contable_debitos_msj) {
                  total_movimiento_contable_mensaje = "< Las cuentas no suman igual valor <";
                  document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                  submitButton.parentNode.removeChild(submitButton)
                }
                if (total_costo_movimiento_contable_creditos_msj == total_costo_movimiento_contable_debitos_msj) {
                  total_movimiento_contable_mensaje = "< Iguales >";
                  document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                  document.getElementById("btn_guardar").innerHTML='<input type="submit" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />';
                }
           }

           if (nombre_tipo_movimiento == 'CREDITOS') {

              for (i=1; i<=total_datos_creditos; i++){
                costo_movimiento_contable_creditos = parseInt(document.getElementsByClassName("costo_movimiento_contable_creditos"+i)[0].value);
                total_costo_movimiento_contable_creditos += costo_movimiento_contable_creditos;
              }
              document.getElementById("total_costo_movimiento_contable_creditos").innerHTML=total_costo_movimiento_contable_creditos.toLocaleString("es-ES");
              total_costo_movimiento_contable_debitos_msj = document.getElementById("total_costo_movimiento_contable_debitos").innerHTML;
              total_costo_movimiento_contable_creditos_msj = document.getElementById("total_costo_movimiento_contable_creditos").innerHTML;

              if (total_costo_movimiento_contable_debitos_msj > total_costo_movimiento_contable_creditos_msj) {
                total_movimiento_contable_mensaje = "> Las cuentas no suman igual valor >";
                document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                submitButton.parentNode.removeChild(submitButton)
              }
              if (total_costo_movimiento_contable_creditos_msj > total_costo_movimiento_contable_debitos_msj) {
                total_movimiento_contable_mensaje = "< Las cuentas no suman igual valor <";
                document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                submitButton.parentNode.removeChild(submitButton)
              }
              if (total_costo_movimiento_contable_creditos_msj == total_costo_movimiento_contable_debitos_msj) {
                total_movimiento_contable_mensaje = "< Iguales >";
                document.getElementById("total_movimiento_contable_mensaje").innerHTML=total_movimiento_contable_mensaje;
                document.getElementById("btn_guardar").innerHTML='<input type="submit" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />';
              }
           }

           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:costo_movimiento_contable_concepto, campo:campo, id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[name="elaborada"]').change(function(){  
           var elaborada_movimiento_contable = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:elaborada_movimiento_contable, campo:"elaborada_movimiento_contable", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="revisada"]').change(function(){  
           var revisada_movimiento_contable = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:revisada_movimiento_contable, campo:"revisada_movimiento_contable", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="autorizada"]').change(function(){  
           var autorizada_movimiento_contable = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:autorizada_movimiento_contable, campo:"autorizada_movimiento_contable", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="contabilizada"]').change(function(){  
           var contabilizada_movimiento_contable = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_ajax.php",  
                method:"POST",  
                data:{valor:contabilizada_movimiento_contable, campo:"contabilizada_movimiento_contable", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


 });  
 </script>