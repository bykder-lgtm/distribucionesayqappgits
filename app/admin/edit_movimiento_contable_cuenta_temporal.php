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
$pagina_manual                      = '../admin/lista_movimiento_contable_cuenta.php';

$tab                                = 'tbl15_puc';
$tipo                               = 'eliminar';
$campo                              = 'cod_puc';
//$fecha_dmy                          = date("Y-m-d");
$origen                             = '';

if (isset($_GET['cod_movimiento_contable'])) {
$cod_movimiento_contable            = intval($_GET['cod_movimiento_contable']);

$obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
$info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

$cod_factura                        = $info_ingre_operacional['cod_factura'];
$doc_modifica                       = $info_ingre_operacional['doc_modifica'];
$nombre_tipo_documento              = $info_ingre_operacional['nombre_tipo_documento'];
$descripcion_movimiento             = $info_ingre_operacional['descripcion_movimiento'];
$total_costo_movimiento_contable    = $info_ingre_operacional['total_costo_movimiento_contable'];
$total_venta_movimiento_contable    = $info_ingre_operacional['total_venta_movimiento_contable'];
$cod_clientes                       = $info_ingre_operacional['cod_clientes'];
$cod_tercero                        = $info_ingre_operacional['cod_tercero'];
$nombres_clientes                   = $info_ingre_operacional['nombres_clientes'];
$nit_cliente                        = $info_ingre_operacional['nit_cliente'];
$digito                             = $info_ingre_operacional['digito'];
$estado_devol                       = $info_ingre_operacional['estado_devol'];
$motivo_devol                       = $info_ingre_operacional['motivo_devol'];
$direccion                          = $info_ingre_operacional['direccion'];
$no_cuenta                          = $info_ingre_operacional['no_cuenta'];
$elaborada                          = $info_ingre_operacional['elaborada'];
$revisada                           = $info_ingre_operacional['revisada'];
$autorizada                         = $info_ingre_operacional['autorizada'];
$contabilizada                      = $info_ingre_operacional['contabilizada'];
$motivo_modificacion                = $info_ingre_operacional['motivo_modificacion'];
$fecha_anyo                         = $info_ingre_operacional['fecha_anyo'];
$fecha_ymd                          = $info_ingre_operacional['fecha_ymd'];
$fecha_mes                          = $info_ingre_operacional['fecha_mes'];
$anyo                               = $info_ingre_operacional['anyo'];
$fecha_seg                          = $info_ingre_operacional['fecha_seg'];
$fecha_factura                      = $info_ingre_operacional['fecha_factura'];
$cuenta                             = $info_ingre_operacional['cuenta'];
$cod_caja_virtual                   = $info_ingre_operacional['cod_caja_virtual'];
$observacion                        = $info_ingre_operacional['observacion'];
$cod_tipo_pago                      = $info_ingre_operacional['cod_tipo_pago'];
$cod_tipo_forma_pago                = $info_ingre_operacional['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago             = $info_ingre_operacional['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago        = $info_ingre_operacional['descripcion_tipo_forma_pago'];
$cod_guia                           = $info_ingre_operacional['cod_guia'];
$url_img_orig_producto              = $info_ingre_operacional['url_img_orig_producto'];


$tab1                               = 'tbl15_movimiento_contable_temporal_concepto';
$campo1                             = 'cod_movimiento_contable_temporal_concepto';
$tipo1                              = 'eliminar';
$tab2                               = 'tbl15_movimiento_contable_temporal_codigo';
$campo2                             = 'cod_movimiento_contable_temporal_codigo';
$tipo2                              = 'eliminar';

$nombre_tab_mad1                    = 'tbl15_movimiento_contable';
$nombre_tab_mad2                    = 'tbl15_movimiento_contable';

$nombre_campo_key1                  = 'cod_movimiento_contable';
$nombre_campo_key2                  = 'cod_movimiento_contable';

$nombre_campo_calc1                 = 'total_costo_movimiento_contable';
$nombre_campo_calc2                 = 'total_costo_movimiento_contable';

$nombre_campo_update1               = 'total_costo_movimiento_contable';
$nombre_campo_update2               = 'total_costo_movimiento_contable';

$total_costo_movimiento_contable_debito   = 0;
$total_costo_movimiento_contable_credito  = 0;

$total_datos_debitos                      = 0;
$total_datos_creditos                     = 0;

$sql_mov_contable_debito = "SELECT * FROM tbl15_movimiento_contable_temporal_concepto 
WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
$consulta_mov_contable_debito = mysqli_query($conectar, $sql_mov_contable_debito) or die(mysqli_error($conectar));
$total_datos_debitos = mysqli_num_rows($consulta_mov_contable_debito);

$tab                                      = 'tbl15_movimiento_contable_temporal_concepto';
$tipo                                     = 'eliminar';
$campo                                    = 'cod_movimiento_contable_temporal_concepto';
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_movimiento_contable_temporal_reg.php">
<table class="table table-striped">
  <tr>
    <td style="text-align:center"><?php echo $nombre_tipo_documento ?> - (<?php echo $cod_movimiento_contable ?>)</td>
<input type="hidden" name="cod_movimiento_contable" value="<?php echo $cod_movimiento_contable ?>" size="20" required>
<input type="hidden" name="nombre_tipo_documento" value="<?php echo $nombre_tipo_documento ?>" size="20" required>
  </tr>
</table>

<table class="table table-striped">
  <tr>
    <td colspan="3">FECHA MOVIMIENTO: <input type="date" name="fecha_ymd" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $fecha_ymd ?>" size="20" required></td>
    <td >OBSERVACION:</td>
    <td ><input type="text" name="doc_modifica" class="doc_modifica" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $doc_modifica ?>" size="10"></td>
  </tr>
  <tr>
    <td colspan="3">RECIBIDO DE: 
<select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_tercero)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
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
    <td>FACTURA #:</td>
    <td><input type="text" name="cod_factura" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $cod_factura ?>" size="10"></td>
  </tr>
  <tr>
<!--
    <td style="text-align:left">DESCRIPCION DEL MOVIMIENTO: </td>
    <td style="text-align:left"></td>
    <td style="text-align:center"></td>
    <td>FECHA:</td>
    <td style="text-align:left"><input type="date" name="fecha_factura" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $fecha_factura ?>" size="10"></td>
-->
  </tr>
</table>

<table class="table table-striped">
  <tr>
    <td style="text-align:left">DESCRIPCION DEL MOVIMIENTO: <input type="text" name="descripcion_movimiento" id="<?php echo $cod_movimiento_contable ?>" value="<?php echo $descripcion_movimiento ?>" style="width: 500px; height: 20px"  size="100"></td>
  </tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<td style="text-align:left">FORMA DE PAGO: 
<select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_tipo_forma_pago)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
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

