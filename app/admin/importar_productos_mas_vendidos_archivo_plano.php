<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<?php 
$pagina                                  = $_SERVER['PHP_SELF']; 
?>
<div class="breadcrumbs">
<a class="btn btn-success" href="../admin/producto_mas_vendido_mes.php">REGRESAR<a/>
<a class="btn btn-success" href="../admin/productos_mas_vendidos_lista_cargada.php">PRODUCTOS MAS VENDIDOS CARGADOS POR CSV<a/>
</div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<form action="../admin/importar_productos_mas_vendidos_archivo_plano_reg.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
<table class="table table-striped">
  <thead>
    <tr>
      <th style="text-align:center">Selecionar archivo: <input name="csv" type="file" required autofocus/></th>
      <th style="text-align:center"><input type="submit" name="Submit" value="Cargar Archivo" /></th>
      <input type="hidden" name="cargar_archivo_csv" value="cargar_archivo_csv">
      <input type="hidden" name="pagina" value="<?php echo $pagina ?>">

    </tr>
  </thead>
</table>
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
<script src="js/jquery-ui.js"></script>

</body>
</html>