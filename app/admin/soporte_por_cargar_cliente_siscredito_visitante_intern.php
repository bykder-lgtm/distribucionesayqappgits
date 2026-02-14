<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_intern.php"); ?>
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
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
if (isset($_GET['cod_nota_observacion'])) {

    $cod_nota_observacion                                 = intval($_GET['cod_nota_observacion']);
    $cod_cuentas_cobrar                                   = intval($_GET['cod_cuentas_cobrar']);
    $cod_tercero                                          = intval($_GET['cod_tercero']);
    $pagina                                               = addslashes($_GET['pagina']);
    $pagina_redirect                                      = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina;

    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];

    $datos_data_info_factura = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                               = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                      = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                      = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                    = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                    = $data_info_factura['apellido2_tercero'];
    $nombre_cliente                                       = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;

    $datos_cuentas_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
    $consulta_cuentas_cobrar = mysqli_query($conectar, $datos_cuentas_cobrar);
    $data_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);

    $cod_producto_barra                                   = $data_cuentas_cobrar['cod_producto_barra'];
    $nombre_producto                                      = $data_cuentas_cobrar['nombre_producto'];
    $cod_entidad_crediticia                               = $data_cuentas_cobrar['cod_entidad_crediticia'];
    $monto_deuda                                          = $data_cuentas_cobrar['monto_deuda'];

    $datos_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $datos_entidad_crediticia);
    $data_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                            = $data_entidad_crediticia['nombre_entidad_crediticia'];

    $tab                                                  = 'tbl15_nota_observacion';
    $campo                                                = 'cod_nota_observacion';
    $tipo                                                 = 'eliminar';

    $fecha_impr                                           = date("Ymd");
    $hora_impr                                            = date("His");
    ?>
        <!-- Start Cart  -->
    <form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/soporte_por_cargar_cliente_siscredito_visitante_intern_reg.php">
        <div class="cart-box-main">
            <div id="eliminar_ok" style="display:none;">&nbsp;</div>
            <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">

                            <div class="col-lg-12 col-sm-12">
                                <div class="contact-info-center" style="text-align:center">
                                    <h3><?php echo $nombre_cliente ?> | <?php echo $nombre_entidad_crediticia ?> | <?php echo $nombre_producto ?> | <?php echo number_format($monto_deuda, 0, ",", ".") ?></h3>
                                </div>
                            </div>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Cargar Soporte</th>
                                        <th style="text-align:center">Nota Observacion</th>
                                        <th style="text-align:center">Fecha</th>
                                        <th style="text-align:center">Tipo</th>
                                    </tr>
                                </thead>
                              <tbody>
                                    <tr>
                                        <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required/><a href="#" class="form-control" id="archivo_selecionado" >Selecione el archivo</a><div id="vista_archivo"></div></td>
                                        <td style="text-align:center; width:80%"><input class="form-control" name="nombre_nota_observacion" type="text" value="<?php echo $nombre_nota_observacion ?>" placeholder="" required/></td>
                                        <td style="text-align:center"><input class="form-control" name="fecha_ymd" type="date" value="<?php echo date("Y-m-d") ?>" placeholder="" required/></td>
                                        <td style="text-align:center">
                                            <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="form-control">
                                                <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '20')";
                                                $resultado = mysqli_query($conectar, $sql_consulta);
                                                while ($contenedor=mysqli_fetch_array($resultado)) { 
                                                $codigo = $contenedor['cod_tipo_nota_observacion'];
                                                $nombre = $contenedor['nombre_tipo_nota_observacion'];
                                                ?>
                                                <option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Gaurdar Soporte</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="cod_nota_observacion" value="<?php echo $cod_nota_observacion ?>">
                                <input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar ?>">
                                <input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
                                <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
                                <input type="hidden" name="insersion" value="formulario_de_insersion">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Cart -->
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

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