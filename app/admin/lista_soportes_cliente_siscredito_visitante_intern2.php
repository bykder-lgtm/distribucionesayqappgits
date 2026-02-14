<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern_confirmdirect.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern_confirmdirect.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php 
$cod_tercero                                          = intval($_GET['cod_tercero']);
$pagina                                               = addslashes($_GET['pagina']);
$pagina_redirect                                      = $pagina.'?cod_tercero='.$cod_tercero.'&pagina='.$pagina;

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_tercero = '$cod_tercero')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_tercero                                          = $data_info_factura['cod_tercero'];
$cod_factura                                          = $data_info_factura['cod_factura'];
$cod_tercero                                          = $data_info_factura['cod_tercero'];
$url_img_orig_producto                                = $data_info_factura['url_img_orig_producto'];

$tab                                                  = 'tbl15_nota_observacion';
$campo                                                = 'cod_nota_observacion';
$tipo                                                 = 'eliminar';

$fecha_impr                                           = date("Ymd");
$hora_impr                                            = date("His");
if ($cod_seguridad == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form>

<div id="eliminar_ok" style="display:none;">&nbsp;</div>

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/edit_soporte_archivo_adjunto_info_factura_venta_reg.php">
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR SOPORTE</th>
            <th style="text-align:center">TIPO</th>
            <?php if ($url_img_orig_producto) { ?><th style="text-align:center">VER SOPORTE</th><?php } ?>
            <th style="text-align:center">GUARDAR</th>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required="required"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
            <td style="text-align:center">
                <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="form-control">
                <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '2')";
                $resultado = mysqli_query($conectar, $sql_consulta);
                while ($contenedor=mysqli_fetch_array($resultado)) { 
                $codigo = $contenedor['cod_tipo_nota_observacion'];
                $nombre = $contenedor['nombre_tipo_nota_observacion'];
                ?>
                <option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option>
                <?php } ?>
                </select>
            </td>
            <?php if ($url_img_orig_producto) { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } ?>
            <td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
        </tr>
    </thead>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
