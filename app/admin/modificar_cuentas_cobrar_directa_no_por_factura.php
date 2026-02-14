<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
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
</head>
<body>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php
if (isset($_GET['cod_cuentas_cobrar'])) {

  $cod_cuentas_cobrar     = intval($_GET['cod_cuentas_cobrar']);
  $cod_tercero            = intval($_GET['cod_tercero']);
  $cod_factura            = intval($_GET['cod_factura']);
  $pagina_local           = $_SERVER['PHP_SELF'];
  if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = "../admin/cuentas_cobrar_abonos.php"; }

  $calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
  tbl15_cuentas_cobrar.monto_deuda  AS total_venta, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, Sum(tbl15_cuentas_cobrar_abonos.abonado) AS total_abonado
  FROM tbl15_cuentas_cobrar_abonos RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero) 
  ON tbl15_cuentas_cobrar_abonos.cod_factura = tbl15_cuentas_cobrar.cod_factura
  GROUP BY tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.monto_deuda, 
  tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero HAVING ((tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') AND (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero'))";
  $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
  $total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
  $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

  $cliente               = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];

  $sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
  $consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
  $sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

  $sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
  $consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
  $sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

  $total_venta                    = $sum_monto_deuda['total_venta'];
  $total_abonado                  = $sum_abonos['total_abonado'];
  $total_deuda                    = $total_venta - $total_abonado;

  $cod_tipo_forma_pago            = '1';
