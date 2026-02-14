<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');

date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cod_administrador  = $_SESSION['cod_administrador'];


$sql_infos_empresas = "SELECT cod_tipo_sistema_numeracion_und_compra, cod_tipo_sistema_numeracion_precio_compra, cod_tipo_sistema_numeracion_precio_venta FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_tipo_sistema_numeracion_und_compra            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_precio_compra         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];


$pagina_complt            = $_SERVER['PHP_SELF'];
$fragm                    = explode("/", $pagina_complt);
$ultimo                   = end($fragm);
$total_elementos          = count($fragm) - 1;
$concatenador             = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }

$pagina                   = $concatenador."producto_copia_inventario_con_existencia_no_cargados_masivo1.php";
//---------------------------------------------------------------------------------------------------------------------------------//
$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if($action == 'ajax') {
    $busqueda_ajax                          = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
    $buscar_por                             = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
    $tabla                                  = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
    $cod_info_producto_copia_inventario     = intval($_REQUEST['cod_info_producto_copia_inventario']);

    $sql_info_factura = "SELECT cod_estado_check FROM tbl15_info_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    $info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

    $cod_estado_check                       = $info_info_factura['cod_estado_check'];
}
if($busqueda_ajax <> NULL) {
	if($buscar_por == 'nombre_producto') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('nombre_producto'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('cod_producto_barra'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra2') {
		$busq_aprox_izq = '';
		$busq_aprox_der = '';
     	$aColumns = array('cod_producto_barra2'); //Columnas de busqueda
	} elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('cod_producto_barra', 'nombre_producto'); //Columnas de busqueda
	} else {
		$busq_aprox_izq = '%';
		$busq_aprox_der = '%';
     	$aColumns = array('cod_producto_barra', 'nombre_producto'); //Columnas de busqueda
	}
}
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
    if($action == 'ajax') {
// escaping, additionally removing everything that could be (html/javascript-) code
     $sTable = "tbl15_producto_copia_inventario";

     $sWhere = "WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
    if ( $_GET['busqueda_ajax'] != "" ) {
        $sWhere = "WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '$busq_aprox_der".$busqueda_ajax."$busq_aprox_izq' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
if ($_GET['busqueda_ajax'] == "") {
    $sWhere.=" ORDER BY cod_producto_copia_inventario DESC";
} else {
    $sWhere.=" ORDER BY cod_producto_copia_inventario DESC";
}
?>
    <table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center;"><input type="checkbox" name="seleccionar_todos" class="seleccionar_todos" id="<?php echo $cod_info_producto_copia_inventario ?>" value="0" <?php if($cod_estado_check=='1'){ echo "checked"; } ?>>TODOS</th>
            <th style="text-align:center">PRODUCTO</th>
            <th style="text-align:center">CÓDIGO</th>
            <th style="text-align:center">INV NUEVO</th>
            <th style="text-align:center">INV VIEJO</th>
            <th style="text-align:center">RESULTADO</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">P.COMPRA</th>
            <th style="text-align:center">P.VENTA</th>
            <th style="text-align:center">ID INV</th>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">...</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_consulta = "SELECT * FROM $sTable $sWhere";
    $resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_consulta);
    while ($info_producto_con_existencia_no_cargado = mysqli_fetch_array($resultado_producto_con_existencia_no_cargado)) {

        $cod_producto_copia_inventario          = $info_producto_con_existencia_no_cargado['cod_producto_copia_inventario'];
        $cod_producto_barra                     = $info_producto_con_existencia_no_cargado['cod_producto_barra'];
        $nombre_producto                        = $info_producto_con_existencia_no_cargado['nombre_producto'];
        $und_producto_nuevo                     = $info_producto_con_existencia_no_cargado['und_producto_nuevo'];
        $und_producto_viejo                     = $info_producto_con_existencia_no_cargado['und_producto_viejo'];
        $precio_compra_producto                 = $info_producto_con_existencia_no_cargado['precio_compra_producto'];
        $precio_venta_producto                  = $info_producto_con_existencia_no_cargado['precio_venta_producto'];
        $comentario_copia_inventario            = $info_producto_con_existencia_no_cargado['comentario_copia_inventario'];
        $fecha_actualizacion                    = $info_producto_con_existencia_no_cargado['fecha_actualizacion'];
        $cod_administrador                      = $info_producto_con_existencia_no_cargado['cuenta'];
        $cod_estado                             = $info_producto_con_existencia_no_cargado['cod_estado'];

        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_nuevo = intval($und_producto_nuevo); } else { $und_producto_nuevo = $und_producto_nuevo; }
        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_viejo = intval($und_producto_viejo); } else { $und_producto_viejo = $und_producto_viejo; }
        if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
        if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
        if ($cod_estado == '1') { $imagen_estado = "../imagenes/spam_reg.png"; } else { $imagen_estado = "../imagenes/btn_revisado.gif"; }

        $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
        $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
        $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

        $cuenta                                 = $datos_administrador['cuenta'];
        $resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
        if ($resta < 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS FALTAN"; } elseif ($resta > 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS SOBRAN"; } elseif ($resta == 0 && $cod_estado == '1') { $titulo_resultado = "BIEN"; } else { $titulo_resultado = ""; }
    ?>
        <tr>
            <td style="text-align:center;"><div id="listado"><input name="cod_estado" class="cod_estado" id="cod_estado_check__<?php echo $cod_producto_copia_inventario ?>" type="checkbox" value="0" <?php if($cod_estado=='1'){ echo "checked"; } ?>></div></td>
            <td style="text-align:left"><?php echo $cod_producto_barra?></td>
            <td style="text-align:left"><?php echo $nombre_producto?></td>
            <td style="text-align:center"><input type="text" name="und_producto_nuevo" value="<?php echo ($und_producto_nuevo) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" /></td>
            <td style="text-align:center"><?php echo $und_producto_viejo?></td>
            <td style="text-align:center" id="mensaje<?php echo $cod_producto_copia_inventario ?>"><?php echo $titulo_resultado?></td>
            <td style="text-align:left"><input type="text" name="comentario_copia_inventario" value="<?php echo ($comentario_copia_inventario) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" style="width: 200px"/></td>
            <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $cod_info_producto_copia_inventario?></td>
            <td style="text-align:center"><?php echo $cod_producto_copia_inventario?></td>
            <td style="text-align:center" id="resultado_transaccion<?php echo $cod_producto_copia_inventario ?>"><img src="<?php echo $imagen_estado?>"></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
            </div>
        <?php    
    }
