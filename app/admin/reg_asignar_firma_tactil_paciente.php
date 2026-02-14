<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
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
<a href="../admin/lista_paciente_buscar.php"><h4>Firma del paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
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
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$nombre_religion                     = $info_cliente['nombre_religion'];
$nombre_ocupacion                    = $info_cliente['nombre_ocupacion'];
$nombre_estado_civil                 = $info_cliente['nombre_estado_civil'];
$nombre_escolaridad                  = $info_cliente['nombre_escolaridad'];
//$nombre_empresa                    = $info_cliente['nombre_empresa'];
//$nombre_empresa_contratante        = $info_cliente['nombre_empresa_contratante'];
$nombre_actividad_ecoemp             = $info_cliente['nombre_actividad_ecoemp'];
$cargo_empresa                       = $info_cliente['cargo_empresa'];
$area_empresa                        = $info_cliente['area_empresa'];
$ciudad_empresa                      = $info_cliente['ciudad_empresa'];
$nombre_estrato                      = $info_cliente['nombre_estrato'];
$nombre_numero_hijos                 = $info_cliente['nombre_numero_hijos'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$nombre_fondo_pension                = $info_cliente['nombre_fondo_pension'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_contacto1                    = $info_cliente['nombre_contacto1'];
$parentesco_contacto1                = $info_cliente['parentesco_contacto1'];
$tel_contacto1                       = $info_cliente['tel_contacto1'];
$direccion_contacto1                 = $info_cliente['direccion_contacto1'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$url_img_foto_min_cli                = $info_cliente['url_img_foto_min_cli'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$cod_grupo_area                      = $info_cliente['cod_grupo_area'];
$cod_grupo_area_cargo                = $info_cliente['cod_grupo_area_cargo'];
$nom_ape                             = $nombres.' '.$apellido1;
/* --------------------------------------------------------------------------------------------------------------*/
$obtener_cod_hist = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica, motivo, fecha_ymd FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente' AND cod_estado_facturacion = '1'";
$consultar_cod_hist = mysqli_query($conectar, $obtener_cod_hist) or die(mysqli_error($conectar));
$info_cod_hist = mysqli_fetch_assoc($consultar_cod_hist);

$motivo                              = $info_cod_hist['motivo'];
$fecha_ymd                           = $info_cod_hist['fecha_ymd'];
?>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="reg_asignar_firma_tactil_paciente_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th style="text-align:center" bgcolor="#FAC090" align="center" valign="middle"><a href="../admin/reg_asignar_profesional_paciente.php?cod_cliente=<?php echo $cod_cliente ?>&pagina=../admin/lista_crear_cita.php">IR A LA VERSION DE FIRMA NO TACTIL</a></th>
        </tr>
    </thead>
</table>
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
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
        <th style="text-align:center" bgcolor="#FAC090">TIPO DE IDENTIFICACIÓN</th>
        <th style="text-align:center" bgcolor="#FAC090">NUMERO</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center"><?php echo ($nombre_tipo_doc) ?></td>
        <td style="text-align:center"><?php echo ($cedula) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
    <th style="text-align:center" bgcolor="#FAC090">MOTIVO CONSULTA</th>
    </tr></thead>
    <tbody>
    <tr>
<td style="text-align:center"><?php echo ($motivo) ?></td>
    </tr></tbody>
</table>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th style="text-align:center; width:100%" bgcolor="#FAC090">IMAGEN FIRMA</th>
        </tr>
</thead>
    <tbody>
        <tr>
            <td style="text-align:center; width:100%">
                <div id="area_firma">
                    <div id="area_firma_actualizar" style="border: 1px solid #000; height: 150px; width: 400px;">
                        <canvas class="img_firma" id="img_firma" height="150" width="400"></canvas>
                        <input type="button" value="Tomar Firma" onClick="tomar_firma(<?php echo $cod_historia_clinica ?>, <?php echo $cod_cliente ?>, <?php echo $cedula ?>)">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" id="borrar_firma" value="Borrar Firma">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th style="text-align:center; width:100%" bgcolor="#FAC090">FIRMA TOMADA</th>
        </tr>
        <tr>
            <td style="text-align:center; width:100%"><div align="center" id="vista_firma_tomada">
                <input type="hidden" name="url_img_firma" value="">
                </div><input type="checkbox" id="foco_firma">
            </td>
        </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>

<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">

<input type="hidden" name="pagina" value="<?php echo $pagina_red ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {
$('#area_firma').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:0});
});

function tomar_firma(cod_historia_clinica, cod_cliente, cedula) {
    html2canvas([document.getElementById('img_firma')], {
        onrendered: function (canvas) {
            //var canvas_img_data = canvas.toDataURL('image/png');
            var canvas_img_data = canvas.toDataURL('image/jpg');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
            //ajax call to save image inside folder
            $.ajax({
                url: '../admin/guardar_img_firma_tactil_ajax.php',
                data: { cod_historia_clinica:cod_historia_clinica, cod_cliente:cod_cliente, cedula:cedula, img_data:img_data },
                type: 'post',
                dataType: 'json',
                success: function (url_firma_ajax) {
                
                document.getElementById('vista_firma_tomada').innerHTML = '<input type="hidden" name="url_img_firma" value="'+url_firma_ajax+'">' + '<img src="'+url_firma_ajax+'"/>';
                //$("#area_firma_actualizar").load("../admin/cargar_firma_vacia_ajax.php");
                document.getElementById('foco_firma').focus();
                }
            });
        }
    });
}
</script>

<script>
$("#borrar_firma").click(function() {
//$("#area_firma_actualizar").load("");
location.reload()
document.getElementById('foco_firma').focus();
});
</script>

</body>
</html>