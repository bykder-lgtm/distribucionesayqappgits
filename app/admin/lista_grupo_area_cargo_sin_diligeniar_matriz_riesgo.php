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

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Cargo a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="#">Cargos Sin Diligenciar Matriz de Riesgo</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area.nombre_grupo, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, 
tbl15_grupo_area_cargo.cod_grupo_area_cargo, tbl15_grupo_area.cod_grupo_area 
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area 
WHERE tbl15_grupo_area_cargo.clasrieg_fis1_ruid ='' ORDER BY tbl15_grupo_area_cargo.cod_grupo_area_cargo DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
//$info_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<div class="table-responsive">
<table id="tabla_clase_datatable" class="table table-striped">
<thead>
<tr>
<th>Area a Laborar</th>
<th>Cargo a Laborar</th>
<th>Cod</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
 	
$cod_grupo_area_cargo          = $info_cliente['cod_grupo_area_cargo'];
$nombre_grupo_area_cargo       = $info_cliente['nombre_grupo_area_cargo'];
$nombre_grupo_area             = $info_cliente['nombre_grupo_area'];
?>
<tr>
<td><?php echo $nombre_grupo_area?></td>
<td><?php echo $nombre_grupo_area_cargo?></td>
<td><?php echo $cod_grupo_area_cargo?></td>
<td align="center"><a href="../admin/edit_grupo_area_cargo.php?cod_grupo_area_cargo=<?php echo $cod_grupo_area_cargo?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php } ?>
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
        "order": [[ 3, "desc" ]],
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
</body>
</html>