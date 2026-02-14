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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Cargo a Laborar</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_grupo_area_cargo = intval($_GET['cod_grupo_area_cargo']);

$sql_cliente = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_grupo_area_cargo = $datos_cliente['nombre_grupo_area_cargo'];
$cod_grupo_area = $datos_cliente['cod_grupo_area'];


$sql_grupo_area = "SELECT * FROM tbl15_grupo_area WHERE cod_grupo_area = '$cod_grupo_area'";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));
$datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area);

$nombre_grupo_area = $datos_grupo_area['nombre_grupo_area'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_grupo_area_cargo_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead><tr>
		<th>NOMBRE AREA A LABORAR</th>
		<th>NOMBRE CARGO A LABORAR</th>
	</tr></thead>
    <tbody><tr>
    	<td><select name="cod_grupo_area" id="cod_grupo_area" onChange="conocer_cargo();" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_grupo_area)) { echo "<option value='0' >Selecione</option>";
} else { echo  "<option value='0' selected >Seleccione</option>"; }
$consulta2_sql = ("SELECT nombre_grupo_area, cod_grupo_area FROM tbl15_grupo_area ORDER BY nombre_grupo_area ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area) AND ($cod_grupo_area == $datos2['cod_grupo_area'])) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_grupo_area'];
$nombre2 = $datos2['nombre_grupo_area'];
echo "<option value='".$codigo."' $seleccionado >".$nombre2."</option>"; } ?>
</select></td>
    	<td><input class="input-block-level" name="nombre_grupo_area_cargo" type="text" value="<?php echo $nombre_grupo_area_cargo ?>" required autofocus/></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_grupo_area_cargo" value="<?php echo $cod_grupo_area_cargo ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<hr>

