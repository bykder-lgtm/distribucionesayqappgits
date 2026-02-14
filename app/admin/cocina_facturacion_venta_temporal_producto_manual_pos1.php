<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
<script type="text/javascript" src="js/jquery.number.js"></script>
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);
$pagina                            = $_GET['pagina'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_caja_virtual_cocina.php?pagina=<?php echo $pagina ?>"><?php echo $nombre_concepto_multi_virtual; ?>S PEDIDOS</a></strong></td>
    </tr></tbody>
</table>
<br>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/cocina_info_factura_venta_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_vacio.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<div id="refrescar_automatico_ajax" class="table-responsive">
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<td style="text-align:center;"></td>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
<th style="text-align:center;">FECHA - HORA</th>
<!--
<th style="text-align:center;">VALOR UNITARIO</th>
<td align="center"></td>
<th style="text-align:center;">VALOR TOTAL</th>
-->
<td style="text-align:center;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
$cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
$cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
$cedula                            = $datos_venta_producto_temporal['cedula'];
$nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
$und_venta                         = $datos_venta_producto_temporal['und_venta'];
$precio_costo_producto             = $datos_venta_producto_temporal['precio_costo_producto'];
$precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
$total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
$nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                    = $datos_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion          = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_venta_producto_temporal['cod_tipo_cobrar'];
//$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta'];
$nombre_tipo_precio_venta          = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta         = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
$und_producto                      = $datos_venta_producto_temporal['und_producto'];

$comentario_producto               = $datos_venta_producto_temporal['comentario_producto'];
$placa_producto                    = $datos_venta_producto_temporal['placa_producto'];
$fecha_ymd_parqueo_ini             = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini            = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin             = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin            = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];

$fecha_seg_venta_producto          = date("Y-m-d H:i:s", $datos_venta_producto_temporal['fecha_seg_venta_producto']);

    
if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$und_producto; } else { $max_und_venta = ""; }
if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<td style="text-align:center;"></td>
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $und_venta ?></td>
<td style="text-align:center;" id="comentario_producto_<?php echo $incre;?>"><?php echo $comentario_producto;?></td>
<td style="text-align:center;" id="fecha_seg_venta_producto_<?php echo $incre;?>"><?php echo $fecha_seg_venta_producto;?></td>
<!--
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
<td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>
<td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
-->
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<?php } ?>
</tbody>
</table>

<?php } else { } ?>

</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
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

<script language="javascript">
setInterval("refrescar_pagina_ajax()",5000);

function refrescar_pagina_ajax(){

	var nombre_estado_factura = 'ABIERTA';
	var cod_estado_cocina = '0';
	var tipo_ajax = 'refrescar';
	var cod_info_factura_venta = <?php echo $cod_info_factura_venta;?>;

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/refrescar_pagina_cocina_facturacion_venta_temporal_producto_manual_pos_ajax.php",
        data: "nombre_estado_factura="+nombre_estado_factura+"&cod_estado_cocina="+cod_estado_cocina+"&cod_info_factura_venta="+cod_info_factura_venta+"&tipo_ajax="+tipo_ajax,
        success: function(resp){
            $('#refrescar_automatico_ajax').html(resp);
        }
    })
//console.log("refresco div")
}
</script>