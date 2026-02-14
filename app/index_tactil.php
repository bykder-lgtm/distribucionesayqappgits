<?php 
if (isset($_GET['cod_mesa'])) {

$cod_caja_virtual                      = intval($_GET['cod_mesa']);
$cod_base_caja                         = $cod_caja_virtual;
$cuenta                                = rand(1000, 9999).time().rand(1000, 9999);

header("Location:session/funciones_admin_tactil.php?cod_mesa=$cod_caja_virtual&cuenta=$cuenta"); 
}
?>