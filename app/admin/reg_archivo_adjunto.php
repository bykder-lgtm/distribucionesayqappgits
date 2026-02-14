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
<a href="#"><h4>Registrar Nuevo Archivo al Expediente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_archivador.php">Lista de Expedientes</h4></a>
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
  $observacion_archivador                         = $matriz_consulta['observacion_archivador'];

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
  ?>

  <form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_archivo_adjunto_reg.php">
  <fieldset>

  <table border="1" class="table table-responsive">
    <thead>
      <tr>
        <th style="text-align:center">ENTIDAD ORIGEN ARCHIVO</th>
        <th style="text-align:center">NOMBRE DEL PACIENTE</th>
        <th style="text-align:center">NOMBRE DEL MEDICO TRATANTE</th>
        <th style="text-align:center">COD HISTORIA CLINICA</th>
        <th style="text-align:center">FACTURA</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td style="text-align:center">
            <select name="cod_entidad_origen_archivo" id="cod_entidad_origen_archivo" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_entidad_origen_archivo WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_entidad_origen_archivo'];
            $nombre = $contenedor['nombre_entidad_origen_archivo'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
        <td style="text-align:center;"><input style="width: 300px;" class="input-block-level" name="nombre_paciente" type="text" value="<?php echo $nombre_paciente ?>" placeholder="" required/></td>
        <td style="text-align:center;"><input style="width: 300px;" class="input-block-level" name="nombre_medico_tratante" type="text" value="<?php echo $nombre_medico_tratante ?>" placeholder="" /></td>
  <!--
        <td style="text-align:center;"><textarea name="nombre_paciente" class="input-block-level" rows="1" cols="20"></textarea></td>
        <td style="text-align:center;"><textarea name="nombre_medico_tratante" class="input-block-level" rows="1" cols="20"></textarea></td>
  -->
        <td style="text-align:center;"><input style="width: 100px;" class="input-block-level" name="cod_historia_clinica" type="text" value="<?php echo $cod_historia_clinica ?>" placeholder="" /></td>
        <td style="text-align:center;"><input style="width: 100px;" class="input-block-level" name="cod_factura" type="text" value="" placeholder="" /></td>
      </tr>
    </tbody>
  </table>

  <table border="1" class="table table-responsive">
    <thead>
      <tr>
        <th style="text-align:center">TIPO AMBITO</th>
        <th style="text-align:center">ESTANTE</th>
        <th style="text-align:center">CUBICULO</th>
        <th style="text-align:center">CARPETA</th>
        <th style="text-align:center">CANTIDAD FOLIOS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center">
            <select name="cod_tipo_ambito" id="cod_tipo_ambito" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_ambito WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_ambito'];
            $nombre = $contenedor['nombre_tipo_ambito'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
        <td style="text-align:center">
            <select name="cod_tipo_estante" id="cod_tipo_estante" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_estante WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_estante'];
            $nombre = $contenedor['nombre_tipo_estante'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
        <td style="text-align:center">
            <select name="cod_tipo_cubiculo" id="cod_tipo_cubiculo" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_cubiculo WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_cubiculo'];
            $nombre = $contenedor['nombre_tipo_cubiculo'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
        <td style="text-align:center">
            <select name="cod_tipo_carpeta" id="cod_tipo_carpeta" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_carpeta WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_carpeta'];
            $nombre = $contenedor['nombre_tipo_carpeta'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
        <td style="text-align:center;"><input style="width: 100px;" class="input-block-level" name="cantidad_folios" type="number" value="" placeholder="" /></td>
      </tr>
    </tbody>
  </table>

  <table border="1" class="table table-responsive">
    <thead>
      <tr>
        <th style="text-align:center">OBSERVACION</th>
        <th style="text-align:center">TIPO DE ARCHIVO</th>
        <th style="text-align:center">TABLA RETENCION DOCUMENTAL</th>
        <th style="text-align:center">TIPO NOTA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;"><textarea name="observacion_archivador" class="input-block-level" rows="1" cols="20"></textarea></td>

        <td style="text-align:center">
            <select name="cod_tipo_archivo" id="cod_tipo_archivo" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_archivo WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_archivo'];
            $nombre = $contenedor['nombre_tipo_archivo'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>

        <td style="text-align:center">
            <select name="cod_tabla_retencion_documental" id="cod_tabla_retencion_documental" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tabla_retencion_documental WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tabla_retencion_documental'];
            $nombre = $contenedor['nombre_tabla_retencion_documental'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>

        <td style="text-align:center">
            <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="form-control" style="width: 200px;">
            <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_estado = '1')";
            $resultado = mysqli_query($conectar, $sql_consulta);
            while ($contenedor=mysqli_fetch_array($resultado)) { 
            $codigo = $contenedor['cod_tipo_nota_observacion'];
            $nombre = $contenedor['nombre_tipo_nota_observacion'];
            ?><option style="font-size:20px" value="<?php echo $codigo ?>"><?php echo $nombre ?></option><?php } ?>
            </select>
        </td>
      </tr>
    </tbody>
  </table>


  <table border="1" class="table table-responsive">
    <thead>
      <tr>
        <th style="text-align:center">ADJUNTAR ARCHIVO</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required />Selecione el archivo</a></td>
      </tr>
    </tbody>
  </table>

  <input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
  <input type="hidden" name="cod_archivador" value="<?php echo $cod_archivador ?>">
  <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
  <input type="hidden" name="insersion" value="formulario_de_insersion">
  <hr>
  <div class="actions">
  <input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
  </div>
  </fieldset>
  </form>
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