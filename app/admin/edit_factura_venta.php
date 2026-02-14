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
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);
$origen                            = 'PARACLINICOS';

$incre                             = 0;
$tab                               = 'tbl15_venta_producto';
$campo                             = 'cod_venta_producto';
$tipo                              = 'eliminar';
$tab2                              = 'tbl15_venta_producto_eliminar_sin_devolucion';
$tab3                              = 'tbl15_info_factura_venta';
$campo3                            = 'cod_info_factura_venta';
?>

<?php if ($cod_estado_agregar_productos_a_venta_facturada== '1') { ?>
<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar=document.getElementById('busqueda').value;
var pagina=document.getElementById('pagina').value;
var cod_info_factura_venta=document.getElementById('cod_info_factura_venta').value;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_venta_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_info_factura_venta="+cod_info_factura_venta+"&pagina="+pagina);
}
</script>
<?php } ?>

<div class="table-responsive">
<!-- ***************************************************************************************************************************** -->
<?php
$datos_factura = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                         = $matriz_temporal['total_venta'];
$total_peso_producto                 = $matriz_temporal['total_peso_producto'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta                                      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                                                 = $data_info_factura['cod_factura'];
$cod_tercero                                                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica                                        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                                                   = $data_info_factura['fecha_ini'];
$fecha_fin                                                   = $data_info_factura['fecha_fin'];
$cod_empresa                                                 = $data_info_factura['cod_empresa'];
$nombre_empresa                                              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
$total_motivo                                                = $data_info_factura['total_motivo'];
$total_muestra                                               = $data_info_factura['total_muestra'];
$fecha_ymdhis                                                = $data_info_factura['fecha_ymdhis'];
$cuenta                                                      = $data_info_factura['cuenta'];
$cod_estado_factura                                          = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                               = $data_info_factura['cod_base_caja'];
$descuento_ptj                                               = $data_info_factura['descuento_ptj'];
$iva_ptj                                                     = $data_info_factura['iva_ptj'];
$flete_ptj                                                   = $data_info_factura['flete_ptj'];
$cod_cliente                                                 = $data_info_factura['cod_cliente'];
$vlr_cancelado                                               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                                                   = $data_info_factura['fecha_dia'];
$fecha_mes                                                   = $data_info_factura['fecha_mes'];
$fecha_anyo                                                  = $data_info_factura['fecha_anyo'];
$anyo                                                        = $data_info_factura['anyo'];
$fecha_hora                                                  = $data_info_factura['fecha_hora'];
$fecha_remision                                              = $data_info_factura['fecha_remision'];
$nombre_ccosto                                               = $data_info_factura['nombre_ccosto'];
$garantia_meses                                              = $data_info_factura['garantia_meses'];
$observacion                                                 = $data_info_factura['observacion'];
$cod_tipo_pago                                               = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                         = $data_info_factura['total_precio_compra'];
$total_precio_venta                                          = $data_info_factura['total_precio_venta'];
$cod_dependencia                                             = $data_info_factura['cod_dependencia'];
$servicio                                                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                                      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                                 = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                              = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                          = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                                  = $data_info_factura['cod_resolucion_facturacion'];
$cod_cufe                                                    = $data_info_factura['cod_cufe'];
$observacion_tercero                                         = $data_info_factura['observacion_tercero'];
$cod_cuentas_cobrar                                          = $data_info_factura['cod_cuentas_cobrar'];
$fecha_entrega                                               = $data_info_factura['fecha_entrega'];
$url_img_orig_producto                                       = $data_info_factura['url_img_orig_producto'];
$tiempo_ejecucion                                            = $data_info_factura['tiempo_ejecucion'];
$tiempo_ejecucion_dian_dataico                               = $data_info_factura['tiempo_ejecucion_dian_dataico'];
$cod_estado_alquiler_renta                                   = $data_info_factura['cod_estado_alquiler_renta'];
$fecha_ini_renta_alquiler                                    = $data_info_factura['fecha_ini_renta_alquiler'];
$fecha_fin_renta_alquiler                                    = $data_info_factura['fecha_fin_renta_alquiler'];
$cod_domiciliario                                            = $data_info_factura['cod_domiciliario'];
$fecha_pago                                                  = $data_info_factura['fecha_pago'];

$sql_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$resultado_cuenta_cobrar = mysqli_query($conectar, $sql_cuenta_cobrar) or die(mysqli_error($conectar));
$existe_cuenta_cobrar = mysqli_num_rows($resultado_cuenta_cobrar);
$matriz_cuenta_cobrar = mysqli_fetch_assoc($resultado_cuenta_cobrar);

$monto_deuda                                                 = $matriz_cuenta_cobrar['monto_deuda'];
$subtotal                                                    = $matriz_cuenta_cobrar['subtotal'];
$abonado                                                     = $matriz_cuenta_cobrar['abonado'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                                                     = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                                                  = $matriz_cliente['identificacion_tercero'];
$direccion_cli                                               = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion                                  = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                                              = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }


$datos_info_cli = "SELECT * FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_info_cli = mysqli_query($conectar, $datos_info_cli);
$info_cli = mysqli_fetch_assoc($consulta_info_cli);

$razonsocial_empresa                                         = $info_cli['razonsocial_empresa'];
$direccion_empresa                                           = $info_cli['direccion_empresa'];
$telefono_empresa                                            = $info_cli['telefono_empresa'];
$nit_empresa                                                 = $info_cli['nit_empresa'];
$cod_tipo_facturacion                                        = $info_cli['cod_tipo_facturacion'];

$datos_info_admin = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_info_admin = mysqli_query($conectar, $datos_info_admin);
$info_admin = mysqli_fetch_assoc($consulta_info_admin);

$cuenta                                                      = $info_admin['cuenta'];

$nombre_modulo_puc                                           = "";

?>
<script src="../js/jquery-3.2.1.min.js"></script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_moneda").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_administrador";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_entrega").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_resolucion_facturacion").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_resolucion_facturacion";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#fecha_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#observacion_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($cod_estado_renta_alquiler_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        var cod_estado_alquiler_renta = $("#cod_estado_alquiler_renta").val();
        if (cod_estado_alquiler_renta == '1') {
            document.getElementById("fechas_alquiler").style.display = 'block';
        } else {
            document.getElementById("fechas_alquiler").style.display = 'none';
        }

        $("#cod_estado_alquiler_renta").on('change', function () {
                var valor = $(this).val();
                var cod_estado_alquiler_renta = $("#cod_estado_alquiler_renta").val();
                if (cod_estado_alquiler_renta == "1") {
                    document.getElementById("fechas_alquiler").style.display = 'block';
                } else {
                    document.getElementById("fechas_alquiler").style.display = 'none';
                }
                var campo = "cod_estado_alquiler_renta";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>

    <script language="javascript">
    $(document).ready(function(){
        $("#fecha_ini_renta_alquiler").on('change', function () {
                var valor = $(this).val();
                var campo = $(this).attr("name");
                var tipo_ajax = "tbl15_info_factura_venta";
                var id = $(this).attr("class");
                //let id = this.id;
                $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>

    <script language="javascript">
    $(document).ready(function(){
        $("#fecha_fin_renta_alquiler").on('change', function () {
                var valor = $(this).val();
                var campo = $(this).attr("name");
                var tipo_ajax = "tbl15_info_factura_venta";
                var id = $(this).attr("class");
                //let id = this.id;
                $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>
<?php } ?>

<?php if ($cod_estado_domiciliario_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_domiciliario").on('change', function () {
                var valor = $(this).val();
                var campo = "cod_domiciliario";
                var tipo_ajax = "tbl15_info_factura_venta";
                $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                    $("#modelo").html(data);
            });
       });
    });
    </script>
<?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
    <?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
    <th style="text-align:center;">EXPORTAR ARCHIVO DE FACTURA ELECTRONICA</th>
    <!--<th style="text-align:center;">EXPORTAR ARCHIVO PLANO CSV DE FACTURA ELECTRONICA (,) </th>-->
    <?php } ?>
    <?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
    <th style="text-align:center;">EXPORTAR ARCHIVO DE FACTURA ELECTRONICA</th>
    <?php } ?>
    <th style="text-align:center;">XLSX EXTERN</th>
    <th style="text-align:center;">CSV INTERN</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_puntoycoma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>
    <!--<td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_coma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_csv.png"></a></td>-->
    <?php } ?>
    <?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_moneybox_xlsx.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_exportar_archivo_factura_electronica.png"></a></td>
    <?php } ?>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_xlsx.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_xlsx.png"></a></td>
    <td style="text-align:center;"><a href="../admin/descargar_factura_venta_campos_punto_y_coma_csv.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>"><img src="../imagenes/btn_csv.png"></a></td>
    <td style="text-align:center;"></td>
  </tr>
