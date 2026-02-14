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
<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Citas</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'historia_clinica_cita';
$tipo = 'eliminar';
$campo = 'cod_historia_clinica';

$sql_cliente = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.apellido2, tbl15_historia_clinica.motivo, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.cuenta, tbl15_historia_clinica.hora
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente WHERE tbl15_historia_clinica.cod_estado_facturacion = '0' ORDER BY tbl15_historia_clinica.fecha_reg_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<th>Elim</th>
<th>HC</th>
<th>Cedula</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Motivo</th>
<th>Fecha</th>
<th>Hora</th>
<th>Cuenta</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_historia_clinica = $info_cliente['cod_historia_clinica'];
$cod_cliente = $info_cliente['cod_cliente'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$motivo = $info_cliente['motivo'];
$fecha_dmy = $info_cliente['fecha_dmy'];
$hora = $info_cliente['hora'];
$cuenta = $info_cliente['cuenta'];
?>
<tr id="<?php echo $cod_historia_clinica;?>">
<td class="service_list" id="cod_historia_clinica<?php echo $cod_historia_clinica ?>" data="<?php echo $cod_historia_clinica ?>"><a class="eliminar" id="cod_historia_clinica<?php echo $cod_historia_clinica ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<!--<td align="center"><a href="../admin/eliminar.php?llave=<?php echo $cod_historia_clinica?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td id="cod_historia_clinica_<?php echo $cod_historia_clinica;?>"><?php echo $cod_historia_clinica?></td>
<td id="cedula<?php echo $cod_historia_clinica;?>"><?php echo $cedula?></td>
<td id="nombres<?php echo $cod_historia_clinica;?>"><?php echo $nombres?></td>
<td id="apellido1<?php echo $cod_historia_clinica;?>"><?php echo $apellido1?></td>
<td id="motivo<?php echo $cod_historia_clinica;?>"><?php echo $motivo?></td>
<td id="fecha_dmy<?php echo $cod_historia_clinica;?>"><?php echo $fecha_dmy?></td>
<td id="hora<?php echo $cod_historia_clinica;?>"><?php echo $hora?></td>
<td id="cuenta<?php echo $cod_historia_clinica;?>"><?php echo $cuenta?></td>
</tr id="<?php echo $cod_historia_clinica;?>">
<?php
}
?>
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_historia_clinica = $(this).parent().attr('data');
        var dataString = 'llave='+cod_historia_clinica+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_historia_clinica+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_historia_clinica_'+cod_historia_clinica).fadeOut("slow");
                $('#cedula'+cod_historia_clinica).fadeOut("slow");
                $('#nombres'+cod_historia_clinica).fadeOut("slow");
                $('#apellido1'+cod_historia_clinica).fadeOut("slow");
                $('#motivo'+cod_historia_clinica).fadeOut("slow");
                $('#fecha_dmy'+cod_historia_clinica).fadeOut("slow");
                $('#hora'+cod_historia_clinica).fadeOut("slow");
                $('#cuenta'+cod_historia_clinica).fadeOut("slow");
                $('#tr'+cod_historia_clinica).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>