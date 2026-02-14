<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/estilo_caja_registradora.css" rel="stylesheet" type="text/css" />
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
<a href="../admin/menu_lista.php"><h4>Lista de Terceros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<?php if ($cod_estado_tercero_registrar == '1') { ?>
<a href="../admin/reg_tercero.php">Registrar Terceros</h4></a>
<?php } ?>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
//-----------------------------------------------------------------------------------------------------------------//
if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else { 
        $condicional_consulta_tercero = 'AND cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_tercero_rel = 'WHERE cod_administrador = "'.$cod_administrador.'"';
        $condicional_consulta_cuenta_cobrar = 'WHERE cod_administrador = "'.$cod_administrador.'"';
    }

} else { 
$condicional_consulta_tercero = ''; 
$condicional_consulta_tercero_rel = '';
$condicional_consulta_cuenta_cobrar = '';
}
//-----------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">

        <div class="contenedor_caja_registradora">
            <label class="switch_tema_caja_registradora">
                <input type="checkbox">
                <span class="slider_tema_caja_registradora"></span>
            </label>
            <form id="formulario_display">
                <input readonly id="display_superior" type="text" class="form-control-lg text-right">
                <input readonly id="display_inferior" type="text" class="form-control-lg text-right">
            </form>

            <div id="refrescar_sonido"></div>

            <table>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_borrar_todo" type="button">&#67;</button></td><!-- C -->
                <td colspan="2"><button id="btn_borrar_numero" type="button">&#9003;</button></td>
                <td rowspan="2"><button id="btn_agregar_registro" type="button" class="operator-group5">PLU</button></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_siete" type="button" class="operand-group">&#55;</button><!-- 7 --></td>
                <td><button id="btn_numero_ocho" type="button" class="operand-group">&#56;</button><!-- 8 --></td>
                <td><button id="btn_numero_nueve" type="button" class="operand-group">&#57;</button><!-- 9 --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_cuatro" type="button" class="operand-group">&#52;</button><!-- 4 --></td>
                <td><button id="btn_numero_cinco" type="button" class="operand-group">&#53;</button> <!-- 5 --></td>
                <td><button id="btn_numero_seis" type="button" class="operand-group">&#54;</button> <!-- 6 --></td>
                <td rowspan="2"><button id="btn_recibido" type="button" class="operator-group5">RECIBID</button></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_uno" type="button" class="operand-group">&#49;</button><!--  1--></td>
                <td><button id="btn_numero_dos" type="button" class="operand-group">&#50;</button><!-- 2 --></td>
                <td><button id="btn_numero_tres" type="button" class="operand-group">&#51;</button><!-- 3 --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td colspan="2"><button id="btn_numero_cero" type="button" class="operand-group">0</button><!-- 0 --></td>
                <td colspan="2"><button id="btn_guardar" type="button">ENTER</button><!-- = --></td>
              </tr>
            </table>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script type="text/javascript">
// Standard Priority Calculator

var display_superior = {
    operation: "",
    evaluation: "",
    answer: ""
};

// default flag values
var flag = {
    ansAllowed: false, // Initially do not allow the use of Ans button
    /*
    decimalPointAllowed: true,
    pctAllowed: false,
    ansAllowed: false,
    digitAllowed: true
    */
};

// default display values
$('#display_superior').val("");
$('#display_inferior').val("");

