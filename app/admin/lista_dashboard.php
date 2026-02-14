<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/fondo_dasboard_login.css" rel="stylesheet">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../menu/03_menu_navegacion_libre_entrar.php'); ?>
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div class="imagen_fondo_login"></div>
<div class="container-fluid h-100  content">

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="ibod">
<!--<div class="jumbotron"><h1><?php echo $desarrollador_emp ?></h1></div>-->
<div class="fcontacto">
<div class="logito"><p class="editaxe_interactivo">
<table>
    <thead>
        <tr>
            <th style="text-align:center; font-size:6rem; color:white; padding: 10px 15px 10px 15px;"><br><br><br><br><br><br><br><?php echo $nombre_emp ?></th>
        </tr>
        <tr>
            <th style="text-align:center; font-size:3rem; color:white; padding: 10px 15px 10px 30px;"><br><br><br><br><?php echo $eslogan_emp ?></th>
        </tr>
    </thead>
</table>
</div>
</div>
</div>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>