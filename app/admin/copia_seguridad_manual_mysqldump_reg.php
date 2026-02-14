<?php $serguridad_pagina = 1; ?>
<?php $nombre_pagina = "Cambiar Contraseña"; ?>
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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Cambiar contraseña de usuario</h4></a></div>-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_curl                               = 1;
$fecha_hoy                              = time();
$fecha_hoy_time                         = time();
$fecha_ymd_his                          = date("Y-m-d H:i:s");
 // ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$nombre_archivo_txt         = $base_datos.'.txt';
$nombre_archivo_zip         = $base_datos.'_'.date("Y_m_d__H_i_s");
$ruta_archivo               = '../Bases_cron/';
$ruta_nombre_archivo_txt    = $ruta_archivo.$nombre_archivo_txt;
$ruta_nombre_archivo_zip    = $ruta_archivo.$nombre_archivo_zip;

$command = 'C:\xampp\mysql\bin\mysqldump --opt -u '.$conexion_usuario.' -p'.$conexion_contrasena.' '.$base_datos.' > '.$ruta_nombre_archivo_txt;
system($command, $output); //Ejecutamos el comando para respaldo

$zip                        = new ZipArchive(); //Objeto de Libreria ZipArchive
//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_ruta_nombre_zip     = $ruta_nombre_archivo_zip.'.zip';

if($zip->open($salida_ruta_nombre_zip, ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
  $zip->addFile($ruta_nombre_archivo_txt); //Agregamos el archivo SQL a ZIP
  $zip->close(); //Cerramos el ZIP
  unlink($ruta_nombre_archivo_txt); //Eliminamos el archivo temporal SQL
  //header ("Location: $salida_ruta_nombre_zip"); // Redireccionamos para descargar el Arcivo ZIP
?>
<table border="1" class="table table-responsive">
  <thead>
    <tr>
      <th style="text-align:center">Copia de seguridad guardada correctamente</th>
    </tr>
      <tr>
      <th style="text-align:center"><a href="<?php echo $salida_ruta_nombre_zip; ?>">Ver copia de seguridad</a></th>
    </tr>
  </thead>
</table>
<?php
  } else { //echo 'Error'; //Enviamos el mensaje de error ?>
<table border="1" class="table table-responsive">
  <thead>
    <tr>
      <th style="text-align:center">No se pudo guardar la copia de seguridad</th>
    </tr>
  </thead>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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