<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script src="js/jquery.js" type="text/javascript"></script> 
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
$incre                             = 0;
$tab                               = 'tbl15_factura_compra_producto';
$campo                             = 'cod_factura_compra_producto';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '0';

$suma_temporal = "SELECT Sum(total_compra_producto) As total_compra FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_compra                = $matriz_temporal['total_compra'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_compra                  = $data_info_factura['cod_info_factura_compra'];
$cod_factura                              = $data_info_factura['cod_factura'];
$cod_tercero                              = $data_info_factura['cod_tercero'];
$cod_caja_virtual                         = $data_info_factura['cod_caja_virtual'];
$nombre_estado_factura                    = $data_info_factura['nombre_estado_factura'];
$nombre_tipo_cargue_factura               = $data_info_factura['nombre_tipo_cargue_factura'];
$nombre_tipo_compra                       = $data_info_factura['nombre_tipo_compra'];
$cod_empresa                              = $data_info_factura['cod_empresa'];
$nombre_empresa                           = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                      = $data_info_factura['razonsocial_empresa'];
$total_muestra                            = $data_info_factura['total_muestra'];
$fecha_ymdhis                             = $data_info_factura['fecha_ymdhis'];
$cuenta                                   = $data_info_factura['cuenta'];
$cod_estado_factura                       = $data_info_factura['cod_estado_factura'];
$cod_base_caja                            = $data_info_factura['cod_base_caja'];
$descuento_ptj                            = $data_info_factura['descuento_ptj'];
$iva_ptj                                  = $data_info_factura['iva_ptj'];
$flete_ptj                                = $data_info_factura['flete_ptj'];
$subtotal                                 = $data_info_factura['subtotal'];
$valor_iva                                = $data_info_factura['valor_iva'];
$cod_cliente                              = $data_info_factura['cod_cliente'];
$vlr_cancelado                            = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                               = $data_info_factura['vlr_vuelto'];
$fecha_dia                                = $data_info_factura['fecha_dia'];
$fecha_mes                                = $data_info_factura['fecha_mes'];
$fecha_anyo                               = $data_info_factura['fecha_anyo'];
$anyo                                     = $data_info_factura['anyo'];
$fecha_hora                               = $data_info_factura['fecha_hora'];
$fecha_remision                           = $data_info_factura['fecha_remision'];
$nombre_ccosto                            = $data_info_factura['nombre_ccosto'];
$garantia_meses                           = $data_info_factura['garantia_meses'];
$observacion                              = $data_info_factura['observacion'];
$cod_tipo_pago                            = $data_info_factura['cod_tipo_pago'];
$cod_administrador                        = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                     = $data_info_factura['nombre_tipo_producto'];
$total_precio_costo                       = $data_info_factura['total_precio_costo'];
$total_precio_compra                      = $data_info_factura['total_precio_compra'];
$total_precio_venta                       = $data_info_factura['total_precio_venta'];
$cod_dependencia                          = $data_info_factura['cod_dependencia'];
$servicio                                 = $data_info_factura['servicio'];
$cod_tipo_forma_pago                      = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                   = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago              = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                      = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                       = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                          = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                           = $data_info_factura['fecha_creacion'];
$fecha_modificacion                       = $data_info_factura['fecha_modificacion'];
$nombre_maquina                           = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                          = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                        = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion               = $data_info_factura['cod_resolucion_facturacion'];
$total_datos_data                         = $data_info_factura['total_datos_data'];
$tiempo_ejecucion                         = $data_info_factura['tiempo_ejecucion'];
$ipc_ptj                                  = $data_info_factura['ipc_ptj'];
$precio_ipc                               = $data_info_factura['precio_ipc'];
$precio_ipc_total                         = $data_info_factura['precio_ipc_total'];
$ret_ica_ptj                              = $data_info_factura['ret_ica_ptj'];
$total_ret_ica                            = $data_info_factura['total_ret_ica'];
$iva_teorico_ptj                          = $data_info_factura['iva_teorico_ptj'];
$total_iva_teorico                        = $data_info_factura['total_iva_teorico'];
$tarifa_rete_vigente_ptj                  = $data_info_factura['tarifa_rete_vigente_ptj'];
$total_tarifa_rete_vigente                = $data_info_factura['total_tarifa_rete_vigente'];
$rete_iva_asumido_ptj                     = $data_info_factura['rete_iva_asumido_ptj'];
$total_rete_iva_asumido                   = $data_info_factura['total_rete_iva_asumido'];
$iva_19                                   = $data_info_factura['iva_19'];
$iva_5                                    = $data_info_factura['iva_5'];
$nombre_rete_fuente_ptj                   = $data_info_factura['nombre_rete_fuente_ptj'];
$total_compra_imp                         = $data_info_factura['total_compra_imp'];
$total_precio_ipc                         = $data_info_factura['total_precio_ipc'];
$total_descuento                          = $data_info_factura['total_descuento'];
$total_rete_fuente                        = $data_info_factura['total_rete_fuente'];
$total_factura_compra_retefuente          = $data_info_factura['total_factura_compra_retefuente'];
$total_factura_compra                     = $data_info_factura['total_factura_compra'];
$cod_doc_soporte                          = $data_info_factura['cod_doc_soporte'];
$total_inv_precio_costo                   = $data_info_factura['total_inv_precio_costo'];
$total_inv_precio_compra                  = $data_info_factura['total_inv_precio_compra'];
$total_inv_precio_venta                   = $data_info_factura['total_inv_precio_venta'];
$total_compra_precio_costo                = $data_info_factura['total_compra_precio_costo'];
$total_compra_precio_compra               = $data_info_factura['total_compra_precio_compra'];
$total_compra_precio_venta                = $data_info_factura['total_compra_precio_venta'];
$total_inv_compra_desp_factura            = $data_info_factura['total_inv_compra_desp_factura'];
$cod_estado                               = $data_info_factura['cod_estado'];
$subtotal_total_precio_compra             = $data_info_factura['subtotal_total_precio_compra'];
$subtotal_total_precio_costo              = $data_info_factura['subtotal_total_precio_costo'];
$cod_tipo_inventario                      = $data_info_factura['cod_tipo_inventario'];
$fecha_entrega                            = $data_info_factura['fecha_entrega'];

