<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
$pagina = addslashes($_GET['pagina']);
$pagina_local = $_SERVER['PHP_SELF'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_soporte_tecnico.php"><h4>Resolver soporte</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_soporte_tecnico                                 = intval($_GET['cod_soporte_tecnico']);
$pagina_local                                        = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT * FROM tbl15_soporte_tecnico WHERE cod_soporte_tecnico = '$cod_soporte_tecnico'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$cod_soporte_tecnico                                         = $info_cliente['cod_soporte_tecnico'];
$problema_soporte_tecnico                                    = $info_cliente['problema_soporte_tecnico'];
$respuesta_soporte_tecnico                                   = $info_cliente['respuesta_soporte_tecnico'];
$correo_registro_soporte_tecnico                             = $info_cliente['correo_registro_soporte_tecnico'];
$correo_contrasena_perfil_cuenta_danada_soporte_tecnico      = $info_cliente['correo_contrasena_perfil_cuenta_danada_soporte_tecnico'];
$cod_perfil_cuenta_completa                                  = $info_cliente['cod_perfil_cuenta_completa'];
$fecha_compra_soporte_tecnico                                = $info_cliente['fecha_compra_soporte_tecnico'];
$fecha_vencimiento_soporte_tecnico                           = $info_cliente['fecha_vencimiento_soporte_tecnico'];
$cod_plataforma_streaming                                    = $info_cliente['cod_plataforma_streaming'];
$cod_tipo_reporte_fallo                                      = $info_cliente['cod_tipo_reporte_fallo'];
$cod_administrador                                           = $info_cliente['cod_administrador'];
$fecha_soporte_tecnico                                       = $info_cliente['fecha_soporte_tecnico'];
$hora_soporte_tecnico                                        = $info_cliente['hora_soporte_tecnico'];
$url_img_orig_producto                                       = $info_cliente['url_img_orig_producto'];

$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
 	
$cedula                                                      = $info_usuario_admin['cedula'];
$nombres                                                     = $info_usuario_admin['nombres'];
$apellidos                                                   = $info_usuario_admin['apellidos'];
$cuenta                                                      = $info_usuario_admin['cuenta'];
$usuario                                                     = $nombres.' '.$apellidos.' | '.$cuenta;

$sql_perfil_cuenta_completa = "SELECT * FROM tbl15_perfil_cuenta_completa WHERE (cod_perfil_cuenta_completa = '$cod_perfil_cuenta_completa')";
$resultado_perfil_cuenta_completa = mysqli_query($conectar, $sql_perfil_cuenta_completa);
$info_perfil_cuenta_completa = mysqli_fetch_assoc($resultado_perfil_cuenta_completa);
 	
$nombre_perfil_cuenta_completa                               = $info_perfil_cuenta_completa['nombre_perfil_cuenta_completa'];

$sql_plataforma_streaming = "SELECT * FROM tbl15_plataforma_streaming WHERE (cod_plataforma_streaming = '$cod_plataforma_streaming')";
$resultado_plataforma_streaming = mysqli_query($conectar, $sql_plataforma_streaming);
$info_plataforma_streaming = mysqli_fetch_assoc($resultado_plataforma_streaming);
 	
$nombre_plataforma_streaming                                 = $info_plataforma_streaming['nombre_plataforma_streaming'];

$sql_tipo_reporte_fallo = "SELECT * FROM tbl15_tipo_reporte_fallo WHERE (cod_tipo_reporte_fallo = '$cod_tipo_reporte_fallo')";
$resultado_tipo_reporte_fallo = mysqli_query($conectar, $sql_tipo_reporte_fallo);
$info_tipo_reporte_fallo = mysqli_fetch_assoc($resultado_tipo_reporte_fallo);
 	
$nombre_tipo_reporte_fallo                                   = $info_tipo_reporte_fallo['nombre_tipo_reporte_fallo'];

if ($url_img_orig_producto <> '') { $activar_imagen_url = '<a href="'.$url_img_orig_producto.'" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a>'; } else { $activar_imagen_url = ''; }
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_soporte_tecnico_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">ID</th>
		<th style="text-align:center">Descripción del Problema</th>
		<th style="text-align:center">Plataforma</th>
		<th style="text-align:center">Tipo de reporte</th>
		<th style="text-align:center">Fecha - Hora</th>
		<th style="text-align:center">Vendedor</th>
		<th style="text-align:center">correo de registro</th>
		<th style="text-align:center">Correo - Contraseña - Perfil (solo si aplica) de la cuenta dañada</th>
		<th style="text-align:center">Soporte Imagen</th>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo $cod_soporte_tecnico ?></td>
		<td style="text-align:left"><?php echo $problema_soporte_tecnico ?></td>
		<td style="text-align:center"><?php echo $nombre_plataforma_streaming ?></td>
		<td style="text-align:center"><?php echo $nombre_tipo_reporte_fallo ?></td>
		<td style="text-align:center"><?php echo $fecha_soporte_tecnico?> - <?php echo $hora_soporte_tecnico?></td>
		<td style="text-align:center"><?php echo $usuario?></td>
		<td style="text-align:center"><?php echo $correo_registro_soporte_tecnico?></td>
		<td style="text-align:center"><?php echo $correo_contrasena_perfil_cuenta_danada_soporte_tecnico?></td>
        <td style="text-align:center;"><?php echo $activar_imagen_url ?></td>
	</tr>
</table>

<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">Respuesta</th>
	</tr>
	<tr>
        <td style="text-align:center"><textarea class="form-control" name="respuesta_soporte_tecnico" id="respuesta_soporte_tecnico" placeholder="" rows="3" cols="20" required><?php echo $respuesta_soporte_tecnico ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_soporte_tecnico" value="<?php echo $cod_soporte_tecnico ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="js/jquery-ui.js"></script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_departamento").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_departamento";
        var tipo_ajax = "tbl15_tercero";
        var id = "0";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_municipio_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
            	$("#cod_municipio_select").html(respuesta);
            }
        });

   });
});
</script>

<script type="text/javascript">
$('#nombre_ciudad').on('keypress',function(){
	var nombre_campo = $(this).attr("name");
	var nombre_sexo = 'HEMBRA';
	var nombre_tipo_producto = 'ANIMAL';
	//var cod_departamento = $("#cod_departamento option:selected").text();
	var cod_departamento = document.getElementById('cod_departamento').value;

	$(function() {
		$("#"+nombre_campo).autocomplete({
		source: "autocompletar_cod_nombre_municipio.php?nombre_campo="+nombre_campo+"&cod_departamento="+cod_departamento+"&nombre_tipo_producto="+nombre_tipo_producto+"",
		minLength: 1,
			select: function(event, ui) {
				event.preventDefault();
				var cod_municipio = ui.item.cod_municipio;
				var nombre_municipio = ui.item.nombre_municipio;

				$('#cod_municipio').val(cod_municipio);
				$('#'+nombre_campo).val(nombre_municipio);

			}
		});
	});

});
</script>

</body>
</html>