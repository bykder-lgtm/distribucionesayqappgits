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
<a class="btn btn-primary" href="#"><h6>PYG</h6></a>
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

if (isset($_GET['cod_pyg'])) {
  $cod_pyg                         = intval($_GET['cod_pyg']);
  $fecha_mes                       = addslashes($_GET['fecha_mes']);
  //$anyo                            = addslashes($_GET['anyo']);
  $fecha_dmy                       = $fecha_mes.'-01';
  $frag_fecha                      = explode('-', $fecha_dmy);
  $fech_dia                        = $frag_fecha[2];
  $fech_mes                        = $frag_fecha[1];
  $fech_anyo                       = $frag_fecha[0];
  $fecha_ymd                       = $fech_anyo.'-'.$fech_mes.'-'.$fech_dia;
  $fecha_ymd_seg                   = strtotime($fecha_ymd);
  $fecha_sig_seg                   = strtotime($fecha_ymd.'+1 month');
  $fecha_actual_seg                = strtotime($fecha_sig_seg.'-1 day');
  $fecha_mes_esp                   = fecha_en_espanol_mes($fecha_ymd_seg);
  $fecha_dia                       = date("d", $fecha_actual_seg);

  $total_ingre_operacional         = 0;
  $total_costo_operacional         = 0;
  $total_gasto_operacional         = 0;
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_pyg_reg.php">
<table class="table table-striped">
  <tr>
    <td></td>
    <td style="text-align:center" colspan="4">ESTADO DE RESULTADOS - PYG</td>
  </tr>
  <tr>
    <td></td>
    <td style="text-align:center" colspan="4"><?php echo strtoupper($fecha_mes_esp) ?> DEL <?php echo strtoupper($fech_anyo) ?></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>ELM</td>

    <td></td>
    <td>INGRESOS OPERACIONALES</td>
    <td></td>
  </tr>
<?php $obtener_info_ingre_operacional = "SELECT cod_ingre_operacional, nombre_ingre_operacional, costo_ingre_operacional, puc_ingre_operacional 
FROM tbl15_ingre_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
while ($info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional)) { 

$cod_ingre_operacional            = $info_ingre_operacional['cod_ingre_operacional'];
$nombre_ingre_operacional         = $info_ingre_operacional['nombre_ingre_operacional'];
$costo_ingre_operacional          = $info_ingre_operacional['costo_ingre_operacional'];
$puc_ingre_operacional            = $info_ingre_operacional['puc_ingre_operacional'];
$total_ingre_operacional         += $costo_ingre_operacional;
?>
  <tr>
    <input type="hidden" name="cod_ingre_operacional[]" class="cod_ingre_operacional" value="<?php echo $cod_ingre_operacional ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_pyg_ingre_operacional.php?cod_ingre_operacional=<?php echo $cod_ingre_operacional ?>&cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td style="text-align:center"><input type="text" name="puc_ingre_operacional[]" class="puc_ingre_operacional" id="<?php echo $cod_ingre_operacional ?>" value="<?php echo $puc_ingre_operacional ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_ingre_operacional[]" class="nombre_ingre_operacional_<?php echo $cod_ingre_operacional ?>" id="<?php echo $cod_ingre_operacional ?>" value="<?php echo $nombre_ingre_operacional ?>" size="60" required></td>
    <td style="text-align:center"><input type="text" name="costo_ingre_operacional[]" class="costo_ingre_operacional" id="<?php echo $cod_ingre_operacional ?>" value="<?php echo $costo_ingre_operacional ?>" onChange="calc_total_ingre_operacional();" size="20" required></td>
    <td style="text-align:center"><a href="../admin/actualizar_ventas_pyg.php?cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>"><img src="../imagenes/ver_total.png"></a></td>
  </tr>
<?php } ?>
  <tr>
    <td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_pyg_reg.php?cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>&campo=ingre_operacional"><img src="../imagenes/mas.png"></a></td>
    <td>TOTAL INGRESOS OPERACIONALES <?php echo $total_datos_ingre_operacional ?></td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_ingre_operacional" class="total_ingre_operacional" id="total_ingre_operacional" value="<?php echo $total_ingre_operacional ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>ELM</td>

    <td></td>
    <td>COSTOS OPERACIONALES</td>
    <td></td>
    <td style="text-align:center"></td>
  </tr>
