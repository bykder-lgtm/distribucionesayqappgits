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
<a href="../admin/menu_lista.php"><h4>Matriz de Riesgo Cargos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_grupo_area_cargo_sin_diligeniar_matriz_riesgo_masivo.php">Ver Cargos Sin Diligenciar Matriz de Riesgo</a>
</h4>
</div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$mostrar_datos_sql = "SELECT tbl15_grupo_area.cod_grupo_area, tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area_cargo.cod_grupo_area_cargo, 
tbl15_grupo_area_cargo.nombre_grupo_area_cargo, tbl15_grupo_area_cargo.clasrieg_fis1_ruid, tbl15_grupo_area_cargo.clasrieg_fis1_ilum, 
tbl15_grupo_area_cargo.clasrieg_fis1_noionic, tbl15_grupo_area_cargo.clasrieg_fis1_vibra, tbl15_grupo_area_cargo.clasrieg_fis1_tempextrem, 
tbl15_grupo_area_cargo.clasrieg_fis1_cambpres, tbl15_grupo_area_cargo.clasrieg_quim1_gasvapor, tbl15_grupo_area_cargo.clasrieg_quim1_aeroliq, 
tbl15_grupo_area_cargo.clasrieg_quim1_solid, tbl15_grupo_area_cargo.clasrieg_quim1_liquid, tbl15_grupo_area_cargo.clasrieg_biolog1_viru, 
tbl15_grupo_area_cargo.clasrieg_biolog1_bacter, tbl15_grupo_area_cargo.clasrieg_biolog1_parasi, tbl15_grupo_area_cargo.clasrieg_biolog1_morde, 
tbl15_grupo_area_cargo.clasrieg_biolog1_picad, tbl15_grupo_area_cargo.clasrieg_biolog1_hongo, tbl15_grupo_area_cargo.clasrieg_ergo1_trabestat, 
tbl15_grupo_area_cargo.clasrieg_ergo1_esfuerfis, tbl15_grupo_area_cargo.clasrieg_ergo1_carga, tbl15_grupo_area_cargo.clasrieg_ergo1_postforz, 
tbl15_grupo_area_cargo.clasrieg_ergo1_movrepet, tbl15_grupo_area_cargo.clasrieg_ergo1_jortrab, tbl15_grupo_area_cargo.clasrieg_psi1_monoto, 
tbl15_grupo_area_cargo.clasrieg_psi1_relhuman, tbl15_grupo_area_cargo.clasrieg_psi1_contentarea, tbl15_grupo_area_cargo.clasrieg_psi1_orgtiemptrab, 
tbl15_grupo_area_cargo.clasrieg_segur1_mecanic, tbl15_grupo_area_cargo.clasrieg_segur1_electri, tbl15_grupo_area_cargo.clasrieg_segur1_locat, 
tbl15_grupo_area_cargo.clasrieg_segur1_fisiquim, tbl15_grupo_area_cargo.clasrieg_segur1_public, tbl15_grupo_area_cargo.clasrieg_segur1_espconfi, 
tbl15_grupo_area_cargo.clasrieg_segur1_trabaltura, tbl15_grupo_area_cargo.clasrieg_observ1_otro, tbl15_grupo_area_cargo.chek_diligenciar, 
tbl15_grupo_area_cargo.clasrieg_segur1_sismo, tbl15_grupo_area_cargo.clasrieg_segur1_delincuenciacomun, 
tbl15_grupo_area_cargo.clasrieg_segur1_accitransito, tbl15_grupo_area_cargo.clasrieg_segur1_caidaobjetos, 
tbl15_grupo_area_cargo.clasrieg_segur1_puestotrabdesorden
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area ORDER BY nombre_grupo_area ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
?>
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

