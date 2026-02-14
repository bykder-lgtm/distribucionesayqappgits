<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
<a href="../admin/menu_lista.php"><h4>Cargar Archivo Plano Sticker Barras&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
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
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="table-responsive">
<form name="formulario_insersion" enctype="multipart/form-data" accept-charset="utf-8" action="../admin/importar_archivo_xlsx_stiker_barras_ajax_reg.php" id="formulario_subir_archio_csv" method="POST">
<table border="0" class="table table-responsive">
  <thead>
    <tr>
      <th>Selecionar archivo: 
        <select name="nombre_tipo_formato_archivo_plano" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
          <?php if (isset($nombre_tipo_formato_archivo_plano)) { echo "";
          } else { echo  ""; }
          $consulta2_sql = ("SELECT cod_tipo_formato_archivo_plano, nombre_tipo_formato_archivo_plano 
          FROM tbl15_tipo_formato_archivo_plano WHERE (cod_estado = '1') ORDER BY cod_tipo_formato_archivo_plano ASC");
          $consulta2 = mysqli_query($conectar, $consulta2_sql);
          while ($datos2 = mysqli_fetch_assoc($consulta2)) {
          if(isset($nombre_tipo_formato_archivo_plano) and $nombre_tipo_formato_archivo_plano == $datos2['nombre_tipo_formato_archivo_plano']) {
          $seleccionado = "selected"; } else { $seleccionado = ""; }
          $codigo = $datos2['nombre_tipo_formato_archivo_plano'];
          $nombre = $datos2['nombre_tipo_formato_archivo_plano'];
          echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <input type="file" name="csv" id="csv" accept=".xls,.xlsx" required><input type="submit" value="Cargar Archivo" name="import" id="btn_subir_archico" class="btn btn-info pull-center" title="Cargar Archivo" /></th>
    </tr>
  </thead>
</table>
</form>
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