</table>

<?php if ($cod_estado_agregar_productos_a_venta_facturada== '1') { ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_venta.php">LISTA DE FACTURAS</a></strong></td></tr></tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong>EDICION DE FACTURA</strong></td></tr></tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>BUSCAR PRODUCTOS: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
        </tr>
    </tbody>
</table>
<?php } ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">MAQUINA</th>
    <th style="text-align:center;">FECHA VENTA</th>
    <?php if ($cod_estado_renta_alquiler_global == '1') { ?><th style="text-align:center;">ALQUILER - RENTA</th><?php } ?>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FACTURA</th>

    <?php if (($cod_estado_fecha_entrega_venta_global == '1')) { ?>
    <th style="text-align:center;">FECHA ENTREGA</th>
    <?php } ?>

   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?>
    <th style="text-align:center;">CUFE</th>
   <?php } ?>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">MONEDA</th>

    <?php if ($cod_estado_soporte_factura_venta_global == '1') { ?><th style="text-align:center;">SOPORTE FACTURA</th><?php } ?>

    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">CLIENTE</th>

   <?php if ($cod_estado_eliminar_productos_a_venta_facturada == '1') { ?>
    <th style="text-align:center;">ELIM</th>
   <?php } ?>

    <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>

    <?php if ($cod_estado_peso_producto_global == '1') { ?>
    <th style="text-align:center">TOTAL PESO (KG)</th>
    <?php } ?>

    <th style="text-align:center;">TOTAL FACTURA</th>
    <?php if ($cod_seguridad== '1') { ?><th style="text-align:center;">RECIBIDO</th><?php } ?>

    <?php if (($cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global == '1') && ($cod_tipo_pago == '2')) { ?>
    <th style="text-align:center;">ABONADO</th>
    <th style="text-align:center;">PENDIENTE</th>
    <?php } ?>

    <th style="text-align:center;">GUARDAR</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
   <td style="text-align:center;"></td>
   <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
   
   <td style="text-align:center;">
        <?php echo $nombre_maquina ?>
        <br>
        GFI: <?php echo $tiempo_ejecucion ?>
        <br>
        RDD: <?php echo $tiempo_ejecucion_dian_dataico ?>
    </td>

   <input name="cod_info_factura_venta" type="hidden" id="cod_info_factura_venta" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $cod_info_factura_venta;?>"/>

   <?php if ($cod_seguridad == '1') { ?>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 120px;" required/><br>HORA: <?php echo $fecha_hora ?></td>
   <?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?><br>HORA: <?php echo $fecha_hora ?></td>
   <?php } ?>

    <?php if ($cod_estado_renta_alquiler_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_estado_alquiler_renta" id="cod_estado_alquiler_renta" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" tabindex="1">
            <?php if (isset($cod_estado_alquiler_renta)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT codigo_sino, nombre_sino FROM tbl15_sino ORDER BY nombre_sino ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_estado_alquiler_renta) AND $cod_estado_alquiler_renta == $datos2['codigo_sino']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['codigo_sino'];
            $nombre = $datos2['nombre_sino'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <br>
        <div id="fechas_alquiler">
        <strong>INICIO:</strong><input name="fecha_ini_renta_alquiler" id="fecha_ini_renta_alquiler" type="date" value="<?php echo $fecha_ini_renta_alquiler ?>" class="input-block-level" style="width: 120px;" tabindex="1"/>
        <br>
        <strong>FINAL:</strong><input name="fecha_fin_renta_alquiler" id="fecha_fin_renta_alquiler" type="date" value="<?php echo $fecha_fin_renta_alquiler ?>" class="input-block-level" style="width: 120px;" tabindex="1"/>
        </div>
    </td>
    <?php } ?>
        
    <td style="text-align:center;">
        <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
            <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo  ""; }
            //$consulta2_sql = "SELECT * FROM tbl15_tipo_factura WHERE (nombre_tipo_factura='$nombre_tipo_factura')";
            $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (nombre_tipo_estado = 'ACTIVO')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_resolucion_facturacion'];
            $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

   <?php if ($cod_seguridad == '1') { ?>
   <td style="text-align:center;"><input name="cod_factura" type="text" id="cod_factura" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $cod_factura;?>" style="width: 70px;" required/></td>
   <?php } else { ?>
   <td style="text-align:center;"><?php echo $cod_factura ?></td>
   <?php } ?>


    <?php if (($cod_estado_fecha_entrega_venta_global == '1')) { ?>
    <td style="text-align:center;"><input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 120px;" /></td>
    <?php } ?>