<body onLoad="myajax = new isiAJAX();">

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
            <th style="text-align:center">MATRIZ DE RIESGO</th>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr>
        	<td colspan="1"></td>
            <td style="text-align:center" colspan="6" bgcolor="#95B3D7"><strong>FÍSICOS</strong></td>
            <td style="text-align:center" colspan="4" bgcolor="#B6DDE8"><strong>QUÍMICOS</strong></td>
            <td style="text-align:center" colspan="6" bgcolor="#C5BE97"><strong>BIOLÓGICO</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#B2A1C7"><strong>ERGONÓMICOS</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#E6B9B8"><strong>PSICOSOCIALES</strong></td>
            <td style="text-align:center" colspan="9" bgcolor="#FAC090"><strong>SEGURIDAD</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>AREA A LABORAR - CARGO</strong></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/01.jpg" alt="Ruido" title="Ruido" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/02.jpg" alt="Iluminacion" title="Iluminacion" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/03.jpg" alt="Rad. No Ionizante" title="Rad. No Ionizante" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/04.jpg" alt="Vibraciones" title="Vibraciones" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/05.jpg" alt="Temp. Extremas" title="Temp. Extremas" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/06.jpg" alt="Cambios de Presión" title="Cambios de Presión" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/07.jpg" alt="Gases y Vapores" title="Gases y Vapores" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/08.jpg" alt="Aerosoles Líquidos" title="Aerosoles Líquidos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/09.jpg" alt="Sólidos" title="Sólidos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/10.jpg" alt="Líquidos" title="Líquidos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/11.jpg" alt="Virus" title="Virus" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/12.jpg" alt="Bacterias" title="Bacterias" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/13.jpg" alt="Parásitos" title="Parásitos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/14.jpg" alt="Mordeduras" title="Mordeduras" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/15.jpg" alt="Picaduras" title="Picaduras" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/16.jpg" alt="Hongos" title="Hongos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/17.jpg" alt="Trab. Estático" title="Trab. Estático" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/18.jpg" alt="Esfuerzo Físico" title="Esfuerzo Físico" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/19.jpg" alt="Cargas" title="Cargas" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/20.jpg" alt="Posiciones Forzadas" title="Posiciones Forzadas" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/21.jpg" alt="Mov. Repetitivos" title="Mov. Repetitivos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/22.jpg" alt="Jornada de Trabajo" title="Jornada de Trabajo" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/23.jpg" alt="Monotonía" title="Monotonía" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/24.jpg" alt="Relaciones Humanas" title="Relaciones Humanas" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/25.jpg" alt="Contenido de la Tarea" title="Contenido de la Tarea" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/26.jpg" alt="Org. del Tiempo de Trabajo" title="Org. del Tiempo de Trabajo" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/27.jpg" alt="Mecánicos" title="Mecánicos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/28.jpg" alt="Eléctricos" title="Eléctricos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/29.jpg" alt="Locativos" title="Locativos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/30.jpg" alt="Físicoquimicos" title="Físicoquimicos" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/31.jpg" alt="Público" title="Público" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/32.jpg" alt="Espacios Confinados" title="Espacios Confinados" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/33.jpg" alt="Trabajo en Alturas" title="Trabajo en Alturas" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/35.jpg" alt="Accidente de transito" title="Accidente de transito" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/34.jpg" alt="Otros" title="Otros" /></td>
            <td style="text-align:center"title="Codigo" /></td>
            <td style="text-align:center"title="Diligenciado" />OK</td>
        </tr>
        <tr>
