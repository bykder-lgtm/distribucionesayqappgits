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
<div class="breadcrumbs"><a href="../admin/lista_grupo_area_cargo.php"><h4>Editar Cargo a Laborar</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_grupo_area_cargo           = intval($_GET['cod_grupo_area_cargo']);

$sql_cliente = "SELECT * FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_grupo_area_cargo                = $datos_cliente['nombre_grupo_area_cargo'];
$funcion_grupo_area_cargo               = $datos_cliente['funcion_grupo_area_cargo'];
$cod_grupo_area                         = $datos_cliente['cod_grupo_area'];
$objetivo_grupo_area_cargo              = $datos_cliente['objetivo_grupo_area_cargo'];
$nombre_escolaridad                     = $datos_cliente['nombre_escolaridad'];
$conocimientos_especificos              = $datos_cliente['conocimientos_especificos'];
$experiencia_previa_requerida           = $datos_cliente['experiencia_previa_requerida'];
$resp_supervision                       = $datos_cliente['resp_supervision'];
$resp_maquina_equipo_material           = $datos_cliente['resp_maquina_equipo_material'];
$resp_relacion                          = $datos_cliente['resp_relacion'];
$resp_operaciones_tecnica               = $datos_cliente['resp_operaciones_tecnica'];
$resp_valores                           = $datos_cliente['resp_valores'];
$org_metodo_trabajo                     = $datos_cliente['org_metodo_trabajo'];
$nombre_nivel_esfuerzo                  = $datos_cliente['nombre_nivel_esfuerzo'];
$descripcion_ambiente                   = $datos_cliente['descripcion_ambiente'];
$maquinas_equipo_herramienta            = $datos_cliente['maquinas_equipo_herramienta'];
$horario                                = $datos_cliente['horario'];
$dat_ocupa_visu1                        = $datos_cliente['dat_ocupa_visu1'];
$dat_ocupa_resp1                        = $datos_cliente['dat_ocupa_resp1'];
$dat_ocupa_audi1                        = $datos_cliente['dat_ocupa_audi1'];
$dat_ocupa_cabeza1                      = $datos_cliente['dat_ocupa_cabeza1'];
$dat_ocupa_manos1                       = $datos_cliente['dat_ocupa_manos1'];
$dat_ocupa_tronco1                      = $datos_cliente['dat_ocupa_tronco1'];
$dat_ocupa_pies1                        = $datos_cliente['dat_ocupa_pies1'];
$dat_ocupa_altu1                        = $datos_cliente['dat_ocupa_altu1'];
$descrip_protec_visual                  = $datos_cliente['descrip_protec_visual'];
$descrip_protec_audit                   = $datos_cliente['descrip_protec_audit'];
$descrip_protec_resp                    = $datos_cliente['descrip_protec_resp'];
$descrip_protec_cabeza                  = $datos_cliente['descrip_protec_cabeza'];
$descrip_protec_manos                   = $datos_cliente['descrip_protec_manos'];
$descrip_protec_tronco                  = $datos_cliente['descrip_protec_tronco'];
$descrip_protec_pies                    = $datos_cliente['descrip_protec_pies'];
$descrip_protec_altura                  = $datos_cliente['descrip_protec_altura'];
$ingreso_hemograma                      = $datos_cliente['ingreso_hemograma'];
$ingreso_perfil_lipidico                = $datos_cliente['ingreso_perfil_lipidico'];
$ingreso_audiometria                    = $datos_cliente['ingreso_audiometria'];
$ingreso_visiometria                    = $datos_cliente['ingreso_visiometria'];
$ingreso_espirometria                   = $datos_cliente['ingreso_espirometria'];
$ingreso_enfa_osteo                     = $datos_cliente['ingreso_enfa_osteo'];
$ingreso_manipul_aliment                = $datos_cliente['ingreso_manipul_aliment'];
$periodico_anyo_hemograma               = $datos_cliente['periodico_anyo_hemograma'];
$periodico_anyo_perfil_lipidico         = $datos_cliente['periodico_anyo_perfil_lipidico'];
$periodico_anyo_audiometria             = $datos_cliente['periodico_anyo_audiometria'];
$periodico_anyo_visiometria             = $datos_cliente['periodico_anyo_visiometria'];
$periodico_anyo_espirometria            = $datos_cliente['periodico_anyo_espirometria'];
$periodico_anyo_enfa_osteo              = $datos_cliente['periodico_anyo_enfa_osteo'];
$periodico_anyo_manipul_aliment         = $datos_cliente['periodico_anyo_manipul_aliment'];
$egreso_hemograma                       = $datos_cliente['egreso_hemograma'];
$egreso_perfil_lipidico                 = $datos_cliente['egreso_perfil_lipidico'];
$egreso_audiometria                     = $datos_cliente['egreso_audiometria'];
$egreso_visiometria                     = $datos_cliente['egreso_visiometria'];
$egreso_espirometria                    = $datos_cliente['egreso_espirometria'];
$egreso_enfa_osteo                      = $datos_cliente['egreso_enfa_osteo'];
$egreso_manipul_aliment                 = $datos_cliente['egreso_manipul_aliment'];
$vacunacion_tetano                      = $datos_cliente['vacunacion_tetano'];
$vacunacion_fiebre_amarilla             = $datos_cliente['vacunacion_fiebre_amarilla'];
$vacunacion_influenza                   = $datos_cliente['vacunacion_influenza'];

