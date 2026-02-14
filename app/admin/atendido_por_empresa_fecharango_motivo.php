<?php $serguridad_pagina = 1; ?> 
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<link href="../estilo_css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../estilo_css/prism.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>

<script language="javascript" src="../admin/js/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'cajhabiltada';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'cajdeshabiltada';
if (last != valor)
myajax.Link('guardar_cod_factura_precio_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body onLoad="myajax = new isiAJAX();">

<?php
if (isset($_GET['cod_empresa']) <> '') { $cod_empresa = addslashes($_GET['cod_empresa']); } else { $cod_empresa = ''; }
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_obtener_empresa = "SELECT * FROM empresa WHERE cod_empresa = '$cod_empresa'";
$consulta_obtener_empresa = mysqli_query($conectar, $sql_obtener_empresa) or die(mysqli_error($conectar));
$matriz_obtener_empresa = mysqli_fetch_assoc($consulta_obtener_empresa);

$nombre_empresa                = $matriz_obtener_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_obtener_empresa['razonsocial_empresa'];
$direccion_empresa             = $matriz_obtener_empresa['direccion_empresa'];
$telefono_empresa              = $matriz_obtener_empresa['telefono_empresa'];
$nit_empresa                   = $matriz_obtener_empresa['nit_empresa'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if (isset($_GET['fecha_ini']) <> '') { 
  $fecha_ini_dathtml         = addslashes($_GET['fecha_ini']); 
  $frag_fecha_ini            = explode('-', $fecha_ini_dathtml);
  $anyo_ini                  = $frag_fecha_ini[0];
  $mes_ini                   = $frag_fecha_ini[1];
  $dia_ini                   = $frag_fecha_ini[2];
  $fecha_ini                 = $anyo_ini.'/'.$mes_ini.'/'.$dia_ini;
} else { 
  $fecha_ini                 = '';
  $fecha_ini_dathtml         = ''; 
}
if (isset($_GET['fecha_fin']) <> '') { 
  $fecha_fin_dathtml         = addslashes($_GET['fecha_fin']);
  $frag_fecha_fin            = explode('-', $fecha_fin_dathtml);
  $anyo_fin                  = $frag_fecha_fin[0];
  $mes_fin                   = $frag_fecha_fin[1];
  $dia_fin                   = $frag_fecha_fin[2];
  $fecha_fin                 = $anyo_fin.'/'.$mes_fin.'/'.$dia_fin; 
} else { 
  $fecha_fin                 = '';
  $fecha_fin_dathtml         = ''; 
}

if (isset($_GET['total_muestra']) <> '') { $total_muestra = intval($_GET['total_muestra']); } else { $total_muestra = '0'; }
$pagina                = $_SERVER['PHP_SELF'];
$fecha                 = date("Y/m/d");
$contador              = 0;
$contadors             = 0;
$url                   = $_SERVER['PHP_SELF'];
?>
<style type="text/css">
.contenedor_reporte_dinamico { text-align:center; }
.div_reporte_dinamico { border:solid 5px #483D8B; display:inline-block; margin-left:auto; margin-right:auto; text-align:center; width: 70%; }
</style>

<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista de Paciente Atendidos Por Empresa, Motivo Y Rango de Fechas</h6></a>
</div>

<div class="contenedor_reporte_dinamico">
<div class="div_reporte_dinamico">
  
  <form action="" method="GET">
  <table cellspacing="0" cellpadding="0">
    <tr>
      <td><a>EMPRESA:</a></td>
      <td>
  <select name="cod_empresa" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
  <?php if (isset($cod_empresa)) { echo "<option value='' >Selecione</option>";
  } else { echo  "<option value='' selected >Selecione</option>"; }
  $consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM empresa ORDER BY nombre_empresa ASC");
  $consulta2 = mysqli_query($conectar, $consulta2_sql);
  while ($datos2 = mysqli_fetch_assoc($consulta2)) {
  if(isset($cod_empresa) AND $cod_empresa == $datos2['cod_empresa']) {
  $seleccionado = "selected"; } else { $seleccionado = ""; }
  $codigo = $datos2['cod_empresa'];
  $nombre = $datos2['nombre_empresa'];
  echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
  </td>
    </tr>
    <tr>
      <td><a>MOTIVO:</a></td>
      <td>
  <select name="motivo[]" data-placeholder="Motivo de Consulta" class="chosen-select" multiple tabindex="4" required>
  <option value="0"></option>
  <?php
  $seleccionado = '';
  $datos_encontrados = array();

  $consulta2_sql = "SELECT cod_motivo_consulta, motivo FROM motivo_consulta ORDER BY motivo ASC";
  $consulta2 = mysqli_query($conectar, $consulta2_sql);
  while ($datos2 = mysqli_fetch_assoc($consulta2)) { $motivos = $datos2['motivo']; ?>

  <?php if (isset($_GET['motivo'])) {
  foreach ($_GET['motivo'] as $key => $motivos_vector) { 
  if ($motivos_vector == $motivos) { $seleccionado = 'selected'; } else { $seleccionado = ''; } ?>
  <option value="<?php echo $motivos ?>" <?php echo $seleccionado ?> ><?php echo $motivos ?></option>
  <?php } 
  } else { ?> <option value="<?php echo $motivos ?>" <?php echo $seleccionado ?> ><?php echo $motivos ?></option> <?php } ?>

  <?php } ?>
  </select>
      </td>
    </tr>

    <tr>
      <td><a>FECHA INI:</a></td>
      <td>
  <input id="fecha_ini" name="fecha_ini" type="date" value="<?php echo $fecha_ini_dathtml ?>" required>
      </td>
    </tr>
    <tr>
      <td><a>FECHA FIN:</a></td>
      <td>
  <input id="fecha_fin" name="fecha_fin" type="date" value="<?php echo $fecha_fin_dathtml ?>" required>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2"><button type="submit">Ver Reporte</button></td>
    </tr>
  </table>
  </form>
</div>
</div>

<br>

<input type="hidden" id="url" name="url" value="<?php echo $url; ?>">

<?php
if (isset($_GET['cod_empresa'])) {

foreach ($_GET['motivo'] as $indice => $valor_motivo) { $contador++; } unset($valor_motivo);

if (isset($_GET['motivo'][0])) { $motivo = $_GET['motivo'][0]; }
if (isset($_GET['motivo'][1])) { $motivo2 = $_GET['motivo'][1]; }
if (isset($_GET['motivo'][2])) { $motivo3 = $_GET['motivo'][2]; }
if (isset($_GET['motivo'][3])) { $motivo4 = $_GET['motivo'][3]; }
if (isset($_GET['motivo'][4])) { $motivo5 = $_GET['motivo'][4]; }
if (isset($_GET['motivo'][5])) { $motivo6 = $_GET['motivo'][5]; }
if (isset($_GET['motivo'][6])) { $motivo7 = $_GET['motivo'][6]; }
if (isset($_GET['motivo'][7])) { $motivo8 = $_GET['motivo'][7]; }
if (isset($_GET['motivo'][8])) { $motivo9 = $_GET['motivo'][8]; }
if (isset($_GET['motivo'][9])) { $motivo10 = $_GET['motivo'][9]; }
if (isset($_GET['motivo'][10])) { $motivo11 = $_GET['motivo'][10]; }
if (isset($_GET['motivo'][11])) { $motivo12 = $_GET['motivo'][11]; }
if (isset($_GET['motivo'][12])) { $motivo13 = $_GET['motivo'][12]; }
if (isset($_GET['motivo'][13])) { $motivo14 = $_GET['motivo'][13]; }
if (isset($_GET['motivo'][14])) { $motivo15 = $_GET['motivo'][14]; }
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($contador==1) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo')";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND (historia_clinica.motivo='$motivo') AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==2) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==3) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==4) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==5) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==6) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==7) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==8) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==9) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') 
  OR (historia_clinica.motivo='$motivo8') OR (historia_clinica.motivo='$motivo9')) AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9')) AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9')) AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9')) AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==10) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10')) AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==11) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==12) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==13) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==14) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==15) {

  $sql_motivo_conteo = "SELECT historia_clinica.cod_historia_clinica, cliente.cedula, cliente.nombres, cliente.apellido1, historia_clinica.fecha_anyo, 
  cliente.nombre_sexo, historia_clinica.motivo, historia_clinica.motivo2, administrador.nombres AS nombre_prof, administrador.apellidos AS apellidos_prof, 
  historia_clinica.cod_administrador, historia_clinica.cod_cliente, historia_clinica.fecha_ymd, historia_clinica.cod_factura, historia_clinica.costo_motivo_consulta,
  historia_clinica.cod_empresa, historia_clinica.fecha_dmy, historia_clinica.hora, historia_clinica.fecha_time, historia_clinica.cod_estado_facturacion
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
  AND (historia_clinica.cod_estado_facturacion=1) ORDER BY historia_clinica.fecha_time DESC";
  $resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo) or die(mysqli_error($conectar));
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15'))";
  $consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
  $datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

  $conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
  AND (historia_clinica.cod_estado_facturacion=1)";
  $consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
  $datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

  $conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) 
  ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  WHERE (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
  AND (historia_clinica.cod_estado_facturacion=0)";
  $consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
  $datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

  $conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_hombre = "SELECT Count(cliente.nombre_sexo) AS conteo_hombre, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='M')";
  $consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
  $datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

  $conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_conteo_atendido_mujer = "SELECT Count(cliente.nombre_sexo) AS conteo_mujer, historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd, historia_clinica.motivo
  FROM empresa RIGHT JOIN (cliente RIGHT JOIN (administrador RIGHT JOIN historia_clinica ON administrador.cod_administrador = historia_clinica.cod_administrador) ON cliente.cod_cliente = historia_clinica.cod_cliente) ON empresa.cod_empresa = historia_clinica.cod_empresa
  GROUP BY historia_clinica.cod_empresa, historia_clinica.cod_estado_facturacion, cliente.nombre_sexo, historia_clinica.fecha_ymd
  HAVING (historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (historia_clinica.cod_empresa='$cod_empresa') 
  AND ((historia_clinica.motivo='$motivo') OR (historia_clinica.motivo='$motivo2') OR (historia_clinica.motivo='$motivo3') OR (historia_clinica.motivo='$motivo4') 
  OR (historia_clinica.motivo='$motivo5') OR (historia_clinica.motivo='$motivo6') OR (historia_clinica.motivo='$motivo7') OR (historia_clinica.motivo='$motivo8') 
  OR (historia_clinica.motivo='$motivo9') OR (historia_clinica.motivo='$motivo10') OR (historia_clinica.motivo='$motivo11') 
  OR (historia_clinica.motivo='$motivo12') OR (historia_clinica.motivo='$motivo13') OR (historia_clinica.motivo='$motivo14') OR (historia_clinica.motivo='$motivo15')) 
  AND (historia_clinica.cod_estado_facturacion=1) AND (cliente.nombre_sexo='F')";
  $consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
  $datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

  $conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$total_motivo = $contador;
?>
<div class="contenedor_reporte_dinamico">
<div class="div_reporte_dinamico">
<form action="" id="" method="GET">
<td align="center">
<?php 
if ($contador==1) { ?>     EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==2) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==3) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==4) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==5) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==6) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==7) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==8) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==9) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==10) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==11) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==12) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==13) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==14) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13.' | '.$motivo14 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==15) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>MOTIVOS: <?php echo $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13.' | '.$motivo14.' | '.$motivo15 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?>
</td>
<?php } ?>
</form>
</div>
</div>
<br>

