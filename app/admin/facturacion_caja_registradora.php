<?php $serguridad_pagina = 1; ?>
<?php $cod_tipo_accion_caja_registradora = "1"; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<?php include_once('../admin/01_modulo_permisos.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_math.min.js"></script>
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>

<script src="../js/default.js" type="text/javascript"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../estilo_css/chosen_600px.css">

<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_caja_registradora.css">

<script type="text/javascript" src="../js/qrious.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<style> .deshabilitar_boton { pointer-events: none; } </style>
<?php
$nombre_tipo_factura                         = $nombre_tipo_factura_defecto_global;
$cod_tipo_forma_pago                         = 1;
$cod_movimiento_contable_cuenta_personal     = 1;
$nombre_modulo_puc                           = 'VENTAS';
$cod_info_factura_venta                      = 0;
$pagina_local                                = $_SERVER['PHP_SELF'];
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("cambiar_forma_pago_facturacion_caja_registradora_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#cod_movimiento_contable_cuenta_personal").html(data);
        });
   });
});
</script>

<script>  
$(document).ready(function(){ 

  var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val();
  var display_superior = $('#display_superior').val();
  var display_inferior = $('#display_inferior').val();

  const formulario_display = document.getElementById('formulario_display');
  const btn_borrar_todo = document.getElementById('btn_borrar_todo');
  const btn_borrar_numero = document.getElementById('btn_borrar_numero');
  const btn_numero_cero = document.getElementById('btn_numero_cero');
  const btn_numero_uno = document.getElementById('btn_numero_uno');
  const btn_numero_dos = document.getElementById('btn_numero_dos');
  const btn_numero_tres = document.getElementById('btn_numero_tres');
  const btn_numero_cuatro = document.getElementById('btn_numero_cuatro');
  const btn_numero_cinco = document.getElementById('btn_numero_cinco');
  const btn_numero_seis = document.getElementById('btn_numero_seis');
  const btn_numero_siete = document.getElementById('btn_numero_siete');
  const btn_numero_ocho = document.getElementById('btn_numero_ocho');
  const btn_numero_nueve = document.getElementById('btn_numero_nueve');
  const btn_guardar = document.getElementById('btn_guardar');

  if ((cod_tipo_accion_caja_registradora == '') && (display_superior == '')) {

    const display_superior = document.getElementById('display_superior');
    const display_inferior = document.getElementById('display_inferior');

    display_superior.disabled = true;
    display_superior.style.opacity = 0.1;

    display_inferior.disabled = true;
    display_inferior.style.opacity = 0.1;

    formulario_display.disabled = true;
    formulario_display.style.opacity = 0.1;

    btn_borrar_todo.disabled = true;
    btn_borrar_todo.style.opacity = 0.1;

    btn_borrar_numero.disabled = true;
    btn_borrar_numero.style.opacity = 0.1;

    btn_numero_cero.disabled = true;
    btn_numero_cero.style.opacity = 0.1;

    btn_numero_uno.disabled = true;
    btn_numero_uno.style.opacity = 0.1;

    btn_numero_dos.disabled = true;
    btn_numero_dos.style.opacity = 0.1;

    btn_numero_tres.disabled = true;
    btn_numero_tres.style.opacity = 0.1;

    btn_numero_cuatro.disabled = true;
    btn_numero_cuatro.style.opacity = 0.1;

    btn_numero_cinco.disabled = true;
    btn_numero_cinco.style.opacity = 0.1;

    btn_numero_seis.disabled = true;
    btn_numero_seis.style.opacity = 0.1;

    btn_numero_siete.disabled = true;
    btn_numero_siete.style.opacity = 0.1;

    btn_numero_ocho.disabled = true;
    btn_numero_ocho.style.opacity = 0.1;

    btn_numero_nueve.disabled = true;
    btn_numero_nueve.style.opacity = 0.1;

    btn_guardar.disabled = true;
    btn_guardar.style.opacity = 0.1;
  }

  $("#cod_tipo_accion_caja_registradora").change(function() {

    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val();
    const display_superior = document.getElementById('display_superior');
    const display_inferior = document.getElementById('display_inferior');
    const formulario_display = document.getElementById('formulario_display');
    const btn_borrar_todo = document.getElementById('btn_borrar_todo');
    const btn_borrar_numero = document.getElementById('btn_borrar_numero');
    const btn_numero_cero = document.getElementById('btn_numero_cero');
    const btn_numero_uno = document.getElementById('btn_numero_uno');
    const btn_numero_dos = document.getElementById('btn_numero_dos');
    const btn_numero_tres = document.getElementById('btn_numero_tres');
    const btn_numero_cuatro = document.getElementById('btn_numero_cuatro');
    const btn_numero_cinco = document.getElementById('btn_numero_cinco');
    const btn_numero_seis = document.getElementById('btn_numero_seis');
    const btn_numero_siete = document.getElementById('btn_numero_siete');
    const btn_numero_ocho = document.getElementById('btn_numero_ocho');
    const btn_numero_nueve = document.getElementById('btn_numero_nueve');
    const btn_guardar = document.getElementById('btn_guardar');

    if ((cod_tipo_accion_caja_registradora == '') && (display_superior == '')) {
      display_superior.disabled = true;
      display_superior.style.opacity = 0.1;

      display_inferior.disabled = true;
      display_inferior.style.opacity = 0.1;

      formulario_display.disabled = true;
      formulario_display.style.opacity = 0.1;

      btn_borrar_todo.disabled = true;
      btn_borrar_todo.style.opacity = 0.1;

      btn_borrar_numero.disabled = true;
      btn_borrar_numero.style.opacity = 0.1;

      btn_numero_cero.disabled = true;
      btn_numero_cero.style.opacity = 0.1;

      btn_numero_uno.disabled = true;
      btn_numero_uno.style.opacity = 0.1;

      btn_numero_dos.disabled = true;
      btn_numero_dos.style.opacity = 0.1;

      btn_numero_tres.disabled = true;
      btn_numero_tres.style.opacity = 0.1;

      btn_numero_cuatro.disabled = true;
      btn_numero_cuatro.style.opacity = 0.1;

      btn_numero_cinco.disabled = true;
      btn_numero_cinco.style.opacity = 0.1;

      btn_numero_seis.disabled = true;
      btn_numero_seis.style.opacity = 0.1;

      btn_numero_siete.disabled = true;
      btn_numero_siete.style.opacity = 0.1;

      btn_numero_ocho.disabled = true;
      btn_numero_ocho.style.opacity = 0.1;

      btn_numero_nueve.disabled = true;
      btn_numero_nueve.style.opacity = 0.1;

      btn_guardar.disabled = true;
      btn_guardar.style.opacity = 1;
    } else {
      display_superior.disabled = false;
      display_superior.style.opacity = 1;

      display_inferior.disabled = false;
      display_inferior.style.opacity = 1;

      formulario_display.disabled = false;
      formulario_display.style.opacity = 1;

      btn_borrar_todo.disabled = false;
      btn_borrar_todo.style.opacity = 1;

      btn_borrar_numero.disabled = false;
      btn_borrar_numero.style.opacity = 1;

      btn_numero_cero.disabled = false;
      btn_numero_cero.style.opacity = 1;

      btn_numero_uno.disabled = false;
      btn_numero_uno.style.opacity = 1;

      btn_numero_dos.disabled = false;
      btn_numero_dos.style.opacity = 1;

      btn_numero_tres.disabled = false;
      btn_numero_tres.style.opacity = 1;

      btn_numero_cuatro.disabled = false;
      btn_numero_cuatro.style.opacity = 1;

      btn_numero_cinco.disabled = false;
      btn_numero_cinco.style.opacity = 1;

      btn_numero_seis.disabled = false;
      btn_numero_seis.style.opacity = 1;

      btn_numero_siete.disabled = false;
      btn_numero_siete.style.opacity = 1;

      btn_numero_ocho.disabled = false;
      btn_numero_ocho.style.opacity = 1;

      btn_numero_nueve.disabled = false;
      btn_numero_nueve.style.opacity = 1;

      btn_guardar.disabled = false;
      btn_guardar.style.opacity = 1;
    }
  });

});
</script>

