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
$cod_info_factura_compra           = intval($_GET['cod_info_factura_compra']);
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$pagina_redirect                   = '../admin/lista_info_factura_compra.php';

$tab                               = 'tbl15_factura_compra_producto';
$campo                             = 'cod_factura_compra_producto';
$tipo                              = 'eliminar';
$tab2                              = 'tbl15_venta_producto_eliminar_sin_devolucion';
$tab3                              = 'tbl15_factura_compra_producto';
$campo3                            = 'cod_factura_compra_producto';

$incre                             = 0;
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

$datos_factura = "SELECT cod_factura_compra_producto FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_cotizacion_compra.php">LISTA DE COTIZACIONES COMPRA</a></strong></td>
    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Cotizacion Compra Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
-->
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_ver_factura_compra_cambiar_fecha_vencimiento.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<td style="text-align:center;"></td>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">T.UND</th>

<?php for ($i=1; $i <= 1; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center">F.VENCIMIENTO</th>
<!--<th style="text-align:center">LOTE</th>-->
<?php } ?>

<th style="text-align:center;">ID</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra') 
ORDER BY cod_factura_compra_producto DESC";
$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

$cod_factura_compra_producto                   = $datos_factura_compra_producto['cod_factura_compra_producto'];
$cod_producto                                  = $datos_factura_compra_producto['cod_producto'];
$cod_producto_barra                            = $datos_factura_compra_producto['cod_producto_barra'];
$nombre_producto                               = $datos_factura_compra_producto['nombre_producto'];
$cedula                                        = $datos_factura_compra_producto['cedula'];
$nombre_cliente                                = $datos_factura_compra_producto['nombre_cliente'];
$und_compra                                    = $datos_factura_compra_producto['und_compra'];
$und_unidades                                  = $datos_factura_compra_producto['und_unidades'];
$und_caja                                      = $datos_factura_compra_producto['und_caja'];
$precio_costo_producto                         = $datos_factura_compra_producto['precio_costo_producto'];
$precio_compra_producto                        = $datos_factura_compra_producto['precio_compra_producto'];
$total_costo_producto                          = $datos_factura_compra_producto['total_costo_producto'];
$total_compra_producto                         = $datos_factura_compra_producto['total_compra_producto'];
$precio_venta_producto                         = $datos_factura_compra_producto['precio_venta_producto'];
$precio_venta_producto2                        = $datos_factura_compra_producto['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_factura_compra_producto['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_factura_compra_producto['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_factura_compra_producto['precio_venta_producto5'];
$iva_ptj                                       = $datos_factura_compra_producto['iva_ptj'];
$dto1                                          = $datos_factura_compra_producto['dto1'];
$dto2                                          = $datos_factura_compra_producto['dto2'];
$precio_ipc                                    = $datos_factura_compra_producto['precio_ipc'];
$precio_venta_producto                         = $datos_factura_compra_producto['precio_venta_producto'];
$total_venta_producto                          = $datos_factura_compra_producto['total_venta_producto'];
$nombre_tipo_producto                          = $datos_factura_compra_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_factura_compra_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_factura_compra_producto['posologia_cantidad'];
$posologia_peso                                = $datos_factura_compra_producto['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_factura_compra_producto['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_factura_compra_producto['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_factura_compra_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_factura_compra_producto['cod_tipo_cobrar'];
$cod_info_factura_compra                       = $datos_factura_compra_producto['cod_info_factura_compra'];
$nombre_tipo_precio_venta                      = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_factura_compra_producto['cod_estado_permitir_venta'];
$und_producto                                  = $datos_factura_compra_producto['und_producto'];
$cajas_sobre                                   = $datos_factura_compra_producto['cajas_sobre'];
$fecha_vencimiento                             = $datos_factura_compra_producto['fecha_vencimiento'];
$lote_vencimiento                              = $datos_factura_compra_producto['lote_vencimiento'];

if ($cajas_sobre > '1') {
$total_cajas                                   = intval($und_compra / $cajas_sobre);
$total_fraccion                                = $und_compra - ($total_cajas * $cajas_sobre);
$total_caja_fraccion                           = $total_cajas.'|'.$total_fraccion;
} else {
$total_cajas                                   = '';
$total_fraccion                                = '';
$total_caja_fraccion                           = '';
}

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($precio_compra_producto == '0') { $precio_compra_producto = 1; } else { $precio_compra_producto = $precio_compra_producto; }
$resta_ganancia                                = $precio_venta_producto - $precio_compra_producto;
$ptj_ganancia                                  = ($resta_ganancia / $precio_compra_producto) * 100;

$incre++;
?>
<tr>
<td style="text-align:center;"></td>
<td style="text-align:left;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"><?php echo $und_compra;?></td>

<?php for ($i=1; $i <= 1; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center;"><?php echo number_format($precio_ventas, 0, ",", ".");?></td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center;"><input name="fecha_vencimiento" type="date" id="<?php echo $cod_factura_compra_producto;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $fecha_vencimiento;?>" style="width: 130px;" /></td>
<!--<td style="text-align:center;"><input name="lote_vencimiento" type="text" id="<?php echo $cod_factura_compra_producto;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $lote_vencimiento;?>" style="width: 50px;" /></td>-->
<?php } ?>

<td style="text-align:center;"><?php echo $cod_factura_compra_producto;?></td>
<td style="text-align:center;"></td>
</tr style="text-align:right;" id="tr<?php echo $cod_factura_compra_producto;?>">
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_factura_compra_producto";
            var id = $(this).attr("id");
            //let id = this.id;
            $.post("edit_fecha_vencimiento_factura_compra_historial_vencimiento_ajax_reg.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>