//if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
//if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_factura_compra_producto FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">
<!--
<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>

<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar = document.getElementById('busqueda').value;
var pagina = document.getElementById('pagina').value;
var nombre_tipo_moneda = "COP";
var nombre_tipo_factura = "POS";
var cod_estado_vacuna = "0";
var nombre_tipo_cargue_factura = "FACTURA_COMPRA_NORMAL";
var buscar_por= $("#buscar_por").val();

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_compra_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&nombre_tipo_cargue_factura="+nombre_tipo_cargue_factura+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>
-->
<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_compra.php">LISTA DE COMPRA</a></strong></td>
    </tr></tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="#">EDICION DE FACTURA DE COMPRA E INVENTARIO</a></strong></td>
    </tr></tbody>
</table>
<br>
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
                <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
                <strong>Compra Manual: [<?php echo $cod_caja_virtual ?>]<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
-->
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/edit_info_factura_compra_pos_e_inventario.php'); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<th style="text-align:center;"></th>
<!--<th style="text-align:center;">ELM</th>
<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<?php if ($cod_estado_compra_caja_global == '1') { ?>
<th style="text-align:center;">PRESENTACION <br> (U.PQ)</th>
<th style="text-align:center;">X</th>
<th style="text-align:center;">UND</th>
<?php } ?>

<th style="text-align:center;">T.UND</th>
<th style="text-align:center;">P.COMPRA+IVA</th>
<?php if ($cod_estado_dto1_global == '1') { ?>
<th style="text-align:center;">%DTO1</th>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<th style="text-align:center;">%DTO2</th>
<?php } ?>
<th style="text-align:center;">%IVA</th>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<th style="text-align:center;">%COMISION</th>
<?php } ?>
<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<th style="text-align:center;">IMPOCONSUMO</th>
<?php } ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
<?php } ?>
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center">VENCIMIENTO</th>
<th style="text-align:center">LOTE</th>
<?php } ?>
<th style="text-align:center;">VALOR COMPRA</th>
<th style="text-align:center;">OK</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra') ORDER BY cod_factura_compra_producto DESC";
$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