</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<body>
<style>body { background-color:#333; }</style>
        <div class="container">
              <tr class="button-row_tema_caja_registradora">
                <td colspan="2">
                  <select name="cod_tipo_accion_caja_registradora" id="cod_tipo_accion_caja_registradora" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 180px;" required>
                      <?php if (isset($cod_tipo_accion_caja_registradora)) { echo "<option value='' selected ></option>"; } else { echo "<option value='' selected ></option>"; }
                      $consulta2_sql = "SELECT cod_tipo_accion_caja_registradora, nombre_tipo_accion_caja_registradora FROM tbl15_tipo_accion_caja_registradora WHERE (cod_estado = '1') ORDER BY cod_tipo_accion_caja_registradora ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tipo_accion_caja_registradora) AND $cod_tipo_accion_caja_registradora == $datos2['cod_tipo_accion_caja_registradora']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tipo_accion_caja_registradora'];
                      $nombre = $datos2['nombre_tipo_accion_caja_registradora'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
                <td colspan="2">
                  <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 150px;" required>
                      <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tipo_forma_pago'];
                      $nombre = $datos2['nombre_tipo_forma_pago'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
                <td colspan="2">
                  <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 130px;" required>
                      <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tipo_pago'];
                      $nombre = $datos2['nombre_tipo_pago'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 130px;" required>
                      <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (nombre_tipo_estado = 'ACTIVO')";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_resolucion_facturacion'];
                      $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>

            <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
              <hr>
              <tr class="">
                <td colspan="2">
                  <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 300px;" tabindex="1">
                      <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                      $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado = '1') ORDER BY nombre_puc ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
                      $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>
            <?php } ?>

              <hr>
              <tr class="button-row_tema_caja_registradora">
                <td colspan="4">
                  <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="text-align:center; font-size:15pt; width: 400px;" required>
                      <?php if (isset($nombre_cod_tercero_defec_global)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                      $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                      FROM tbl15_tercero ORDER BY nombre1_tercero ASC";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($nombre_cod_tercero_defec_global) AND $nombre_cod_tercero_defec_global == $datos2['cod_tercero']) {
                      $seleccionado = "selected"; } else { $seleccionado = ""; }
                      $codigo = $datos2['cod_tercero'];
                      $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                  </select>
                </td>
              </tr>

            <label class="switch_tema_caja_registradora">
                <input type="checkbox">
                <span class="slider_tema_caja_registradora"></span>
            </label>
            <form id="formulario_display">
                <input readonly id="display_superior" type="text" class="form-control-lg text-right">
                <input readonly id="display_inferior" type="text" class="form-control-lg text-right">
            </form>

            <table>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_borrar_todo" type="button">&#67;</button></td><!-- C -->
                <td colspan="2"><button id="btn_borrar_numero" type="button">&#9003;</button></td>
                <!--<td rowspan="2"><button id="btn_agregar_registro" type="button" class="operator-group5">PLU</button></td>-->
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_siete" type="button" class="operand-group">&#55;</button><!-- 7 --></td>
                <td><button id="btn_numero_ocho" type="button" class="operand-group">&#56;</button><!-- 8 --></td>
                <td><button id="btn_numero_nueve" type="button" class="operand-group">&#57;</button><!-- 9 --></td>
              </tr>
              <tr class="button-row_tema_caja_registradora">
                <td><button id="btn_numero_cuatro" type="button" class="operand-group">&#52;</button><!-- 4 --></td>
                <td><button id="btn_numero_cinco" type="button" class="operand-group">&#53;</button> <!-- 5 --></td>
                <td><button id="btn_numero_seis" type="button" class="operand-group">&#54;</button><!-- 6 --></td>
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
            <div id="refrescar_sonido"></div>
        </div>
<hr>

<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/lista_caja_virtual.php" class="btn btn-warning">Ir a Modulo Administrativo</a></td>
  </tr>
</table>

</body>

<script type="text/javascript" src="js/chosen.jquery.js"></script>
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
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "0";
    $('#display_superior').val($('#display_superior').val() + '\u0030');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_uno').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "1";
    $('#display_superior').val($('#display_superior').val() + '\u0031');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_dos').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "2";
    $('#display_superior').val($('#display_superior').val() + '\u0032');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_tres').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "3";
    $('#display_superior').val($('#display_superior').val() + '\u0033');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_cuatro').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "4";
    $('#display_superior').val($('#display_superior').val() + '\u0034');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_cinco').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "5";
    $('#display_superior').val($('#display_superior').val() + '\u0035');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_seis').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "6";
    $('#display_superior').val($('#display_superior').val() + '\u0036');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_siete').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "7";
    $('#display_superior').val($('#display_superior').val() + '\u0037');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_ocho').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "8";
    $('#display_superior').val($('#display_superior').val() + '\u0038');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_numero_nueve').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc0.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "9";
    $('#display_superior').val($('#display_superior').val() + '\u0039');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "0";
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val()

    $.post("guardar_caja_registradora_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora }, function(data){
      $('#display_inferior').val(data);
    });
})

