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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Remisión</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_remision';
$tipo = 'eliminar';
$campo = 'cod_remision';
 	 	 	
$sql_cliente = "SELECT tbl15_remision.cod_remision, tbl15_remision.cod_cliente, tbl15_remision.cod_administrador, 
tbl15_remision.cod_tipo_remision, tbl15_remision.motivo, tbl15_remision.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.url_img_firma, tbl15_cliente.url_img_foto, 
tbl15_cliente.apellido2, tbl15_administrador.cuenta, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof 
FROM (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_remision ON tbl15_administrador.cod_administrador = tbl15_remision.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_remision.cod_cliente) ORDER BY tbl15_remision.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
?>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table id="tabla_clase_datatable" class="table table-bordered">
<thead>
<tr>
<th>Elim</th>
<th>COD</th>
<th>Cedula</th>
<th>Nombre Paciente</th>
<th>Motivo</th>
<th>Nombre Profesional</th>
<th>Fecha</th>
<th>Hora</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_remision                      = $info_cliente['cod_remision'];
$cod_cliente                       = $info_cliente['cod_cliente'];
$cod_administrador_hist            = $info_cliente['cod_administrador'];
$cedula                            = $info_cliente['cedula'];
$nombres                           = $info_cliente['nombres'];
$apellido1                         = $info_cliente['apellido1'];
$apellido2                         = $info_cliente['apellido2'];
$motivo                            = $info_cliente['motivo'];
$nombre_prof                       = $info_cliente['nombre_prof'];
$apellidos_prof                    = $info_cliente['apellidos_prof'];
$url_img_firma                     = $info_cliente['url_img_firma'];
$url_img_foto                      = $info_cliente['url_img_foto'];
$fecha_time                        = $info_cliente['fecha_time'];
$fecha_dmy                         = date("Y/m/d", $fecha_time);
$hora                              = date("H:i", $fecha_time);
?>
<tr id="<?php echo $cod_remision;?>">
<td class="service_list" id="cod_remision<?php echo $cod_remision ?>" data="<?php echo $cod_remision ?>"><a class="eliminar" id="cod_remision<?php echo $cod_remision ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td id="cod_remision_<?php echo $cod_remision;?>"><?php echo $cod_remision?></td>
<td id="cedula_<?php echo $cod_remision;?>"><?php echo $cedula?></td>
<td id="nombres_<?php echo $cod_remision;?>"><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td id="motivo_<?php echo $cod_remision;?>"><?php echo $motivo?></td>
<td id="nombre_prof_<?php echo $cod_remision;?>"><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td id="fecha_dmy_<?php echo $cod_remision;?>"><?php echo $fecha_dmy?></td>
<td id="hora_<?php echo $cod_remision;?>"><?php echo $hora?></td>
</tr id="<?php echo $cod_remision;?>">
<?php
}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#tabla_clase_datatable').DataTable( {
    	"lengthMenu": [[5, 10, 25, 50, 100, 200, 300, -1], [5, 10, 25, 50, 100, 200, 300, "Todo"]],
        "paging":   true,
        "ordering": true,
        "info":     true,
        "order": [[ 6, "desc" ]],
        "pagingType": "full_numbers",
         stateSave: true

    } );

 $('#tabla_clase_datatable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );


} );
</script>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_remision = $(this).parent().attr('data');
        var dataString = 'llave='+cod_remision+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_remision+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_remision_'+cod_remision).fadeOut("slow");
                $('#cedula_'+cod_remision).fadeOut("slow");
                $('#nombres_'+cod_remision).fadeOut("slow");
                $('#motivo_'+cod_remision).fadeOut("slow");
                $('#nombre_prof_'+cod_remision).fadeOut("slow");
                $('#fecha_dmy_'+cod_remision).fadeOut("slow");
                $('#hora_'+cod_remision).fadeOut("slow");
                $('#tr'+cod_remision).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>