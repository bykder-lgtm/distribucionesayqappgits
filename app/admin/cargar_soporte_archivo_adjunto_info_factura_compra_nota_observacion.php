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
<?php 
$pagina_local                                          = $_SERVER['PHP_SELF'];
$cod_administrador_sesion                              = $cod_administrador;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_compra                               = intval($_GET['cod_info_factura_compra']);
$pagina                                                = addslashes($_GET['pagina']);

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_compra                               = $data_info_factura['cod_info_factura_compra'];
$cod_factura                                           = $data_info_factura['cod_factura'];
$cod_tercero                                           = $data_info_factura['cod_tercero'];
$url_img_orig_producto                                 = $data_info_factura['url_img_orig_producto'];
$cuenta                                                = $data_info_factura['cuenta'];
$cod_caja_virtual                                      = $data_info_factura['cod_caja_virtual'];

$tab                                                   = 'tbl15_nota_observacion';
$campo                                                 = 'cod_nota_observacion';
$tipo                                                  = 'eliminar';

$fecha_impr                                            = date("Ymd");
$hora_impr                                             = date("His");

$pagina_redirect                                       = $pagina.'?cod_info_factura_compra='.$cod_info_factura_compra.'&pagina='.$pagina;
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="breadcrumbs">
<a class="btn btn-primary" href="<?php echo $pagina_redirect;?>">Regresar</a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="table-responsive">

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/cargar_soporte_archivo_adjunto_info_factura_compra_nota_observacion_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR SOPORTE</th>
            <th style="text-align:center">TIPO</th>
			<?php if ($url_img_orig_producto) { ?><th style="text-align:center">SOPORTE PRINCIPAL</th><?php } ?>
			<th style="text-align:center">GUARDAR</th>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required="required"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
            <td style="text-align:center">
                <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="form-control">
                <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '3')";
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
            <input type="hidden" name="cod_info_factura_compra" value="<?php echo $cod_info_factura_compra ?>"/>
            <input type="hidden" name="cuenta" value="<?php echo $cuenta ?>"/>
            <input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual ?>"/>
            <input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
            <input type="hidden" name="insertar_datos" value="formulario">
        </tr>
    </thead>
</table>
</fieldset>
</form>

<table class="table table-hover">
<thead>
<tr>
    <th style="text-align:center">PRINC</th>
    <th style="text-align:center">ID</th>
    <th style="text-align:left">NOTA OBSERVACION</th>
    <th style="text-align:center">TIPO</th>
    <th style="text-align:center">FECHA</th>
    <th style="text-align:center">HORA</th>
    <th style="text-align:center">USUARIO</th>
    <th style="text-align:center">SOPORTE</th>
    <th style="text-align:center">EDIT</th>
    <th style="text-align:center">ELIM</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_compra = '$cod_info_factura_compra') ORDER BY cod_nota_observacion DESC";
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

    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];

    if (($cod_tipo_nota_observacion == 0) && ($url_img_orig_producto <> '')) { //NOTAS Y OBSERVACIONES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_nota_observacion='.$cod_nota_observacion;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 1) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE VENTA
        $url_redirect_recurso = '../admin/edit_factura_venta.php'.'?cod_info_factura_venta='.$cod_info_factura_venta;
        $titulo_celda = "ID VENTA";
    } elseif (($cod_tipo_nota_observacion == 2) && ($url_img_orig_producto <> '')) { //SOPORTES FACTURA DE COMPRA
        $url_redirect_recurso = '../admin/ver_factura_compra.php'.'?cod_info_factura_compra='.$cod_info_factura_compra;
        $titulo_celda = "ID VENTA";
    } elseif (($cod_tipo_nota_observacion == 3) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE COMPRA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_compra='.$cod_info_cotizacion_factura_compra;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 4) && ($url_img_orig_producto <> '')) { //SOPORTES COTIZACIONES DE VENTA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_cotizacion_factura_venta='.$cod_info_cotizacion_factura_venta;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 5) && ($url_img_orig_producto <> '')) { //SOPORTES AUDITORIA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_auditoria='.$cod_info_factura_auditoria;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 6) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIAS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia='.$cod_info_factura_transferencia;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 7) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA ENTRADA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega_entrada='.$cod_info_factura_transferencia_bodega_entrada;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 8) && ($url_img_orig_producto <> '')) { //SOPORTES TRANSFERENCIA SALIDA
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_info_factura_transferencia_bodega='.$cod_info_factura_transferencia_bodega;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 9) && ($url_img_orig_producto <> '')) { //SOPORTES MOVIMIENTOS CONTABLES
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_movimiento_contable='.$cod_movimiento_contable;
        $titulo_celda = "";
    } elseif (($cod_tipo_nota_observacion == 10) && ($url_img_orig_producto <> '')) { //SOPORTES EGRESOS
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?cod_egreso='.$cod_egreso;
        $titulo_celda = "";
    } else {
        $url_redirect_recurso = '../admin/aaaaaaa.php'.'?aaaaaa='.$aaaaaa;
    }
?>
<tr id="elim<?php echo $cod_nota_observacion;?>">
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><a href="../admin/soporte_principal_factura_venta_reg.php?cod_nota_observacion=<?php echo $cod_nota_observacion?>&cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&pagina=<?php echo $pagina_local ?>"><img src="<?php echo $url_img_active ?>" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $cod_nota_observacion; ?></td>
    <td style="text-align:left"   id="elim<?php echo $cod_nota_observacion;?>"><?php echo $nombre_nota_observacion; ?></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $nombre_tipo_nota_observacion; ?></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $fecha_ymd; ?></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $fecha_hora; ?></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><?php echo $cuenta; ?></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion;?>"><a href="../admin/edit_nota_observacion.php?cod_nota_observacion=<?php echo $cod_nota_observacion?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center" id="elim<?php echo $cod_nota_observacion ?>" data="<?php echo $cod_nota_observacion ?>"><a class="eliminar" id="cod_nota_observacion<?php echo $cod_nota_observacion ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
</tr id="elim<?php echo $cod_nota_observacion;?>">
<?php
}
?>
</tr>
</tbody>
</table>
</div>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
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