$cod_factura_compra_producto                  = $datos_factura_compra_producto['cod_factura_compra_producto'];
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
$nombre_tipo_precio_venta                      = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_factura_compra_producto['cod_estado_permitir_venta'];
$fecha_vencimiento                             = $datos_factura_compra_producto['fecha_vencimiento'];
$lote_vencimiento                              = $datos_factura_compra_producto['lote_vencimiento'];
$comision_ptj                                  = $datos_factura_compra_producto['comision_ptj'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_factura_compra_producto;?>">
<th style="text-align:center;"></th>
<!--<td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_factura_compra_producto?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" ><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"><?php echo $nombre_producto ?></td>

<?php if ($cod_estado_compra_caja_global == '1') { ?>
<td style="text-align:center;"><input name="und_unidades" type="number" id="und_unidades<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_unidades;?>" style="width: 40px;" /></td>
<td style="text-align:center;">X</td>
<td style="text-align:center;"><input name="und_caja" type="number" id="und_caja<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_caja;?>" style="width: 40px;" /></td>
<?php } ?>

<td style="text-align:center;"><input name="und_compra" type="number" id="und_compra<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $und_compra;?>" style="width: 60px;" /></td>
<td style="text-align:center;"><input name="precio_compra_producto" type="text" id="precio_compra_producto<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" onChange="calc_total_compra();" value="<?php echo $precio_compra_producto;?>" style="width: 100px;" /></td>

<?php if ($cod_estado_dto1_global == '1') { ?>
<td style="text-align:center;"><input name="dto1" type="number" id="dto1<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $dto1;?>" style="width: 40px;" /></td>
<?php } ?>
<?php if ($cod_estado_dto2_global == '1') { ?>
<td style="text-align:center;"><input name="dto2" type="number" id="dto2<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $dto2;?>" style="width: 40px;" /></td>
<?php } ?>

<td style="text-align:center;"><input name="iva_ptj" type="number" id="iva_ptj<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $iva_ptj;?>" style="width: 40px;" /></td>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<td style="text-align:center;"><input name="comision_ptj" type="number" id="comision_ptj<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $comision_ptj;?>" style="width: 40px;" /></td>
<?php } ?>

<?php if ($cod_estado_impoconsumo_global == '1') { ?>
<td style="text-align:center;"><input name="precio_ipc" type="number" id="precio_ipc<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $precio_ipc;?>" style="width: 100px;" /></td>
<?php } ?>
<?php for ($i=1; $i <= $numero_precio; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center;"><input name="precio_venta_producto<?php echo $contador; ?>" type="number" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $precio_ventas;?>" style="width: 100px;" /></td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center;"><input name="fecha_vencimiento" type="date" id="fecha_vencimiento<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $fecha_vencimiento;?>" style="width: 130px;" /></td>
<td style="text-align:center;"><input name="lote_vencimiento" type="text" id="lote_vencimiento<?php echo $incre;?>" class="<?php echo $cod_factura_compra_producto;?>" value="<?php echo $lote_vencimiento;?>" style="width: 50px;" /></td>
<?php } ?>
<td style="text-align:right;" id="total_compra_producto<?php echo $incre;?>"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>
<th style="text-align:center;"></th>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!--
<script type="text/javascript">
$(document).ready(function() {
    var cod_tipo_cobrar = $('#cod_tipo_cobrar').val();
    if (cod_tipo_cobrar=='1') { $('#cod_tipo_cobrar').val('1'); $('#cod_tipo_cobrar').prop('checked',true); } else { $('#cod_tipo_cobrar').val('0'); $('#cod_tipo_cobrar').prop('checked',false); } 
    $(".cod_tipo_cobrar").change(function(){ if( $(this).is(':checked') ){ $(".cod_tipo_cobrar").val("1"); } else { $(".cod_tipo_cobrar").val("0"); } });
});
</script>
-->
<script>
function calc_total_compra(){

var i=0;
var incre = <?php echo $total_datos;?>;
var und_compra_text = "";
var precio_compra_producto_text = "";
var total_compra_producto_text = "";
var total_compra = 0;
var und_compra = 0;
var precio_compra_producto = 0;
var total_compra_producto = 0;
var smtr_total_compra = 0;
var Max_Length = 4;
var length = 0;

for (i=1; i<=incre; i++){

und_compra_text = "und_compra"+i;
precio_compra_producto_text = "precio_compra_producto"+i;
total_compra_producto_text = "total_compra_producto"+i;
//mensaje_alerta_text = "mensaje_alerta"+i;

//mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
und_compra = document.getElementById(und_compra_text).value;
precio_compra_producto = document.getElementById(precio_compra_producto_text).value;
total_compra_producto = (und_compra * precio_compra_producto);
smtr_total_compra = smtr_total_compra + total_compra_producto;

console.log(total_compra_producto);

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
length = document.getElementById(und_compra_text).value.length;
if (length > Max_Length) {
//var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
//objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
//  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
console.log(length);
} else {  }
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

document.getElementById(total_compra_producto_text).innerHTML=total_compra_producto.toLocaleString("es-ES");
}
total_compra = smtr_total_compra;
//document.getElementById("total_compra") = total_compra;
}
</script>

</body>
</html>