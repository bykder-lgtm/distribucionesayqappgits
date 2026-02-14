<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link href="../estilo_css/jquery.signaturepad.css" rel="stylesheet">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/numeric-1.2.6.min.js"></script> 
<script src="../js/bezier.js"></script>
<script type='text/javascript' src="../js/html2canvas.js"></script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<script src="../js/jquery.signaturepad.js"></script>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/lista_paciente_buscar.php"><h4>Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy                           = date("Y/m/d H:i:00");
$pagina_red                          = $_SERVER['PHP_SELF'];
$cod_historia_clinica                = intval($_GET['cod_historia_clinica']);
$cod_cliente                         = intval($_GET['cod_cliente']);

$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, cod_entidad, url_img_foto_min AS url_img_foto_min_cli, 
url_img_firma_min AS url_img_firma_min_cli, cod_grupo_area, cod_grupo_area_cargo, 
nombre_religion, nombre_ocupacion, nombre_estado_civil, nombre_escolaridad, nombre_empresa, nombre_empresa_contratante, 
nombre_actividad_ecoemp, cargo_empresa, area_empresa, ciudad_empresa, nombre_estrato, nombre_numero_hijos, 
nombre_tipo_regimen, nombre_fondo_pension, nombre_arl, nombre_contacto1, parentesco_contacto1, tel_contacto1, direccion_contacto1
FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
$url_img_foto_min_cli                = $info_cliente['url_img_foto_min_cli'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$nom_ape                             = $nombres.' '.$apellido1;
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th style="text-align:center; width:50%" bgcolor="#FAC090" valign="middle"><a href="../admin/edit_cargar_foto_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_foto_min_cli ?>" class="img-polaroid" alt="Foto Paciente" style="border-style:dotted;border-width:1px; height:200px;" /></a></th>
            <th style="text-align:center; width:50%" bgcolor="#FAC090" valign="middle"><a href="../admin/edit_cargar_firma_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_firma_min_cli ?>" class="img-polaroid" alt="Foto Firma" style="border-style:dotted;border-width:1px; height:200px;" /></a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
        <th style="text-align:center" bgcolor="#FAC090">APELLIDOS</th>
        <th style="text-align:center" bgcolor="#FAC090">NOMBRES COMPLETOS</th></tr></thead>
    <tbody><tr>
        <td style="text-align:center"><?php echo ($apellido1) ?></td>
        <td style="text-align:center"><?php echo ($nombres) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

</body>
</html>