?>

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_producto_copia_inventario";
        let id = this.id;
        var campo_incre = id;

        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_producto_copia_inventario_venta_simultanea_masivo_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#'+campo+''+id).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;
                if ((afectado == 'SI' && (campo == 'und_producto_nuevo'))) {
                    $('#resultado_transaccion'+id).html('');
                    $('#resultado_transaccion'+id).html('<img src="../imagenes/spam_reg.png">');
                    $('#mensaje'+id).html(''+mensaje);
                } else if ((afectado == 'SI' && (campo == 'comentario_copia_inventario'))) {
                } else {
                    $('#resultado_transaccion'+id).html('');
                    $('#resultado_transaccion'+id).html('Error');
                }
            }
        });
    });
});
</script>

<script>
$(function(){
    $('.seleccionar_todos').prop('checked',true);
    $(".seleccionar_todos").change(function(){ if( $(this).is(':checked') ){ $(".seleccionar_todos").val("0"); } else { $(".seleccionar_todos").val("1"); } });
});
</script>

<script>
$('input:checkbox[name="cod_estado"]').change(function(){ 
    var valor = $(this).val();
    var campo = $(this).attr("name");
    var id = $(this).attr("id");
    let framentador = id.split('__');
    var ids = framentador[1];
    var cod_estado = valor;

    if (campo == 'cod_estado') { if( $('#cod_estado_check__'+ids).prop('checked') ) { valor = 1; $('#cod_estado_check__'+ids).prop('checked',true); } else { valor = 0; $('#cod_estado_check__'+ids).prop('checked',false); } }

    $.ajax({
      url:"../admin/guardar_inventario_imediato_venta_simultanea_check_ajax.php",
      method:"POST",
      data:{valor:valor, campo:campo, id:id},
      success:function(data){ 
           $('#result').html(data);
      }
    });

});
</script>

<script>
$('input:checkbox[name="seleccionar_todos"]').change(function(){ 
    var valor = $(this).val();
    var campo = $(this).attr("name");
    var id = $(this).attr("id");
    var seleccionar_todos = valor;

    $('#listado > input[type=checkbox]').prop('checked', $(this).is(':checked'));

    $.ajax({
      url:"../admin/guardar_inventario_imediato_venta_simultanea_check_ajax.php",
      method:"POST",
      data:{valor:valor, campo:campo, id:id},
      success:function(data){ 
           $('#result').html(data);
      }
    });
});
</script>