<?php
while ($datos = mysqli_fetch_assoc($consulta)) {
$cod_grupo_area_cargo                  = $datos['cod_grupo_area_cargo'];
$cod_grupo_area                        = $datos['cod_grupo_area'];
$nombre_grupo_area                     = $datos['nombre_grupo_area'];
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
$clasrieg_segur1_sismo                 = $datos['clasrieg_segur1_sismo'];
$clasrieg_segur1_delincuenciacomun     = $datos['clasrieg_segur1_delincuenciacomun'];
$clasrieg_segur1_accitransito          = $datos['clasrieg_segur1_accitransito'];
$clasrieg_segur1_caidaobjetos          = $datos['clasrieg_segur1_caidaobjetos'];
$clasrieg_segur1_puestotrabdesorden    = $datos['clasrieg_segur1_puestotrabdesorden'];
$clasrieg_observ1_otro                 = $datos['clasrieg_observ1_otro'];
$chek_diligenciar                      = $datos['chek_diligenciar'];
?>
<tr>
<td style="text-align:left"><strong><?php echo $nombre_grupo_area;?> - </strong><?php echo $nombre_grupo_area_cargo;?></td>
<td style='text-align:center'><input name='clasrieg_fis1_ruid' class="clasrieg_fis1_ruid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_ruid=='S'){ echo 'checked'; } ?> title="Ruido"></td>
<td style='text-align:center'><input name='clasrieg_fis1_ilum' class="clasrieg_fis1_ilum" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_ilum=='S'){ echo 'checked'; } ?> title="Iluminacion"></td>
<td style='text-align:center'><input name='clasrieg_fis1_noionic' class="clasrieg_fis1_noionic" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_noionic=='S'){ echo 'checked'; } ?> title="Rad. No Ionizante"></td>
<td style='text-align:center'><input name='clasrieg_fis1_vibra' class="clasrieg_fis1_vibra" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_vibra=='S'){ echo 'checked'; } ?> title="Vibraciones"></td>
<td style='text-align:center'><input name='clasrieg_fis1_tempextrem' class="clasrieg_fis1_tempextrem" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_tempextrem=='S'){ echo 'checked'; } ?> title="Temp. Extremas"></td>
<td style='text-align:center'><input name='clasrieg_fis1_cambpres' class="clasrieg_fis1_cambpres" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_fis1_cambpres=='S'){ echo 'checked'; } ?> title="Cambios de Presión"></td>
<td style='text-align:center'><input name='clasrieg_quim1_gasvapor' class="clasrieg_quim1_gasvapor" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_quim1_gasvapor=='S'){ echo 'checked'; } ?> title="Gases y Vapores"></td>
<td style='text-align:center'><input name='clasrieg_quim1_aeroliq' class="clasrieg_quim1_aeroliq" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_quim1_aeroliq=='S'){ echo 'checked'; } ?> title="Aerosoles Líquidos"></td>
<td style='text-align:center'><input name='clasrieg_quim1_solid' class="clasrieg_quim1_solid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_quim1_solid=='S'){ echo 'checked'; } ?> title="Sólidos"></td>
<td style='text-align:center'><input name='clasrieg_quim1_liquid' class="clasrieg_quim1_liquid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_quim1_liquid=='S'){ echo 'checked'; } ?> title="Líquidos"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_viru' class="clasrieg_biolog1_viru" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_viru=='S'){ echo 'checked'; } ?> title="Virus"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_bacter' class="clasrieg_biolog1_bacter" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_bacter=='S'){ echo 'checked'; } ?> title="Bacterias"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_parasi' class="clasrieg_biolog1_parasi" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_parasi=='S'){ echo 'checked'; } ?> title="Parásitos"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_morde' class="clasrieg_biolog1_morde" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_morde=='S'){ echo 'checked'; } ?> title="Mordeduras"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_picad' class="clasrieg_biolog1_picad" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_picad=='S'){ echo 'checked'; } ?> title="Picaduras"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_hongo' class="clasrieg_biolog1_hongo" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_biolog1_hongo=='S'){ echo 'checked'; } ?> title="Hongos"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_trabestat' class="clasrieg_ergo1_trabestat" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_trabestat=='S'){ echo 'checked'; } ?> title="Trab. Estático"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_esfuerfis' class="clasrieg_ergo1_esfuerfis" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_esfuerfis=='S'){ echo 'checked'; } ?> title="Esfuerzo Físico"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_carga' class="clasrieg_ergo1_carga" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_carga=='S'){ echo 'checked'; } ?> title="Cargas"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_postforz' class="clasrieg_ergo1_postforz" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_postforz=='S'){ echo 'checked'; } ?> title="Posiciones Forzadas"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_movrepet' class="clasrieg_ergo1_movrepet" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_movrepet=='S'){ echo 'checked'; } ?> title="Mov. Repetitivos"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_jortrab' class="clasrieg_ergo1_jortrab" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_ergo1_jortrab=='S'){ echo 'checked'; } ?> title="Jornada de Trabajo"></td>
<td style='text-align:center'><input name='clasrieg_psi1_monoto' class="clasrieg_psi1_monoto" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_psi1_monoto=='S'){ echo 'checked'; } ?> title="Monotonía"></td>
<td style='text-align:center'><input name='clasrieg_psi1_relhuman' class="clasrieg_psi1_relhuman" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_psi1_relhuman=='S'){ echo 'checked'; } ?> title="Relaciones Humanas"></td>
<td style='text-align:center'><input name='clasrieg_psi1_contentarea' class="clasrieg_psi1_contentarea" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_psi1_contentarea=='S'){ echo 'checked'; } ?> title="Contenido de la Tarea"></td>
<td style='text-align:center'><input name='clasrieg_psi1_orgtiemptrab' class="clasrieg_psi1_orgtiemptrab" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_psi1_orgtiemptrab=='S'){ echo 'checked'; } ?> title="Org. del Tiempo de Trabajo"></td>
<td style='text-align:center'><input name='clasrieg_segur1_mecanic' class="clasrieg_segur1_mecanic" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_mecanic=='S'){ echo 'checked'; } ?> title="Mecánicos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_electri' class="clasrieg_segur1_electri" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_electri=='S'){ echo 'checked'; } ?> title="Eléctricos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_locat' class="clasrieg_segur1_locat" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_locat=='S'){ echo 'checked'; } ?> title="Locativos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_fisiquim' class="clasrieg_segur1_fisiquim" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_fisiquim=='S'){ echo 'checked'; } ?> title="Físicoquimicos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_public' class="clasrieg_segur1_public" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_public=='S'){ echo 'checked'; } ?> title="Público"></td>
<td style='text-align:center'><input name='clasrieg_segur1_espconfi' class="clasrieg_segur1_espconfi" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_espconfi=='S'){ echo 'checked'; } ?> title="Espacios Confinados"></td>
<td style='text-align:center'><input name='clasrieg_segur1_trabaltura' class="clasrieg_segur1_trabaltura" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_trabaltura=='S'){ echo 'checked'; } ?> title="Trabajo en Alturas"></td>
<td style='text-align:center'><input name='clasrieg_segur1_accitransito' class="clasrieg_segur1_accitransito" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_segur1_accitransito=='S'){ echo 'checked'; } ?> title="Accidente de transito"></td>
<td style='text-align:center'><input name='clasrieg_observ1_otro' class="clasrieg_observ1_otro" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($clasrieg_observ1_otro=='S'){ echo 'checked'; } ?> title="Otros"></td>
<td style="text-align:center"><strong><?php echo $cod_grupo_area_cargo;?></strong></td>
<td style='text-align:center'><input name='chek_diligenciar' class="chek_diligenciar" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <? if($chek_diligenciar=='S'){ echo 'checked'; } ?> title="Diligenciado"></td>
</tr>
<?php } ?>
</tbody>
</table>


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
<script>  
 $(document).ready(function(){ 

$(".clasrieg_fis1_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ruid").val("S"); } else {   $(".clasrieg_fis1_ruid").val("N"); } });
$(".clasrieg_fis1_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ilum").val("S"); } else {   $(".clasrieg_fis1_ilum").val("N"); } });
$(".clasrieg_fis1_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_noionic").val("S"); } else { $(".clasrieg_fis1_noionic").val("N"); } });
$(".clasrieg_fis1_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_vibra").val("S"); } else { $(".clasrieg_fis1_vibra").val("N"); } });
$(".clasrieg_fis1_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_tempextrem").val("S"); } else {   $(".clasrieg_fis1_tempextrem").val("N"); } });
$(".clasrieg_fis1_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_cambpres").val("S"); } else {   $(".clasrieg_fis1_cambpres").val("N"); } });
$(".clasrieg_quim1_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_gasvapor").val("S"); } else { $(".clasrieg_quim1_gasvapor").val("N"); } });
$(".clasrieg_quim1_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_aeroliq").val("S"); } else {   $(".clasrieg_quim1_aeroliq").val("N"); } });
$(".clasrieg_quim1_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_solid").val("S"); } else {   $(".clasrieg_quim1_solid").val("N"); } });
$(".clasrieg_quim1_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_liquid").val("S"); } else { $(".clasrieg_quim1_liquid").val("N"); } });
$(".clasrieg_biolog1_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_viru").val("S"); } else { $(".clasrieg_biolog1_viru").val("N"); } });
$(".clasrieg_biolog1_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_bacter").val("S"); } else { $(".clasrieg_biolog1_bacter").val("N"); } });
$(".clasrieg_biolog1_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_parasi").val("S"); } else { $(".clasrieg_biolog1_parasi").val("N"); } });
$(".clasrieg_biolog1_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_morde").val("S"); } else {   $(".clasrieg_biolog1_morde").val("N"); } });
$(".clasrieg_biolog1_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_picad").val("S"); } else {   $(".clasrieg_biolog1_picad").val("N"); } });
$(".clasrieg_biolog1_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_hongo").val("S"); } else {   $(".clasrieg_biolog1_hongo").val("N"); } });
$(".clasrieg_ergo1_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_trabestat").val("S"); } else {   $(".clasrieg_ergo1_trabestat").val("N"); } });
$(".clasrieg_ergo1_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_esfuerfis").val("S"); } else {   $(".clasrieg_ergo1_esfuerfis").val("N"); } });
$(".clasrieg_ergo1_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_carga").val("S"); } else {   $(".clasrieg_ergo1_carga").val("N"); } });
$(".clasrieg_ergo1_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_postforz").val("S"); } else { $(".clasrieg_ergo1_postforz").val("N"); } });
$(".clasrieg_ergo1_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_movrepet").val("S"); } else { $(".clasrieg_ergo1_movrepet").val("N"); } });
$(".clasrieg_ergo1_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_jortrab").val("S"); } else {   $(".clasrieg_ergo1_jortrab").val("N"); } });
$(".clasrieg_psi1_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_monoto").val("S"); } else {   $(".clasrieg_psi1_monoto").val("N"); } });
$(".clasrieg_psi1_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_relhuman").val("S"); } else {   $(".clasrieg_psi1_relhuman").val("N"); } });
$(".clasrieg_psi1_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_contentarea").val("S"); } else { $(".clasrieg_psi1_contentarea").val("N"); } });
$(".clasrieg_psi1_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_orgtiemptrab").val("S"); } else {   $(".clasrieg_psi1_orgtiemptrab").val("N"); } });
$(".clasrieg_segur1_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_mecanic").val("S"); } else { $(".clasrieg_segur1_mecanic").val("N"); } });
$(".clasrieg_segur1_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_electri").val("S"); } else { $(".clasrieg_segur1_electri").val("N"); } });
$(".clasrieg_segur1_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_locat").val("S"); } else { $(".clasrieg_segur1_locat").val("N"); } });
$(".clasrieg_segur1_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_fisiquim").val("S"); } else {   $(".clasrieg_segur1_fisiquim").val("N"); } });
$(".clasrieg_segur1_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_public").val("S"); } else {   $(".clasrieg_segur1_public").val("N"); } });
$(".clasrieg_segur1_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_espconfi").val("S"); } else {   $(".clasrieg_segur1_espconfi").val("N"); } });
$(".clasrieg_segur1_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_trabaltura").val("S"); } else {   $(".clasrieg_segur1_trabaltura").val("N"); } });

$(".clasrieg_segur1_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_sismo").val("S"); } else {   $(".clasrieg_segur1_sismo").val("N"); } });
$(".clasrieg_segur1_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur1_delincuenciacomun").val("N"); } });
$(".clasrieg_segur1_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_accitransito").val("S"); } else {   $(".clasrieg_segur1_accitransito").val("N"); } });
$(".clasrieg_segur1_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_caidaobjetos").val("S"); } else {   $(".clasrieg_segur1_caidaobjetos").val("N"); } });
$(".clasrieg_segur1_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur1_puestotrabdesorden").val("N"); } });

$(".clasrieg_observ1_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ1_otro").val("S"); } else { $(".clasrieg_observ1_otro").val("N"); } });
$(".chek_diligenciar").change(function(){ if( $(this).is(':checked') ){ $(".chek_diligenciar").val("S"); } else { $(".chek_diligenciar").val("N"); } });

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("input");
$.ajax({  
    url:"edit_lista_areacargo_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("select");
$.ajax({  
    url:"edit_lista_areacargo_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("textarea");
$.ajax({  
    url:"edit_lista_areacargo_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});


 });  
 </script> 
 
</body>
</html>