<?php
$incre                                        = 0;
$und_vendida                                  = 0;
$costo_movimiento_diario                      = 0;
$total_costo_movimiento_diario                = 0;
$nombre_tabla                                 = "movimiento_diario_venta";
$nombre_llave                                 = "cod_movimiento_diario_venta";
$id_campo_total                               = "total_costo_movimiento_diario_venta";
$nombre_campo_class_sumar                     = "costo_movimiento_diario_venta";
?>
<table border="1" style="text-align:center; font-family:mono; font-size:12pt; width:99%"><tr><td style="text-align:center">CUENTA<a href="../admin/reg_movimiento_contable_temporal_concepto_cuenta_reg.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>&nombre_tipo_documento=<?php echo $nombre_tipo_documento?>&nombre_tipo_movimiento=DEBITOS"><img src=../imagenes/mas.png alt="mas"></a></td></tr></table>

<table class="table table-striped">
  <tr> 
    <td style="text-align:center">Elim</td>
    <td style="text-align:center">Codigo</td>
    <td style="text-align:center">Nombre</td>
    <td style="text-align:center">Valor</td>
  </tr>
<?php
$incre                       = 0;

$obtener_info_movimiento_contable_temporal_concepto = "SELECT * FROM tbl15_movimiento_contable_temporal_concepto 
WHERE (cod_movimiento_contable = '$cod_movimiento_contable' AND nombre_tipo_movimiento = 'DEBITOS')";
$resultado_info_movimiento_contable_temporal_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_temporal_concepto) or die(mysqli_error($conectar));
while ($info_movimiento_contable_temporal_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_temporal_concepto)) {

$cod_movimiento_contable_temporal_concepto      = $info_movimiento_contable_temporal_concepto['cod_movimiento_contable_temporal_concepto'];
$nombre_tipo_movimiento                         = $info_movimiento_contable_temporal_concepto['nombre_tipo_movimiento'];
$nombre_tipo_documento                          = $info_movimiento_contable_temporal_concepto['nombre_tipo_documento'];
$codigo_puc                                     = $info_movimiento_contable_temporal_concepto['codigo_puc'];
$nombre_puc                                     = $info_movimiento_contable_temporal_concepto['nombre_puc'];
$tipo_puc                                       = $info_movimiento_contable_temporal_concepto['tipo_puc'];
$und_vendida                                    = $info_movimiento_contable_temporal_concepto['und_vendida'];
$costo_movimiento_contable                      = $info_movimiento_contable_temporal_concepto['costo_movimiento_contable'];
$venta_movimiento_contable                      = $info_movimiento_contable_temporal_concepto['venta_movimiento_contable'];
$total_costo_movimiento_contable                = $info_movimiento_contable_temporal_concepto['total_costo_movimiento_contable'];
$total_venta_movimiento_contable                = $info_movimiento_contable_temporal_concepto['total_venta_movimiento_contable'];
$total_costo_movimiento_contable_debito        += $total_costo_movimiento_contable;
$incre++;
?>
    <tr id="tr<?php echo $cod_movimiento_contable_temporal_concepto;?>">
      <td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_movimiento_contable_temporal_concepto ?>&cod_movimiento_contable=<?php echo $cod_movimiento_contable ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
      <!--<td style="text-align:center" class="service_list" id="cod_movimiento_contable_temporal_concepto<?php echo $cod_movimiento_contable_temporal_concepto ?>" data="<?php echo $cod_movimiento_contable_temporal_concepto ?>"><a class="eliminar_movimiento_contable_temporal_concepto" id="cod_movimiento_contable_temporal_concepto<?php echo $cod_movimiento_contable_temporal_concepto ?>"><img src="../imagenes/eliminar.png"></a></td>-->
      <td style="text-align:center"><input type="text" name="codigo_puc[]" class="codigo_puc" id="<?php echo $cod_movimiento_contable_temporal_concepto ?>" value="<?php echo $codigo_puc ?>" size="8"></td>
      <td style="text-align:left"><input type="text" name="nombre_puc[]" class="nombre_puc_<?php echo $cod_movimiento_contable_temporal_concepto ?>" id="<?php echo $cod_movimiento_contable_temporal_concepto ?>" value="<?php echo $nombre_puc ?>" size="25"></td>
      <td style="text-align:center"><input type="text" name="costo_movimiento_contable[]" class="costo_movimiento_contable_debitos<?php echo $incre ?>" data="DEBITOS" id="<?php echo $cod_movimiento_contable_temporal_concepto ?>" value="<?php echo $costo_movimiento_contable ?>" size="8"></td>
      <input type="hidden" name="und_vendida[]" value="<?php echo $und_vendida ?>">
      <input type="hidden" name="cod_movimiento_contable_temporal_concepto[]" value="<?php echo $cod_movimiento_contable_temporal_concepto ?>">
    </tr id="tr<?php echo $cod_movimiento_contable_temporal_concepto;?>">
<?php } ?>
</table> 

