                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3><a href="../admin/ver_producto.php">Categorias</a></h3>
                            </div>
<?php
if (isset($_GET['cod_categoria'])) { $cod_categoria_get = addslashes($_GET['cod_categoria']); } else { $cod_categoria_get = ''; }

$sql_producto_total = "SELECT cod_producto FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$total_productos = mysqli_num_rows($consulta_producto_total);
?>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1">Categorias<small class="text-muted">(<?php echo $total_productos ?>)</small>
                                </a>
                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">
<?php
$sql_producto_categoria = "SELECT cod_categoria, count(cod_categoria) AS total_cat FROM tbl15_producto WHERE (nombre_estado = 'HABILITADO') GROUP BY cod_categoria";
$consulta_producto_categoria = mysqli_query($conectar, $sql_producto_categoria) or die(mysqli_error($conectar));
while ($datos_producto_categoria = mysqli_fetch_assoc($consulta_producto_categoria)) {

$cod_categoria                  = $datos_producto_categoria['cod_categoria'];
$cod_categoria_codif            = DAXCODIFCRYPTOR::encodiftextodax($cod_categoria);
$cod_categoria_codifcryp        = DAXCODIFCRYPTOR::encriptardax($cod_categoria_codif);

$total_cat                      = $datos_producto_categoria['total_cat'];

$sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE (cod_categoria = '$cod_categoria')";
$consulta_categoria = mysqli_query($conectar, $sql_categoria) or die(mysqli_error($conectar));
$datos_categoria = mysqli_fetch_assoc($consulta_categoria);

$nombre_categoria               = $datos_categoria['nombre_categoria'];

if ($cod_categoria == $cod_categoria_get) { ?><a href="../admin/ver_producto_visitante_intern.php?cod_categoria=<?php echo $cod_categoria ?>" class="list-group-item list-group-item-action <?php echo $active ?>"><?php echo $nombre_categoria ?> <small class="text-muted">(<?php echo $total_cat ?>)</small></a>
<?php } else { ?><a href="../admin/ver_producto_visitante_intern.php?cod_categoria=<?php echo $cod_categoria ?>" class="list-group-item list-group-item-action"><?php echo $nombre_categoria ?> <small class="text-muted">(<?php echo $total_cat ?>)</small></a><?php } ?>

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