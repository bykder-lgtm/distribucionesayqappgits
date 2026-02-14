<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link href="../estilo_css/jquery.signaturepad.css" rel="stylesheet">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/numeric-1.2.6.min.js"></script> 
<script src="../js/bezier.js"></script>
<script type='text/javascript' src="../js/html2canvas.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<a href="../admin/lista_paciente_buscar.php"><h4>Asignar Médico al Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
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
$fecha_ymd                           = date("Y-m-d");
$fecha_hora                          = date("H:i:00");
$pagina_red                          = $_SERVER['PHP_SELF'];
$cod_cliente                         = intval($_GET['cod_cliente']);

$obtener_cedula = "SELECT cod_cliente, cedula, nombres, fecha_nac_ymd, senas_particulares, nombre_procedencia, 
nombre_sexo, nombre_especie, nombre_raza, nombre_color, nombre_contacto1, identificacion_contacto1, 
estrato_contacto1, municipio_contacto1, ocupacion_contacto1, tel_contacto1, direccion_contacto1, correo_contacto1, 
edad_mes, edad_anyo, url_img_foto_min AS url_img_foto_min_cli, url_img_firma_min AS url_img_firma_min_cli, cod_empresa
FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$datos_consulta = mysqli_fetch_assoc($consultar_cedula);

$cod_cliente                     = $datos_consulta['cod_cliente'];
$cedula                          = $datos_consulta['cedula'];
$nombres                         = $datos_consulta['nombres'];
$fecha_nac_ymd                   = $datos_consulta['fecha_nac_ymd'];
$edad_mes                        = $datos_consulta['edad_mes'];
$edad_anyo                       = $datos_consulta['edad_anyo'];
$senas_particulares              = $datos_consulta['senas_particulares'];
$nombre_procedencia              = $datos_consulta['nombre_procedencia'];
$nombre_sexo                     = $datos_consulta['nombre_sexo'];
$nombre_especie                  = $datos_consulta['nombre_especie'];
$nombre_raza                     = $datos_consulta['nombre_raza'];
$nombre_color                    = $datos_consulta['nombre_color'];
$nombre_contacto1                = $datos_consulta['nombre_contacto1'];
$identificacion_contacto1        = $datos_consulta['identificacion_contacto1'];
$estrato_contacto1               = $datos_consulta['estrato_contacto1'];
$municipio_contacto1             = $datos_consulta['municipio_contacto1'];
$ocupacion_contacto1             = $datos_consulta['ocupacion_contacto1'];
$tel_contacto1                   = $datos_consulta['tel_contacto1'];
$correo_contacto1                = $datos_consulta['correo_contacto1'];
$direccion_contacto1             = $datos_consulta['direccion_contacto1'];
$url_img_foto_min_cli            = $datos_consulta['url_img_foto_min_cli'];
$url_img_firma_min_cli           = $datos_consulta['url_img_firma_min_cli'];
$cod_empresa                     = $datos_consulta['cod_empresa'];
/* --------------------------------------------------------------------------------------------------------------*/
$obtener_cod_hist = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica, motivo, fecha_ymd FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente' AND cod_estado_facturacion = '1'";
$consultar_cod_hist = mysqli_query($conectar, $obtener_cod_hist) or die(mysqli_error($conectar));
$info_cod_hist = mysqli_fetch_assoc($consultar_cod_hist);

$cod_historia_clinica                = $info_cod_hist['cod_historia_clinica'];
$motivo                              = $info_cod_hist['motivo'];
$fecha_ymd_hist                      = $info_cod_hist['fecha_ymd'];

$_SESSION['cod_cliente_sesion']      = $cod_cliente;
$_SESSION['cedula_sesion']           = $cedula;