<br>
<table class="table table-striped">
  <tr>
    <td style="text-align:center; width:33%" id="total_costo_movimiento_contable_debitos"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></td>
  </tr>
</table>

<br>

<table class="table table-striped">
  <tr>
    <td style="text-align:left" rowspan="3">MOTIVOS DE MODIFICACION:</td>
    <td style="text-align:left" rowspan="3"><input type="text" name="motivo_modificacion" id="motivo_modificacion_z_<?php echo $cod_movimiento_contable ?>" value="<?php echo $motivo_modificacion ?>" size="60"></td>
    <td style="text-align:left">SUB TOTAL</td>
    <td style="text-align:right" id="subtotal_total_movimiento_contable_temporal"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></td>
  </tr>
  <tr>
    <td style="text-align:left">IVA 0%</td>
    <td style="text-align:right">0</td>
  </tr>
  <tr>
    <td style="text-align:left">TOTAL</td>
    <td style="text-align:right" id="total_movimiento_contable_temporal"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".");?></td>
  </tr>
</table>

<hr>
<input type="hidden" name="cod_movimiento_contable" value="<?php echo $cod_movimiento_contable ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina_manual ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<div id="btn_guardar">
<input type="submit" value="Guardar Movimiento" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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
$('.nombre_puc_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_puc_'+id).val();
console.log("nombre_puc_"+id);

          $.ajax({  
                url:"../admin/guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST", 
                data:{id:id, valor:valor, campo:campo, codigo_puc:codigo_puc, nombre_puc:nombre_puc, jqui:jqui},  
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

    $('.eliminar_movimiento_contable_temporal_concepto').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_movimiento_contable_temporal_concepto = $(this).parent().attr('data');
        var dataString = 'llave='+cod_movimiento_contable_temporal_concepto+'&'+'tab='+'<?php echo $tab1 ?>'+'&'+'campo='+'<?php echo $campo1 ?>'+'&'+'tipo='+'<?php echo $tipo1 ?>'+'&'+'nombre_tab_mad='+'<?php echo $nombre_tab_mad1 ?>'+'&'+'nombre_campo_key='+'<?php echo $nombre_campo_key1 ?>'+'&'+'nombre_campo_calc='+'<?php echo $nombre_campo_calc1 ?>'+'&'+'nombre_campo_update='+'<?php echo $nombre_campo_update1 ?>'+'&'+'llave_tab_mad='+'<?php echo $cod_movimiento_contable ?>';
        
        $.ajax({
            type: "POST",
            url: "../admin/eliminar_movimiento_contable_temporal_concepto.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el producto con codigo = '+cod_movimiento_contable_temporal_concepto+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_movimiento_contable_temporal_concepto_z_'+cod_movimiento_contable_temporal_concepto).fadeOut("slow");
                $('#nombre_movimiento_contable_temporal_concepto_z_'+cod_movimiento_contable_temporal_concepto).fadeOut("slow");
                $('#costo_movimiento_contable_temporal_concepto_z_'+cod_movimiento_contable_temporal_concepto).fadeOut("slow");
                $('#tr'+cod_movimiento_contable_temporal_concepto).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

    $('.eliminar_movimiento_contable_temporal_codigo').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_movimiento_contable_temporal_codigo = $(this).parent().attr('data');
        var dataString = 'llave='+cod_movimiento_contable_temporal_codigo+'&'+'tab='+'<?php echo $tab2 ?>'+'&'+'campo='+'<?php echo $campo2 ?>'+'&'+'tipo='+'<?php echo $tipo2 ?>'+'&'+'nombre_tab_mad='+'<?php echo $nombre_tab_mad2 ?>'+'&'+'nombre_campo_key='+'<?php echo $nombre_campo_key2 ?>'+'&'+'nombre_campo_calc='+'<?php echo $nombre_campo_calc1 ?>'+'&'+'nombre_campo_update='+'<?php echo $nombre_campo_update2 ?>'+'&'+'cod_nota='+'<?php echo $cod_movimiento_contable ?>';
        
        $.ajax({
            type: "POST",
            url: "../admin/eliminar.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el producto con codigo = '+cod_movimiento_contable_temporal_codigo+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_movimiento_contable_temporal_codigo_z_'+cod_movimiento_contable_temporal_codigo).fadeOut("slow");
                $('#movimiento_contable_temporal_codigo_z_'+cod_movimiento_contable_temporal_codigo).fadeOut("slow");
                $('#movimiento_contable_temporal_debito_z_'+cod_movimiento_contable_temporal_codigo).fadeOut("slow");
                $('#tr'+cod_movimiento_contable_temporal_codigo).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });


});
</script>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
 <script>  
 $(document).ready(function(){  

         $('select[name="cod_tercero"]').change(function(){  
           var cod_tercero = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
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
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:cod_tipo_forma_pago, campo:"cod_tipo_forma_pago", id:<?php echo $cod_movimiento_contable ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('input[name="doc_modifica"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"doc_modifica", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
         
         $('input[name="descripcion_movimiento"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"descripcion_movimiento", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

         $('input[name="cod_factura"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"cod_factura", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


         $('input[name="fecha_factura"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"fecha_factura", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });



         $('input[name="motivo_modificacion"]').change(function(){  
           var nombre_empresa_movimiento_contable_temporal = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"motivo_modificacion", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


        $('input[name="fecha_ymd"]').change(function(){  
           var fecha_ymd = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
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
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:nombre_empresa_movimiento_contable_temporal, campo:"descripcion_tipo_forma_pago", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        
        $('input[name="no_cuenta"]').change(function(){  
           var no_cuenta_movimiento_contable_temporal = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:no_cuenta_movimiento_contable_temporal, campo:"no_cuenta_movimiento_contable_temporal", id:id},  
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
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:und_vendida, campo:campo, id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[name="costo_movimiento_contable[]"]').change(function(){  
           var costo_movimiento_contable_temporal_concepto = $(this).val();
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

           if (nombre_tipo_movimiento == 'DEBITOS') {

              for (i=1; i<=total_datos_debitos; i++){
                costo_movimiento_contable_debitos = parseInt(document.getElementsByClassName("costo_movimiento_contable_debitos"+i)[0].value);
                total_costo_movimiento_contable_debitos += costo_movimiento_contable_debitos;
              }
                document.getElementById("total_costo_movimiento_contable_debitos").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
                document.getElementById("subtotal_total_movimiento_contable_temporal").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
                document.getElementById("total_movimiento_contable_temporal").innerHTML=total_costo_movimiento_contable_debitos.toLocaleString("es-ES");
           }
           

           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:costo_movimiento_contable_temporal_concepto, campo:campo, id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[name="elaborada"]').change(function(){  
           var elaborada_movimiento_contable_temporal = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:elaborada_movimiento_contable_temporal, campo:"elaborada_movimiento_contable_temporal", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="revisada"]').change(function(){  
           var revisada_movimiento_contable_temporal = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:revisada_movimiento_contable_temporal, campo:"revisada_movimiento_contable_temporal", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="autorizada"]').change(function(){  
           var autorizada_movimiento_contable_temporal = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:autorizada_movimiento_contable_temporal, campo:"autorizada_movimiento_contable_temporal", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[name="contabilizada"]').change(function(){  
           var contabilizada_movimiento_contable_temporal = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_movimiento_contable_temporal_ajax.php",  
                method:"POST",  
                data:{valor:contabilizada_movimiento_contable_temporal, campo:"contabilizada_movimiento_contable_temporal", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


 });  
 </script> 