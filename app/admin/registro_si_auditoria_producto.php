<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_auditoria_resultado_comentario_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
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
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_factura_auditoria_producto';
$campo                             = 'cod_factura_auditoria_producto';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = "POS";
$cod_estado_vacuna                 = "0";
$nombre_tipo_cargue_factura        = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['cod_info_factura_auditoria'])) { $cod_info_factura_auditoria = intval($_GET['cod_info_factura_auditoria']); } else { $cod_info_factura_auditoria = 0; }
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_factura_auditoria_producto FROM tbl15_factura_auditoria_producto WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_auditoria.php">LISTA DE AUDITORIAS</a></strong></td>
    </tr></tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_auditoria_final_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero_auditoria.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
                        
<th style="text-align:center;"></th>
<?php if ($cod_estado_prod_auditoria_eliminar == '1') { ?>
<th style="text-align:center;">ELM</th>
<?php } ?>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">UND SISTEMA</th>
<th style="text-align:center;">CUENTA</th>
<th style="text-align:center;">FECHA</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_factura_auditoria_producto = "SELECT * FROM tbl15_factura_auditoria_producto WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria') 
ORDER BY cod_factura_auditoria_producto DESC";
$consulta_factura_auditoria_producto = mysqli_query($conectar, $sql_factura_auditoria_producto);
while ($datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto)) {

$cod_factura_auditoria_producto                = $datos_factura_auditoria_producto['cod_factura_auditoria_producto'];
$cod_producto                                  = $datos_factura_auditoria_producto['cod_producto'];
$cod_producto_barra                            = $datos_factura_auditoria_producto['cod_producto_barra'];
$nombre_producto                               = $datos_factura_auditoria_producto['nombre_producto'];
$cedula                                        = $datos_factura_auditoria_producto['cedula'];
$nombre_cliente                                = $datos_factura_auditoria_producto['nombre_cliente'];
$und_compra                                    = $datos_factura_auditoria_producto['und_compra'];
$und_unidades                                  = $datos_factura_auditoria_producto['und_unidades'];
$und_caja                                      = $datos_factura_auditoria_producto['und_caja'];
$precio_costo_producto                         = $datos_factura_auditoria_producto['precio_costo_producto'];
$precio_compra_producto                        = $datos_factura_auditoria_producto['precio_compra_producto'];
$precio_compra_producto                        = $datos_factura_auditoria_producto['precio_compra_producto'];
$total_costo_producto                          = $datos_factura_auditoria_producto['total_costo_producto'];
$total_compra_producto                         = $datos_factura_auditoria_producto['total_compra_producto'];
$precio_venta_producto                         = $datos_factura_auditoria_producto['precio_venta_producto'];
$precio_venta_producto2                        = $datos_factura_auditoria_producto['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_factura_auditoria_producto['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_factura_auditoria_producto['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_factura_auditoria_producto['precio_venta_producto5'];
$iva_ptj                                       = $datos_factura_auditoria_producto['iva_ptj'];
$dto1                                          = $datos_factura_auditoria_producto['dto1'];
$dto2                                          = $datos_factura_auditoria_producto['dto2'];
$precio_ipc                                    = $datos_factura_auditoria_producto['precio_ipc'];
$total_venta_producto                          = $datos_factura_auditoria_producto['total_venta_producto'];
$nombre_tipo_producto                          = $datos_factura_auditoria_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_factura_auditoria_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_factura_auditoria_producto['posologia_cantidad'];
$posologia_peso                                = $datos_factura_auditoria_producto['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_factura_auditoria_producto['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_factura_auditoria_producto['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_factura_auditoria_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_factura_auditoria_producto['cod_tipo_cobrar'];
$nombre_tipo_precio_venta                      = $datos_factura_auditoria_producto['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_factura_auditoria_producto['cod_estado_permitir_venta'];
$fecha_vencimiento                             = $datos_factura_auditoria_producto['fecha_vencimiento'];
$lote_vencimiento                              = $datos_factura_auditoria_producto['lote_vencimiento'];
$comision_ptj                                  = $datos_factura_auditoria_producto['comision_ptj'];
$nombre_tipo_unidad_medida                     = $datos_factura_auditoria_producto['nombre_tipo_unidad_medida'];
$ganancia_ptj                                  = $datos_factura_auditoria_producto['ganancia_ptj'];
$fecha_mantenimiento                           = $datos_factura_auditoria_producto['fecha_mantenimiento'];
$corregir_inventario                           = $datos_factura_auditoria_producto['corregir_inventario'];
$und_producto                                  = $datos_factura_auditoria_producto['und_producto'];
$comentario                                    = $datos_factura_auditoria_producto['comentario'];
$fecha_modificacion                            = $datos_factura_auditoria_producto['fecha_modificacion'];
$cuenta                                        = $datos_factura_auditoria_producto['cuenta'];
$resta                                         = $und_producto - $und_compra;

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($resta < 0) {
$mensaje = "UNDS SOBRAN";
$dato_mostrar = $resta * -1;
$estado = "sobran";
$imagen = "../imagenes/borrar.gif";
$url = "../admin/factura_auditoria_producto_accion_resultado_reg.php?cod_factura_auditoria_producto=".$cod_factura_auditoria_producto."&cod_info_factura_auditoria=".$cod_info_factura_auditoria."&estado=".$estado."&pagina=".$pagina;
$url_redirect = "<a href=".$url."><img src=".$imagen."></a>";
} elseif ($resta > 0) {
$mensaje = "UNDS FALTAN";
$dato_mostrar = $resta;
$estado = "faltan";
$imagen = "../imagenes/auxilio.gif";
$url = "../admin/factura_auditoria_producto_accion_resultado_reg.php?cod_factura_auditoria_producto=".$cod_factura_auditoria_producto."&cod_info_factura_auditoria=".$cod_info_factura_auditoria."&estado=".$estado."&pagina=".$pagina;
$url_redirect = "<a href=".$url."><img src=".$imagen."></a>";
} else {
$mensaje = "BIEN";
$dato_mostrar = '0';
$estado = "bien";
$imagen = "../imagenes/bien.png";
$url = "../admin/factura_auditoria_producto_accion_resultado_reg.php?cod_factura_auditoria_producto=".$cod_factura_auditoria_producto."&cod_info_factura_auditoria=".$cod_info_factura_auditoria."&estado=".$estado."&pagina=".$pagina;
$url_redirect = "<a href=".$url."><img src=".$imagen."></a>";
}

$incre++;
?>
<tr>
<td style="text-align:center;"></td>
<?php if ($cod_estado_prod_auditoria_eliminar == '1') { ?>
<td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_factura_auditoria_producto?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<td style="text-align:left;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>
<td style="text-align:center;"><?php echo $und_producto ?></td>
<td style="text-align:center;"><?php echo $cuenta ?></td>
<td style="text-align:center;"><?php echo $fecha_modificacion ?></td>
<td style="text-align:center;"></td>
</tr>
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

</body>
</html>