<?php $obtener_info_costo_operacional = "SELECT cod_costo_operacional, nombre_costo_operacional, costo_costo_operacional, puc_costo_operacional 
FROM tbl15_costo_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_costo_operacional = mysqli_query($conectar, $obtener_info_costo_operacional) or die(mysqli_error($conectar));
$total_datos_costo_operacional = mysqli_num_rows($resultado_info_costo_operacional);
while ($info_costo_operacional = mysqli_fetch_assoc($resultado_info_costo_operacional)) { 

$cod_costo_operacional            = $info_costo_operacional['cod_costo_operacional'];
$nombre_costo_operacional         = $info_costo_operacional['nombre_costo_operacional'];
$costo_costo_operacional          = $info_costo_operacional['costo_costo_operacional'];
$puc_costo_operacional            = $info_costo_operacional['puc_costo_operacional'];
$total_costo_operacional         += $costo_costo_operacional;
?>
  <tr>
    <input type="hidden" name="cod_costo_operacional[]" class="cod_costo_operacional" value="<?php echo $cod_costo_operacional ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_pyg_costo_operacional.php?cod_costo_operacional=<?php echo $cod_costo_operacional ?>&cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td style="text-align:center"><input type="text" name="puc_costo_operacional[]" class="puc_costo_operacional" id="<?php echo $cod_costo_operacional ?>" value="<?php echo $puc_costo_operacional ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_costo_operacional[]" class="nombre_costo_operacional_<?php echo $cod_costo_operacional ?>" id="<?php echo $cod_costo_operacional ?>" value="<?php echo $nombre_costo_operacional ?>" size="60" required></td>
    <td style="text-align:center"><input type="text" name="costo_costo_operacional[]" class="costo_costo_operacional" id="<?php echo $cod_costo_operacional ?>" value="<?php echo $costo_costo_operacional ?>" onChange="calc_total_costo_operacional();" size="20" required></td>
    <td style="text-align:center"></td>
  </tr>
<?php } ?>
<?php $total_utilidad_bruta = $total_ingre_operacional - $total_costo_operacional ?>
  <tr>
<td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_pyg_reg.php?cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>&campo=costo_operacional"><img src="../imagenes/mas.png"></a></td>
    <td>TOTAL COSTOS OPERACIONALES</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_costo_operacional" class="total_costo_operacional" id="total_costo_operacional" value="<?php echo $total_costo_operacional ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>UTILIDAD BRUTA</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_utilidad_bruta" class="total_utilidad_bruta" id="total_utilidad_bruta" value="<?php echo $total_utilidad_bruta ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Menos</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>GASTOS OPERACIONALES</td>
    <td></td>
    <td></td>
  </tr>
<?php $obtener_info_gasto_operacional = "SELECT cod_gasto_operacional, nombre_gasto_operacional, costo_gasto_operacional, puc_gasto_operacional 
FROM tbl15_gasto_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_gasto_operacional = mysqli_query($conectar, $obtener_info_gasto_operacional) or die(mysqli_error($conectar));
$total_datos_gasto_operacional = mysqli_num_rows($resultado_info_gasto_operacional);
while ($info_gasto_operacional = mysqli_fetch_assoc($resultado_info_gasto_operacional)) { 

$cod_gasto_operacional            = $info_gasto_operacional['cod_gasto_operacional'];
$nombre_gasto_operacional         = $info_gasto_operacional['nombre_gasto_operacional'];
$costo_gasto_operacional          = $info_gasto_operacional['costo_gasto_operacional'];
$puc_gasto_operacional            = $info_gasto_operacional['puc_gasto_operacional'];
$total_gasto_operacional         += $costo_gasto_operacional;
?>
  <tr>
    <input type="hidden" name="cod_gasto_operacional[]" class="cod_gasto_operacional" value="<?php echo $cod_gasto_operacional ?>" required>
    <td style="text-align:center"><a href="../admin/eliminar_pyg_gasto_operacional.php?cod_gasto_operacional=<?php echo $cod_gasto_operacional ?>&cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>"><img src="../imagenes/eliminar.png"></a></td>
    <td style="text-align:center"><input type="text" name="puc_gasto_operacional[]" class="puc_gasto_operacional" id="<?php echo $cod_gasto_operacional ?>" value="<?php echo $puc_gasto_operacional ?>" size="6" required></td>
    <td style="text-align:center"><input type="text" name="nombre_gasto_operacional[]" class="nombre_gasto_operacional_<?php echo $cod_gasto_operacional ?>" id="<?php echo $cod_gasto_operacional ?>" value="<?php echo $nombre_gasto_operacional ?>" size="60" required></td>
    <td style="text-align:center"><input type="text" name="costo_gasto_operacional[]" class="costo_gasto_operacional" id="<?php echo $cod_gasto_operacional ?>" value="<?php echo $costo_gasto_operacional ?>" onChange="calc_total_gasto_operacional();" size="20" required></td>
    <td style="text-align:center"></td>
  </tr>
<?php } ?>
<?php 
$total_resultado_operacional     = $total_utilidad_bruta - $total_gasto_operacional;
$total_resultado_antes_impuesto  = $total_resultado_operacional;
$total_resultado_ejercicio       = $total_resultado_operacional;
?>
  <tr>