$sql_grupo_area = "SELECT * FROM tbl15_grupo_area WHERE cod_grupo_area = '$cod_grupo_area'";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));
$datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area);

$nombre_grupo_area             = $datos_grupo_area['nombre_grupo_area'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_grupo_area_cargo_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead><tr>
		<th style="text-align:center">NOMBRE AREA A LABORAR</th>
		<th style="text-align:center">NOMBRE CARGO A LABORAR</th>
	</tr></thead>
    <tbody><tr>
    	<td style="text-align:center"><select name="cod_grupo_area" id="cod_grupo_area" onChange="conocer_cargo();" class="selectpicker" data-show-subtext="true" data-live-search="true">
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
    	<td style="text-align:center"><input class="input-block-level" name="nombre_grupo_area_cargo" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $nombre_grupo_area_cargo ?>" required autofocus/></td>
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
            <td style="text-align:center"><img src="../imagenes/img_riesgos/35.jpg" /></td>
            <td style="text-align:center"><img src="../imagenes/img_riesgos/34.jpg" alt="Otros" title="Otros" /></td>
            <td style="text-align:center"title="Codigo" /></td>
            <td style="text-align:center"title="Diligenciado" />OK</td>
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

$clasrieg_fis1_presionatmosf           = $datos['clasrieg_fis1_presionatmosf'];
$clasrieg_fis1_ionic                   = $datos['clasrieg_fis1_ionic'];
$clasrieg_biolog1_fluidexcrement       = $datos['clasrieg_biolog1_fluidexcrement'];
$clasrieg_quim1_polvoinorgorg          = $datos['clasrieg_quim1_polvoinorgorg'];
$clasrieg_quim1_fibras                 = $datos['clasrieg_quim1_fibras'];
$clasrieg_quim1_humos                  = $datos['clasrieg_quim1_humos'];
$clasrieg_quim1_materialparticulad     = $datos['clasrieg_quim1_materialparticulad'];
$clasrieg_psi1_gestorg                 = $datos['clasrieg_psi1_gestorg'];
$clasrieg_psi1_caracorgtrab            = $datos['clasrieg_psi1_caracorgtrab'];
$clasrieg_psi1_caracgrupsoctrab        = $datos['clasrieg_psi1_caracgrupsoctrab'];
$clasrieg_psi1_condictarea             = $datos['clasrieg_psi1_condictarea'];
$clasrieg_psi1_interfaspersontarea     = $datos['clasrieg_psi1_interfaspersontarea'];
$clasrieg_psi1_estreslab               = $datos['clasrieg_psi1_estreslab'];
$clasrieg_psi1_trabbajopresion         = $datos['clasrieg_psi1_trabbajopresion'];
$clasrieg_ergo1_manipmanualcarg        = $datos['clasrieg_ergo1_manipmanualcarg'];
$clasrieg_segur1_sismo                 = $datos['clasrieg_segur1_sismo'];
$clasrieg_segur1_delincuenciacomun     = $datos['clasrieg_segur1_delincuenciacomun'];
$clasrieg_segur1_accitransito          = $datos['clasrieg_segur1_accitransito'];
$clasrieg_segur1_caidaobjetos          = $datos['clasrieg_segur1_caidaobjetos'];
$clasrieg_segur1_puestotrabdesorden    = $datos['clasrieg_segur1_puestotrabdesorden'];

$chek_diligenciar                      = $datos['chek_diligenciar'];
?>
<tr>
<td style="text-align:center"><strong><?php echo $nombre_grupo_area;?> - </strong><?php echo $nombre_grupo_area_cargo;?></td>
<td style='text-align:center'><input name='clasrieg_fis1_ruid' class="clasrieg_fis1_ruid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_ruid=='S'){ echo 'checked'; } ?> title="Ruido"></td>
<td style='text-align:center'><input name='clasrieg_fis1_ilum' class="clasrieg_fis1_ilum" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_ilum=='S'){ echo 'checked'; } ?> title="Iluminacion"></td>
<td style='text-align:center'><input name='clasrieg_fis1_noionic' class="clasrieg_fis1_noionic" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_noionic=='S'){ echo 'checked'; } ?> title="Rad. No Ionizante"></td>
<td style='text-align:center'><input name='clasrieg_fis1_vibra' class="clasrieg_fis1_vibra" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_vibra=='S'){ echo 'checked'; } ?> title="Vibraciones"></td>
<td style='text-align:center'><input name='clasrieg_fis1_tempextrem' class="clasrieg_fis1_tempextrem" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_tempextrem=='S'){ echo 'checked'; } ?> title="Temp. Extremas"></td>
<td style='text-align:center'><input name='clasrieg_fis1_cambpres' class="clasrieg_fis1_cambpres" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_fis1_cambpres=='S'){ echo 'checked'; } ?> title="Cambios de Presión"></td>
<td style='text-align:center'><input name='clasrieg_quim1_gasvapor' class="clasrieg_quim1_gasvapor" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_quim1_gasvapor=='S'){ echo 'checked'; } ?> title="Gases y Vapores"></td>
<td style='text-align:center'><input name='clasrieg_quim1_aeroliq' class="clasrieg_quim1_aeroliq" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_quim1_aeroliq=='S'){ echo 'checked'; } ?> title="Aerosoles Líquidos"></td>
<td style='text-align:center'><input name='clasrieg_quim1_solid' class="clasrieg_quim1_solid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_quim1_solid=='S'){ echo 'checked'; } ?> title="Sólidos"></td>
<td style='text-align:center'><input name='clasrieg_quim1_liquid' class="clasrieg_quim1_liquid" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_quim1_liquid=='S'){ echo 'checked'; } ?> title="Líquidos"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_viru' class="clasrieg_biolog1_viru" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_viru=='S'){ echo 'checked'; } ?> title="Virus"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_bacter' class="clasrieg_biolog1_bacter" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_bacter=='S'){ echo 'checked'; } ?> title="Bacterias"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_parasi' class="clasrieg_biolog1_parasi" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_parasi=='S'){ echo 'checked'; } ?> title="Parásitos"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_morde' class="clasrieg_biolog1_morde" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_morde=='S'){ echo 'checked'; } ?> title="Mordeduras"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_picad' class="clasrieg_biolog1_picad" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_picad=='S'){ echo 'checked'; } ?> title="Picaduras"></td>
<td style='text-align:center'><input name='clasrieg_biolog1_hongo' class="clasrieg_biolog1_hongo" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_biolog1_hongo=='S'){ echo 'checked'; } ?> title="Hongos"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_trabestat' class="clasrieg_ergo1_trabestat" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_trabestat=='S'){ echo 'checked'; } ?> title="Trab. Estático"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_esfuerfis' class="clasrieg_ergo1_esfuerfis" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_esfuerfis=='S'){ echo 'checked'; } ?> title="Esfuerzo Físico"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_carga' class="clasrieg_ergo1_carga" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_carga=='S'){ echo 'checked'; } ?> title="Cargas"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_postforz' class="clasrieg_ergo1_postforz" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_postforz=='S'){ echo 'checked'; } ?> title="Posiciones Forzadas"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_movrepet' class="clasrieg_ergo1_movrepet" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_movrepet=='S'){ echo 'checked'; } ?> title="Mov. Repetitivos"></td>
<td style='text-align:center'><input name='clasrieg_ergo1_jortrab' class="clasrieg_ergo1_jortrab" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_ergo1_jortrab=='S'){ echo 'checked'; } ?> title="Jornada de Trabajo"></td>
<td style='text-align:center'><input name='clasrieg_psi1_monoto' class="clasrieg_psi1_monoto" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_psi1_monoto=='S'){ echo 'checked'; } ?> title="Monotonía"></td>
<td style='text-align:center'><input name='clasrieg_psi1_relhuman' class="clasrieg_psi1_relhuman" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_psi1_relhuman=='S'){ echo 'checked'; } ?> title="Relaciones Humanas"></td>
<td style='text-align:center'><input name='clasrieg_psi1_contentarea' class="clasrieg_psi1_contentarea" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_psi1_contentarea=='S'){ echo 'checked'; } ?> title="Contenido de la Tarea"></td>
<td style='text-align:center'><input name='clasrieg_psi1_orgtiemptrab' class="clasrieg_psi1_orgtiemptrab" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_psi1_orgtiemptrab=='S'){ echo 'checked'; } ?> title="Org. del Tiempo de Trabajo"></td>
<td style='text-align:center'><input name='clasrieg_segur1_mecanic' class="clasrieg_segur1_mecanic" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_mecanic=='S'){ echo 'checked'; } ?> title="Mecánicos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_electri' class="clasrieg_segur1_electri" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_electri=='S'){ echo 'checked'; } ?> title="Eléctricos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_locat' class="clasrieg_segur1_locat" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_locat=='S'){ echo 'checked'; } ?> title="Locativos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_fisiquim' class="clasrieg_segur1_fisiquim" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_fisiquim=='S'){ echo 'checked'; } ?> title="Físicoquimicos"></td>
<td style='text-align:center'><input name='clasrieg_segur1_public' class="clasrieg_segur1_public" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_public=='S'){ echo 'checked'; } ?> title="Público"></td>
<td style='text-align:center'><input name='clasrieg_segur1_espconfi' class="clasrieg_segur1_espconfi" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_espconfi=='S'){ echo 'checked'; } ?> title="Espacios Confinados"></td>
<td style='text-align:center'><input name='clasrieg_segur1_trabaltura' class="clasrieg_segur1_trabaltura" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_trabaltura=='S'){ echo 'checked'; } ?> title="Trabajo en Alturas"></td>
<td style='text-align:center'><input name='clasrieg_segur1_accitransito' class="clasrieg_segur1_accitransito" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_segur1_accitransito=='S'){ echo 'checked'; } ?> title=""></td>
<td style='text-align:center'><input name='clasrieg_observ1_otro' class="clasrieg_observ1_otro" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($clasrieg_observ1_otro=='S'){ echo 'checked'; } ?> title="Otros"></td>
<td style="text-align:center"><strong><?php echo $cod_grupo_area_cargo;?></strong></td>
<td style='text-align:center'><input name='chek_diligenciar' class="chek_diligenciar" id="<?php echo $cod_grupo_area_cargo;?>" type='checkbox' value='S' <?php if($chek_diligenciar=='S'){ echo 'checked'; } ?> title="Diligenciado"></td>
</tr>
</tbody>
</table>

