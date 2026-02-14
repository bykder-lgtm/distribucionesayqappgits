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
<div class="container">
<div class="divPanel page-content">

<?php if (isset($_GET['cod_archivador'])) { $cod_archivador = intval($_GET['cod_archivador']); } ?>
<div class="breadcrumbs">
<a href="../admin/lista_archivador_expediente_documento.php"><h4>Regresar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; 

if (isset($_GET['cod_archivador'])) { 
  $cod_archivador                                 = intval($_GET['cod_archivador']);

  $mostrar_datos_sql = "SELECT * FROM tbl15_archivador WHERE (cod_archivador = '$cod_archivador')";
  $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
  $matriz_consulta = mysqli_fetch_assoc($consulta);

  $nombre_archivador                              = $matriz_consulta['nombre_archivador'];
  $descripcion_archivador                         = $matriz_consulta['descripcion_archivador'];
  $observacion_archivador                         = $matriz_consulta['observacion_archivador'];
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

  $nombre_paciente                                = $matriz_consulta['nombre_paciente'];
  $nombre_medico_tratante                         = $matriz_consulta['nombre_medico_tratante'];
  $fecha_creacion                                 = $matriz_consulta['fecha_creacion'];
  $cod_historia_clinica                           = $matriz_consulta['cod_historia_clinica'];
  $cod_factura                                    = $matriz_consulta['cod_factura'];

  $cod_tipo_ambito                                = $matriz_consulta['cod_tipo_ambito'];
  $cod_tipo_estante                               = $matriz_consulta['cod_tipo_estante'];
  $cod_tipo_cubiculo                              = $matriz_consulta['cod_tipo_cubiculo'];
  $cod_tipo_carpeta                               = $matriz_consulta['cod_tipo_carpeta'];
  $cod_entidad_origen_archivo                     = $matriz_consulta['cod_entidad_origen_archivo'];
  $cod_tipo_archivo                               = $matriz_consulta['cod_tipo_archivo'];
  $cod_tabla_retencion_documental                 = $matriz_consulta['cod_tabla_retencion_documental'];
  $cantidad_folios                                = $matriz_consulta['cantidad_folios'];

  $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
  $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
  $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
  $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

  $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_entidad_origen_archivo = "SELECT * FROM tbl15_entidad_origen_archivo WHERE (cod_entidad_origen_archivo = '$cod_entidad_origen_archivo')";
  $consulta_entidad_origen_archivo = mysqli_query($conectar, $sql_entidad_origen_archivo);
  $datos_entidad_origen_archivo = mysqli_fetch_assoc($consulta_entidad_origen_archivo);

  $nombre_entidad_origen_archivo                  = $datos_entidad_origen_archivo['nombre_entidad_origen_archivo'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_archivo = "SELECT * FROM tbl15_tipo_archivo WHERE (cod_tipo_archivo = '$cod_tipo_archivo')";
  $consulta_tipo_archivo = mysqli_query($conectar, $sql_tipo_archivo);
  $datos_tipo_archivo = mysqli_fetch_assoc($consulta_tipo_archivo);

  $nombre_tipo_archivo                            = $datos_tipo_archivo['nombre_tipo_archivo'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_ambito = "SELECT * FROM tbl15_tipo_ambito WHERE (cod_tipo_ambito = '$cod_tipo_ambito')";
  $consulta_tipo_ambito = mysqli_query($conectar, $sql_tipo_ambito);
  $datos_tipo_ambito = mysqli_fetch_assoc($consulta_tipo_ambito);

  $nombre_tipo_ambito                            = $datos_tipo_ambito['nombre_tipo_ambito'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_estante = "SELECT * FROM tbl15_tipo_estante WHERE (cod_tipo_estante = '$cod_tipo_estante')";
  $consulta_tipo_estante = mysqli_query($conectar, $sql_tipo_estante);
  $datos_tipo_estante = mysqli_fetch_assoc($consulta_tipo_estante);

  $nombre_tipo_estante                            = $datos_tipo_estante['nombre_tipo_estante'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_cubiculo = "SELECT * FROM tbl15_tipo_cubiculo WHERE (cod_tipo_cubiculo = '$cod_tipo_cubiculo')";
  $consulta_tipo_cubiculo = mysqli_query($conectar, $sql_tipo_cubiculo);
  $datos_tipo_cubiculo = mysqli_fetch_assoc($consulta_tipo_cubiculo);

  $nombre_tipo_cubiculo                            = $datos_tipo_cubiculo['nombre_tipo_cubiculo'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tipo_carpeta = "SELECT * FROM tbl15_tipo_carpeta WHERE (cod_tipo_carpeta = '$cod_tipo_carpeta')";
  $consulta_tipo_carpeta = mysqli_query($conectar, $sql_tipo_carpeta);
  $datos_tipo_carpeta = mysqli_fetch_assoc($consulta_tipo_carpeta);

  $nombre_tipo_carpeta                            = $datos_tipo_carpeta['nombre_tipo_carpeta'];
/* ----------------------------------------------------------------------------------------------------------/ */
  $sql_tabla_retencion_documental = "SELECT * FROM tbl15_tabla_retencion_documental WHERE (cod_tabla_retencion_documental = '$cod_tabla_retencion_documental')";
  $consulta_tabla_retencion_documental = mysqli_query($conectar, $sql_tabla_retencion_documental);
  $datos_tabla_retencion_documental = mysqli_fetch_assoc($consulta_tabla_retencion_documental);

  $nombre_tabla_retencion_documental                            = $datos_tabla_retencion_documental['nombre_tabla_retencion_documental'];
/* ----------------------------------------------------------------------------------------------------------/ */
?>
<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/cargar_nuevo_folio_archivo_archivador_expediente_documento_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR NUEVO FOLIO AL EXPEDIENTE</th>
            <th style="text-align:center">NOMBRE DEL ARCHIVO (NUEVO FOLIO)</th>
            <th style="text-align:center">TIPO</th>
            <th style="text-align:center">GUARDAR</th>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required="required"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
            <td style="text-align:center;"><input class="input-block-level" name="descripcion_archivador" type="text" value="" placeholder="" required/></td>
            <td style="text-align:center">
                <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="form-control">
                <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '18')";
                $resultado = mysqli_query($conectar, $sql_consulta);
                while ($contenedor=mysqli_fetch_array($resultado)) { 
                $codigo = $contenedor['cod_tipo_nota_observacion'];
                $nombre = $contenedor['nombre_tipo_nota_observacion'];
                ?>
                <option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option>
                <?php } ?>
                </select>
            </td>
            <td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
            <input type="hidden" name="cod_archivador" value="<?php echo $cod_archivador ?>"/>
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

  <table border="1" class="table table-responsive">
    <thead>
      <tr>
        <!--<th style="text-align:center">ENTIDAD ORIGEN ARCHIVO</th>-->
        <th style="text-align:center">ID</th>
        <th style="text-align:center">NOMBRE DEL EXPEDIENTE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;"><?php echo $cod_archivador ?></td>
        <td style="text-align:center;"><?php echo $nombre_archivador ?></td>
      </tr>
    </tbody>
  </table>


  <table class="table table-hover">
  <thead>
  <tr>
    <th style="text-align:center">VER</th>
    <th style="text-align:center">NOMBRE DEL ARCHIVO</th>
    <th style="text-align:center">ESTANTE</th>
    <th style="text-align:center">CUBICULO</th>
    <th style="text-align:center">CARPETA</th>
    <th style="text-align:center">FECHA</th>
    <th style="text-align:center">USUARIO</th>
    <th style="text-align:center">COD</th>
    <th style="text-align:center">EDIT</th>
  <!--<th style="text-align:center">RECURSO</th>-->
  </tr>
  </thead>
  <tbody>
  <?php
  $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_archivador = '$cod_archivador') ORDER BY cod_nota_observacion DESC";
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
    $cod_tipo_ambito                                = $matriz_consulta['cod_tipo_ambito'];
    $cod_tipo_estante                               = $matriz_consulta['cod_tipo_estante'];
    $cod_tipo_cubiculo                              = $matriz_consulta['cod_tipo_cubiculo'];
    $cod_tipo_carpeta                               = $matriz_consulta['cod_tipo_carpeta'];
    $cod_entidad_origen_archivo                     = $matriz_consulta['cod_entidad_origen_archivo'];
    $cod_tipo_archivo                               = $matriz_consulta['cod_tipo_archivo'];
    $observacion_archivador                         = $matriz_consulta['observacion_archivador'];
    $cod_tabla_retencion_documental                 = $matriz_consulta['cod_tabla_retencion_documental'];
    $cantidad_folios                                = $matriz_consulta['cantidad_folios'];
    $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
    $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
    $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
    $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

    $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_origen_archivo = "SELECT * FROM tbl15_entidad_origen_archivo WHERE (cod_entidad_origen_archivo = '$cod_entidad_origen_archivo')";
    $consulta_entidad_origen_archivo = mysqli_query($conectar, $sql_entidad_origen_archivo);
    $datos_entidad_origen_archivo = mysqli_fetch_assoc($consulta_entidad_origen_archivo);

    $nombre_entidad_origen_archivo                  = $datos_entidad_origen_archivo['nombre_entidad_origen_archivo'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_archivo = "SELECT * FROM tbl15_tipo_archivo WHERE (cod_tipo_archivo = '$cod_tipo_archivo')";
    $consulta_tipo_archivo = mysqli_query($conectar, $sql_tipo_archivo);
    $datos_tipo_archivo = mysqli_fetch_assoc($consulta_tipo_archivo);

    $nombre_tipo_archivo                            = $datos_tipo_archivo['nombre_tipo_archivo'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_ambito = "SELECT * FROM tbl15_tipo_ambito WHERE (cod_tipo_ambito = '$cod_tipo_ambito')";
    $consulta_tipo_ambito = mysqli_query($conectar, $sql_tipo_ambito);
    $datos_tipo_ambito = mysqli_fetch_assoc($consulta_tipo_ambito);

    $nombre_tipo_ambito                             = $datos_tipo_ambito['nombre_tipo_ambito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_estante = "SELECT * FROM tbl15_tipo_estante WHERE (cod_tipo_estante = '$cod_tipo_estante')";
    $consulta_tipo_estante = mysqli_query($conectar, $sql_tipo_estante);
    $datos_tipo_estante = mysqli_fetch_assoc($consulta_tipo_estante);

    $nombre_tipo_estante                            = $datos_tipo_estante['nombre_tipo_estante'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_cubiculo = "SELECT * FROM tbl15_tipo_cubiculo WHERE (cod_tipo_cubiculo = '$cod_tipo_cubiculo')";
    $consulta_tipo_cubiculo = mysqli_query($conectar, $sql_tipo_cubiculo);
    $datos_tipo_cubiculo = mysqli_fetch_assoc($consulta_tipo_cubiculo);

    $nombre_tipo_cubiculo                           = $datos_tipo_cubiculo['nombre_tipo_cubiculo'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_carpeta = "SELECT * FROM tbl15_tipo_carpeta WHERE (cod_tipo_carpeta = '$cod_tipo_carpeta')";
    $consulta_tipo_carpeta = mysqli_query($conectar, $sql_tipo_carpeta);
    $datos_tipo_carpeta = mysqli_fetch_assoc($consulta_tipo_carpeta);

    $nombre_tipo_carpeta                            = $datos_tipo_carpeta['nombre_tipo_carpeta'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tabla_retencion_documental = "SELECT * FROM tbl15_tabla_retencion_documental WHERE (cod_tabla_retencion_documental = '$cod_tabla_retencion_documental')";
    $consulta_tabla_retencion_documental = mysqli_query($conectar, $sql_tabla_retencion_documental);
    $datos_tabla_retencion_documental = mysqli_fetch_assoc($consulta_tabla_retencion_documental);

    $nombre_tabla_retencion_documental              = $datos_tabla_retencion_documental['nombre_tabla_retencion_documental'];
    /* ----------------------------------------------------------------------------------------------------------/ */
      if ($cod_info_factura_venta <> '0') {
        $titulo_variable = 'FACT_VENT: '.$cod_info_factura_venta;
      } elseif ($cod_info_factura_compra <> '0') {
        $titulo_variable = 'FACT_COMP: '.$cod_info_factura_compra;
      } elseif ($cod_info_cotizacion_factura_compra <> '0') {
        $titulo_variable = 'COTIZ_COMP: '.$cod_info_cotizacion_factura_compra;
      } elseif ($cod_info_cotizacion_factura_venta <> '0') {
        $titulo_variable = 'COTIZ_VENTA: '.$cod_info_cotizacion_factura_venta;
      } elseif ($cod_info_factura_auditoria <> '0') {
        $titulo_variable = 'AUDIT: '.$cod_info_factura_auditoria;
      } elseif ($cod_info_factura_transferencia <> '0') {
        $titulo_variable = 'TRANSF_SALID: '.$cod_info_factura_transferencia;
      } elseif ($cod_info_factura_transferencia_bodega_entrada <> '0') {
        $titulo_variable = 'TRANSF_ENTRAD: '.$cod_info_factura_transferencia_bodega_entrada;
      } elseif ($cod_info_factura_transferencia_bodega <> '0') {
        $titulo_variable = 'TRANSF_BODEG: '.$cod_info_factura_transferencia_bodega;
      } elseif ($cod_movimiento_contable <> '0') {
        $titulo_variable = 'MOV_CONT: '.$cod_movimiento_contable;
      } elseif ($cod_archivador <> '0') {
        $titulo_variable = 'ARCH: '.$cod_archivador;
      } else {
        $titulo_variable = 'OTRO';
      }
  /* ----------------------------------------------------------------------------------------------------------/ */
  ?>
  <tr>
    <td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/expediente.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:left"><?php echo $nombre_nota_observacion; ?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_estante ?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_cubiculo ?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_carpeta ?></td>
    <td style="text-align:center"><?php echo $fecha_creacion; ?></td>
    <td style="text-align:center"><?php echo $cuenta; ?></td>
    <td style="text-align:center"><?php echo $cod_nota_observacion; ?></td>
    <td style="text-align:center"><a href="../admin/edit_nota_observacion.php?cod_nota_observacion=<?php echo $cod_nota_observacion?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
  <!--<td style="text-align:center" id="elim<?php echo $cod_archivador;?>"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>-->
  </tr>
  <?php } ?>
  </tr>
  </tbody>
  </table>
<?php } ?>
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