<td></td>
    <td style="text-align:center"><a href="../admin/reg_campos_nuevos_pyg_reg.php?cod_pyg=<?php echo $cod_pyg ?>&fecha_mes=<?php echo $fecha_mes ?>&campo=gasto_operacional"><img src="../imagenes/mas.png"></a></td>
    <td>TOTAL GASTOS OPERACIONALES</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_gasto_operacional" class="total_gasto_operacional" id="total_gasto_operacional" value="<?php echo $total_gasto_operacional ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>RESULTADO OPERACIONAL</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_resultado_operacional" class="total_resultado_operacional" id="total_resultado_operacional" value="<?php echo $total_resultado_operacional ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>RESULTADO ANTES DE IMPUESTOS</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_resultado_antes_impuesto" class="total_resultado_antes_impuesto" id="total_resultado_antes_impuesto" value="<?php echo $total_resultado_antes_impuesto ?>" size="20" required></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>RESULTADOS DEL EJERCICIO</td>
    <td></td>
    <td></td>
    <td style="text-align:center"><input type="text" name="total_resultado_ejercicio" class="total_resultado_ejercicio" id="total_resultado_ejercicio" value="<?php echo $total_resultado_ejercicio ?>" size="20" required></td>
  </tr>
</table>

<hr>
<input type="hidden" name="cod_pyg" value="<?php echo $cod_pyg ?>">
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
$(".puc_ingre_operacional").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=ACTIVO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_ingre_operacional_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_ingre_operacional_'+id).val();

          $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
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
$(".puc_costo_operacional").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=COSTOS DE VENTAS",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_costo_operacional_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_costo_operacional_'+id).val();

          $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST", 
                data:{id:id, valor:valor, campo:campo, codigo_puc:codigo_puc, nombre_puc:nombre_puc, jqui:jqui},  
                success:function(data){  
                     $('#result').html(data);
                     console.log("puc_costo_operacional");

                }  
           });
}

});
});
</script>