if ($_SESSION['cod_cliente_sesion'] == $cod_cliente_sesion) { $url_img_foto_sesion = $url_img_foto_sesion; $url_img_firma_sesion = $url_img_firma_sesion; } else { $url_img_foto_sesion = ''; $url_img_firma_sesion = ''; }
?>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="reg_asignar_cita_foto_paciente_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($cod_historia_clinica <> '') { ?>
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th style="text-align:center" bgcolor="#FAC090" align="center" valign="middle"><img src="../imagenes/advertencia.gif"/>LA ULTIMA VEZ QUE ASISTIÓ <?php echo ($fecha_ymd_hist) ?> Y EL MOTIVO FUE <?php echo ($motivo) ?> (HC - <?php echo ($cod_historia_clinica) ?>)<img src="../imagenes/advertencia.gif"/></th>
        </tr>
    </thead>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th style="text-align:center" bgcolor="#FAC090" align="center" valign="middle"><a href="../admin/reg_asignar_profesional_paciente.php?cod_cliente=<?php echo $cod_cliente ?>&pagina=../admin/lista_crear_cita.php">IR A LA VERSION NO TACTIL</a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th style="text-align:center; width:50%" bgcolor="#FAC090" valign="middle"><a href="../admin/edit_cargar_foto_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_foto_min_cli ?>" class="img-polaroid" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
    <tr>
        <th>NOMBRE</th>
        <th>ESPECIE</th>
        <th>RAZA</th>
    </tr>
</thead>
<tbody><tr>
<td><input class="input-block-level" name="nombres" type="text" value="<?php echo $nombres ?>" required/></td>

