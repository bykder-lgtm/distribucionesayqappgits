<!DOCTYPE html>
<html lang="en">
<head>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
</head><!--/head-->
<body>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../menu/03_modulo_menu_navegacion_libre_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php ?>

<section id="contact-info">
        <div class="center">                
            <h2>¿Cómo Encontrarnos?</h2>
            <!--<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>-->
        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <div class="gmap">
<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Editaxe,+San Pelayo,+San Pelayo+Cordoba,+Colombiah&amp;aq=0&amp;oq=Editaxe&amp;sll=0,0&amp;sspn=0,0&amp;ie=UTF8&amp;hq=Editaxe,&amp;hnear=San Pelayo,+San Pelayo+Cordoba,+Colombiah&amp;ll=8.9578846,-75.8391436&amp;spn=0,0&amp;t=m&amp;z=15&amp;iwloc=A&amp;cid=0&amp;output=embed"></iframe>
                        </div>
                    </div>

                    <div class="col-sm-7 map-content">
                        <ul class="row">
                            <li class="col-sm-6">
                                <address>
                                    <h5>Oficina central</h5>
                                    <p><?php echo $dir_oficiana1_emp; ?> <br></p>
                                    <p>Teléfono: <?php echo $tel1_emp; ?> <br>
                                    Correo: <?php echo $correo_emp; ?></p>
                                </address>
<!--
                                <address>
                                    <h5>Oficina Zonal</h5>
                                    <p><?php echo $dir_oficiana2_emp; ?> <br></p>                                
                                    <p>Teléfono: <?php echo $tel2_emp; ?> <br>
                                    Correo: <?php echo $correo_emp; ?></p>
                                </address>
-->
                            </li>

<!--
                            <li class="col-sm-6">
                                <address>
                                    <h5>Oficina Zona # 2</h5>
                                    <p><?php echo $dir_oficiana3_emp; ?> <br></p>
                                    <p>Teléfono: <?php echo $tel3_emp; ?> <br>
                                    Correo: <?php echo $correo_emp; ?></p>
                                </address>

                                <address>
                                    <h5>Oficina Zona # 3</h5>
                                    <p><?php echo $dir_oficiana4_emp; ?> <br></p>
                                    <p>Teléfono: <?php echo $tel4_emp; ?> <br>
                                    Correo: <?php echo $correo_emp; ?></p>
                                </address>
                            </li>
-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Escribanos</h2>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="enviar_correo.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Nombre *</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Correo *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nombre de la Compañia</label>
                            <input type="text" class="form-control">
                        </div>                        
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Asunto *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Mensaje *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Enviar Mensaje</button>
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER PATROCINADORES*********************************************** -->
<?php include_once('../admin/05_modulo_footer_patrocinadores.php'); ?>
<!-- 1******************************************************* MODULO FOOTER PATROCINADORES*********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php //include_once('../admin/04_modulo_publicidad_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
            </div><!--/.row-->
         </div><!--/.blog-->
    </section><!--/#blog-->
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/05_modulo_footer_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
    
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/06_modulo_js_1.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
</body>
</html>