<script type="text/javascript">
$(function() {
$(".puc_gasto_operacional").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=GASTOS",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#'+id).val(ui.item.codigo_puc);
$('.nombre_gasto_operacional_'+id).val(ui.item.nombre_puc);

var codigo_puc = $('#'+id).val();
var nombre_puc = $('.nombre_gasto_operacional_'+id).val();

          $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
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
 $(document).ready(function(){  

        $('input[name="nombre_ingre_operacional[]"]').focusout(function(){  
           var valor = $(this).val();
           var codigo_puc = 0;
           var nombre_puc = 0;
           var jqui = 0;
           var campo = 'nombre_ingre_operacional';
           let id = this.id;
           console.log("id - "+id);
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST", 
                data:{id:id, valor:valor, campo:campo, codigo_puc:codigo_puc, nombre_puc:nombre_puc, jqui:jqui},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[class="costo_ingre_operacional[]"]').focusout(function(){  
           var costo_ingre_operacional = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_ingre_operacional, campo:"costo_ingre_operacional", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


        $('input[class="nombre_costo_operacional[]"]').focusout(function(){  
           var nombre_costo_operacional = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_costo_operacional, campo:"nombre_costo_operacional", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        $('input[class="costo_costo_operacional[]"]').focusout(function(){  
           var costo_costo_operacional = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_costo_operacional, campo:"costo_costo_operacional", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[id="total_activo"]').focusout(function(){  
           var total_activo = $(this).val();  
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_activo, campo:"total_activo", id:<?php echo $cod_pyg; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[class="nombre_gasto_operacional[]"]').focusout(function(){  
           var nombre_gasto_operacional = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_gasto_operacional, campo:"nombre_gasto_operacional", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[class="costo_gasto_operacional[]"]').focusout(function(){  
           var costo_gasto_operacional = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_gasto_operacional, campo:"costo_gasto_operacional", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

        $('input[id="total_pasivo"]').focusout(function(){  
           var total_pasivo = $(this).val();  
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:total_pasivo, campo:"total_pasivo", id:<?php echo $cod_pyg; ?>},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });


        $('input[class="nombre_patrimonio[]"]').focusout(function(){  
           var nombre_patrimonio = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:nombre_patrimonio, campo:"nombre_patrimonio", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });
        
        $('input[class="costo_patrimonio[]"]').focusout(function(){  
           var costo_patrimonio = $(this).val();
           let id = this.id;
           $.ajax({  
                url:"guardar_pyg_radio_button_ajax.php",  
                method:"POST",  
                data:{valor:costo_patrimonio, campo:"costo_patrimonio", id:id},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      });

 });  
 </script>

<script>
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_ingre_operacional(){
total_ingre_operacional         = 0;
total_costo_operacional         = 0;
total_utilidad_bruta            = 0;
total_resultado_operacional     = 0;
total_resultado_antes_impuesto  = 0;
total_resultado_ejercicio       = 0;

$("input[class='costo_ingre_operacional']").each(function() {
total_ingre_operacional += parseFloat(this.value);
});

$("input[class='costo_costo_operacional']").each(function() {
total_costo_operacional += parseFloat(this.value);
});

$("input[class='costo_gasto_operacional']").each(function() {
total_gasto_operacional += parseFloat(this.value);
});

total_utilidad_bruta            = total_ingre_operacional - total_costo_operacional;
total_resultado_operacional     = total_utilidad_bruta - total_gasto_operacional;
total_resultado_antes_impuesto  = total_resultado_operacional;
total_resultado_ejercicio       = total_resultado_operacional;
document.getElementById("total_ingre_operacional").value = total_ingre_operacional;
document.getElementById("total_utilidad_bruta").value = total_utilidad_bruta;
document.getElementById("total_resultado_operacional").value = total_resultado_operacional;
document.getElementById("total_resultado_antes_impuesto").value = total_resultado_antes_impuesto;
document.getElementById("total_resultado_ejercicio").value = total_resultado_ejercicio;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_costo_operacional(){
total_costo_operacional         = 0;
total_ingre_operacional         = 0;
total_utilidad_bruta            = 0;
total_resultado_operacional     = 0;
total_resultado_antes_impuesto  = 0;
total_resultado_ejercicio       = 0;

$("input[class='costo_costo_operacional']").each(function() {
total_costo_operacional += parseFloat(this.value);
});

$("input[class='costo_ingre_operacional']").each(function() {
total_ingre_operacional += parseFloat(this.value);
});

$("input[class='costo_gasto_operacional']").each(function() {
total_gasto_operacional += parseFloat(this.value);
});

total_utilidad_bruta            = total_ingre_operacional - total_costo_operacional;
total_resultado_operacional     = total_utilidad_bruta - total_gasto_operacional;
total_resultado_antes_impuesto  = total_resultado_operacional;
total_resultado_ejercicio       = total_resultado_operacional;
document.getElementById("total_costo_operacional").value = total_costo_operacional;
document.getElementById("total_utilidad_bruta").value = total_utilidad_bruta;
document.getElementById("total_resultado_operacional").value = total_resultado_operacional;
document.getElementById("total_resultado_antes_impuesto").value = total_resultado_antes_impuesto;
document.getElementById("total_resultado_ejercicio").value = total_resultado_ejercicio;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
function calc_total_gasto_operacional(){
total_gasto_operacional         = 0;
total_ingre_operacional         = 0;
total_costo_operacional         = 0;
total_utilidad_bruta            = 0;
total_resultado_operacional     = 0;
total_resultado_antes_impuesto  = 0;
total_resultado_ejercicio       = 0;

$("input[class='costo_gasto_operacional']").each(function() {
total_gasto_operacional += parseFloat(this.value);
});

$("input[class='costo_costo_operacional']").each(function() {
total_costo_operacional += parseFloat(this.value);
});

$("input[class='costo_ingre_operacional']").each(function() {
total_ingre_operacional += parseFloat(this.value);
});

total_utilidad_bruta            = total_ingre_operacional - total_costo_operacional;
total_resultado_operacional     = total_utilidad_bruta - total_gasto_operacional;
total_resultado_antes_impuesto  = total_resultado_operacional;
total_resultado_ejercicio       = total_resultado_operacional;
document.getElementById("total_gasto_operacional").value = total_gasto_operacional;
document.getElementById("total_resultado_operacional").value = total_resultado_operacional;
document.getElementById("total_resultado_antes_impuesto").value = total_resultado_antes_impuesto;
document.getElementById("total_resultado_ejercicio").value = total_resultado_ejercicio;
}
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* //////////////////////////////////////////////////////////////////////////////////////////////////////// */
</script>