// Set default theme (light)
$(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-light");
$("form").addClass("form-light");
$("form input").addClass("form-input-light");
$(".operand-group").addClass("operand-group-light");
$(".operator-group").addClass("operator-group-light");
$("#btn_guardar").addClass("equal-light");
$("#btn_borrar_todo").addClass("btn_borrar_todo-light");
$("#btn_borrar_numero").addClass("btn_borrar_numero-light");

function evaluate() {
    try {
        math.eval(display_superior.operation);
        display_superior.evaluation = math.eval(display_superior.operation);
        return true; // no exception occured
    } catch (e) {
        if (e instanceof SyntaxError) { // Syntax error exception
            display_superior.evaluation = "E";
            return false; // exception occured
        }
        else {// Unspecified exceptions
            display_superior.evaluation = "UE";
            return false; // exception occured
        }
    }
}

// Digits
$('#btn_numero_cero').on('click', function () {
    display_superior.operation = display_superior.operation + "0";
    //$('#refrescar_sonido').html('<audio autoplay><source src="sonidos/timbre_entrada_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    $('#display_superior').val($('#display_superior').val() + '\u0030');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_uno').on('click', function () {
    //$('#refrescar_sonido').html('<audio autoplay><source src="sonidos/timbre_entrada_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "1";
    $('#display_superior').val($('#display_superior').val() + '\u0031');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_dos').on('click', function () {
    display_superior.operation = display_superior.operation + "2";
    $('#display_superior').val($('#display_superior').val() + '\u0032');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_tres').on('click', function () {
    display_superior.operation = display_superior.operation + "3";
    $('#display_superior').val($('#display_superior').val() + '\u0033');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_cuatro').on('click', function () {
    display_superior.operation = display_superior.operation + "4";
    $('#display_superior').val($('#display_superior').val() + '\u0034');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_cinco').on('click', function () {
    display_superior.operation = display_superior.operation + "5";
    $('#display_superior').val($('#display_superior').val() + '\u0035');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_seis').on('click', function () {
    display_superior.operation = display_superior.operation + "6";
    $('#display_superior').val($('#display_superior').val() + '\u0036');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_siete').on('click', function () {
    display_superior.operation = display_superior.operation + "7";
    $('#display_superior').val($('#display_superior').val() + '\u0037');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_ocho').on('click', function () {
    display_superior.operation = display_superior.operation + "8";
    $('#display_superior').val($('#display_superior').val() + '\u0038');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_numero_nueve').on('click', function () {
    display_superior.operation = display_superior.operation + "9";
    $('#display_superior').val($('#display_superior').val() + '\u0039');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

$('#btn_agregar_registro').on('click', function () {
    display_superior.operation = display_superior.operation + "+";
    $('#display_superior').val($('#display_superior').val() + '\u002b');
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_agregar_registro";

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, }, function(data){
        $("#modelo").html(data);
    });

})
// Equal
$('#btn_guardar').on('click', function () {
    display_superior.answer = display_superior.evaluation; // Store the answer (Ans button)
    var valores_separados = $('#display_superior').val();
    var valor_total = display_superior.answer;
    var valor = valores_separados;
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_guardar";

    $('#display_superior').val(display_superior.answer); // Update display_superior
    $('#display_inferior').val(""); // Update display_inferior
    display_superior.operation = display_superior.answer; // Current operation equals the answer
    flag.ansAllowed = true; // Allow the use of Ans button

    $.post("guardar_info_factura_y_venta_producto_temporal_caja_registradora_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, }, function(data){
        $("#modelo").html(data);
    });

    console.log("---------------");
    console.log("valores_separados = "+valores_separados);
    console.log("valor_total = "+valor_total);
})

// btn_borrar_numero
$('#btn_borrar_numero').on('click', function () {    
    display_superior.operation = display_superior.operation.slice(0, display_superior.operation.length-1);
    $('#display_superior').val($('#display_superior').val().slice(0, $('#display_superior').val().length-1));
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

// btn_borrar_todo
$('#btn_borrar_todo').on('click', function () {
    display_superior.operation = "",
    display_superior.evaluation = "",
    $('#display_superior').val("");
    $('#display_inferior').val("");
})

// Theme system
$("input[type='checkbox']").change(function () {
    // dark theme
    if (this.checked) {
        //alert("dark");
        $(".contenedor_caja_registradora").removeClass("contenedor_caja_registradora-light");
        $(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-dark");
        $("form").removeClass("form-light");
        $("form").addClass("form-dark");
        $("form input").removeClass("form-input-light");
        $("form input").addClass("form-input-dark");
        $(".operand-group").removeClass("operand-group-light");
        $(".operand-group").addClass("operand-group-dark");
        $(".operator-group").removeClass("operator-group-light");
        $(".operator-group").addClass("operator-group-dark");
        $("#btn_guardar").removeClass("equal-light");
        $("#btn_guardar").addClass("equal-dark");
        $("#btn_borrar_todo").removeClass("btn_borrar_todo-light");
        $("#btn_borrar_todo").addClass("btn_borrar_todo-dark");
        $("#btn_borrar_numero").removeClass("btn_borrar_numero-light");
        $("#btn_borrar_numero").addClass("btn_borrar_numero-dark");
    }
    // light theme (default)
    else {
        //alert("light");
        $(".contenedor_caja_registradora").removeClass("contenedor_caja_registradora-dark");
        $(".contenedor_caja_registradora").addClass("contenedor_caja_registradora-light");
        $("form").removeClass("form-dark");
        $("form").addClass("form-light");
        $("form input").removeClass("form-input-dark");
        $("form input").addClass("form-input-light");
        $(".operand-group").removeClass("operand-group-dark");
        $(".operand-group").addClass("operand-group-light");
        $(".operator-group").removeClass("operator-group-dark");
        $(".operator-group").addClass("operator-group-light");
        $("#btn_guardar").removeClass("equal-dark");
        $("#btn_guardar").addClass("equal-light");
        $("#btn_borrar_todo").removeClass("btn_borrar_todo-dark");
        $("#btn_borrar_todo").addClass("btn_borrar_todo-light");
        $("#btn_borrar_numero").removeClass("btn_borrar_numero-dark");
        $("#btn_borrar_numero").addClass("btn_borrar_numero-light");
    }
})
</script>