<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

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
<a class="btn btn-primary" href="#"><h6>BALANCE GENERAL</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_puc';
$tipo                        = 'eliminar';
$campo                       = 'cod_puc';
//$fecha_dmy                   = date("Y-m-d");
$origen                      = '';

if (isset($_GET['cod_balance_general'])) {
$cod_balance_general             = intval($_GET['cod_balance_general']);

$obtener_info_pyg = "SELECT fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo FROM tbl15_balance_general WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_pyg = mysqli_query($conectar, $obtener_info_pyg) or die(mysqli_error($conectar));
$info_pyg = mysqli_fetch_assoc($resultado_info_pyg);

$fecha_mes                        = $info_pyg['fecha_mes'];
$anyo                             = $info_pyg['anyo'];
$fecha_dmy                       = '01-'.$fecha_mes;
$frag_fecha                      = explode('-', $fecha_dmy);
$fech_dia                        = $frag_fecha[0];
$fech_mes                        = $frag_fecha[1];
$fech_anyo                       = $frag_fecha[2];
$fecha_ymd                       = $fech_anyo.'-'.$fech_mes.'-'.$fech_dia;
$fecha_ymd_seg                   = strtotime($fecha_ymd);
$fecha_sig_seg                   = strtotime($fecha_ymd.'+1 month');
$fecha_actual_seg                = strtotime($fecha_sig_seg.'-1 day');
$fecha_mes_esp                   = fecha_en_espanol_mes($fecha_ymd_seg);
$fecha_dia                       = date("d", $fecha_actual_seg);

$total_activo_corriente          = 0;
$total_pasivo_corriente          = 0;
$total_propied_planta_equipo     = 0;
$total_patrimonio_smtr           = 0;
$total_resultado_ejercicio       = 0;
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_balance_general_reg.php">
<table class="table table-striped">
<tr>
    <td style="text-align:center"></td>
    <td style="text-align:center" colspan="4" width="535"><?php echo $cod_balance_general ?></td>
  </tr>
  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:center" colspan="4">BALANCE GENERAL</td>
  </tr>
  <tr>
    <td></td>
    <td style="text-align:center" colspan="4"><?php echo strtoupper($fecha_mes_esp) ?> DEL <?php echo strtoupper($anyo) ?></td>
  </tr>
</table>

<br>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td style="text-align:center">Elm</td>
    <td style="text-align:center"></td>
    <td style="text-align:left">ACTIVOS</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:left">CORRIENTES</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
<?php 
$obtener_info_activo_corriente = "SELECT cod_activo_corriente, nombre_activo_corriente, costo_activo_corriente, puc_activo_corriente 
FROM tbl15_activo_corriente WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_activo_corriente = mysqli_query($conectar, $obtener_info_activo_corriente) or die(mysqli_error($conectar));
$total_datos_activo_corriente = mysqli_num_rows($resultado_info_activo_corriente);
while ($info_activo_corriente = mysqli_fetch_assoc($resultado_info_activo_corriente)) { 

$cod_activo_corriente            = $info_activo_corriente['cod_activo_corriente'];
$nombre_activo_corriente         = $info_activo_corriente['nombre_activo_corriente'];
$costo_activo_corriente          = $info_activo_corriente['costo_activo_corriente'];
$puc_activo_corriente            = $info_activo_corriente['puc_activo_corriente'];
$total_activo_corriente         += $costo_activo_corriente;
?>
  <tr>
    <input type="hidden" name="cod_activo_corriente[]" class="cod_activo_corriente" value="<?php echo $cod_activo_corriente ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_balance_activo_corriente.php?cod_activo_corriente=<?php echo $cod_activo_corriente ?>&cod_balance_general=<?php echo $cod_balance_general ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td align="right"><input type="text" name="puc_activo_corriente[]" class="puc_activo_corriente" id="<?php echo $cod_activo_corriente ?>" value="<?php echo $puc_activo_corriente ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_activo_corriente[]" class="nombre_activo_corriente_<?php echo $cod_activo_corriente ?>" id="<?php echo $cod_activo_corriente ?>" value="<?php echo $nombre_activo_corriente ?>" size="60" required></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="costo_activo_corriente[]" class="costo_activo_corriente" id="<?php echo $cod_activo_corriente ?>" value="<?php echo $costo_activo_corriente ?>" onChange="calc_total_activo_corriente();" size="20" required></td>
    <td></td>
  </tr>
<?php } ?>
  <tr>
<td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_balance_general_reg.php?cod_balance_general=<?php echo $cod_balance_general ?>&campo=activo_corriente"><img src="../imagenes/mas.png"></a></td>
    <td style="text-align:left">Total Activos Corrientes</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_activo_corriente" class="total_activo_corriente" id="total_activo_corriente" value="<?php echo $total_activo_corriente ?>" size="20" required></td>
  </tr>
</table>

<br>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td style="text-align:center">Elm</td>
    <td style="text-align:center"></td>
    <td style="text-align:left">PROPIEDADES, PLANTA Y EQUIPO</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
<?php 
$obtener_info_propied_planta_equipo = "SELECT cod_propied_planta_equipo, nombre_propied_planta_equipo, costo_propied_planta_equipo, puc_propied_planta_equipo 
FROM tbl15_propied_planta_equipo WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_propied_planta_equipo = mysqli_query($conectar, $obtener_info_propied_planta_equipo) or die(mysqli_error($conectar));
$total_datos_propied_planta_equipo = mysqli_num_rows($resultado_info_propied_planta_equipo);
while ($info_propied_planta_equipo = mysqli_fetch_assoc($resultado_info_propied_planta_equipo)) { 

$cod_propied_planta_equipo            = $info_propied_planta_equipo['cod_propied_planta_equipo'];
$nombre_propied_planta_equipo         = $info_propied_planta_equipo['nombre_propied_planta_equipo'];
$costo_propied_planta_equipo          = $info_propied_planta_equipo['costo_propied_planta_equipo'];
$puc_propied_planta_equipo            = $info_propied_planta_equipo['puc_propied_planta_equipo'];
$total_propied_planta_equipo         += $costo_propied_planta_equipo;
?>
  <tr>
    <input type="hidden" name="cod_propied_planta_equipo[]" class="cod_propied_planta_equipo" value="<?php echo $cod_propied_planta_equipo ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_balance_propied_planta_equipo.php?cod_propied_planta_equipo=<?php echo $cod_propied_planta_equipo ?>&cod_balance_general=<?php echo $cod_balance_general ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td align="right"><input type="text" name="puc_propied_planta_equipo[]" class="puc_propied_planta_equipo" id="<?php echo $cod_propied_planta_equipo ?>" value="<?php echo $puc_propied_planta_equipo ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_propied_planta_equipo[]" class="nombre_propied_planta_equipo_<?php echo $cod_propied_planta_equipo ?>" id="<?php echo $cod_propied_planta_equipo ?>" value="<?php echo $nombre_propied_planta_equipo ?>" size="60" required></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="costo_propied_planta_equipo[]" class="costo_propied_planta_equipo" id="<?php echo $cod_propied_planta_equipo ?>" value="<?php echo $costo_propied_planta_equipo ?>" onChange="calc_total_propied_planta_equipo();" size="20" required></td>
    <td style="text-align:center"></td>
  </tr>
<?php } ?>
<?php $total_activo = $total_activo_corriente + $total_propied_planta_equipo ?>

  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_balance_general_reg.php?cod_balance_general=<?php echo $cod_balance_general ?>&campo=propied_planta_equipo"><img src="../imagenes/mas.png"></a></td>
    <td style="text-align:left">Total Propiedades, Planta y Equipo</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_propied_planta_equipo" class="total_propied_planta_equipo" id="total_propied_planta_equipo" value="<?php echo $total_propied_planta_equipo ?>" size="20" required></td>
  </tr>
  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:left">TOTAL ACTIVOS</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_activo" class="total_activo" id="total_activo" value="<?php echo $total_activo ?>" size="20" required></td>
  </tr>
</table>

<br>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td style="text-align:center">Elm</td>
    <td style="text-align:center"></td>
    <td style="text-align:left">PASIVOS</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>CORRIENTES</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
<?php 
$obtener_info_pasivo_corriente = "SELECT cod_pasivo_corriente, nombre_pasivo_corriente, costo_pasivo_corriente, puc_pasivo_corriente 
FROM tbl15_pasivo_corriente WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_pasivo_corriente = mysqli_query($conectar, $obtener_info_pasivo_corriente) or die(mysqli_error($conectar));
$total_datos_pasivo_corriente = mysqli_num_rows($resultado_info_pasivo_corriente);
while ($info_pasivo_corriente = mysqli_fetch_assoc($resultado_info_pasivo_corriente)) { 

$cod_pasivo_corriente            = $info_pasivo_corriente['cod_pasivo_corriente'];
$nombre_pasivo_corriente         = $info_pasivo_corriente['nombre_pasivo_corriente'];
$costo_pasivo_corriente          = $info_pasivo_corriente['costo_pasivo_corriente'];
$puc_pasivo_corriente            = $info_pasivo_corriente['puc_pasivo_corriente'];
$total_pasivo_corriente         += $costo_pasivo_corriente;
?>
  <tr>
    <input type="hidden" name="cod_pasivo_corriente[]" class="cod_pasivo_corriente" value="<?php echo $cod_pasivo_corriente ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_balance_pasivo_corriente.php?cod_pasivo_corriente=<?php echo $cod_pasivo_corriente ?>&cod_balance_general=<?php echo $cod_balance_general ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td align="right"><input type="text" name="puc_pasivo_corriente[]" class="puc_pasivo_corriente" id="<?php echo $cod_pasivo_corriente ?>" value="<?php echo $puc_pasivo_corriente ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_pasivo_corriente[]" class="nombre_pasivo_corriente_<?php echo $cod_pasivo_corriente ?>" id="<?php echo $cod_pasivo_corriente ?>" value="<?php echo $nombre_pasivo_corriente ?>" size="60" required></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="costo_pasivo_corriente[]" class="costo_pasivo_corriente" id="<?php echo $cod_pasivo_corriente ?>" value="<?php echo $costo_pasivo_corriente ?>" onChange="calc_total_pasivo_corriente();" size="20" required></td>
    <td></td>
  </tr>
<?php } ?>
<?php $total_pasivo = $total_pasivo_corriente ?>
  <tr>
<td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_balance_general_reg.php?cod_balance_general=<?php echo $cod_balance_general ?>&campo=pasivo_corriente"><img src="../imagenes/mas.png"></a></td>
    <td style="text-align:left">Total Pasivos Corrientes</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_pasivo_corriente" class="total_pasivo_corriente" id="total_pasivo_corriente" value="<?php echo $total_pasivo_corriente ?>" size="20" required></td>
  </tr>
  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:left">TOTAL PASIVOS</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_pasivo" class="total_pasivo" id="total_pasivo" value="<?php echo $total_pasivo ?>" size="20" required></td>
  </tr>
</table>

<br>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td style="text-align:center">Elm</td>
    <td style="text-align:center"></td>
    <td style="text-align:left">PATRIMONIO</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
<?php 
$obtener_info_patrimonio = "SELECT cod_patrimonio, nombre_patrimonio, costo_patrimonio, puc_patrimonio FROM tbl15_patrimonio 
WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_patrimonio = mysqli_query($conectar, $obtener_info_patrimonio) or die(mysqli_error($conectar));
$total_datos_patrimonio = mysqli_num_rows($resultado_info_patrimonio);
while ($info_patrimonio = mysqli_fetch_assoc($resultado_info_patrimonio)) { 

$cod_patrimonio            = $info_patrimonio['cod_patrimonio'];
$nombre_patrimonio         = $info_patrimonio['nombre_patrimonio'];
$costo_patrimonio          = $info_patrimonio['costo_patrimonio'];
$puc_patrimonio            = $info_patrimonio['puc_patrimonio'];
$total_patrimonio_smtr    += $costo_patrimonio;
?>
  <tr>
    <input type="hidden" name="cod_patrimonio[]" class="cod_patrimonio" value="<?php echo $cod_patrimonio ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_balance_patrimonio.php?cod_patrimonio=<?php echo $cod_patrimonio ?>&cod_balance_general=<?php echo $cod_balance_general ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td align="right"><input type="text" name="puc_patrimonio[]" class="puc_patrimonio" id="<?php echo $cod_patrimonio ?>" value="<?php echo $puc_patrimonio ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_patrimonio[]" class="nombre_patrimonio_<?php echo $cod_patrimonio ?>" id="<?php echo $cod_patrimonio ?>" value="<?php echo $nombre_patrimonio ?>" size="60" required></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="costo_patrimonio[]" class="costo_patrimonio" id="<?php echo $cod_patrimonio ?>" value="<?php echo $costo_patrimonio ?>" onChange="calc_total_patrimonio();" size="20" required></td>
    <td></td>
  </tr>
<?php } ?>
<?php 
$total_patrimonio            = $total_patrimonio_smtr - $total_resultado_ejercicio;
$total_pasivo_patrimonio     = $total_pasivo_corriente + $total_patrimonio;
?>
  <tr>
<td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_balance_general_reg.php?cod_balance_general=<?php echo $cod_balance_general ?>&campo=patrimonio"><img src="../imagenes/mas.png"></a></td>
    <td style="text-align:left">TOTAL PATRIMONIO</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_patrimonio" class="total_patrimonio" id="total_patrimonio" value="<?php echo $total_patrimonio ?>" size="20" required></td>
  </tr>
</table>

<br>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td style="text-align:center"></td>
    <td style="text-align:left">TOTAL PASIVO MAS PATRIMONIO</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td align="right"><input type="text" name="total_pasivo_patrimonio" class="total_pasivo_patrimonio" id="total_pasivo_patrimonio" value="<?php echo $total_pasivo_patrimonio ?>" size="20" required></td>
  </tr>
</table>

<hr>
<input type="hidden" name="cod_balance_general" value="<?php echo $cod_balance_general ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Editar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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
</div>
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
$(".puc_activo_corriente").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=ACTIVO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_activo_corriente_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_activo_corriente_'+id).val();

          $.ajax({  
                url:"../admin/guardar_balance_general_ajax.php",  
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
$(function() {
$(".puc_propied_planta_equipo").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_propied_planta_equipo_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_propied_planta_equipo_'+id).val();

          $.ajax({  
                url:"../admin/guardar_balance_general_ajax.php",  
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
$(function() {
$(".puc_pasivo_corriente").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_pasivo_corriente_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_pasivo_corriente_'+id).val();

          $.ajax({  
                url:"../admin/guardar_balance_general_ajax.php",  
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
$(function() {
$(".puc_patrimonio").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_patrimonio_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_patrimonio_'+id).val();

          $.ajax({  
                url:"../admin/guardar_balance_general_ajax.php",  
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


<script>
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_activo_corriente(){
total_activo_corriente = 0;
total_propied_planta_equipo = 0;

$("input[class='costo_activo_corriente']").each(function() {
total_activo_corriente += parseFloat(this.value);
});

$("input[class='costo_propied_planta_equipo']").each(function() {
total_propied_planta_equipo += parseFloat(this.value);
total_activo = total_activo_corriente + total_propied_planta_equipo;
});

document.getElementById("total_activo_corriente").value = total_activo_corriente;
document.getElementById("total_activo").value = total_activo;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_propied_planta_equipo(){
total_propied_planta_equipo = 0;
total_activo_corriente = 0;

$("input[class='costo_propied_planta_equipo']").each(function() {
total_propied_planta_equipo += parseFloat(this.value);
});

$("input[class='costo_activo_corriente']").each(function() {
total_activo_corriente += parseFloat(this.value);
total_activo = total_activo_corriente + total_propied_planta_equipo;
});

document.getElementById("total_propied_planta_equipo").value = total_propied_planta_equipo;
document.getElementById("total_activo").value = total_activo;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_pasivo_corriente(){
total_pasivo_corriente = 0;
total_pasivo = 0;

$("input[class='costo_pasivo_corriente']").each(function() {
total_pasivo_corriente += parseFloat(this.value);
total_pasivo = total_pasivo_corriente;
});

document.getElementById("total_pasivo_corriente").value = total_pasivo_corriente;
document.getElementById("total_pasivo").value = total_pasivo;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_patrimonio(){
total_patrimonio = 0;
total_pasivo_patrimonio = 0;
total_pasivo_corriente = 0;
total_pasivo = 0;

$("input[class='costo_pasivo_corriente']").each(function() {
total_pasivo_corriente += parseFloat(this.value);
total_pasivo = total_pasivo_corriente;
});

$("input[class='costo_patrimonio']").each(function() {
total_patrimonio += parseFloat(this.value);
total_pasivo_patrimonio = total_pasivo + total_patrimonio;
});

document.getElementById("total_patrimonio").value = total_patrimonio;
document.getElementById("total_pasivo_patrimonio").value = total_pasivo_patrimonio;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
</script>

 <script>  
 $(document).ready(function(){  

         $('input[class="puc_activo_corriente"]').focusout(function(){  
           var puc_activo_corriente = $(this).val();  
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:puc_activo_corriente, campo:"puc_activo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="nombre_activo_corriente"]').focusout(function(){  
           var nombre_activo_corriente = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_activo_corriente, campo:"nombre_activo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="costo_activo_corriente"]').focusout(function(){  
           var costo_activo_corriente = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_activo_corriente, campo:"costo_activo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[id="total_activo_corriente"]').focusout(function(){  
           var total_activo_corriente = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_activo_corriente, campo:"total_activo_corriente", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="puc_propied_planta_equipo"]').focusout(function(){  
           var puc_propied_planta_equipo = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:puc_propied_planta_equipo, campo:"puc_propied_planta_equipo", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="nombre_propied_planta_equipo"]').focusout(function(){  
           var nombre_propied_planta_equipo = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_propied_planta_equipo, campo:"nombre_propied_planta_equipo", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="costo_propied_planta_equipo"]').focusout(function(){  
           var costo_propied_planta_equipo = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_propied_planta_equipo, campo:"costo_propied_planta_equipo", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_propied_planta_equipo"]').focusout(function(){  
           var total_propied_planta_equipo = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_propied_planta_equipo, campo:"total_propied_planta_equipo", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_activo"]').focusout(function(){  
           var total_activo = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_activo, campo:"total_activo", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="puc_pasivo_corriente"]').focusout(function(){  
           var puc_pasivo_corriente = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:puc_pasivo_corriente, campo:"puc_pasivo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="nombre_pasivo_corriente"]').focusout(function(){  
           var nombre_pasivo_corriente = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_pasivo_corriente, campo:"nombre_pasivo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="costo_pasivo_corriente"]').focusout(function(){  
           var costo_pasivo_corriente = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_pasivo_corriente, campo:"costo_pasivo_corriente", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_pasivo_corriente"]').focusout(function(){  
           var total_pasivo_corriente = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_pasivo_corriente, campo:"total_pasivo_corriente", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_pasivo"]').focusout(function(){  
           var total_pasivo = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_pasivo, campo:"total_pasivo", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="puc_patrimonio"]').focusout(function(){  
           var puc_patrimonio = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:puc_patrimonio, campo:"puc_patrimonio", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="nombre_patrimonio"]').focusout(function(){  
           var nombre_patrimonio = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_patrimonio, campo:"nombre_patrimonio", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="costo_patrimonio"]').focusout(function(){  
           var costo_patrimonio = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_patrimonio, campo:"costo_patrimonio", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_patrimonio"]').focusout(function(){  
           var total_patrimonio = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_patrimonio, campo:"total_patrimonio", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[id="total_pasivo_patrimonio"]').focusout(function(){  
           var total_pasivo_patrimonio = $(this).val();  
           $.ajax({  
                url:"guardar_balance_general_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_pasivo_patrimonio, campo:"total_pasivo_patrimonio", id:<?php echo $cod_balance_general; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


 });  
 </script> 