$('#btn_agregar_registro').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc3.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "+";
    $('#display_superior').val($('#display_superior').val() + '\u002b');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_agregar_registro";
})


$('#btn_recibido').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc1.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation + "|";
    $('#display_superior').val($('#display_superior').val() + '\u007c');
    //evaluate();
    //$('#display_inferior').val(display_superior.evaluation);
    $('#display_inferior').val("");
    var valor = $('#display_superior').val();
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_agregar_registro";
})



// Equal
$('#btn_guardar').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc4.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.answer = display_superior.evaluation; // Store the answer (Ans button)
    var valores_separados = $('#display_superior').val();
    var cod_tipo_forma_pago = $('#cod_tipo_forma_pago').val();
    var cod_tipo_pago = $('#cod_tipo_pago').val();
    var cod_tercero = $('#cod_tercero').val();
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val();
    var cod_resolucion_facturacion = $('#cod_resolucion_facturacion').val();
    var nombre_tipo_factura = "<?php echo $nombre_tipo_factura_defecto_global ?>";
    var cod_movimiento_contable_cuenta_personal = $('#cod_movimiento_contable_cuenta_personal').val();

    var valor_total = display_superior.answer;
    var valor = valores_separados;
    var tipo_ajax = "tbl15_venta_producto_temporal";
    var campo = "precio_venta_producto";
    var opcion = "btn_guardar";
    var condicion_producto_con_precio_venta_cero = "";
    var pagina = "<?php echo $pagina_local;?>";

    var parametros = { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_forma_pago:cod_tipo_forma_pago, cod_tipo_pago:cod_tipo_pago, cod_tercero:cod_tercero, cod_resolucion_facturacion:cod_resolucion_facturacion, cod_movimiento_contable_cuenta_personal:cod_movimiento_contable_cuenta_personal, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora, pagina:pagina };

    $.ajax({
      type: "POST",
      url: "../admin/guardar_caja_registradora_ajax.php",
      data: parametros,
      dataType: "json",
      //contentType: false,
      //processData: false,
      beforeSend: function(entrada){
          //$("#icono_estado").html('<img src="../imagenes/cargador.gif">');
          //$("#estado").html('Cargando...');
        },
      success: function(respuesta){
        var llave = respuesta.llave;
        var total_precio_venta = respuesta.total_precio_venta;
        var vlr_cancelado = respuesta.vlr_cancelado;
        var vlr_vuelto = respuesta.vlr_vuelto;
        var estado = respuesta.estado;
        var cod_tipo_accion_caja_registradora = respuesta.cod_tipo_accion_caja_registradora;
        var nombre_tipo_factura = respuesta.nombre_tipo_factura;
        var pagina_redirect_imprimir = respuesta.pagina_redirect_imprimir;
        var conexion_internet = respuesta.conexion_internet;
        var cod_estado_enviar_factura_venta_electronica_dian_api = respuesta.cod_estado_enviar_factura_venta_electronica_dian_api;

        if (cod_tipo_accion_caja_registradora == '1') { //INGRESAR VENTA
          $('#display_superior').val(total_precio_venta.toLocaleString()); // Update display_superior
          $('#display_inferior').val(vlr_vuelto.toLocaleString()); // Update display_inferior
          display_superior.operation = display_superior.answer; // Current operation equals the answer
          flag.ansAllowed = true; // Allow the use of Ans button

          if (cod_estado_enviar_factura_venta_electronica_dian_api == '1' && nombre_tipo_factura == 'ELECTRONICA' && conexion_internet == 'SI') { 
            window.location.replace("../admin/enviar_factura_electronica_dian_dataico_caja_registradora_ajax.php?cod_info_factura_venta="+llave+"&cod_tipo_pago="+cod_tipo_pago+"&conexion_internet="+conexion_internet+"&condicion_producto_con_precio_venta_cero="+condicion_producto_con_precio_venta_cero+"&cod_tipo_accion_caja_registradora="+cod_tipo_accion_caja_registradora+"&pagina="+pagina);
          } else { 
            window.location.replace("../admin/opcion_imprimir_factura_venta_caja_registradora.php?cod_info_factura_venta="+llave);
          }
          
        }
        if (cod_tipo_accion_caja_registradora == '2') { //INGRESAR COMPRA
          window.location.replace("../admin/opcion_imprimir_factura_compra_caja_registradora.php?cod_info_factura_compra="+llave);
        }
        if (cod_tipo_accion_caja_registradora == '3') { //ABONO CLIENTE (CUENTA POR COBRAR)
          window.location.replace("../admin/opcion_imprimir_cuentas_cobrar_abonos_caja_registradora.php?cod_cuentas_cobrar_abonos="+llave);
        }
        if (cod_tipo_accion_caja_registradora == '5') { //INGRESAR GASTOS
          window.location.replace("../admin/opcion_imprimir_movimiento_contable_cuenta_personal_caja_registradora.php?cod_movimiento_contable_cuenta_personal_concepto="+llave);
        }
      }
    });

})

