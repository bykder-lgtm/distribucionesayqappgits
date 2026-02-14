    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
<?php
$sql_producto = "SELECT * FROM tbl15_marca WHERE (nombre_estado = 'ACTIVO') ORDER BY cod_marca";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

    $contador++;
    $cod_marca                         = $datos_producto['cod_marca'];
    $cod_marca_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_marca);
    $cod_marca_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_marca_codif);
    $nombre_marca                      = $datos_producto['nombre_marca'];
    $nombre_marca_codif                = DAXCODIFCRYPTOR::encodiftextodax($nombre_marca);
    $nombre_marca_codifcryp            = DAXCODIFCRYPTOR::encriptardax($nombre_marca_codif);
    $nombre_tipo_marca                 = $datos_producto['nombre_tipo_marca'];
    $nombre_tipo_marca_codif           = DAXCODIFCRYPTOR::encodiftextodax($nombre_tipo_marca);
    $nombre_tipo_marca_codifcryp       = DAXCODIFCRYPTOR::encriptardax($nombre_tipo_marca_codif);
    $url_img_marca_min                 = $datos_producto['url_img_marca_min'];
    $url_img_marca_orig                = $datos_producto['url_img_marca_orig'];
    $cod_estado                        = $datos_producto['cod_estado'];
?>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="<?php echo $url_img_marca_orig ?>" alt="<?php echo $nombre_marca ?>" />
                    <div class="hov-in"><a href="../admin/ver_producto.php?nombre_marca_codifcryp=<?php echo $nombre_tipo_marca_codifcryp ?>"><i class="fab fa-instagram"></i></a></div>
                </div>
            </div>
<?php } ?>
        </div>
    </div>