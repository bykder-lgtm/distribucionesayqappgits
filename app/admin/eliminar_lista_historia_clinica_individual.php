<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min.css" type="text/css" />
<script src="../js/sweetalert2.min.js"></script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Historias Clinicas</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_historia_clinica';
$tipo = 'eliminar';
$campo = 'cod_historia_clinica';
?>
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4">
            Mostrar:
            <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                <option value="800">800</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="10000">10000</option>
                <option value="100000">100000</option>
            </select>
            Buscar por:
            <select class="form-control" id="buscar_por" onchange='load(1);'>
                <option value="nombres_apellidos">Nombre Paciente</option>
                <option value="cedula">Documento</option>
                <option value="motivo">Motivo</option>
                <option value="nombre_empresa">Empresa</option>
                <option value="fecha_ymd">Fecha</option>
                <option value="cod_historia_clinica">Codigo Historia</option>
            </select>
            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
        </div>
</form>     
<!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                <div class='salida_informacion_actualizada' id='salida_informacion_actualizada'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- **************************************************************************************************** -->
<!-- **************************************************************************************************** -->
<script>
$(document).ready(function(){
    load(1);
});
//****************************************************************************************************//
function load(page){
    $(document).ready(function(){
        var action = 'ajax';
        var busqueda_ajax= $("#busqueda_ajax").val();
        var numero_registro_por_pagina= $("#numero_registro_por_pagina").val();
        var buscar_por = $("#buscar_por").val();

$.ajax({
        url:'busqueda_paginacion_eliminar_lista_historia_clinica_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&buscar_por='+buscar_por,
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".salida_informacion_actualizada").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
        $(document).on('click', '#cod_concatenado', function(e){
            var info_ajax = $(this).data('id');
            var frag = info_ajax.split('|');
            var cod_historia_clinica = frag[0];
            var nombres_apellidos = frag[1];
            var cedula = frag[2];
            var action = frag[3];
            var page = frag[4];
            var busqueda_ajax = frag[5];
            var numero_registro_por_pagina = frag[6];
            var buscar_por = frag[7];

            SwalDelete(cod_historia_clinica, nombres_apellidos, cedula, action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por);
            e.preventDefault();
        });
        
    });
}
//****************************************************************************************************//
function SwalDelete(cod_historia_clinica, nombres_apellidos, cedula, action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por){
    swal({
        title: 'Estás seguro?',
        text: "Se eliminará permanentemente a <br>"+nombres_apellidos+"!<br>("+cedula+' - '+cod_historia_clinica+")",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínar!',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                url: '../admin/eliminar_registro_ajax.php',
                type: 'POST',
                data: 'cod_historia_clinica='+cod_historia_clinica,
                dataType: 'json'
             })
             .done(function(response){
                swal('Eliminado!', response.message, response.status);

                leer_registros(action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por);

             })
             .fail(function(){
                swal('Oops...', 'Algo salió mal con ajax !', 'error');
             });
          });
        },
        allowOutsideClick: false              
    }); 
    
}
//****************************************************************************************************//
function leer_registros(action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por){
    $.ajax({
        url:"busqueda_paginacion_eliminar_lista_historia_clinica_ajax.php",
        method:"POST",
        data:{action:action, page:page, busqueda_ajax:busqueda_ajax, numero_registro_por_pagina:numero_registro_por_pagina, buscar_por:buscar_por},
        cache:false,
        success:function(data) {
        $('#salida_informacion_actualizada').empty();
        $('#salida_informacion_actualizada').append(data);
        }
    });
}
</script>
<!-- **************************************************************************************************** -->
<!-- **************************************************************************************************** -->
<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_historia_clinica = $(this).parent().attr('data');
        var dataString = 'llave='+cod_historia_clinica+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_historia_clinica+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_historia_clinica_'+cod_historia_clinica).fadeOut("slow");
                $('#cedula'+cod_historia_clinica).fadeOut("slow");
                $('#nombres'+cod_historia_clinica).fadeOut("slow");
                $('#apellido1'+cod_historia_clinica).fadeOut("slow");
                $('#motivo'+cod_historia_clinica).fadeOut("slow");
                $('#fecha_ymd'+cod_historia_clinica).fadeOut("slow");
                $('#hora'+cod_historia_clinica).fadeOut("slow");
                $('#cuenta'+cod_historia_clinica).fadeOut("slow");
                $('#tr'+cod_historia_clinica).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>