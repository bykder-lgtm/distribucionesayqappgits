<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">

<link rel="stylesheet" href="../estilo_css/sweetalert2.min.css" type="text/css" />
<script src="../js/jquery.min.js"></script>
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

<hr>
<div class="row-fluid">
<!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                    = $_SERVER['PHP_SELF'];
$limite_inicial            = 0;
$limite_final              = 25;
?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->                  
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4">
            Mostrar:
            <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                <option value="10">10</option>
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
                <option value="cod_cliente">Codigo Paciente</option>
            </select>
            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
        </div>
</form> 

<div class="container">
    <div id="cargar_datos_ajax"></div><!-- los registros se cargarán aquí -->
</div>

    </div><!-- /page content -->
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
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>

<script>
    $(document).ready(function(){
        leer_registros(); /* it will load products when document loads */
        $(document).on('click', '#info_ajax', function(e){
            var info_ajax = $(this).data('id');
            var frag = info_ajax.split('|');
            var cod_cliente = frag[0];
            var nombres_apellidos = frag[1];
            var cedula = frag[2];

            SwalDelete(cod_cliente, nombres_apellidos, cedula);
            e.preventDefault();
        });
        
    });
//------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------//
    function SwalDelete(cod_cliente, nombres_apellidos, cedula){
        
        swal({
            title: 'Estás seguro?',
            text: "Se eliminará permanentemente a <br>"+nombres_apellidos+"!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, elimínar!',
            showLoaderOnConfirm: true,
              
            preConfirm: function() {
              return new Promise(function(resolve) {
                   
                 $.ajax({
                    url: '../admin/eliminar_paciente_cargador_scroll_sweetalert2.php',
                    type: 'POST',
                    data: 'cod_cliente='+cod_cliente,
                    dataType: 'json'
                 })
                 .done(function(response){
                    swal('Eliminado!', response.message, response.status);
                    leer_registros();
                 })
                 .fail(function(){
                    swal('Oops...', 'Algo salió mal con ajax !', 'error');
                 });
              });
            },
            allowOutsideClick: false              
        }); 
        
    }
//------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------//
function leer_registros(){

var limite_inicial = 0;
var limite_final = 25;
var action = 'inactive';

function cargar_datos_encontrados(limite_inicial, limite_final) {
$.ajax({
url:"../admin/leer_datos_paciente_cargador_scroll_sweetalert2.php",
method:"POST",
data:{limite_inicial:limite_inicial, limite_final:limite_final},
cache:false,
success:function(data) {
$('#cargar_datos_ajax').append(data);
            }
        });
    }

if(action == 'inactive') {
action = 'active';
cargar_datos_encontrados(limite_inicial, limite_final);
}
$(window).scroll(function(){
if($(window).scrollTop() + $(window).height() > $("#cargar_datos_ajax").height() && action == 'inactive') {
action = 'active';
limite_inicial = limite_inicial + limite_final;
setTimeout(function(){
cargar_datos_encontrados(limite_inicial, limite_final);
}, 100);
}
});
$('#cargar_datos_ajax').load('../admin/leer_datos_paciente_cargador_scroll_sweetalert2.php');  
}
//------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------//
</script>
</body>
</html>