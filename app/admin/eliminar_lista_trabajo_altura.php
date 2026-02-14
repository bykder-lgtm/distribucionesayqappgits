<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
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
<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Trabajo en Alturas</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_trabajo_altura';
$tipo = 'eliminar';
$campo = 'cod_trabajo_altura';

$sql_cliente = "SELECT tbl15_trabajo_altura.cod_trabajo_altura, tbl15_trabajo_altura.cod_historia_clinica, 
tbl15_trabajo_altura.cod_cliente, tbl15_trabajo_altura.cod_administrador, tbl15_trabajo_altura.motivo_trabajo_altura, 
tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_trabajo_altura.fecha_time, tbl15_cliente.url_img_foto_min, tbl15_cliente.url_img_firma_min
FROM tbl15_historia_clinica RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_trabajo_altura 
ON tbl15_administrador.cod_administrador = tbl15_trabajo_altura.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_trabajo_altura.cod_cliente) 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_trabajo_altura.cod_historia_clinica ORDER BY tbl15_trabajo_altura.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//HAVING (((tbl15_cliente.cedula) LIKE '') OR ((tbl15_cliente.nombres) LIKE '') OR ((tbl15_cliente.apellido1) LIKE '')) ORDER BY tbl15_trabajo_altura.fecha_time DESC";
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table id="tabla_clase_datatable" class="table table-bordered">
<thead>
<tr>
<th>Elim</th>
<th>COD</th>
<th>HC</th>
<th>Cedula</th>
<th>Nombre Paciente</th>
<th>Motivo</th>
<th>Nombre Profesional</th>
<th>Fecha</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_trabajo_altura        = $info_cliente['cod_trabajo_altura'];
$cod_historia_clinica      = $info_cliente['cod_historia_clinica'];
$cod_cliente               = $info_cliente['cod_cliente'];
$cod_administrador_hist    = $info_cliente['cod_administrador'];
$cedula                    = $info_cliente['cedula'];
$nombres                   = $info_cliente['nombres'];
$apellido1                 = $info_cliente['apellido1'];
$motivo_trabajo_altura     = $info_cliente['motivo_trabajo_altura'];
$nombre_prof               = $info_cliente['nombre_prof'];
$apellidos_prof            = $info_cliente['apellidos_prof'];
$url_img_firma_min         = $info_cliente['url_img_firma_min'];
$url_img_foto_min          = $info_cliente['url_img_foto_min'];
$fecha_time                = $info_cliente['fecha_time'];
$fecha_dmy                 = date("Y/m/d", $fecha_time);
$hora                      = date("H:i", $fecha_time);
?>
<tr id="<?php echo $cod_trabajo_altura;?>">
<td class="service_list" id="cod_trabajo_altura<?php echo $cod_trabajo_altura ?>" data="<?php echo $cod_trabajo_altura ?>"><a class="eliminar" id="cod_trabajo_altura<?php echo $cod_trabajo_altura ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="cod_trabajo_altura_<?php echo $cod_trabajo_altura;?>"><?php echo $cod_trabajo_altura;?></td>
<td id="cod_historia_clinica<?php echo $cod_trabajo_altura;?>"><?php echo $cod_historia_clinica;?></td>
<td id="cedula<?php echo $cod_trabajo_altura;?>"><?php echo $cedula?></td>
<td id="nombres<?php echo $cod_trabajo_altura;?>"><?php echo $nombres.' '.$apellido1?></td>
<td id="motivo_trabajo_altura<?php echo $cod_trabajo_altura;?>"><?php echo $motivo_trabajo_altura?></td>
<td id="nombre_prof<?php echo $cod_trabajo_altura;?>"><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td id="fecha_dmy<?php echo $cod_trabajo_altura;?>"><?php echo $fecha_dmy?></td>
</tr id="<?php echo $cod_trabajo_altura;?>">
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_trabajo_altura = $(this).parent().attr('data');
        var dataString = 'llave='+cod_trabajo_altura+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_trabajo_altura+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_trabajo_altura_'+cod_trabajo_altura).fadeOut("slow");
                $('#cod_historia_clinica'+cod_trabajo_altura).fadeOut("slow");
                $('#cedula'+cod_trabajo_altura).fadeOut("slow");
                $('#nombres'+cod_trabajo_altura).fadeOut("slow");
                $('#motivo_trabajo_altura'+cod_trabajo_altura).fadeOut("slow");
                $('#nombre_prof'+cod_trabajo_altura).fadeOut("slow");
                $('#fecha_dmy'+cod_trabajo_altura).fadeOut("slow");
                $('#tr'+cod_trabajo_altura).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>