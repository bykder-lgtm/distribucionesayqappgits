                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <div class="single-product-details"><h2>Marcas</h2></div>
                            </div>
<?php
if (isset($_GET['nombre_categoria'])) { $nombre_categoria_get = addslashes($_GET['nombre_categoria']); } else { $nombre_categoria_get = ''; } ?>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
            
                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">
<?php
$sql_producto_categoria = "SELECT * FROM tbl15_marca WHERE (cod_estado = '1') ORDER BY cod_marca";
$consulta_producto_categoria = mysqli_query($conectar, $sql_producto_categoria) or die(mysqli_error($conectar));
while ($datos_producto_categoria = mysqli_fetch_assoc($consulta_producto_categoria)) {

$cod_marca                         = $datos_producto_categoria['cod_marca'];
$cod_marca_codif                   = DAXCODIFCRYPTOR::encodifdax($cod_marca);
$cod_marca_codifcryp               = DAXCODIFCRYPTOR::encriptardax($cod_marca_codif);
$nombre_marca                      = $datos_producto_categoria['nombre_marca'];
$nombre_marca_codif                = DAXCODIFCRYPTOR::encodiftextodax($nombre_marca);
$nombre_marca_codifcryp            = DAXCODIFCRYPTOR::encriptardax($nombre_marca_codif);
$nombre_tipo_marca                 = $datos_producto_categoria['nombre_tipo_marca'];
$url_img_marca_min                 = $datos_producto_categoria['url_img_marca_min'];
$url_img_marca_orig                = $datos_producto_categoria['url_img_marca_orig'];
$cod_estado                        = $datos_producto_categoria['cod_estado'];
?>
<a href="../admin/ver_producto.php?nombre_marca_codifcryp=<?php echo $nombre_marca_codifcryp ?>"><img class="d-block w-55 img-fluid" src="<?php echo $url_img_marca_orig ?>" alt="" /></a>
<?php } ?>
                                        </div>
                                    </div>
                                </div>
<!--
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Footwear 
                                <small class="text-muted">(50)</small>
                                </a>
                                    <div class="collapse" id="sub-men2" data-parent="#list-group-men">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">Sports Shoes <small class="text-muted">(10)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Sneakers <small class="text-muted">(20)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Formal Shoes <small class="text-muted">(20)</small></a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="list-group-item list-group-item-action"> Men  <small class="text-muted">(150) </small></a>
                                <a href="#" class="list-group-item list-group-item-action">Accessories <small class="text-muted">(11)</small></a>
                                <a href="#" class="list-group-item list-group-item-action">Bags <small class="text-muted">(22)</small></a>
-->
                            </div>
                        </div>