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
<a href="../admin/lista_cie10_edit_estado.php"><h4>Listado Cie - 10 Editar Estado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="#">Listado Cie - 10 Editar Todo</h4></a>
</div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_cie10 ORDER BY codigo_cie10 ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
?>
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'cajhabiltada';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'cajdeshabiltada';
if (last != valor)
myajax.Link('edit_lista_cie10_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>

<body onLoad="myajax = new isiAJAX();">
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Key</th>
<th>Codigo</th>
<th>Descripcion</th>
<th>Simbolo</th>
<th>Sexo</th>
<th>Limit Inf</th>
<th>Limit Sup</th>
<th>No Afect</th>
<th>Observacion</th>
<th>Estado</th>
</tr>
</thead>
<tbody>
<?php
while ($datos = mysqli_fetch_assoc($consulta)) {
$cod_cie10                      = $datos['cod_cie10'];
$codigo_cie10                   = $datos['codigo_cie10'];
$simbolo_cie10                  = $datos['simbolo_cie10'];
$descripcion_cie10              = $datos['descripcion_cie10'];
$sexo_cie10                     = $datos['sexo_cie10'];
$limit_inf_cie10                = $datos['limit_inf_cie10'];
$limit_sup_cie10                = $datos['limit_sup_cie10'];
$no_afect_prin_cie10            = $datos['no_afect_prin_cie10'];
$observacion_cie10              = $datos['observacion_cie10'];
$cod_estado_cie10               = $datos['cod_estado_cie10'];
?>
<tr>
<td><?php echo $cod_cie10;?></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'codigo_cie10', <?php echo $cod_cie10;?>)" class="cajbarras" id="<?php echo $cod_cie10;?>" value="<?php echo $codigo_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'descripcion_cie10', <?php echo $cod_cie10;?>)" class="cajsuper" id="<?php echo $cod_cie10;?>" value="<?php echo $descripcion_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'simbolo_cie10', <?php echo $cod_cie10;?>)" class="cajpequena" id="<?php echo $cod_cie10;?>" value="<?php echo $simbolo_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'sexo_cie10', <?php echo $cod_cie10;?>)" class="cajpequena" id="<?php echo $cod_cie10;?>" value="<?php echo $sexo_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'limit_inf_cie10', <?php echo $cod_cie10;?>)" class="cajpequena" id="<?php echo $cod_cie10;?>" value="<?php echo $limit_inf_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'limit_sup_cie10', <?php echo $cod_cie10;?>)" class="cajpequena" id="<?php echo $cod_cie10;?>" value="<?php echo $limit_sup_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'no_afect_prin_cie10', <?php echo $cod_cie10;?>)" class="cajpequena" id="<?php echo $cod_cie10;?>" value="<?php echo $no_afect_prin_cie10;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'observacion_cie10', <?php echo $cod_cie10;?>)" class="cajbarras" id="<?php echo $cod_cie10;?>" value="<?php echo $observacion_cie10;?>"></td>
<td>
<select name="cod_estado_cie10" id="<?php echo $cod_cie10 ?>" required>
<?php if (isset($cod_estado_cie10)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_estado_cie10) and $cod_estado_cie10 == $datos2['cod_estado']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_estado'];
$nombre = $datos2['nombre_estado'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
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
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_cie10_ajax.php",  
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
$.ajax({  
    url:"guardar_edit_cie10_ajax.php",  
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
$.ajax({  
    url:"guardar_edit_cie10_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>