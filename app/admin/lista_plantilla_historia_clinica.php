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
<a href="#"><h4>Plantillas Historia Clinica</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
/*
echo "<br>usuario_cryp - ".$_SESSION['usuario_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
echo "<br>cs_cryp - ".$_SESSION['cs_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);
echo "<br>ca_cryp - ".$_SESSION['ca_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['ca_cryp']);
echo "<br>tokn_cryp - ".$_SESSION['tokn_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['tokn_cryp']);
echo "<br>pag_redirec_sesion_cryp - ".$_SESSION['pag_redirec_sesion_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['pag_redirec_sesion_cryp']);
echo "<br>cod_tipo_historia_clinica_cryp - ".$_SESSION['cod_tipo_historia_clinica_cryp'].' ==== '.DAXCRYPTOR::descriptardax($_SESSION['cod_tipo_historia_clinica_cryp']);
echo "<br>";
echo "<br>cod_seguridad - ".$cod_seguridad;
echo "<br>cod_administrador - ".$cod_administrador;
echo "<br>cod_sesion - ".$cod_sesion;
echo "<br>cod_tipo_historia_clinica - ".$cod_tipo_historia_clinica;
echo "<br>pag_inic_des - ".$pag_inic_des;
*/
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT cod_tipo_historia_clinica, nombre_tipo_historia_clinica, estructura_tipo_historia_clinica
FROM tbl15_tipo_historia_clinica ORDER BY nombre_tipo_historia_clinica DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Edit</th>
<th>Historia Clinica</th>
<th>cod</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_tipo_historia_clinica = $info_cliente['cod_tipo_historia_clinica'];
$nombre_tipo_historia_clinica = $info_cliente['nombre_tipo_historia_clinica'];
?>
<tr>
<td align="center"><a href="../admin/edit_plantilla_historia_clinica.php?cod_tipo_historia_clinica=<?php echo $cod_tipo_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/actualizar.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $nombre_tipo_historia_clinica?></td>
<td><?php echo $cod_tipo_historia_clinica?></td>
</tr>
<?php
}
?>
</tbody>
</table><!--End table table table-striped-->
</div><!--End div table-responsive-->
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