<td style="text-align:left">
<div class="input-append date">
    <select name="nombre_especie" id="select_nombre_especie" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
    <?php if (isset($nombre_especie)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $consulta2_sql = ("SELECT cod_especie, nombre_especie FROM tbl15_especie ORDER BY cod_especie ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_especie) and $nombre_especie == $datos2['nombre_especie']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['nombre_especie'];
    $nombre = $datos2['nombre_especie'];
    echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
    </select>

<input type="text" id="input_nombre_especie" name="input_nombre_especie" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_especie_mas"><button type="button" id="func_boton_nombre_especie_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_especie_reg"><button type="button" id="func_boton_nombre_especie_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:left">
<div class="input-append date">
    <select name="nombre_raza" id="select_nombre_raza" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
    <?php if (isset($nombre_raza)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza ORDER BY cod_raza ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_raza) and $nombre_raza == $datos2['nombre_raza']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['nombre_raza'];
    $nombre = $datos2['nombre_raza'];
    echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
    </select>

<input type="text" id="input_nombre_raza" name="input_nombre_raza" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_raza_mas"><button type="button" id="func_boton_nombre_raza_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_raza_reg"><button type="button" id="func_boton_nombre_raza_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

</tr>
    <tr>
        <th>COLOR</th>
        <th>SEXO</th>
        <th>FECHA NACIMIENTO</th>
    </tr>
    <tr>
        <td><input class="input-block-level" name="nombre_color" type="text" value="<?php echo $nombre_color ?>" /></td>
        <td style="text-align:left">
            <select name="nombre_sexo" id="select_nombre_sexo" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
            <?php if (isset($nombre_sexo)) { echo "<option value='' >Selecione</option>";
            } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_sexo, nombre_sexo FROM tbl15_sexo ORDER BY cod_sexo ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_sexo) and $nombre_sexo == $datos2['nombre_sexo']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_sexo'];
            $nombre = $datos2['nombre_sexo'];
            echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
        </td>
        <td><input class="input-block-level" name="fecha_nac_ymd" type="date" value="<?php echo $fecha_nac_ymd ?>" required/></td>
    </tr>
    <tr>
        <th>EDAD (MESES)</th>
        <th>SEÑAS PARTICULARES</th>
        <th>PROCEDENCIA</th>
    </tr>
    <tr>
        <td>
            <input class="input-block-level" name="edad_mes" id="edad_mes" type="number" value="<?php echo $edad_mes ?>" />
            <strong>EDAD (AÑOS)</strong>
            <input class="input-block-level" name="edad_anyo" id="edad_anyo" type="number" value="<?php echo $edad_anyo ?>" />
        </td>
        <td><input class="input-block-level" name="senas_particulares" type="text" value="<?php echo $senas_particulares ?>" /></td>

        <td style="text-align:left">
            <select name="nombre_procedencia" id="select_nombre_procedencia" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
            <?php if (isset($nombre_procedencia)) { echo "<option value='' >Selecione</option>";
            } else { echo  "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_procedencia, nombre_procedencia FROM tbl15_procedencia ORDER BY cod_procedencia ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_procedencia) and $nombre_procedencia == $datos2['nombre_procedencia']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_procedencia'];
            $nombre = $datos2['nombre_procedencia'];
            echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
        </td>
    </tr>
</tbody>
</table>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="left" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>DATOS DEL PROPIETARIO</th></tr></thead></table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
    <tr>
        <th>NOMBRE</th>
        <th>IDENTIFICACIÓN</th>
        <th>DIRECCIÓN</th>
    </tr>
    <tr>
    <tr>
        <td><input class="input-block-level" name="nombre_contacto1" id="nombre_empresa" type="text" value="<?php echo $nombre_contacto1 ?>" required /></td>
        <td><input class="input-block-level" name="identificacion_contacto1" id="nombre_empresa" type="text" value="<?php echo $identificacion_contacto1 ?>"/></td>
        <td><input class="input-block-level" name="direccion_contacto1" id="direccion_empresa" type="text" value="<?php echo $direccion_contacto1 ?>"/></td>
    </tr>
    <tr>
        <th>ESTRATO</th>
        <th>MUNICIPIO</th>
        <th>TELÉFONO</th>
    </tr>
    <tr>
        <td><input class="input-block-level" name="estrato_contacto1" id="estrato_empresa" type="number" value="<?php echo $estrato_contacto1 ?>"/></td>
        <td><input class="input-block-level" name="municipio_contacto1" id="municipio_contacto1" type="text" value="<?php echo $municipio_contacto1 ?>"/></td>
        <td><input class="input-block-level" name="tel_contacto1" id="telefono_empresa" type="text" value="<?php echo $tel_contacto1 ?>"/></td>
    </tr>
    <tr>
        <th>CORREO</th>
        <th>OCUPACIÓN</th>
    </tr>
    <tr>
        <td><input class="input-block-level" name="correo_contacto1" id="correo_empresa" type="text" value="<?php echo $correo_contacto1 ?>"/></td>
        <td><input class="input-block-level" name="ocupacion_contacto1" id="ocupacion_empresa" type="text" value="<?php echo $ocupacion_contacto1 ?>"/></td>
        <input class="input-block-level" name="cod_empresa" id="cod_empresa" type="hidden" value="<?php echo $cod_empresa ?>"/>
    </tr>
</thead>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
    <tr>
        <th>MOTIVO DE LA CONSULTA</th>
        <th>COSTO</th>
        <th>PROFESIONAL</th>
        <th>FECHA</th>
        <th>HORA</th>
    </tr>
    <tr>
    <tr>
        <td><input class="input-block-level" name="motivo" type="text" value="" required/></td>
        <td><input class="input-block-level" name="costo_motivo_consulta" type="number" value="" required/></td>

        <td style="text-align:center">
        <div class="input-append date">
            <select id="select_profesional" name="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <?php $sql_consulta = "SELECT tbl15_administrador.cod_administrador, tbl15_administrador.nombres, tbl15_administrador.apellidos, tbl15_administrador.cod_seguridad, tbl15_administrador.cod_tipo_historia_clinica, 
            tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica
            FROM tbl15_tipo_historia_clinica INNER JOIN tbl15_administrador ON tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_administrador.cod_tipo_historia_clinica
            WHERE (tbl15_administrador.cod_seguridad = 1) ORDER BY nombres ASC";
            $resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
            while ($contenedor = mysqli_fetch_assoc($resultado)) { 
            $cod_administrador = $contenedor['cod_administrador'];
            $nombres = $contenedor['nombres'];
            $apellidos = $contenedor['apellidos'];
            $nombre_tipo_historia_clinica = $contenedor['nombre_tipo_historia_clinica'];
            ?>
            <option value="<?php echo $cod_administrador ?>"><?php echo $nombres.' '.$apellidos ?></option>
            <?php } ?>
            </select>
        <input type="text" id="input_profesional" name="input_profesional" value="" class="form-control">

        <span class="add-on">
        <div id="boton_profesional_mas"><button type="button" id="func_boton_profesional_mas"><i class="fa fa-plus-circle"></i></button></div>
        <div id="boton_profesional_reg"><button type="button" id="func_boton_profesional_reg"><i class="fa fa-check"></i></button></div>
        </span>
        </div>
    </td>
    <td><input class="input-block-level" name="fecha_ymd" type="date" value="<?php echo $fecha_ymd ?>" required/></td>
    <td><input class="input-block-level" name="fecha_hora" type="time" value="<?php echo $fecha_hora ?>" required/></td>
    </tr>
</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--
<table align="left" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr><th style="text-align:center; width:20%" bgcolor="#FAC090">VISTA PREVIA</th><th style="text-align:center; width:80%" bgcolor="#FAC090">IMAGEN TOMADA</th></tr></thead>
    <tbody>
        <tr>
            <td style="text-align:center; width:20%"><div align="center" id="vista_previa_camara"></div>
            <form>
                <input type="button" value="Tomar Foto" onClick="tomar_foto(<?php echo $cod_cliente ?>, <?php echo $cedula ?>)">
            </form>
        </td>
            <td style="text-align:left; width:80%">
                <div align="left" id="vista_imagen_tomada">
<input type="hidden" name="url_img_foto" value="<?php echo $url_img_foto_sesion ?>"><img src="<?php echo $url_img_foto_sesion ?>"/>
            </div>
        </td>
        </tr>
    </tbody>
</table>
-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina_red ?>">
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1****************************************************************************************************** -->
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/json2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<!--
<script type="text/javascript" src="js/webcam.js"></script>
<script language="JavaScript">
Webcam.set({ width: 300, height: 300, image_format: 'jpeg', jpeg_quality: 90 });
Webcam.attach( '#vista_previa_camara' );

function tomar_foto(cod_cliente, cedula) {
Webcam.snap( function(data_uri) {
document.getElementById('vista_imagen_tomada').innerHTML = '<img src="../imagenes/loader.gif"/>';
Webcam.upload( data_uri, '../admin/guardar_img_foto_webcam_ajax.php', function(code, url_foto_ajax) { document.getElementById('vista_imagen_tomada').innerHTML = '<input type="hidden" name="url_img_foto" value="'+url_foto_ajax+'">' + '<img src="'+url_foto_ajax+'"/>';
} ); } ); 
}
</script>
-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

    $("#select_nombre_especie").change(function(){

        var valor = $("#select_nombre_especie").val();
        var campo = 'nombre_especie';
        var tipo_ajax = 'nombre_especie';
            
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/recargar_especie_raza_select_dependiente_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#select_nombre_raza').html(resp);
            }
        });

    });

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

    $("#fecha_nac_ymd").change(function(){

        var fecha_nac_ymd = $("#fecha_nac_ymd").val();
        var frag = "";
        var edad_anyo = "";
        var edad_mes = "";

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/convertir_facha_nac_en_anyos_meses_ajax.php",
            data: "fecha_nac_ymd="+fecha_nac_ymd,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                frag = resp.split("-");
                edad_anyo = frag[0];
                edad_mes = frag[1];
                document.getElementById("edad_anyo").value = edad_anyo;
                document.getElementById("edad_mes").value = edad_mes;
            }
        });

    });

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_especie_reg').hide();
$('#input_nombre_especie').hide();