?>
<style>body { background-color:#333; }</style>

        <div class="container">
              <tr class="button-row_tema_caja_registradora">
                <td colspan="4">
                  <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1" style="text-align:center; font-size:15pt; width: 400px;" required>
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
              </tr>
              <hr>
              <tr class="button-row_tema_caja_registradora">
                <td colspan="4">
                  <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="text-align:center; font-size:15pt; width: 400px;" required>
                      <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
                      $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
                      $consulta2 = mysqli_query($conectar, $consulta2_sql);
                      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                      if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
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
            <form>
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
                <td><button id="btn_numero_seis" type="button" class="operand-group">&#54;</button> <!-- 6 --></td>
                <!--<td rowspan="2"><button id="btn_recibido" type="button" class="operator-group5">REC</button></td>-->
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
              <tr class="button-row_tema_caja_registradora">
                <td>------</td>
                <td>------</td>
                <td>------</td>
              </tr>
            </table>
            <div id="refrescar_sonido"></div>
        </div>

      <hr>

      <table class="table table-striped">
        <tr>
          <td style="text-align:left; color:#fff;"><font size="6">TOTAL DEUDA:</font></td>
          <td style="text-align:left; color:#fff;"><font size="6"><?php echo number_format($total_venta, 0, ",", "."); ?></font></td>
        </tr>
        <tr valign="baseline">
          <td style="text-align:left; color:#fff;"><font size="6">TOTAL PENDIENTE:</font></td>
          <td style="text-align:left; color:#fff;"><font size="6"><?php echo number_format($total_deuda, 0, ",", "."); ?></font></td>
        </tr>
      </table>

      <table class="table table-striped">
        <tr>
          <td style="text-align:center;"><a href="../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero?>" class="btn btn-warning">Regresar</a></td>
        </tr>
      </table>


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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        console.log("");

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "0";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";

        $.post("guardar_abono_cuenta_cobrar_directa_no_por_factura_numeros_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar }, function(data){
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
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
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "btn_agregar_registro";
    })



    // Equal
    $('#btn_guardar').on('click', function () {
        $('#refrescar_sonido').html('<audio autoplay><source src="../sonidos/pitido_calc4.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>');
        display_superior.answer = display_superior.evaluation; // Store the answer (Ans button)
        var valores_separados = $('#display_superior').val();
        var cod_tipo_forma_pago = $('#cod_tipo_forma_pago').val();
        var cod_tercero = $('#cod_tercero').val();

        var valor_total = display_superior.answer;
        var valor = valores_separados;
        var tipo_ajax = "tbl15_cuentas_cobrar";
        var campo = "abono";
        var opcion = "btn_guardar";
        var cod_cuentas_cobrar = "<?php echo $cod_cuentas_cobrar?>";
        var cod_factura = "<?php echo $cod_factura?>";

        var parametros = { valor:valor, campo:campo, tipo_ajax:tipo_ajax, opcion:opcion, cod_cuentas_cobrar:cod_cuentas_cobrar, cod_tipo_forma_pago:cod_tipo_forma_pago, cod_tercero:cod_tercero };

        $.ajax({
          type: "POST",
          url: "../admin/modificar_cuentas_cobrar_directa_no_por_factura_ajax.php",
          data: parametros,
          dataType: "json",
          //contentType: false,
          //processData: false,
          beforeSend: function(entrada){
              //$("#icono_estado").html('<img src="../imagenes/cargador.gif">');
              //$("#estado").html('Cargando...');
            },
          success: function(respuesta){
            var cod_cuentas_cobrar_abonos = respuesta.llave;
            var abonado = respuesta.abonado;
            var vlr_cancelado = respuesta.vlr_cancelado;
            var vlr_vuelto = respuesta.vlr_vuelto;
            var estado = respuesta.estado;

            if (estado == '1') {
              $('#display_superior').val(abonado.toLocaleString()); // Update display_superior
              $('#display_inferior').val(vlr_vuelto.toLocaleString()); // Update display_inferior
              display_superior.operation = display_superior.answer; // Current operation equals the answer
              flag.ansAllowed = true; // Allow the use of Ans button
              window.location.replace("../admin/cuentas_cobrar_opcion_imprimir.php?cod_cuentas_cobrar_abonos="+cod_cuentas_cobrar_abonos+"&"+"cod_cuentas_cobrar="+cod_cuentas_cobrar+"&"+"cod_factura="+cod_factura+"&"+"cod_tercero="+cod_tercero+"&"+"cliente="+"&"+"pagina=../admin/cuentas_cobrar_abonos.php");
            } else {
              window.location.replace("../admin/cuentas_cobrar_opcion_imprimir.php");
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
<?php } ?>

<?php 
if (isset($_GET['cod_cuentas_cobrar_abonos'])) { 
  $cod_cuentas_cobrar_abonos           = intval($_GET['cod_cuentas_cobrar_abonos']);

  $obtener_info_fact = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
  $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
  $info_fact = mysqli_fetch_assoc($resultado_info_fact);

  $cod_factura                         = $info_fact['cod_factura'];
  $fecha_anyo                          = $info_fact['fecha_anyo'];
  $fecha_hora                          = substr($info_fact['fecha_hora'], 0, 5);
  $total_precio_compra                 = $info_fact['total_precio_compra'];
  $total_precio_venta                  = $info_fact['total_precio_venta'];
  $total_datos_data                    = $info_fact['total_datos_data'];
  $cod_tercero                         = $info_fact['cod_tercero'];
  $cuenta                              = $info_fact['cuenta'];
  $vlr_cancelado                       = $info_fact['vlr_cancelado'];
  $vlr_vuelto                          = $info_fact['vlr_vuelto'];
  $cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
  $cod_administrador                   = $info_fact['cod_administrador'];
  $cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
  $nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
  $nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
  $cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
  $descuento_ptj                       = $info_fact['descuento_ptj'];
  $cod_caja_virtual                    = $info_fact['cod_caja_virtual'];
  $cod_base_caja                       = $info_fact['cod_base_caja'];
  $vlr_cambio                          = ($vlr_cancelado - $total_precio_venta);
?>
    <table class="table table-striped">
      <tr>
        <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
        <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
      </tr>
      <tr>
        <td><font color='black' size= "+3">FACTURA NO:</font></td>
        <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
      </tr>
      <tr>
        <td><font color='black' size= "+3">SUBTOTAL:</font></td>
        <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base_sin_descuento, 0, ",", "."); ?></font></td>
      </tr>
      <tr>
        <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
        <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
      </tr>
    </table>

    <table class="table table-striped">
      <tr>
        <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
        <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
        <?php } ?>
      </tr>
    </table>


    <script>  
    $(document).ready(function(){  
      $('#btnImprimir').click(function(){
      var cod_cuentas_cobrar_abonos = <?php echo $cod_cuentas_cobrar_abonos ?>;
      var origen = "1";  
        $.ajax({ url:"imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_cuentas_cobrar_abonos:cod_cuentas_cobrar_abonos, campo:"cod_cuentas_cobrar_abonos", id:cod_cuentas_cobrar_abonos, origen:origen }, 
         success: function(response){
             if(response==1){
                 //alert('Imprimiendo....');
             }else{
                 //alert('Error');
             }
         }
        });  
      });
    });  
    </script>
<?php } ?>

</body>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
</html>