<script language="javascript" src="../admin/class_php/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'cajhabiltada';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'cajdeshabiltada';
if (last != valor)
myajax.Link('edit_lista_areacargo_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
            <th style="text-align:center">MATRIZ DE RIESGO</th>
</table>


<body onLoad="myajax = new isiAJAX();">
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
        	<td colspan="1"></td>
            <td style="text-align:center" colspan="6" bgcolor="#95B3D7"><strong>FÍSICOS</strong></td>
            <td style="text-align:center" colspan="4" bgcolor="#B6DDE8"><strong>QUÍMICOS</strong></td>
            <td style="text-align:center" colspan="6" bgcolor="#C5BE97"><strong>BIOLÓGICO</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#B2A1C7"><strong>ERGONÓMICOS</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#E6B9B8"><strong>PSICOSOCIALES</strong></td>
            <td style="text-align:center" colspan="8" bgcolor="#FAC090"><strong>SEGURIDAD</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>AREA A LABORAR - CARGO</strong></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/01.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/02.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/03.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/04.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/05.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/06.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/07.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/08.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/09.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/10.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/11.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/12.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/13.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/14.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/15.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/16.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/17.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/18.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/19.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/20.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/21.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/22.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/23.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/24.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/25.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/26.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/27.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/28.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/29.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/30.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/31.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/32.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/33.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/34.jpg" /></td>
            <td></td>
        </tr>
        <tr>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$datos = mysqli_fetch_assoc($consulta);

$cod_grupo_area_cargo                  = $datos['cod_grupo_area_cargo'];
$cod_grupo_area                        = $datos['cod_grupo_area'];
$nombre_grupo_area_cargo               = $datos['nombre_grupo_area_cargo'];
$clasrieg_fis1_ruid                    = $datos['clasrieg_fis1_ruid'];
$clasrieg_fis1_ilum                    = $datos['clasrieg_fis1_ilum'];
$clasrieg_fis1_noionic                 = $datos['clasrieg_fis1_noionic'];
$clasrieg_fis1_vibra                   = $datos['clasrieg_fis1_vibra'];
$clasrieg_fis1_tempextrem              = $datos['clasrieg_fis1_tempextrem'];
$clasrieg_fis1_cambpres                = $datos['clasrieg_fis1_cambpres'];
$clasrieg_quim1_gasvapor               = $datos['clasrieg_quim1_gasvapor'];
$clasrieg_quim1_aeroliq                = $datos['clasrieg_quim1_aeroliq'];
$clasrieg_quim1_solid                  = $datos['clasrieg_quim1_solid'];
$clasrieg_quim1_liquid                 = $datos['clasrieg_quim1_liquid'];
$clasrieg_biolog1_viru                 = $datos['clasrieg_biolog1_viru'];
$clasrieg_biolog1_bacter               = $datos['clasrieg_biolog1_bacter'];
$clasrieg_biolog1_parasi               = $datos['clasrieg_biolog1_parasi'];
$clasrieg_biolog1_morde                = $datos['clasrieg_biolog1_morde'];
$clasrieg_biolog1_picad                = $datos['clasrieg_biolog1_picad'];
$clasrieg_biolog1_hongo                = $datos['clasrieg_biolog1_hongo'];
$clasrieg_ergo1_trabestat              = $datos['clasrieg_ergo1_trabestat'];
$clasrieg_ergo1_esfuerfis              = $datos['clasrieg_ergo1_esfuerfis'];
$clasrieg_ergo1_carga                  = $datos['clasrieg_ergo1_carga'];
$clasrieg_ergo1_postforz               = $datos['clasrieg_ergo1_postforz'];
$clasrieg_ergo1_movrepet               = $datos['clasrieg_ergo1_movrepet'];
$clasrieg_ergo1_jortrab                = $datos['clasrieg_ergo1_jortrab'];
$clasrieg_psi1_monoto                  = $datos['clasrieg_psi1_monoto'];
$clasrieg_psi1_relhuman                = $datos['clasrieg_psi1_relhuman'];
$clasrieg_psi1_contentarea             = $datos['clasrieg_psi1_contentarea'];
$clasrieg_psi1_orgtiemptrab            = $datos['clasrieg_psi1_orgtiemptrab'];
$clasrieg_segur1_mecanic               = $datos['clasrieg_segur1_mecanic'];
$clasrieg_segur1_electri               = $datos['clasrieg_segur1_electri'];
$clasrieg_segur1_locat                 = $datos['clasrieg_segur1_locat'];
$clasrieg_segur1_fisiquim              = $datos['clasrieg_segur1_fisiquim'];
$clasrieg_segur1_public                = $datos['clasrieg_segur1_public'];
$clasrieg_segur1_espconfi              = $datos['clasrieg_segur1_espconfi'];
$clasrieg_segur1_trabaltura            = $datos['clasrieg_segur1_trabaltura'];
$clasrieg_observ1_otro                 = $datos['clasrieg_observ1_otro'];
?>
<tr>
<td style="text-align:center"><strong><?php echo $nombre_grupo_area;?> - </strong><?php echo $nombre_grupo_area_cargo;?></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_ruid', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_ruid;?>" title="Ruido"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_ilum', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_ilum;?>" title="Iluminacion"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_noionic', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_noionic;?>" title="Rad. No Ionizante"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_vibra', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_vibra;?>" title="Vibraciones"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_tempextrem', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_tempextrem;?>" title="Temp. Extremas"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_fis1_cambpres', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_fis1_cambpres;?>" title="Cambios de Presión"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_quim1_gasvapor', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_quim1_gasvapor;?>" title="Gases y Vapores"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_quim1_aeroliq', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_quim1_aeroliq;?>" title="Aerosoles Líquidos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_quim1_solid', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_quim1_solid;?>" title="Sólidos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_quim1_liquid', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_quim1_liquid;?>" title="Líquidos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_viru', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_viru;?>" title="Virus"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_bacter', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_bacter;?>" title="Bacterias"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_parasi', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_parasi;?>" title="Parásitos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_morde', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_morde;?>" title="Mordeduras"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_picad', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_picad;?>" title="Picaduras"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_biolog1_hongo', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_biolog1_hongo;?>" title="Hongos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_trabestat', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_trabestat;?>" title="Trab. Estático"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_esfuerfis', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_esfuerfis;?>" title="Esfuerzo Físico"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_carga', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_carga;?>" title="Cargas"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_postforz', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_postforz;?>" title="Posiciones Forzadas"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_movrepet', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_movrepet;?>" title="Mov. Repetitivos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_ergo1_jortrab', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_ergo1_jortrab;?>" title="Jornada de Trabajo"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_psi1_monoto', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_psi1_monoto;?>" title="Monotonía"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_psi1_relhuman', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_psi1_relhuman;?>" title="Relaciones Humanas"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_psi1_contentarea', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_psi1_contentarea;?>" title="Contenido de la Tarea"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_psi1_orgtiemptrab', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_psi1_orgtiemptrab;?>" title="Org. del Tiempo de Trabajo"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_mecanic', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_mecanic;?>" title="Mecánicos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_electri', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_electri;?>" title="Eléctricos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_locat', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_locat;?>" title="Locativos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_fisiquim', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_fisiquim;?>" title="Físicoquimicos"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_public', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_public;?>" title="Público"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_espconfi', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_espconfi;?>" title="Espacios Confinados"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_segur1_trabaltura', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_segur1_trabaltura;?>" title="Trabajo en Alturas"></td>
<td><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'clasrieg_observ1_otro', <?php echo $cod_grupo_area_cargo;?>)" class="input-block-level" id="<?php echo $cod_grupo_area_cargo;?>" value="<?php echo $clasrieg_observ1_otro;?>" title="Otros"></td>
<td style="text-align:center"><strong><?php echo $cod_grupo_area_cargo;?></strong></td>
</tr>
</tbody>
</table>

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