<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Usuarios Archivados</h4></a>
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina = $_SERVER['PHP_SELF'];
?>

<div class="table-responsive">
<table class="table table-hover">
<thead>
	<tr>
		<th style="text-align:center">Cuenta</th>
		<th style="text-align:center">Nombres</th>
		<th style="text-align:center">Tipo de Rol</th>
		<th style="text-align:center">Correo</th>
		<th style="text-align:center">Telefono</th>
		<th style="text-align:center">Fecha Registro</th>
		<th style="text-align:center">Acciones</th>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT tbl15_administrador.*, tbl15_seguridad.nombre_seguridad 
FROM tbl15_administrador 
LEFT JOIN tbl15_seguridad ON tbl15_seguridad.cod_seguridad = tbl15_administrador.cod_seguridad 
WHERE (tbl15_administrador.cod_estado = '0' OR tbl15_administrador.cod_estado_activacion_usuario = '3') 
ORDER BY tbl15_administrador.cod_administrador DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_administrador             = $matriz_consulta['cod_administrador'];
$cuenta                        = $matriz_consulta['cuenta'];
$nombres                       = $matriz_consulta['nombres'];
$apellidos                     = $matriz_consulta['apellidos'];
$correo                        = $matriz_consulta['correo'];
$nombre_seguridad              = $matriz_consulta['nombre_seguridad'];
$telefono                      = $matriz_consulta['telefono'];
$fecha                         = $matriz_consulta['fecha'];
?>
	<tr>
		<td style="text-align:left"><?php echo $cuenta; ?></td>
		<td style="text-align:left"><?php echo $nombres.' '.$apellidos; ?></td>
		<td style="text-align:center"><?php echo $nombre_seguridad; ?></td>
		<td style="text-align:center"><?php echo $correo; ?></td>
		<td style="text-align:center"><?php echo $telefono; ?></td>
		<td style="text-align:center"><?php echo $fecha; ?></td>
		<td style="text-align:center">
            <button class="btn btn-success" onclick="restaurarUsuario(<?php echo $cod_administrador; ?>)">Restaurar</button>
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
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>

<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function restaurarUsuario(cod_administrador) {
    Swal.fire({
        title: '¿Restaurar Usuario?',
        text: "¿Estás seguro de que deseas restaurar este usuario? Volverá a estar activo en el sistema.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, restaurar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'proceso_restaurar_usuario_ajax.php',
                type: 'POST',
                data: { cod_administrador: cod_administrador },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            '¡Restaurado!',
                            'El usuario ha sido restaurado correctamente.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }
            });
        }
    });
}
</script>

</body>
</html>
