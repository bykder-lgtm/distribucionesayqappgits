<?php
include_once('../conexiones/conexione.php');
include_once('../gestor_administrar_msj_alerta_error/gestor_alerta_error.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$nombre_pagina = "Iniciar Sesion";
$cod_seguridad_pag = "1";
$keywords = "immunocal, suplemento, immunotec, glutation, immunocal que es, immunocal platinum, immunotec immunocal, immunocal regular, immunocal diabetes, immunocal platinum beneficios, immunocal platinum cancer, que es immunotec";
$description = "El Immunocal es un suplemento natural que contiene una proteína completa, lo que significa que suministra todos los aminoácidos que su cuerpo necesita para funcionar de manera eficiente. Sus beneficios se atribuyen sobre todo al hecho de que es una fuente rica del aminoacido llamado cisteína que al ser ingerido se convierte en un poderoso antioxidante llamado glutation";
$author = "Immunotec Ciencia y Bienestar";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>
<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<?php include_once("../admin/02_modulo_meta_vistante.php"); ?>
    
<?php include_once("../admin/03_modulo_css_visitante.php"); ?>
<link href="../estilo_css/custom_login.css" rel="stylesheet">
</head>

<body>
    <!-- End Main Top -->
<?php include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php //include_once('../menu/05_modulo_menu_visitante.php'); ; ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head_visitante.php"); ?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">

                    <?php gestor_alerta_error(); //llamada a la funcion de alertas ?>
                    <section class="login_content">
                        <form action="../admin/verificacion_visitante.php" method="post">
                            <h1>Iniciar Sesión</h1>
                            <div>
                                <input type="text" name="cuenta" class="form-control" placeholder="Usuario" required />
                            </div>
                            <div>
                                <input type="password" name="contrasena" id="pass" class="form-control" placeholder="Contraseña" required/>
                            </div>
                            <div>
                                <button type="submit" name="token" id="enviar" value="Login" class="btn btn-default" onclick="cifrar()">Iniciar Sesion</button>
                                <a class="reset_pass" href="#">Olvidaste Tu contraseña?</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><!--<i class="fa fa-ticket"></i>--><img src="../imagenes/logo_index.png" alt="Logo"></h1>
                        <!--<p><a style="text-decoration: underline;" target="_blank" href="#">Support</a>is a Bootstrap 3 template. Privacy and Terms by <a target="_blank" style="text-decoration: underline;" href="#">Abisoft</a></p>-->
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

<?php //include_once("../admin/09_modulo_footer_visitante.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante.php"); ?>

<script src="../js/sha1.js"></script>
<script>
function cifrar(){
var input_pass = document.getElementById("pass");
input_pass.value = sha1(input_pass.value);
}
</script>

</body>

</html>