<div class="contenedor_reporte_dinamico">
<div class="div_reporte_dinamico">
<div class="table-responsive">
<table class="table table-striped">
<tr>
<?php if ($contador==1) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==2) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==3) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==4) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==5) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==6) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==7) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==8) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==9) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==10) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==11) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==12) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==13) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==14) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } elseif ($contador==15) { ?>
<th style="text-align:center"><a href="../admin/reg_venta_temporal_producto_evaluados_reg.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/generar_factura_venta.png"></a></th>
<?php if ($cod_estado_perfil_sociodemografico_global == '1') { ?><th style="text-align:center"><a href="../admin/ver_perfil_sociodemografico_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_perfil_sociodemografico.png"></a></th><?php } ?>
<!--
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_consolidado_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande_consolidado.png"></a></th>
-->
<!--<th style="text-align:center"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_empresa=<?php echo $cod_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&motivo9=<?php echo $motivo9 ?>&motivo10=<?php echo $motivo10 ?>&motivo11=<?php echo $motivo11 ?>&motivo12=<?php echo $motivo12 ?>&motivo13=<?php echo $motivo13 ?>&motivo14<?php echo $motivo14 ?>&motivo15<?php echo $motivo15 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>-->
<?php } ?>
</tr>
</table>
</div>
</div>
</div>
<br>
<div class="contenedor_reporte_dinamico">
<div class="div_reporte_dinamico">
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th style="text-align:center"><a href="#">Total Citas</a></th>
<th style="text-align:center"><a href="#">Total Atendidos</a></th>
<th style="text-align:center"><a href="#">Total Sin Atender</a></th>
<th style="text-align:center"><a href="#">Poblacion Objeto</a></th>
</tr>
<tr>
<td style="text-align:center"><?php echo number_format($conteo_citas, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo number_format($conteo_atendido, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo number_format($conteo_no_atendido, 0, ",", ".") ?></td>
<td style="text-align:center"><input style="text-align:center" type="number" id="total_muestra" value="<?php echo $total_muestra;?>" class="input-block-level" size="6"></td>
</tr>
</table>
</div>
</div>
</div>
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Hc</th>
<th>Cedula</th>
<th>Nombres</th>
<th>Sexo</th>
<th>Motivo</th>
<!--<th>Motivo2</th>-->
<th>Profesional</th>
<th>Empresa</th>
<th>Costo</th>
<!--<th>Factura</th>-->
<th>Fecha</th>
<th>Hora</th>
<th>Edit</th>
<th>#</th>
</tr>
</thead>
<tbody>
<?php
$conteo                        = 0;
while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo)) {

$cod_historia_clinica          = $info_motivo_conteo['cod_historia_clinica'];
$cod_cliente                   = $info_motivo_conteo['cod_cliente'];
$cod_administrador_hist        = $info_motivo_conteo['cod_administrador'];
$cedula                        = $info_motivo_conteo['cedula'];
$nombres                       = $info_motivo_conteo['nombres'];
$apellido1                     = $info_motivo_conteo['apellido1'];
$motivo                        = $info_motivo_conteo['motivo'];
$motivo2                       = $info_motivo_conteo['motivo2'];
$nombre_prof                   = $info_motivo_conteo['nombre_prof'];
$apellidos_prof                = $info_motivo_conteo['apellidos_prof'];
$nombre_sexo                   = $info_motivo_conteo['nombre_sexo'];
//$nombre_empresa                = $info_motivo_conteo['nombre_empresa'];
$cod_factura                   = $info_motivo_conteo['cod_factura'];
$costo_motivo_consulta         = $info_motivo_conteo['costo_motivo_consulta'];
$fecha_time                    = $info_motivo_conteo['fecha_time'];
$fecha_dmy                     = date("Y/m/d", $fecha_time);
$hora                          = date("H:i", $fecha_time);
$conteo++;
?>
<tr>
<td><?php echo $cod_historia_clinica?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $nombre_sexo?></td>
<td><strong><?php echo $motivo?></strong></td>
<!--<td><?php echo $motivo2?></td>-->
<td><?php echo $nombre_prof.' '.$apellidos_prof ?></td>
<td><?php echo $nombre_empresa?></td>
<td style="text-align:center"><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'costo_motivo_consulta', <?php echo $cod_historia_clinica;?>)" id="costo_motivo_consulta" value="<?php echo $costo_motivo_consulta;?>" class="input-block-level" size="6"></td>
<!--<td style="text-align:center"><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_factura', <?php echo $cod_historia_clinica;?>)" id="cod_factura" value="<?php echo $cod_factura;?>" class="input-block-level" size="1"></td>-->
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
<td align="center"><a href="../admin/edit_historia_clinica_mejorada.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $conteo?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
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
<?php include_once('../admin/05_modulo_sin_chosen_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>

<script>  
$(document).ready(function(){ 

$("#total_muestra").change(function(){ 
var url_parameter = $("#url_modif").attr("href");
var url = $("#url").val();
var total_muestra = $(this).val();
var reem_total_muestra = '';
var frag_url = url_parameter.split('&');
var total_muestra_text = frag_url[3]; 
reem_total_muestra = url_parameter.replace(total_muestra_text,'total_muestra='+total_muestra);

$("#url_modif").attr("href", reem_total_muestra);
});

});
</script>

</body>
</html>