// btn_borrar_numero
$('#btn_borrar_numero').on('click', function () {   
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc2.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
    display_superior.operation = display_superior.operation.slice(0, display_superior.operation.length-1);
    $('#display_superior').val($('#display_superior').val().slice(0, $('#display_superior').val().length-1));
    evaluate();
    $('#display_inferior').val(display_superior.evaluation);
})

// btn_borrar_todo
$('#btn_borrar_todo').on('click', function () {
    $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc2.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
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

<script type="text/javascript">
$('#cod_tipo_accion_caja_registradora').on('change', function () {
    var cod_tipo_accion_caja_registradora = $('#cod_tipo_accion_caja_registradora').val();
    var cod_tercero = $('#cod_tercero').val();
    var cod_tipo_forma_pago = $('#cod_tipo_forma_pago').val();
    var cod_tipo_pago = $('#cod_tipo_pago').val();
    var valor = cod_tipo_accion_caja_registradora;

    var tipo_ajax = "tipo_accion";
    var campo = "cod_tipo_accion_caja_registradora";
    var opcion = "mostrar_terceros";
    var parametros = { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_tipo_forma_pago:cod_tipo_forma_pago, cod_tipo_pago:cod_tipo_pago, cod_tercero:cod_tercero, cod_tipo_accion_caja_registradora:cod_tipo_accion_caja_registradora };

    if (cod_tipo_accion_caja_registradora == '1') {
      var url_ajax = "../admin/mostrar_tercero_caja_registradora_ajax.php";
    } else if (cod_tipo_accion_caja_registradora == '2') {
      var url_ajax = "../admin/mostrar_tercero_caja_registradora_ajax.php";
    } else if (cod_tipo_accion_caja_registradora == '3') {
      var url_ajax = "../admin/mostrar_tercero_caja_registradora_ajax.php";
    } else if (cod_tipo_accion_caja_registradora == '4') {
      var url_ajax = "../admin/sin.php";
    } else if (cod_tipo_accion_caja_registradora == '5') {
      var url_ajax = "../admin/mostrar_concepto_movimiento_caja_registradora_ajax.php";
    } else {
      var url_ajax = "../admin/sin.php";
    }

    $.ajax({
      type: "POST",
      url: url_ajax,
      data: parametros,
      //dataType: "json",
      beforeSend: function(entrada) {
      },
      success: function(respuesta) {
        $('#cod_tercero').html(respuesta);

        //var llave = respuesta.llave;
        //var total_precio_venta = respuesta.total_precio_venta;
        //var vlr_cancelado = respuesta.vlr_cancelado;
        //var vlr_vuelto = respuesta.vlr_vuelto;
        //var estado = respuesta.estado;
        //var cod_tipo_accion_caja_registradora = respuesta.cod_tipo_accion_caja_registradora;

      }
    });
})
</script>