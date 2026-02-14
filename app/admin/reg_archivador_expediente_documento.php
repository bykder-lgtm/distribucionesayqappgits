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

<div class="breadcrumbs">
<a href="#"><h4>Registrar Expediente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_archivador_expediente_documento.php">Lista de Expedientes</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; ?>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_archivador_expediente_documento_reg.php">
<fieldset>

<table border="1" class="table table-responsive">
  <thead>
    <tr>
      <th style="text-align:center">NOMBRE DEL EXPEDIENTE</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align:center;"><input class="input-block-level" name="nombre_archivador" type="text" value="" placeholder="" required/></td>
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
      <th style="text-align:center">TIPO DE ARCHIVO</th>
      <th style="text-align:center">TABLA RETENCION DOCUMENTAL</th>
      <th style="text-align:center">TIPO NOTA</th>
    </tr>
  </thead>
  <tbody>
    <tr>
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
          <?php $sql_consulta="SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '18') AND (cod_estado = '1')";
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
      <th style="text-align:center">DESCRIPCION DEL ARCHIVO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align:center;"><input type="file" name="url_img1" id="url_img1" required />Selecione el archivo</a></td>
      <td style="text-align:center;"><input class="input-block-level" name="descripcion_archivador" type="text" value="" placeholder="" required/></td>
    </tr>
  </tbody>
</table>

<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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