$("#func_boton_nombre_especie_mas").click(function(){
    $('#input_nombre_especie').show();
    $('#boton_nombre_especie_reg').show();
    $('#select_nombre_especie').hide();
    $('#boton_nombre_especie_mas').hide();
    document.getElementById("input_nombre_especie").focus();
});

$("#func_boton_nombre_especie_reg").click(function(){
    $('#boton_nombre_especie_mas').show();
    $('#select_nombre_especie').show();
    $('#boton_nombre_especie_reg').hide();
    $('#input_nombre_especie').hide();

        var valor = $("#input_nombre_especie").val();
        var campo = 'nombre_especie';
        var tipo_ajax = 'nombre_especie';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_tipo_doc();
                Cargar_tipo_doc(valor, campo);
            }
        });

});

function Cargar_tipo_doc(valor, campo) {
var capa_cargar_datos = 'select_nombre_especie';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_nombre_especie';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_raza_reg').hide();
$('#input_nombre_raza').hide();

$("#func_boton_nombre_raza_mas").click(function(){
    $('#input_nombre_raza').show();
    $('#boton_nombre_raza_reg').show();
    $('#select_nombre_raza').hide();
    $('#boton_nombre_raza_mas').hide();
    document.getElementById("input_nombre_raza").focus();
});