<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr>
        <th style="text-align:center">OBJETIVO DEL CARGO A LABORAR</th>
        <th style="text-align:center">FUNCIÓN DEL CARGO A LABORAR</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center"><textarea name="objetivo_grupo_area_cargo" id="<?php echo $cod_grupo_area_cargo ?>" rows="4" cols="50"><?php echo $objetivo_grupo_area_cargo ?></textarea></td>
        <td style="text-align:center"><textarea name="funcion_grupo_area_cargo" id="<?php echo $cod_grupo_area_cargo ?>" rows="4" cols="50"><?php echo $funcion_grupo_area_cargo ?></textarea></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
            <th style="text-align:center">FORMACION  EXIGIDO POR CARGO O POR PUESTO DE TRABAJO</th>
</table>
<table border="1" class="table table-responsive">
    <thead><tr>
        <th style="text-align:center">NIVEL DE FORMACION MÍNIMA NECESARIA</th>
        <th style="text-align:center">CONOCIMIENTOS ESPECÍFICOS EN SEGURIAD Y SALUD EN EL TRABAJO</th>
        <th style="text-align:center">EXPERIENCIA PREVIA REQUERIDA</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center">
        <select id="<?php echo $cod_grupo_area_cargo;?>" name="nombre_escolaridad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_escolaridad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_escolaridad, nombre_escolaridad FROM tbl15_escolaridad ORDER BY nombre_escolaridad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_escolaridad) AND $nombre_escolaridad == $datos2['nombre_escolaridad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_escolaridad'];
