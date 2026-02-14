<META HTTP-EQUIV="REFRESH" CONTENT="0; admin/entrar_visitante_intern.php">
<?php 
if (isset($_GET['cod_mesa'])) {

	$cod_caja_virtual                      = intval($_GET['cod_mesa']);
	$cod_base_caja                         = $cod_caja_virtual;
	$cuenta                                = rand(1000, 9999).time().rand(1000, 9999);

	header("Location:session/funciones_admin_visitante_ext.php?cod_mesa=$cod_caja_virtual&cuenta=$cuenta"); 
}
?>