<input type="hidden" name="insertar_datos" value="formulario">
</form>


        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">

                        <div class="mb-2">
                            <div class="col-12 d-flex shopping-box"><a href="../admin/reg_soporte_tecnico_visitante_intern_confirmdirect.php" class="ml-auto btn hvr-hover">Registrar Nuevo Soporte</a> </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:left">NOTA OBSERVACION</th>
                                    <th style="text-align:center">TIPO</th>
                                    <th style="text-align:center">FECHA</th>
                                    <th style="text-align:center">HORA</th>
                                    <th style="text-align:center">USUARIO</th>
                                    <th style="text-align:center">SOPORTE</th>
                                    <th style="text-align:center">ID</th>

                                    <th style="text-align:center;">Problema</th>
                                    <th style="text-align:center;">Respuesta</th>
                                    <th style="text-align:center;">Fecha</th>
                                    <th style="text-align:center;">Hora</th>
                                    <th style="text-align:center;">Vendedor</th>
                                    <th style="text-align:center;">Soporte</th>
                                    <th style="text-align:center;">Estado</th>
                                </tr>
                            </thead>
                          <tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_nota_observacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_nota_observacion                           = $matriz_consulta['cod_nota_observacion'];
    $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];
    $fecha_ymd                                      = $matriz_consulta['fecha_ymd'];
    $fecha_hora                                     = $matriz_consulta['fecha_hora'];
    $cuenta                                         = $matriz_consulta['cuenta'];
    $cod_tipo_nota_observacion                      = $matriz_consulta['cod_tipo_nota_observacion'];
    $cod_info_factura_venta                         = $matriz_consulta['cod_info_factura_venta'];
    $cod_info_factura_compra                        = $matriz_consulta['cod_info_factura_compra'];
    $cod_info_cotizacion_factura_compra             = $matriz_consulta['cod_info_cotizacion_factura_compra'];
    $cod_info_cotizacion_factura_venta              = $matriz_consulta['cod_info_cotizacion_factura_venta'];
    $cod_info_factura_auditoria                     = $matriz_consulta['cod_info_factura_auditoria'];
    $cod_info_factura_transferencia                 = $matriz_consulta['cod_info_factura_transferencia'];
    $cod_info_factura_transferencia_bodega_entrada  = $matriz_consulta['cod_info_factura_transferencia_bodega_entrada'];
    $cod_info_factura_transferencia_bodega          = $matriz_consulta['cod_info_factura_transferencia_bodega'];
    $cod_movimiento_contable                        = $matriz_consulta['cod_movimiento_contable'];
    $cod_egreso                                     = $matriz_consulta['cod_egreso'];
    $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
    $cod_posicion                                   = $matriz_consulta['cod_posicion'];
    $active                                         = $matriz_consulta['active'];

    if ($active == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }

    if (($cod_tipo_nota_observacion == 0) && ($url_img_orig_producto <> '')) { //NOTAS Y OBSERVACIONES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_nota_observacion='.$cod_nota_observacion;
    } elseif (($cod_tipo_nota_observacion == 1) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE VENTA
        $url_redirect_recurso = '../admin/edit_factura_venta.php'.'?cod_info_factura_venta='.$cod_info_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 2) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE COMPRA
        $url_redirect_recurso = '../admin/ver_factura_compra.php'.'?cod_info_factura_compra='.$cod_info_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 3) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE COMPRA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_compra='.$cod_info_cotizacion_factura_compra;
    } elseif (($cod_tipo_nota_observacion == 4) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE VENTA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_venta='.$cod_info_cotizacion_factura_venta;
    } elseif (($cod_tipo_nota_observacion == 5) && ($url_img_orig_producto <> '')) { //SOPORTES AUDITORIA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_auditoria='.$cod_info_factura_auditoria;
    } elseif (($cod_tipo_nota_observacion == 6) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIAS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia='.$cod_info_factura_transferencia;
    } elseif (($cod_tipo_nota_observacion == 7) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA ENTRADA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega_entrada='.$cod_info_factura_transferencia_bodega_entrada;
    } elseif (($cod_tipo_nota_observacion == 8) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA SALIDA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega='.$cod_info_factura_transferencia_bodega;
    } elseif (($cod_tipo_nota_observacion == 9) && ($url_img_orig_producto <> '')) { //SOPORTES MOVIMIENTOS CONTABLES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_movimiento_contable='.$cod_movimiento_contable;
    } elseif (($cod_tipo_nota_observacion == 10) && ($url_img_orig_producto <> '')) { //SOPORTES EGRESOS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_egreso='.$cod_egreso;
    } else {
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?aaaaaa='.$aaaaaa;
    }
    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];
?>
                                <tr>
                                    <td style="text-align:left"   id="elim<?php echo $cod_nota_observacion;?>"><?php echo $nombre_nota_observacion; ?></td>
                                    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $nombre_tipo_nota_observacion; ?></td>
                                    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $fecha_ymd; ?></td>
                                    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $fecha_hora; ?></td>
                                    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $cuenta; ?></td>
                                    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $cod_nota_observacion; ?></td>
                                </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern_confirmdirect.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_confirmdirect.php"); ?>

</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_nota_observacion = $(this).parent().attr('data');
        var tab = "<?php echo $tab; ?>";
        var campo = "<?php echo $campo; ?>";
        var tipo = "<?php echo $tipo; ?>";

        var datos_url_ajax = 'llave='+cod_nota_observacion+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo='+tipo;
        $.ajax({
            type: "POST",
            url: "../admin/eliminar_nota_observacion_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;
                if (afectado == 'SI') {
                    $('#elim'+cod_nota_observacion).fadeOut("slow");
                }
           }
        });
    });
});
</script>


<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>