$nombre = $datos2['nombre_escolaridad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
        </td>
        <td style="text-align:center"><textarea name="conocimientos_especificos" id="<?php echo $cod_grupo_area_cargo ?>" rows="4" cols="50"><?php echo $conocimientos_especificos ?></textarea></td>
        <td style="text-align:center"><input class="input-block-level" name="experiencia_previa_requerida" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $experiencia_previa_requerida ?>" /></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
            <th style="text-align:center">RESPONSABILIDAD</th>
</table>

<table border="1" class="table table-responsive">
    <thead><tr>
        <th style="text-align:center">Responsabilidad por supervisión</th>
        <th style="text-align:center">Responsabilidad por relaciones</th>
        <th style="text-align:center">Responsabilidad por valores</th>
        <th style="text-align:center">Responsabilidad por maquinas, equipo y materiales</th>
        <th style="text-align:center">Responsabilidad por operaciones técnicas</th>
        <th style="text-align:center">Organización y métodos de trabajo</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center"><input name="resp_supervision" class="resp_supervision" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($resp_supervision=='S'){ echo "checked"; } ?>></td>
        <td style="text-align:center"><input name="resp_relacion" class="resp_relacion" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($resp_relacion=='S'){ echo "checked"; } ?>></td>
        <td style="text-align:center"><input name="resp_valores" class="resp_valores" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($resp_valores=='S'){ echo "checked"; } ?>></td>
        <td style="text-align:center"><input name="resp_maquina_equipo_material" class="resp_maquina_equipo_material" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($resp_maquina_equipo_material=='S'){ echo "checked"; } ?>></td>
        <td style="text-align:center"><input name="resp_operaciones_tecnica" class="resp_operaciones_tecnica" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($resp_operaciones_tecnica=='S'){ echo "checked"; } ?>></td>
        <td style="text-align:center"><input name="org_metodo_trabajo" class="org_metodo_trabajo" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($org_metodo_trabajo=='S'){ echo "checked"; } ?>></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr>
        <th style="text-align:center">NIVEL DE ESFUERZO</th>
        <th style="text-align:center">DESCRIPCION DEL AMBIENTE</th>
        <th style="text-align:center">MAQUINAS EQUIPOS Y HERRAMIENTAS</th>
        <th style="text-align:center">HORARIO</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center">
        <select id="<?php echo $cod_grupo_area_cargo ?>" name="nombre_nivel_esfuerzo" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_nivel_esfuerzo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_nivel_esfuerzo, nombre_nivel_esfuerzo FROM tbl15_nivel_esfuerzo ORDER BY nombre_nivel_esfuerzo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_nivel_esfuerzo) AND $nombre_nivel_esfuerzo == $datos2['nombre_nivel_esfuerzo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_nivel_esfuerzo'];
