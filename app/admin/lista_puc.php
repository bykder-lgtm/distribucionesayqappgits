<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
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

<div class="breadcrumbs">
<!--<a href="#"><h4>Lista plan unico de cuentas (PUC)</a></h4>-->
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista plan unico de cuentas (PUC)</font></a></th>
        <th style="text-align:right"><font size='+2'><a href="../admin/lista_parametrizacion_modulos_tipo_forma_pago.php">Parametrizar PUC</a></font></th>
    </tr>
</table>

<?php
$pagina = $_SERVER['PHP_SELF'];
$pagina_local = $_SERVER['PHP_SELF'];
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '5') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input type="text" id="busqueda" name="busqueda" onkeyup="leer_registros()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
</table>

<div class="AAAA">
    <div class="right_col" role="main"> <!-- page content -->
        <div class="DDDD">
            <div id="cargar_datos_ajax"></div><!-- los registros se cargarán aquí -->
            <div id="cargador_scroll"></div>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>

</body>
</html>

<script>
$(document).ready(function(){
    leer_registros(); /* it will load products when document loads */
});
//------------------------------------------------------------------------------------------------------------------//
function leer_registros(){

    var limite_inicial = 0;
    var limite_final = 10;
    var action = 'inactive';
    var cantidad_reg_por_pagina = 50;
    var paginador_actual = 0;
    var buscar_por = document.getElementById('buscar_por').value;
    var busqueda = document.getElementById('busqueda').value;
    //var buscar_por = $("#buscar_por").val();
    //var busqueda = $("#busqueda").val();

    function cargar_datos_encontrados(limite_inicial, limite_final) {
        paginador_actual = paginador_actual + 1;
        $.ajax({
            url:"../admin/leer_datos_puc_scroll_sweetalert.php",
            method:"POST",
            data:{ cantidad_reg_por_pagina:cantidad_reg_por_pagina, paginador_actual:paginador_actual, buscar_por:buscar_por, busqueda:busqueda },
            cache:false,
            success:function(respuesta) {
                $('#cargar_datos_ajax').append(respuesta);
                if(respuesta == '') {
                    //$('#cargador_scroll').html("<button type='button' class='btn btn-info'>Datos no encontrados</button>");
                    action = 'active';
                }
                else {
                    //$('#cargador_scroll').html("<button type='button' class='btn btn-warning'>Cargando....</button>");
                    action = "inactive";
                }
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

    if (busqueda == '') { 
        $('#cargar_datos_ajax').html(""); 
    } else {
        $('#cargar_datos_ajax').load('../admin/leer_datos_puc_scroll_sweetalert.php?cantidad_reg_por_pagina='+cantidad_reg_por_pagina+'&paginador_actual='+paginador_actual+'&buscar_por='+buscar_por+'&busqueda='+busqueda);  
    }
}
</script>