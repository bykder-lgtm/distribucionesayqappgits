<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda' AND cod_estado != '0'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_tienda                                     = $matriz_consulta['nombre_tienda'];
$nombre1_tercero                                   = $matriz_consulta['nombre1_tercero'];
$identificacion_tercero                            = $matriz_consulta['identificacion_tercero'];
$digito_tercero                                    = $matriz_consulta['digito_tercero'];
$direccion_tercero                                 = $matriz_consulta['direccion_tercero'];
$telefono1_tercero                                 = $matriz_consulta['telefono1_tercero'];
$correo_tercero                                    = $matriz_consulta['correo_tercero'];
$cod_pais                                          = $matriz_consulta['cod_pais'];
$cod_departamento                                  = $matriz_consulta['cod_departamento'];
$cod_municipio                                     = $matriz_consulta['cod_municipio'];
$nombre_tipo_cliente                               = $matriz_consulta['nombre_tipo_cliente'];
$nombre_tipo_regimen                               = $matriz_consulta['nombre_tipo_regimen'];
$nombre_tipo_impuesto                              = $matriz_consulta['nombre_tipo_impuesto'];
$url_img_orig_tienda                               = $matriz_consulta['url_img_orig_tienda'];
$url_img_min_tienda                                = $matriz_consulta['url_img_min_tienda'];

$sql_seguridad_usuario = "SELECT nombre_seguridad FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad_usuar'";
$consulta = mysqli_query($conectar, $sql_seguridad_usuario) or die(mysqli_error($conectar));
$matriz_seguridad_usuario = mysqli_fetch_assoc($consulta);

$nombre_seguridad                                 = $matriz_seguridad_usuario['nombre_seguridad'];
?>
<!-- Encabezado -->
<header class="header_app_movil_enrollment">
  <div class="container d-flex align-items-center">
    <div class="logo_app_movil_enrollmen me-3"><img src="../imagenes/logo_flexitech_sistema.png" style="height: 80px" class="logo" alt=""></div>
    <!--<div class="logo_app_movil_enrollmen me-3"><img src="<?php echo $url_img_orig_tienda ?>" style="height: 80px" class="logo" alt=""></div>-->

    <div>
      <h5 class="mb-0 fw-bold"><?php echo $nombre_tienda ?></h5>
      <small class="text-white">Catalogo de productos</small>
    </div>
  </div>
</header>