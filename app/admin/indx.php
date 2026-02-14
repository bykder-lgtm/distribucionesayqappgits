<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../menu/03_menu_navegacion_libre.php'); ?> 
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Buscar Laboratorio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_laboratorio.php">Registrar Laboratorio</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>

<div class="container">

    <div class="divPanel page-content">

        <div class="row-fluid">
            <!--Edit Main Content Area here-->
                <div class="span12" id="divMain">

                    <h1>Full Width Page</h1>
                    <hr>
					<img src="big-images/pink-flowers.jpg" class="img-polaroid" style="margin:5px 0px 15px;" alt="">
                    <p><strong>dolor</strong> sit amet, consectetur adipiscing elit. 
					Curabitur ac tortor elit, non hendrerit felis. Nam adipiscing gravida magna, ac pretium neque volutpat a. Integer gravida 
					lorem lorem. erat enim.</p>									
					<!--Edit Blockquote here-->
					<blockquote>
					
                    <h3 class="text-success">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</h3>
                    <small>Someone famous <cite title="Source Title">Source Title</cite></small>
					
                    </blockquote>
					<!--/End Blockquote-->
                    <p>Etiam cerat, vel mollis risus interdum. Sed ut porta dolor, vitae accumsan lorem.</p>						
		                            
                </div>
            <!--End Main Content Area-->
            </div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>