<!--
    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
            <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo  ""; }
            //$consulta2_sql = "SELECT * FROM tbl15_tipo_factura WHERE (nombre_tipo_factura='$nombre_tipo_factura')";
            $consulta2_sql = "SELECT * FROM tbl15_tipo_factura";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
-->
   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?>
   <td style="text-align:center;"><input name="cod_cufe" type="text" id="cod_cufe" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $cod_cufe;?>" style="width: 200px;"/></td>
   <?php } ?>

<!--
   <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>

    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>
-->
   <?php if ($cod_seguridad == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
            <?php if (isset($cod_administrador)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <?php if ($cod_estado_domiciliario_global == '1') { ?>
        <br>
        <select name="cod_domiciliario" id="cod_domiciliario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 130px;" tabindex="1">
            <?php if (isset($cod_domiciliario)) { echo "<option value='' selected >ESCOGER</option>"; } else { echo "<option value='' selected >ESCOGER</option>"; }
            $consulta2_sql = "SELECT cod_domiciliario, nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE (cod_estado = '1') ORDER BY cod_domiciliario ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_domiciliario) AND $cod_domiciliario == $datos2['cod_domiciliario']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_domiciliario'];
            $nombre = $datos2['nombres_domiciliario'].' '.$datos2['apellidos_domiciliario'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <?php } ?>
    </td>
   <?php } else { ?>
   <td style="text-align:center;"><?php echo $cuenta ?></td>
   <?php } ?>



    <td style="text-align:center;">
        <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
            <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_moneda'];
            $nombre = $datos2['nombre_tipo_moneda'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <?php if ($cod_estado_soporte_factura_venta_global == '1') { ?><td style="text-align:center;">
    <?php if ($url_img_orig_producto <> '') { ?><a href="<?php echo $url_img_orig_producto?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""><a/><br><br><?php } ?>
    <a href="../admin/edit_soporte_archivo_adjunto_info_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&pagina=<?php echo $pagina_local;?>">CARGAR SOPORTE<a/></td>
    <?php } ?>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <br>
        <input name="descripcion_tipo_forma_pago" type="text" id="descripcion_tipo_forma_pago" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $descripcion_tipo_forma_pago;?>" style="width: 130px;"/>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" required>
            <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <?php if ($cod_tipo_pago == '2') { ?><br><strong>FECHA PAGO: </strong><input name="fecha_pago" id="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" style="width: 110px;"/><?php } ?>
        <br><?php if ($existe_cuenta_cobrar <> '0') { ?> <a href="../admin/cuentas_cobrar_abonos.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>">CUENTA POR COBRAR</a><?php } ?>
    </td>

    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

   <?php if ($cod_estado_eliminar_productos_a_venta_facturada == '1') { ?>
    <td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_info_factura_venta?>&tab=<?php echo $tab3?>&campo=<?php echo $campo3?>&tipo=<?php echo $tipo?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
   <?php } ?>
   
    <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><td style="text-align:center;"><textarea name="observacion_tercero" id="observacion_tercero" class="<?php echo $cod_info_factura_venta;?>" rows="3" cols="20"><?php echo $observacion_tercero ?></textarea></td><?php } else { ?> <input type="hidden" name="observacion_tercero" id="observacion_tercero" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $observacion_tercero ?>"><?php } ?>

    <?php if ($cod_estado_peso_producto_global == '1') { ?>
    <td style="text-align:center"><?php echo number_format($total_peso_producto, 0, ",", "."); ?></td>
    <?php } ?>

    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>

    <?php if ($cod_seguridad== '1') { ?><td style="text-align:center; font-size:30;" id="vlr_cancelado"><input name="vlr_cancelado" type="number" id="vlr_cancelado" class="<?php echo $cod_info_factura_venta;?>" value="<?php echo $vlr_cancelado;?>" style="width: 100px;"/></td><?php } ?>

    <?php if (($cod_estado_modulo_cuenta_cobrar_abono_editar_venta_global == '1') && ($cod_tipo_pago == '2')) { ?>
    <td style="text-align:center;"><?php echo number_format($abonado, 0, ",", "."); ?><?php if ($subtotal <> '0') { ?><br><a href="../admin/modificar_cuentas_cobrar.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/base_caja.png alt="Abonar"></a><?php } ?></td>
    <td style="text-align:center;"><?php echo number_format($subtotal, 0, ",", "."); ?></td>
    <?php } ?>

    <td style="text-align:center;"><a href="../admin/actualizar_factura_venta_edit_reg.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&pagina=<?php echo $pagina_local?>"><img src="../imagenes/guardar.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<?php if ($cod_estado_escoger_precio_venta_automatico_global == '1') { ?>
<table class="table table-striped">
    <td style="text-align:center;">
        <?php for ($i=1; $i <= $numero_precio_user; $i++) { ?>
        <a href="../admin/actualizar_precio_venta_automatico_masivo_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina?>"><img src="<?php echo "../imagenes/PV$i.png"; ?>"></a>
        <?php } ?>
     </td>
</table>
<?php } ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
    <tr>
        <th style="text-align:center;"></th>
        <?php if ($cod_estado_eliminar_productos_a_venta_facturada== '1' && $cod_tipo_pago == '1') { ?>
        <th style="text-align:center;">ELM</th>
        <?php } ?>
        <!--<th style="text-align:center;">COBRAR</th>-->
        <th style="text-align:center;">CODIGO</th>
        <th style="text-align:center;">NOMBRE CONCEPTO</th>

        <?php if ($cod_estado_facturacion_devol_venta  == '1') { ?>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">U/M</th>
        <?php } else { ?>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">U/M</th>
        <?php } ?>

        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?><th style="text-align:center;">CAJA (PRESENTACION)</th><?php } else { ?><th style="text-align:center;">CAJA (PRESENTACION)</th><?php } ?>

        <?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">COMENTARIO</th><?php } ?>

        <?php if ($cod_seguridad == '1') { ?><th style="text-align:center;">P.COMPRA</th><?php } ?>

        <?php if ($cod_estado_peso_producto_global == '1') { ?><th style="text-align:center">PESO (KG)</th><?php } ?>

        <?php if ($cod_estado_edit_precio_venta_btn_factura_venta == '1') { ?><th style="text-align:center;">T.P</th><?php } ?>

        <?php if ($cod_estado_edit_precio_venta_pvar_factura_venta == '1') { ?><th style="text-align:center;">PVAR</th><?php } ?>

        <?php if ($cod_estado_edit_precio_venta_precio_estatico_factura_venta == '1') { ?><th style="text-align:center;">VALOR UNITARIO</th><?php } ?>

        <th style="text-align:center;">VALOR TOTAL</th>
        <?php if ($cod_estado_servicio_cava_global == '1') { ?><th style="text-align:center">Cava</th><?php } ?>
        <?php if ($cod_estado_devolucion_btn_verde_global== '1') { ?>
        <th style="text-align:center;">ELM</th>
        <?php } ?>
        <th style="text-align:center;"></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {

    $cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
    $cod_producto                      = $datos_venta_producto['cod_producto'];
    $cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_venta_producto['nombre_producto'];
    $cedula                            = $datos_venta_producto['cedula'];
    $nombre_cliente                    = $datos_venta_producto['nombre_cliente'];
    $und_venta                         = $datos_venta_producto['und_venta'];
    $precio_compra_producto            = $datos_venta_producto['precio_compra_producto'];
    $precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
    $total_costo_producto              = $datos_venta_producto['total_costo_producto'];
    $precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
    $total_venta_producto              = $datos_venta_producto['total_venta_producto'];
    $nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_venta_producto['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_venta_producto['posologia_cantidad'];
    $posologia_peso                    = $datos_venta_producto['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_venta_producto['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_venta_producto['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_venta_producto['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_venta_producto['cod_tipo_cobrar'];
    $cod_info_factura_venta            = $datos_venta_producto['cod_info_factura_venta'];
    $nombre_tipo_precio_venta          = $datos_venta_producto['nombre_tipo_precio_venta'];
    $comentario_producto               = $datos_venta_producto['comentario_producto'];
    $peso_producto                     = $datos_venta_producto['peso_producto'];
    $unidad_medida_peso                = $datos_venta_producto['unidad_medida_peso'];
    $cod_estado_cava                   = $datos_venta_producto['cod_estado_cava'];
    $cajas_sobre                       = intval($datos_venta_producto['cajas_sobre']);


    if ($cajas_sobre == '0') { $cajas_sobre = 1; }
    if ($cod_estado_converir_und_a_caja_mostrar_imprimir_global == '1') { 
        if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
            $und_venta_presentacion = ($und_venta); 
            //$und_venta = ($und_venta); 
            //$nombre_tipo_unidad_medida = 'UND'; 
            //$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
            //$precio_venta_producto = ($precio_venta_producto); 
        } else { 
            $und_venta_presentacion = ($und_venta / $cajas_sobre); 
            //$und_venta = ($und_venta / $cajas_sobre); 
            //$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
            //$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
            //$precio_venta_producto = ($precio_venta_producto * $cajas_sobre); 
        }
    } else { 
        if (($nombre_tipo_unidad_medida == '') || ($nombre_tipo_unidad_medida == 'UND')) { 
            $und_venta_presentacion = ($und_venta); 
            //$und_venta = ($und_venta); 
            //$nombre_tipo_unidad_medida = 'UND'; 
            //$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))); 
            //$precio_venta_producto = ($precio_venta_producto); 
        } else { 
            $und_venta_presentacion = ($und_venta / $cajas_sobre); 
            //$und_venta = ($und_venta / $cajas_sobre); 
            //$nombre_tipo_unidad_medida = $nombre_tipo_unidad_medida; 
            //$precio_venta_producto_antes_de_iva = ($precio_venta_producto - ($precio_venta_producto * ($iva_ptj/100))) * $cajas_sobre; 
            //$precio_venta_producto = ($precio_venta_producto * $cajas_sobre); 
        }
    }

    if ($cod_estado_cava == '1') { $img_entrega_cava = "<img src=../imagenes/sem_no_atendido_peq.png>"; $url_entrega_cava = "../admin/marcar_cava_entregada.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_venta_producto=".$cod_venta_producto; } else { $img_entrega_cava = ""; $url_entrega_cava = "#"; }

    $cod_producto_barra_madre = $cod_producto_barra;

    $obtener_producto_principal = "SELECT * FROM tbl15_venta_producto_sub WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre') AND (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_producto_principal = mysqli_query($conectar, $obtener_producto_principal);
    $producto_principal = mysqli_fetch_assoc($resultado_producto_principal);
    $existe_subproducto = mysqli_num_rows($resultado_producto_principal);

    if ($existe_subproducto <> '0') {
        $previsualizar_subproducto_venta = '<a href="#" onclick="obtener_datos_mostrar_subproducto_venta_modal('.$cod_producto_barra_madre.', '.$cod_info_factura_venta.');" data-toggle="modal" data-target=".abrir_previsualizacion_subproducto_venta">'.$nombre_producto.'</a>';
        $url_subproducto_venta = '<a href="../admin/subproducto_factura_venta.php?cod_producto_barra_madre='.$cod_producto_barra_madre.'&cod_info_factura_venta='.$cod_info_factura_venta.'" target="_blank">'.$nombre_producto.'</a>';
    } else {
        $previsualizar_subproducto_venta = $nombre_producto;
        $url_subproducto_venta = $nombre_producto;
    }
    $incre++;
?>
    <tr style="text-align:center;" id="tr<?php echo $cod_venta_producto;?>">
        <td style="text-align:center;"></td>
        <?php if ($cod_estado_eliminar_productos_a_venta_facturada == '1' && $cod_tipo_pago == '1') { ?>
        <td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_venta_producto?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_venta_producto;?>" id="cod_tipo_cobrar_<?php echo $cod_venta_producto;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
        <!--<td style="text-align:center;" id="cod_venta_producto_<?php echo $cod_venta_producto ?>" class="service_list" data="<?php echo $cod_venta_producto ?>"><a class="eliminar" id="cod_venta_producto<?php echo $cod_venta_producto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
        <td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
        <td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $url_subproducto_venta ?></td>

        <?php if ($cod_estado_facturacion_devol_venta== '1') { ?>
        <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
        <td style="text-align:center" id="nombre_tipo_unidad_medida_<?php echo $incre;?>">
            <select name="nombre_tipo_unidad_medida" id="nombre_tipo_unidad_medida<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" data-show-subtext="true" data-live-search="true" style="width: 60px;" required>
                <?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' $seleccionado >TODOS</option>"; } else { echo  "<option value='' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT cod_tipo_unidad_medida, nombre_tipo_unidad_medida, nombre_completo_tipo_unidad_medida FROM tbl15_tipo_unidad_medida ORDER BY cod_tipo_unidad_medida ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_unidad_medida) AND $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_unidad_medida'];
                $nombre = $datos2['nombre_tipo_unidad_medida'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>(<?php echo ($und_venta_presentacion);?>)
        </td>
        <?php } else { ?>
        <td style="text-align:center;" id="und_venta<?php echo $incre;?>"><?php echo number_format($und_venta, 0, ",", ".");?></td>
        <td style="text-align:center;" id="und_venta<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?> (<?php echo ($und_venta_presentacion);?>)</td>
        <?php } ?>

        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
        <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="cajas_sobre" type="number" id="cajas_sobre-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $cajas_sobre;?>" style="width: 50px;" /></td>
        <?php } else { ?>
        <td style="text-align:center;" id="und_venta<?php echo $incre;?>"><?php echo intval($cajas_sobre);?> - (<?php echo ($und_venta_presentacion);?>)</td>
        <?php } ?>

        <?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align:center;"><input name="comentario_producto" type="text" id="comentario_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $comentario_producto;?>" style="width: 400px;" /></td><?php } ?>

        <?php if ($cod_seguridad == '1') { ?>
        <td style="text-align:right;" id="precio_compra_producto<?php echo $incre;?>"><?php echo number_format($precio_compra_producto, 0, ",", ".");?></td>
        <?php } ?>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <td style="text-align:center;" id="peso_producto_<?php echo $incre;?>"><input name="peso_producto" type="number" id="peso_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $peso_producto;?>" step="any" min=0 style="width: 70px;" /></td>
        <?php } ?>

        <?php if ($cod_estado_edit_precio_venta_btn_factura_venta == '1') { ?>
        <td style="text-align:center;">
        <?php for ($i=1; $i <= $numero_precio; $i++) { ?>
        <a href="../admin/actualizar_precio_venta_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_venta_producto=<?php echo $cod_venta_producto?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&pagina=<?php echo $pagina?>"><img src="<?php if ($nombre_tipo_precio_venta=="PV$i") { echo "../imagenes/PV".$i."_R.png"; } else { echo "../imagenes/PV$i.png"; } ?>"></a>
        <?php } ?>
        </td>
        <?php } ?>

        <?php if ($cod_estado_edit_precio_venta_pvar_factura_venta == '1') { ?>
        <td style="text-align:center;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
        <?php } ?>

        <?php if ($cod_estado_edit_precio_venta_precio_estatico_factura_venta == '1') { ?>
        <td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
        <?php } ?>

        <td style="text-align:right;" id="total_venta_producto_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
        <?php if ($cod_estado_servicio_cava_global == '1') { ?><td style="text-align:center"><a href="<?php echo $url_entrega_cava; ?>"><?php echo $img_entrega_cava; ?></a></td><?php } ?>

        <?php if ($cod_estado_devolucion_btn_verde_global== '1') { ?>
        <td style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_venta_producto?>&tab=<?php echo $tab2 ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar_verde.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
    </tr style="text-align:right;" id="tr<?php echo $cod_venta_producto;?>">
<?php } ?>
</tbody>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
<!--
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=FACTURA&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
-->
    <td style="text-align:center;"><a href="../admin/venta_productos_opcion_imprimir.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
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

<script language="javascript">
$(document).ready(function(){
    $('select[name="nombre_tipo_unidad_medida"]').change(function(){ 
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script>
function obtener_datos_mostrar_subproducto_venta_modal(cod_producto_barra_madre, cod_info_factura_venta){

    var cod_producto_barra_madre = cod_producto_barra_madre;
    var cod_info_factura_venta = cod_info_factura_venta;
    //$("#mod_"+"cod_nota_observacion").val(id);
}
</script>