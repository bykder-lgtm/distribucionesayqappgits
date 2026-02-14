<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery-3.1.1.min.js"></script> 

<script language="javascript" src="../admin/class_php/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_medicamento_formulado_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body id="pageBody" onLoad="myajax = new isiAJAX();">

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
<a href="#"><h4>Manipulación de Alimentos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_manipulacion_alimento           = intval($_GET['cod_manipulacion_alimento']);
$cod_historia_clinica                = intval($_GET['cod_historia_clinica']);
$cod_cliente                         = intval($_GET['cod_cliente']);
$pagina                              = addslashes($_GET['pagina']);
$pagina_local                        = $_SERVER['PHP_SELF'];
$fecha_hoy_time                      = strtotime(date("Y/m/d"));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_manipulacion_alimento = "SELECT * FROM tbl15_manipulacion_alimento WHERE cod_manipulacion_alimento = '".($cod_manipulacion_alimento)."'";
$consultar_manipulacion_alimento = mysqli_query($conectar, $obtener_manipulacion_alimento) or die(mysqli_error($conectar));
$info_manipulacion_alimento= mysqli_fetch_assoc($consultar_manipulacion_alimento);

$cod_cliente                          = $info_manipulacion_alimento['cod_cliente'];
$cod_administrador                    = $info_manipulacion_alimento['cod_administrador'];
$motivo                               = $info_manipulacion_alimento['motivo_manipulacion_alimento'];
$motivo_manipulacion_alimento         = $info_manipulacion_alimento['motivo_manipulacion_alimento'];
$ant_tos_expectora                    = $info_manipulacion_alimento['ant_tos_expectora'];
$ant_fiebre_febricula                 = $info_manipulacion_alimento['ant_fiebre_febricula'];
$ant_lesion_piel_unyas                = $info_manipulacion_alimento['ant_lesion_piel_unyas'];
$ant_piel_ojos_amarillos              = $info_manipulacion_alimento['ant_piel_ojos_amarillos'];
$ant_purito                           = $info_manipulacion_alimento['ant_purito'];
$rec_piel                             = $info_manipulacion_alimento['rec_piel'];
$rec_unyas                            = $info_manipulacion_alimento['rec_unyas'];
$rec_mucosa                           = $info_manipulacion_alimento['rec_mucosa'];
$rec_aparato_gastro                   = $info_manipulacion_alimento['rec_aparato_gastro'];
$rec_extemidad                        = $info_manipulacion_alimento['rec_extemidad'];
$rec_obser                            = $info_manipulacion_alimento['rec_obser'];
$resexalab_cult_faringeo              = $info_manipulacion_alimento['resexalab_cult_faringeo'];
$resexalab_koh_cult_unyas             = $info_manipulacion_alimento['resexalab_koh_cult_unyas'];
$resexalab_bk_seriado                 = $info_manipulacion_alimento['resexalab_bk_seriado'];
$resexalab_observ                     = $info_manipulacion_alimento['resexalab_observ'];
$resexalab_nombre_lab_clinico         = $info_manipulacion_alimento['resexalab_nombre_lab_clinico'];
$resexalab_nombre_bacteriologo        = $info_manipulacion_alimento['resexalab_nombre_bacteriologo'];
$resexalab_numero_tajeta              = $info_manipulacion_alimento['resexalab_numero_tajeta'];
$concepto_manipulador                 = $info_manipulacion_alimento['concepto_manipulador'];
$concepto_tratamiento_manipulador     = $info_manipulacion_alimento['concepto_tratamiento_manipulador'];
$concepto_descrip_tratamiento         = $info_manipulacion_alimento['concepto_descrip_tratamiento'];
$concepto_requiere_reubicado          = $info_manipulacion_alimento['concepto_requiere_reubicado'];
$concepto_fecha_cntl_medi             = $info_manipulacion_alimento['concepto_fecha_cntl_medi'];
$control_medico_dia                   = $info_manipulacion_alimento['control_medico_dia'];
$control_medico_mes                   = $info_manipulacion_alimento['control_medico_mes'];
$control_medico_anyo                  = $info_manipulacion_alimento['control_medico_anyo'];
$afiliacion_eps                       = $info_manipulacion_alimento['afiliacion_eps'];
$afiliacion_ars                       = $info_manipulacion_alimento['afiliacion_ars'];
$fecha_mes                            = $info_manipulacion_alimento['fecha_mes'];
$fecha_anyo                           = $info_manipulacion_alimento['fecha_anyo'];
$fecha_ymd_hora                       = $info_manipulacion_alimento['fecha_ymd'];
$fecha_dmy                            = $info_manipulacion_alimento['fecha_dmy'];
$fecha_time                           = $info_manipulacion_alimento['fecha_time'];
$fecha_reg_time                       = $info_manipulacion_alimento['fecha_reg_time'];
$cuenta                               = $info_manipulacion_alimento['cuenta'];
$cuenta_reg                           = $info_manipulacion_alimento['cuenta_reg'];
$fecha_hora                           = date("H:i:s", $fecha_time);
$cod_grupo_area                       = $info_manipulacion_alimento['cod_grupo_area'];
$cod_grupo_area_cargo                 = $info_manipulacion_alimento['cod_grupo_area_cargo'];
$costo_motivo_consulta                = $info_manipulacion_alimento['costo_motivo_consulta'];
$cod_factura                          = $info_manipulacion_alimento['cod_factura'];
$nombre_ocupacion                     = $info_manipulacion_alimento['nombre_ocupacion'];
$nombre_empresa                       = $info_manipulacion_alimento['nombre_empresa'];
$cargo_empresa                        = $info_manipulacion_alimento['cargo_empresa'];
$area_empresa                         = $info_manipulacion_alimento['area_empresa'];
$ciudad_empresa                       = $info_manipulacion_alimento['ciudad_empresa'];
$nombre_empresa_contratante           = $info_manipulacion_alimento['nombre_empresa_contratante'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_estructura_manipulacion_alimento = "SELECT nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, motivo, cod_cliente,  
cod_administrador, nombre_arl, nombre_tipo_regimen FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_manipulacion_alimento = mysqli_query($conectar, $obtener_estructura_manipulacion_alimento) or die(mysqli_error($conectar));
$info_estructura_manipulacion_alimento= mysqli_fetch_assoc($consultar_estructura_manipulacion_alimento);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_empresa= "SELECT razonsocial_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '".($nombre_empresa)."'";
$consultar_empresa= mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$tbl15_info_empresa= mysqli_fetch_assoc($consultar_empresa);

$razonsocial_empresa                 = $tbl15_info_empresa['razonsocial_empresa'];
$direccion_empresa                   = $tbl15_info_empresa['direccion_empresa'];
$telefono_empresa                    = $tbl15_info_empresa['telefono_empresa'];
$nit_empresa                         = $tbl15_info_empresa['nit_empresa'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_prof = "SELECT nombres AS nombre_prof, apellidos AS apellidos_prof FROM tbl15_administrador WHERE cod_administrador = '".($cod_administrador)."'";
$consultar_prof = mysqli_query($conectar, $obtener_prof) or die(mysqli_error($conectar));
$info_prof = mysqli_fetch_assoc($consultar_prof);

$nombre_prof                         = $info_prof['nombre_prof'];
$apellidos_prof                      = $info_prof['apellidos_prof'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_firma_min AS url_img_firma_min_cli, direccion, lugar_residencia,
tel_cliente, cod_entidad, fecha_nac_ymd, nombre_arl, nombre_tipo_regimen FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$nombre_sexo                         = $info_cliente['nombre_sexo'];
$direccion                           = $info_cliente['direccion'];
$lugar_residencia                    = $info_cliente['lugar_residencia'];
$tel_cliente                         = $info_cliente['tel_cliente'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$fecha_nac_ymd                       = $info_cliente['fecha_nac_ymd'];
$fecha_nac_time                      = strtotime($fecha_nac_ymd);
$diferencia_edad                     = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
$nom_ape                             = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '".($cod_entidad)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($fecha_ymd_hora == '') { $fecha_ymd_hora = date("Y/m/d H:i:s"); } 
else { $fecha_ymd_hora = $fecha_ymd_hora.' '.$fecha_hora; } ?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_manipulacion_alimento_reg.php">
<fieldset>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
<th style="text-align:center"><strong>CERTIFICADO MEDICO – MANIPULACION DE ALIMENTOS <a href="../admin/actualizar_campos_no_cargados_manipulacion_alimento.php?cod_manipulacion_alimento=<?php echo $cod_manipulacion_alimento?>&cod_cliente=<?php echo $cod_cliente?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina_local?>"><img src="../imagenes/btn_recargar.png" alt=""></a></strong></th>

</tr>
</table>

<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="6">FECHA - HORA</td>
  </tr>
  <tr>
      <td style="text-align:center"><div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_ymd_hora ?>" required></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>&nbsp; 1. IDENTIFICACION DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td>1.1 </td>
    <td colspan="3">Apellidos: <?php echo $apellido1 ?></td>
    <td>1.2 </td>
    <td colspan="2">Nombres: <?php echo $nombres ?></td>
  </tr>
  <tr>
    <td>1.3 </td>
    <td colspan="3">Tipo de documento: <?php echo $nombre_tipo_doc ?></td>
    <td>1.4 </td>
    <td colspan="2">Numero documento: <?php echo $cedula ?></td>
  </tr>
  <tr>
    <td>1.5 </td>
    <td>Sexo: </td>
    <td colspan="2">
        <table border="1" cellspacing="0" cellpadding="0" align="left" width="170">
          <tr>
            <td>&nbsp;&nbsp;<?php echo $nombre_sexo ?>&nbsp;&nbsp;</td>
          </tr>
      </table></td>
    <td>1.6 </td>
    <td colspan="2">Edad: <?php echo $edad_anyo ?> Años</td>
  </tr>
 <tr>
    <td></td>
    <td colspan="3">Motivo Consulta: 
<select name="motivo_manipulacion_alimento" id="<?php echo $cod_manipulacion_alimento ?>" required>
<?php if (isset($motivo_manipulacion_alimento)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($motivo_manipulacion_alimento) and $motivo_manipulacion_alimento == $datos2['motivo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['motivo'];
$nombre = $datos2['motivo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
    <td></td>
    <td colspan="2"></td>
  </tr>

  <tr>
    <td>1.7 </td>
    <td colspan="2">Afiliación EPS: </td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="afiliacion_eps" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($afiliacion_eps=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="afiliacion_eps" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($afiliacion_eps=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>1.8 </td>
    <td>Régimen: </td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
    <td>&nbsp;<?php echo $nombre_tipo_regimen ?>&nbsp;
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>1.9 </td>
    <td colspan="6">Nombre Empresa: &nbsp;<?php echo $nombre_entidad ?>&nbsp;</td>
  </tr>
  <tr>
    <td>1.10 </td>
    <td colspan="2">Afiliación ARL: </td>
    <td ><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="afiliacion_ars" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($afiliacion_ars=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="afiliacion_ars" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($afiliacion_ars=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>1.11 </td>
    <td colspan="2">Nombre aseguradora: <?php echo $nombre_arl ?></td>
  </tr>
  <tr>
    <td>1.12 </td>
    <td colspan="6">Dirección residencia: <?php echo $lugar_residencia ?></td>
  </tr>
  <tr>
    <td>1.13 </td>
    <td colspan="3">Barrio: <?php echo $direccion ?></td>
    <td>1.14 </td>
    <td colspan="2">Teléfonos: <?php echo $tel_cliente ?></td>
  </tr>
  <tr>
    <td>1.15 </td>
    <td colspan="6">Nombre del establecimiento donde labora:  <?php echo $nombre_empresa ?></td>
  </tr>
  <tr>
    <td>1.16 </td>
    <td colspan="6">Dirección establecimiento: <?php echo $direccion_empresa ?></td>
  </tr>
  <tr>
    <td>1.17 </td>
    <td colspan="3">Barrio: <?php echo $direccion_empresa ?></td>
    <td>1.18 </td>
    <td colspan="2">Teléfonos: <?php echo $telefono_empresa ?></td>
  </tr>
  <tr>
    <td>1.19 </td>
    <td colspan="3">Cargo que desempeña: <?php echo $cargo_empresa ?></td>
    <td>1.20 </td>
    <td colspan="2">Área de trabajo: <?php echo $area_empresa ?></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>2. ANTECEDENTES INFECCIOSOS DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td colspan="6">El paciente ha presentado alguno de los siguientes síntomas en los últimos 15 o más días: </td>
    <td></td>
  </tr>
  <tr>
    <td>Tos con expectoración</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="ant_tos_expectora" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($ant_tos_expectora=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="ant_tos_expectora" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($ant_tos_expectora=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Fiebre o febrículas</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="ant_fiebre_febricula" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($ant_fiebre_febricula=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="ant_fiebre_febricula" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($ant_fiebre_febricula=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Lesiones en piel o uñas</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="ant_lesion_piel_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($ant_lesion_piel_unyas=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="ant_lesion_piel_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($ant_lesion_piel_unyas=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
  </tr>
  <tr>
    <td>Piel y ojos amarillos </td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="ant_piel_ojos_amarillos" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($ant_piel_ojos_amarillos=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="ant_piel_ojos_amarillos" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($ant_piel_ojos_amarillos=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Prurito</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;SI<input type="radio" name="ant_purito" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($ant_purito=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="ant_purito" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($ant_purito=='NO')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2"></td>
    <td></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>3. RECONOCIMIENTO MEDICO DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td rowspan="3">3.1 </td>
    <td colspan="6">Datos positivos al examen físico del manipulador de alimentos: </td>
  </tr>
  <tr>
    <td>Piel</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="rec_piel" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($rec_piel=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="rec_piel" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($rec_piel=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Uñas</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="rec_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($rec_unyas=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="rec_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($rec_unyas=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Mucosas</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="rec_mucosa" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($rec_mucosa=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="rec_mucosa" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($rec_mucosa=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>Aparato gastrointestinal</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="rec_aparato_gastro" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($rec_aparato_gastro=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="rec_aparato_gastro" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($rec_aparato_gastro=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Extremidades</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="rec_extemidad" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($rec_extemidad=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="rec_extemidad" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($rec_extemidad=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones:<input class="input-block-level" name="rec_obser" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $rec_obser ?>"/></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>4. RESULTADOS DE EXAMENES DE LABORATORIO </strong></td>
  </tr>
  <tr>
    <td rowspan="3">4.1 </td>
    <td colspan="6">Exámenes clínicos del manipulador de alimentos:<strong> </strong></td>
  </tr>
  <tr>
    <td >Cultivo faríngeo</td>
    <td colspan="2"><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="resexalab_cult_faringeo" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($resexalab_cult_faringeo=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="resexalab_cult_faringeo" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($resexalab_cult_faringeo=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">KOH + cultivo uñas negativo</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="resexalab_koh_cult_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($resexalab_koh_cult_unyas=='Positivo')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="resexalab_koh_cult_unyas" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($resexalab_koh_cult_unyas=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">BK Seriado (en caso de sintomático respiratorio)</td>
    <td colspan="2"><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;Positivo<input type="radio" name="resexalab_bk_seriado" id="<?php echo $cod_manipulacion_alimento ?>" value="Positivo" <?php echo ($resexalab_bk_seriado=='Positivo')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
  Negativo<input type="radio" name="resexalab_bk_seriado" id="<?php echo $cod_manipulacion_alimento ?>" value="Negativo" <?php echo ($resexalab_bk_seriado=='Negativo')?'checked':'' ?> />&nbsp;&nbsp;
Vacio<input type="radio" name="resexalab_bk_seriado" id="<?php echo $cod_manipulacion_alimento ?>" value="" <?php echo ($resexalab_bk_seriado=='')?'checked':'' ?> />&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones: <input class="input-block-level" name="resexalab_observ" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $resexalab_observ ?>"/></td>
  </tr>
  <tr>
    <td>4.2 </td>
    <td colspan="6">Nombre del tbl15_laboratorio clínico: <input class="input-block-level" name="resexalab_nombre_lab_clinico" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $resexalab_nombre_lab_clinico ?>"/></td>
  </tr>
  <tr>
    <td>4.3 </td>
    <td colspan="6">Nombre y apellido del bacteriólogo que realizo el análisis: <input class="input-block-level" name="resexalab_nombre_bacteriologo" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $resexalab_nombre_bacteriologo ?>"/></td>
  </tr>
  <tr>
    <td>4.4 </td>
    <td colspan="6">Número de tarjeta profesional: <input class="input-block-level" name="resexalab_numero_tajeta" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $resexalab_numero_tajeta ?>"/></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="3"><strong>5. CONCEPTO MEDICO Y TRATAMIENTO</strong></td>
  </tr>
  <tr>
    <td>5.1</td>
    <td>Concepto médico del manipulador de alimentos: </td>
    <td ><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>Apto<input type="radio" name="concepto_manipulador" id="<?php echo $cod_manipulacion_alimento ?>" value="Apto" <?php echo ($concepto_manipulador=='Apto')?'checked':'' ?> required>
&nbsp;&nbsp;&nbsp;No Apto<input type="radio" name="concepto_manipulador" id="<?php echo $cod_manipulacion_alimento ?>" value="No Apto" <?php echo ($concepto_manipulador=='No Apto')?'checked':'' ?> /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.2</td>
    <td>El manipulador de alimentos requiere tratamiento: </td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>SI<input type="radio" name="concepto_tratamiento_manipulador" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($concepto_tratamiento_manipulador=='SI')?'checked':'' ?> required>
&nbsp;&nbsp;&nbsp;NO<input type="radio" name="concepto_tratamiento_manipulador" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($concepto_tratamiento_manipulador=='NO')?'checked':'' ?> /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.3</td>
    <td colspan="2">Descripción tratamiento: <input class="input-block-level" name="concepto_descrip_tratamiento" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $concepto_descrip_tratamiento ?>"/></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$obtener_medicamento_formulado = "SELECT * FROM tbl15_medicamento_formulado WHERE cod_manipulacion_alimento = '".($cod_manipulacion_alimento)."'";
$consultar_medicamento_formulado = mysqli_query($conectar, $obtener_medicamento_formulado) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_medicamento_formulado);

$coluna_anidad = 3 + $total_datos;
?>
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" rowspan="<?php echo $coluna_anidad ?>">5.4 </td>
    <td style="text-align:center" rowspan="<?php echo $coluna_anidad ?>">Medicamentos formulados: </td>
    <td style="text-align:center" rowspan="2">Nombre genérico</td>
    <td style="text-align:center" rowspan="2">Concentración</td>
    <td style="text-align:center" rowspan="2">Forma farmacéutica</td>
    <td style="text-align:center" rowspan="2">Dosis/vía de administración</td>
    <td style="text-align:center" colspan="2">Cantidad prescrita</td>
  </tr>
  <tr>
    <td>En Números</td>
    <td>En letras</td>
  </tr>
<?php while ($info_medicamento_formulado = mysqli_fetch_assoc($consultar_medicamento_formulado)) { 

$cod_medicamento_formulado       = $info_medicamento_formulado['cod_medicamento_formulado'];
$nombre_generico                 = $info_medicamento_formulado['nombre_generico'];
$concentracion                   = $info_medicamento_formulado['concentracion'];
$forma_farmaceutica              = $info_medicamento_formulado['forma_farmaceutica'];
$dosis                           = $info_medicamento_formulado['dosis'];
$cantidad_numero                 = $info_medicamento_formulado['cantidad_numero'];
$cantidad_letra                  = $info_medicamento_formulado['cantidad_letra'];
?>
  <tr>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'nombre_generico', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $nombre_generico;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'concentracion', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $concentracion;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'forma_farmaceutica', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $forma_farmaceutica;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'dosis', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $dosis;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cantidad_numero', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $cantidad_numero;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cantidad_letra', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $cantidad_letra;?>"></td>
  </tr>
<?php } ?>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
      <tr>
        <td bgcolor="#FAC090"><strong><a href="../admin/reg_medicamento_manipulacion_medicamento_reg.php?cod_manipulacion_alimento=<?php echo $cod_manipulacion_alimento ?>&cod_historia_clinica=0&cod_cliente=<?php echo $cod_cliente ?>&pagina=<?php echo $pagina_local ?>">Nuevo Medicamento <img src="../imagenes/mascie10.png" alt="Mas"></a> </strong></td>
      </tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td>5.5</td>
    <td colspan="2">El manipulador requiere ser reubicado    temporalmente fuera del área de alimentos:</td>
    <td><table border="1" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>SI<input type="radio" name="concepto_requiere_reubicado" id="<?php echo $cod_manipulacion_alimento ?>" value="SI" <?php echo ($concepto_requiere_reubicado=='SI')?'checked':'' ?> >
&nbsp;&nbsp;&nbsp;NO<input type="radio" name="concepto_requiere_reubicado" id="<?php echo $cod_manipulacion_alimento ?>" value="NO" <?php echo ($concepto_requiere_reubicado=='NO')?'checked':'' ?> /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.6</td>
    <td>Fecha control médico: </td>
    <td colspan="2"><div align="center">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>DIA</td>
          <td><input class="input-block-level" name="control_medico_dia" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $control_medico_dia ?>"/></td>
          <td>MES</td>
          <td><input class="input-block-level" name="control_medico_mes" type="text" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $control_medico_mes ?>"/></td>
          <td>AÑO</td>
          <td><input class="input-block-level" name="control_medico_anyo" type="number" id="<?php echo $cod_manipulacion_alimento ?>" value="<?php echo $control_medico_anyo ?>"/></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" width="681" colspan="4" valign="top"><strong>6. DATOS MEDICO TRATANTE</strong></td>
  </tr>
  <tr>
    <td><p>6.1 </p></td>
    <td><p>Firma: <img src="<?php echo $propietario_url_firma_emp ?>" height="60px"/></p></td>
    <td><p>6.2 </p></td>
    <td><p>Nombre y apellido: <?php echo $propietario_nombres_apellidos_emp ?></p></td>
  </tr>
  <tr>
    <td><p>6.3 </p></td>
    <td><p>Tipo de documento: CC</p></td>
    <td><p>6.3 </p></td>
    <td><p>Número de documento: <?php echo $propietario_nit_emp ?></p></td>
  </tr>
  <tr>
    <td><p>6.5 </p></td>
    <td><p>Registro medico: <?php echo $reg_medico_emp ?></p></td>
    <td><p>6.6 </p></td>
    <td><p>Institución donde labora: <?php echo $direccion_emp ?></p></td>
  </tr>
  <tr>
    <td><p>6.7 </p></td>
    <td><p>Dirección: <?php echo $direccion_emp ?></p></td>
    <td><p>6.8 </p></td>
    <td><p>Teléfono: <?php echo $telefono_emp ?></p></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<input type="hidden" name="cod_manipulacion_alimento" value="<?php echo $cod_manipulacion_alimento ?>">
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<!--<input type="hidden" name="pagina" value="<?php echo $pagina ?>">-->
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_manipulacion_alimento_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_manipulacion_alimento ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_manipulacion_alimento_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_manipulacion_alimento ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_manipulacion_alimento_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_manipulacion_alimento ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>