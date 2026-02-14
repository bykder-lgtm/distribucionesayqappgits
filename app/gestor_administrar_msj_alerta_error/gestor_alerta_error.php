<?php 
//function de alertas by abisoft https://github.com/amnersaucedososa
function gestor_alerta_error() {

$error_session = sha1(md5("contrasena y usuario invalido"));

if (isset($_GET['error_session']) && $_GET['error_session']==$error_session) {
echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'><strong>Error!</strong> Contraseña o usuario invalido</div>";
header("location: ../admin/index.php?error_session=$error_session");
}
$exito_datos_actualizados = sha1(md5("datos actualizados"));

if (isset($_GET['exito_datos_actualizados']) && $_GET['exito_datos_actualizados']==$exito_datos_actualizados) {
echo "<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
</button><strong>Aviso!</strong> Datos Actualizados Correctamente</div>";
}
$cambio_contrasena_exitoso = sha1(md5("contrasena actualizada"));

if (isset($_GET['cambio_contrasena_exitoso']) && $_GET['cambio_contrasena_exitoso']==$cambio_contrasena_exitoso) {
echo "<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
</button> Datos y contraseña actualizados correctamente.</div>";
}
$contrasena_no_coincide_con_anterior = sha1(md5("la contrasena no coincide la contraseña con la anterior"));

if (isset($_GET['contrasena_no_coincide_con_anterior']) && $_GET['contrasena_no_coincide_con_anterior']==$contrasena_no_coincide_con_anterior) {
echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
</button><strong>Aviso!</strong> La contraseña no coincide con la anterior.</div>";
}
$contrasenas_no_coinciden = sha1(md5("las nuevas  contraseñas no coinciden"));

if (isset($_GET['contrasenas_no_coinciden']) && $_GET['contrasenas_no_coinciden']==$contrasenas_no_coinciden) {
echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
</button><strong>Aviso!</strong> Las nuevas contraseñas no coinciden.</div>";
}
}
?>