$nombre = $datos2['nombre_nivel_esfuerzo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
        </td>
        <td style="text-align:center"><textarea name="descripcion_ambiente" id="<?php echo $cod_grupo_area_cargo ?>" rows="4" cols="50"><?php echo $descripcion_ambiente ?></textarea></td>
        <td style="text-align:center"><input class="input-block-level" name="maquinas_equipo_herramienta" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $maquinas_equipo_herramienta ?>"/></td>
        <td style="text-align:center"><input class="input-block-level" name="horario" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $horario ?>"/></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
  <tr height="21">
    <td style="text-align:center" colspan="3" rowspan="2">ELEMENTOS DE PROTECCION PERSONAL.</td>
    <td style="text-align:center">CABEZA</td>
    <td style="text-align:center">OJOS</td>
    <td style="text-align:center">RESPIRATORIA</td>
    <td style="text-align:center">AUDITIVA</td>
    <td style="text-align:center">MANOS</td>
    <td style="text-align:center" colspan="2">TRONCO</td>
    <td style="text-align:center">PIES</td>
    <td style="text-align:center">ALTURAS</td>
  </tr>
  <tr>
    <td style="text-align:center"><input name="dat_ocupa_cabeza1" class="dat_ocupa_cabeza1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_cabeza1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_visu1" class="dat_ocupa_visu1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_visu1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_resp1" class="dat_ocupa_resp1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_resp1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_audi1" class="dat_ocupa_audi1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_audi1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_manos1" class="dat_ocupa_manos1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_manos1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="dat_ocupa_tronco1" class="dat_ocupa_tronco1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_tronco1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_pies1" class="dat_ocupa_pies1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_pies1=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center"><input name="dat_ocupa_altu1" class="dat_ocupa_altu1" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($dat_ocupa_altu1=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="3">DESCRIPCION EPP</td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_visual" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_visual ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_audit" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_audit ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_resp" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_resp ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_cabeza" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_cabeza ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_manos" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_manos ?>"/></td>
    <td style="text-align:center" colspan="2"><input class="input-block-level" name="descrip_protec_tronco" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_tronco ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_pies" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_pies ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="descrip_protec_altura" id="<?php echo $cod_grupo_area_cargo ?>" type="text" value="<?php echo $descrip_protec_altura ?>"/></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
  <tr>
    <td style="text-align:center" colspan="11">EVALUACIONES MEDICAS OCUPACIONALES</td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="6">EVALUACIONES MEDICAS OCUPACIONALES</td>
    <td style="text-align:center">INGRESO</td>
    <td style="text-align:center" colspan="2">PERIODICOS (CADA AÑO )</td>
    <td style="text-align:center" colspan="2">EGRESO</td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">HEMOGRAMA</td>
    <td style="text-align:center"><input name="ingreso_hemograma" class="ingreso_hemograma" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_hemograma=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_hemograma" class="periodico_anyo_hemograma" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_hemograma=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_hemograma" class="egreso_hemograma" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_hemograma=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">PERFIL LIPIDICO</td>
    <td style="text-align:center"><input name="ingreso_perfil_lipidico" class="ingreso_perfil_lipidico" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_perfil_lipidico=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_perfil_lipidico" class="periodico_anyo_perfil_lipidico" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_perfil_lipidico=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_perfil_lipidico" class="egreso_perfil_lipidico" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_perfil_lipidico=='S'){ echo "checked"; } ?>></td>
  </tr>

  <tr>
    <td style="text-align:left" colspan="6">AUDIOMETRIA</td>
    <td style="text-align:center"><input name="ingreso_audiometria" class="ingreso_audiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_audiometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_audiometria" class="periodico_anyo_audiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_audiometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_audiometria" class="egreso_audiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_audiometria=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">VISOMETRIA</td>
    <td style="text-align:center"><input name="ingreso_visiometria" class="ingreso_visiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_visiometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_visiometria" class="periodico_anyo_visiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_visiometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_visiometria" class="egreso_visiometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_visiometria=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">ESPIROMETRIA</td>
    <td style="text-align:center"><input name="ingreso_espirometria" class="ingreso_espirometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_espirometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_espirometria" class="periodico_anyo_espirometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_espirometria=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_espirometria" class="egreso_espirometria" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_espirometria=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">EVALUACION MEDICA OCUPACIONAL CON ENFASS OSTEOMUSCULAR</td>
    <td style="text-align:center"><input name="ingreso_enfa_osteo" class="ingreso_enfa_osteo" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_enfa_osteo=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_enfa_osteo" class="periodico_anyo_enfa_osteo" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_enfa_osteo=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_enfa_osteo" class="egreso_enfa_osteo" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_enfa_osteo=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6">MANIPULACION DE ALIMENTOS</td>
    <td style="text-align:center"><input name="ingreso_manipul_aliment" class="ingreso_manipul_aliment" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($ingreso_manipul_aliment=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="periodico_anyo_manipul_aliment" class="periodico_anyo_manipul_aliment" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($periodico_anyo_manipul_aliment=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="egreso_manipul_aliment" class="egreso_manipul_aliment" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($egreso_manipul_aliment=='S'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td style="text-align:left" colspan="6" rowspan="2">VACUNACION</td>
    <td style="text-align:center">TETANO</td>
    <td style="text-align:center" colspan="2">FIEBRE AMARILLA</td>
    <td style="text-align:center" colspan="2">INFLUENZA</td>
  </tr>
  <tr>
    <td style="text-align:center"><input name="vacunacion_tetano" class="vacunacion_tetano" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($vacunacion_tetano=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="vacunacion_fiebre_amarilla" class="vacunacion_fiebre_amarilla" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($vacunacion_fiebre_amarilla=='S'){ echo "checked"; } ?>></td>
    <td style="text-align:center" colspan="2"><input name="vacunacion_influenza" class="vacunacion_influenza" id="<?php echo $cod_grupo_area_cargo ?>" type="checkbox" value="S" <?php if($vacunacion_influenza=='S'){ echo "checked"; } ?>></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="actions">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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

$(".resp_supervision").change(function(){ if( $(this).is(':checked') ){ $(".resp_supervision").val("S"); } else { $(".resp_supervision").val("N"); } });
$(".resp_maquina_equipo_material").change(function(){ if( $(this).is(':checked') ){ $(".resp_maquina_equipo_material").val("S"); } else { $(".resp_maquina_equipo_material").val("N"); } });
$(".resp_relacion").change(function(){ if( $(this).is(':checked') ){ $(".resp_relacion").val("S"); } else { $(".resp_relacion").val("N"); } });
$(".resp_operaciones_tecnica").change(function(){ if( $(this).is(':checked') ){ $(".resp_operaciones_tecnica").val("S"); } else { $(".resp_operaciones_tecnica").val("N"); } });
$(".resp_valores").change(function(){ if( $(this).is(':checked') ){ $(".resp_valores").val("S"); } else { $(".resp_valores").val("N"); } });


$(".org_metodo_trabajo").change(function(){ if( $(this).is(':checked') ){ $(".org_metodo_trabajo").val("S"); } else { $(".org_metodo_trabajo").val("N"); } });
$(".dat_ocupa_cabeza1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_cabeza1").val("S"); } else { $(".dat_ocupa_cabeza1").val("N"); } });
$(".dat_ocupa_visu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu1").val("S"); } else { $(".dat_ocupa_visu1").val("N"); } });
$(".dat_ocupa_resp1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp1").val("S"); } else { $(".dat_ocupa_resp1").val("N"); } });
$(".dat_ocupa_audi1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi1").val("S"); } else { $(".dat_ocupa_audi1").val("N"); } });
$(".dat_ocupa_manos1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_manos1").val("S"); } else { $(".dat_ocupa_manos1").val("N"); } });
$(".dat_ocupa_tronco1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_tronco1").val("S"); } else { $(".dat_ocupa_tronco1").val("N"); } });
$(".dat_ocupa_pies1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_pies1").val("S"); } else { $(".dat_ocupa_pies1").val("N"); } });
$(".dat_ocupa_altu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu1").val("S"); } else { $(".dat_ocupa_altu1").val("N"); } });
$(".ingreso_hemograma").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_hemograma").val("S"); } else { $(".ingreso_hemograma").val("N"); } });
$(".ingreso_perfil_lipidico").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_perfil_lipidico").val("S"); } else { $(".ingreso_perfil_lipidico").val("N"); } });
$(".ingreso_audiometria").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_audiometria").val("S"); } else { $(".ingreso_audiometria").val("N"); } });
$(".ingreso_visiometria").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_visiometria").val("S"); } else { $(".ingreso_visiometria").val("N"); } });
$(".ingreso_espirometria").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_espirometria").val("S"); } else { $(".ingreso_espirometria").val("N"); } });
$(".ingreso_enfa_osteo").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_enfa_osteo").val("S"); } else { $(".ingreso_enfa_osteo").val("N"); } });
$(".ingreso_manipul_aliment").change(function(){ if( $(this).is(':checked') ){ $(".ingreso_manipul_aliment").val("S"); } else { $(".ingreso_manipul_aliment").val("N"); } });
$(".periodico_anyo_hemograma").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_hemograma").val("S"); } else { $(".periodico_anyo_hemograma").val("N"); } });
$(".periodico_anyo_perfil_lipidico").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_perfil_lipidico").val("S"); } else { $(".periodico_anyo_perfil_lipidico").val("N"); } });
$(".periodico_anyo_audiometria").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_audiometria").val("S"); } else { $(".periodico_anyo_audiometria").val("N"); } });
$(".periodico_anyo_visiometria").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_visiometria").val("S"); } else { $(".periodico_anyo_visiometria").val("N"); } });
$(".periodico_anyo_espirometria").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_espirometria").val("S"); } else { $(".periodico_anyo_espirometria").val("N"); } });
$(".periodico_anyo_enfa_osteo").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_enfa_osteo").val("S"); } else { $(".periodico_anyo_enfa_osteo").val("N"); } });
$(".periodico_anyo_manipul_aliment").change(function(){ if( $(this).is(':checked') ){ $(".periodico_anyo_manipul_aliment").val("S"); } else { $(".periodico_anyo_manipul_aliment").val("N"); } });
$(".egreso_hemograma").change(function(){ if( $(this).is(':checked') ){ $(".egreso_hemograma").val("S"); } else { $(".egreso_hemograma").val("N"); } });
$(".egreso_perfil_lipidico").change(function(){ if( $(this).is(':checked') ){ $(".egreso_perfil_lipidico").val("S"); } else { $(".egreso_perfil_lipidico").val("N"); } });
$(".egreso_audiometria").change(function(){ if( $(this).is(':checked') ){ $(".egreso_audiometria").val("S"); } else { $(".egreso_audiometria").val("N"); } });
$(".egreso_visiometria").change(function(){ if( $(this).is(':checked') ){ $(".egreso_visiometria").val("S"); } else { $(".egreso_visiometria").val("N"); } });
$(".egreso_espirometria").change(function(){ if( $(this).is(':checked') ){ $(".egreso_espirometria").val("S"); } else { $(".egreso_espirometria").val("N"); } });
$(".egreso_enfa_osteo").change(function(){ if( $(this).is(':checked') ){ $(".egreso_enfa_osteo").val("S"); } else { $(".egreso_enfa_osteo").val("N"); } });
$(".egreso_manipul_aliment").change(function(){ if( $(this).is(':checked') ){ $(".egreso_manipul_aliment").val("S"); } else { $(".egreso_manipul_aliment").val("N"); } });
$(".vacunacion_tetano").change(function(){ if( $(this).is(':checked') ){ $(".vacunacion_tetano").val("S"); } else { $(".vacunacion_tetano").val("N"); } });
$(".vacunacion_fiebre_amarilla").change(function(){ if( $(this).is(':checked') ){ $(".vacunacion_fiebre_amarilla").val("S"); } else { $(".vacunacion_fiebre_amarilla").val("N"); } });
$(".vacunacion_influenza").change(function(){ if( $(this).is(':checked') ){ $(".vacunacion_influenza").val("S"); } else { $(".vacunacion_influenza").val("N"); } });


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