$("#func_boton_nombre_raza_reg").click(function(){
    $('#boton_nombre_raza_mas').show();
    $('#select_nombre_raza').show();
    $('#boton_nombre_raza_reg').hide();
    $('#input_nombre_raza').hide();

    var valor = $("#input_nombre_raza").val();
    var nombre_especie = $("#select_nombre_especie").val();
    var campo = 'nombre_raza';
    var tipo_ajax = 'nombre_raza';

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/guardar_consulta_select_ajax.php",
        data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax+"&nombre_especie="+nombre_especie,
        success: function(resp){
            $('#respuesta_ajax').html(resp);
            Limpiar_tipo_doc();
            Cargar_tipo_doc(valor, campo, nombre_especie);
        }
    });

});

function Cargar_tipo_doc(valor, campo, nombre_especie) {
var capa_cargar_datos = 'select_nombre_raza';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo, 'nombre_especie': nombre_especie });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_nombre_raza';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_profesional_reg').hide();
$('#input_profesional').hide();

$("#func_boton_profesional_mas").click(function(){
    $('#input_profesional').show();
    $('#boton_profesional_reg').show();
    $('#select_profesional').hide();
    $('#boton_profesional_mas').hide();
    document.getElementById("input_profesional").focus();
});

$("#func_boton_profesional_reg").click(function(){
    $('#boton_profesional_mas').show();
    $('#select_profesional').show();
    $('#boton_profesional_reg').hide();
    $('#input_profesional').hide();

var valor = $("#input_profesional").val();
var campo = 'profesional';
var tipo_ajax = 'profesional';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_tipo_doc();
        Cargar_tipo_doc(valor, campo);
    }
});

});

function Cargar_tipo_doc(valor, campo) {
var capa_cargar_datos = 'select_profesional';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_profesional';
$("#"+limpiar_datos).val("");
}

});
</script>


<script type="text/javascript">
$(function() {
$("#nombre_empresa").autocomplete({
source: "autocompletar_nombre_empresa_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
console.log(this.name);
console.log(this.id);

$('#cod_empresa').val(ui.item.cod_empresa);
$('#nombre_empresa').val(ui.item.nombre_empresa);
$('#nit_empresa').val(ui.item.nit_empresa);
$('#direccion_empresa').val(ui.item.direccion_empresa);
$('#estrato_empresa').val(ui.item.estrato_empresa);
$('#municipio_empresa').val(ui.item.municipio_empresa);
$('#telefono_empresa').val(ui.item.telefono_empresa);
$('#correo_empresa').val(ui.item.correo_empresa);
$('#ocupacion_empresa').val(ui.item.ocupacion_empresa);
}
});
});
</script>

</body>
</html>