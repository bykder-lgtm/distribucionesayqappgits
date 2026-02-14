<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_info_empresa_visitante_ext.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);

$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);

$accion_codifcryp                   = $_GET['accion_codifcryp'];
$accion_codif                       = DAXCODIFCRYPTOR::descriptardax($accion_codifcryp);
$accion                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($accion_codif));

$tipo_codifcryp                     = $_GET['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$origen_codifcryp                   = $_GET['origen_codifcryp'];
$origen_codif                       = DAXCODIFCRYPTOR::descriptardax($origen_codifcryp);
$origen                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($origen_codif));
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($accion == 'redirecionar_whatapp' && $origen == 'carrito') {

	$sqlr_adm = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$modificar_adm = mysqli_query($conectar, $sqlr_adm) or die(mysqli_error($conectar));
	$datos_adm = mysqli_fetch_assoc($modificar_adm);

	$fecha_anyo                                   = $datos_adm['fecha_anyo'];
	$fecha_hora                                   = $datos_adm['fecha_hora'];
	$nombre1_tercero                              = $datos_adm['nombre1_tercero'];
	$telefono1_tercero                            = $datos_adm['telefono1_tercero'];
    $cod_tipo_forma_pago                          = $datos_adm['cod_tipo_forma_pago'];
    $cod_administrador_tercero                    = $datos_adm['cod_administrador_tercero'];
    $total_precio_venta                           = $datos_adm['total_precio_venta'];

    $sql_info_impresora = "SELECT * FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
    $info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

    $nombre_tipo_forma_pago                       = $info_impresora['nombre_tipo_forma_pago'];

    $enterbr                                      = '%0A';
    $negrita_abre                                 = "%0A*";
    $negrita_cierre                               = "*%0A";
    $info_pedido_producto_concat                  = "";
    $sql_producto = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto_temporal DESC";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $total_reg = mysqli_num_rows($consulta_producto);
    while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

        $cod_venta_producto_temporal              = $datos_producto['cod_venta_producto_temporal'];
        $cod_carrito_compra_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_venta_producto_temporal);
        $cod_carrito_compra_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_carrito_compra_temporal_codif);
        $nombre_producto                          = $datos_producto['nombre_producto'];
        $und_venta                                = $datos_producto['und_venta'];
        $precio_venta_producto                    = $datos_producto['precio_venta_producto'];
        $total_venta_producto                     = $datos_producto['total_venta_producto'];
        $total_venta_ind                          = $und_venta * $precio_venta_producto;
        $total_venta                             += $und_venta * $precio_venta_producto;
        $info_pedido_producto_concat             .= $negrita_abre.'X'.intval($und_venta).' '.$nombre_producto.' %24'.number_format($precio_venta_producto, 0, ",", ".").$negrita_cierre;
    }
    $vengo_de                                     = "👋 Vengo de urbanstreaming.com";
    $tipo_solicitud_cliente                       = $negrita_abre.'Tipo de Solicitud'.'%3A '.'Solicitud de Compra'.$negrita_cierre;
    $fecha_hora_registro                          = '🗓️ '.$fecha_anyo.' ⏰ '.$fecha_hora;
    $nombre_cliente                               = 'Nombre'.'%3A '.trim($nombre1_tercero.' '.$apellido1_tercero).' - IDV:'.$cod_administrador_tercero;
    $telefono_cliente                             = 'Teléfono%3A '.$telefono1_tercero;
    $productos_cliente                            = $enterbr.'📝 Productos'.$info_pedido_producto_concat;
    $subtotal_cliente                             = 'Subtotal'.'%3A '.number_format($total_precio_venta, 0, ",", ".");
    $entrega_cliente                              = 'Entrega'.'%3A '.'0';
    $total_cliente                                = $negrita_abre.'Total'.'%3A '.number_format($total_precio_venta, 0, ",", ".").$negrita_cierre;
    $titulo_pago_cliente                          = $negrita_abre."💲 Pago".$negrita_cierre;
    $forma_pago_cliente                           = $negrita_abre."Total a pagar".'%3A '.number_format($total_precio_venta, 0, ",", ".").$negrita_cierre.$enterbr.$nombre_tipo_forma_pago.'%3A '.number_format($total_precio_venta, 0, ",", ".");
    $mensaje_final                                = $enterbr."👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.";
    $id_cod_info_factura_venta                    = $enterbr."ID".'%3A'.$cod_info_factura_venta;

    $mensaje_whatsapp = $vengo_de.''.$enterbr.$tipo_solicitud_cliente.$enterbr.$fecha_hora_registro.$enterbr.$nombre_cliente.$enterbr.$telefono_cliente.$enterbr.$productos_cliente.$enterbr.$subtotal_cliente.$total_cliente.$forma_pago_cliente.$enterbr.$mensaje_final.$enterbr.$id_cod_info_factura_venta;
	$url_redir = "https://api.whatsapp.com/send?phone=57$telefono&text=".$mensaje_whatsapp;
	header("Location: $url_redir");
} 
elseif ($accion == 'redirecionar_telefono' && $origen == 'carrito') {

	$url_redir = "tel:57$telefono";
	header("Location: $url_redir");
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
/*
%F0%9F%91%8B%20Vengo%20de%20https%3A%2F%2Farepasrube-col.ola.click%0ACO-2917157790%0A%F0%9F%97%93%EF%B8%8F%2028%2F02%2F2025%20%E2%8F%B0%2006%3A00%20pm%0A%0A*Tipo%20de%20servicio%3A%20En%20el%20local*%0A%0ANombre%3A%20JUAN%20ESTEBAN%0ATel%C3%A9fono%3A%2057%203002698441%0A%0A*%F0%9F%93%9D%20Productos*%0A*X1%20SALCHIPAPA%20-%20especial%20%24%2025.000*%0A%0ASubtotal%3A%20%24%2025.000%0A
Entrega%3A%20%24%200%0A*
Total%3A%20%24%2025.000*%0A%0A*%F0%9F%92%B2%20Pago*%0AEstado%20del%20pago%3A%20No%20pagado%0A*Total%20a%20pagar%3A%20%24%2025.000*%0AEfectivo%2025000%20(monto%20recibido%2050000%2C%20vuelto%2025000)%20%0A%0A%0A%F0%9F%91%86%20Env%C3%ADanos%20este%20mensaje%20ahora.%20En%20cuanto%20lo%20recibamos%20estaremos%20atendi%C3%A9ndole.%0A




text=👋 Vengo de https%3A%2F%2Farepasrube-col.ola.click%0ACO-5054625200%0A🗓%EF%B8%8F 27%2F02%2F2025 ⏰ 09%3A19 pm%0A%0A*Tipo de servicio%3A En el local*%0A%0ANombre%3A CARLO HUERTAS%0ATeléfono%3A 57 3012895254%0A%0A*📝 Productos*%0A*X1 AREPA R2%20 %24 19.300*%0A%20%20%20 1 Unidad(es)%20 %24 19.300%20%0A%20%20%20 %2B1 BLANDITA%20%0A*X1 AREPA COSTEÑO %2B BEBIDA%20 %24 20.800*%0A*X1 IMPERDIBLE 1 %2B BEBIDA%20 %24 20.800*%0A*X1 AREPA 3 INGRDIENTES%20 %24 17.000*%0A%20%20%20 1 Unidad(es)%20 %24 17.000%20%0A%20%20%20 %2B1 ARTESANA%20%0A%20%20%20 %2B1 QUESO FRITO%20%0A%20%20%20 %2B1 MORTADELA%20%0A*X1 AREPA DE POLLO %2B CARNE%20 %24 15.300*%0A*X1 AREPA DE CHICHARRON%20 %24 11.900*%0A%20%20%20 1 Unidad(es)%20 %24 0%20%0A%20%20%20 %2B1 SENCILLA %24 11.900%0A*X1 BUTIFARRA%20 %24 4.400*%0A*X1 PORCION DE FRANCESA%20 %24 5.000*%0A%0ASubtotal%3A %24 114.500%0AEntrega%3A %24 0%0A*Total%3A %24 114.500*%0A%0A*💲 Pago*%0AEstado del pago%3A No pagado

%0A*Total a pagar%3A %24 114.500*%0A
Efectivo 114500 (monto recibido 120000%2C vuelto 5500)%20%0A%0A%0A👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.%0A

*%0A%20%20%20 1 Unidad(es)%20 %24 19.300%20%0A%20%20%20 %2B1 BLANDITA%20%0A*X1 AREPA COSTEÑO %2B BEBIDA%20 %24 20.800*%0A*X1 IMPERDIBLE 1 %2B BEBIDA%20 %24 20.800*%0A*X1 AREPA 3 INGRDIENTES%20 %24 17.000*%0A%20%20%20 1 Unidad(es)%20 %24 17.000%20%0A%20%20%20 %2B1 ARTESANA%20%0A%20%20%20 %2B1 QUESO FRITO%20%0A%20%20%20 %2B1 MORTADELA%20%0A*X1 AREPA DE POLLO %2B CARNE%20 %24 15.300*%0A*X1 AREPA DE CHICHARRON%20 %24 11.900*%0A%20%20%20 1 Unidad(es)%20 %24 0%20%0A%20%20%20 %2B1 SENCILLA %24 11.900%0A*X1 BUTIFARRA%20 %24 4.400*%0A*X1 PORCION DE FRANCESA%20 %24 5.000*%0A%0ASubtotal%3A %24 114.500%0AEntrega%3A %24 0%0A*Total%3A %24 114.500*%0A%0A*💲 Pago*%0AEstado del pago%3A No pagado%0A*Total a pagar%3A %24 114.500*%0AEfectivo 114500 (monto recibido 120000%2C vuelto 5500)%20%0A%0A%0A👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.%0A

Vengo de https://arepasrube-col.ola.click
👋 Vengo de https%3A%2F%2Farepasrube-col.ola.click

%0A

CO-5054625200

%0A

🗓️ 27/02/2025 ⏰ 09:19 pm
🗓%EF%B8%8F 27%2F02%2F2025 ⏰ 09%3A19 pm

%0A
%0A

*Tipo de servicio%3A En el local
*%0
A%0

Nombre: CARLO HUERTAS
Nombre%3A CARLO HUERTAS
%0A

Teléfono: 57 3012895254
Teléfono%3A 57 3012895254

%0A%0A*

📝 Productos
📝 Productos

*%0A*
X1 AREPA R2  $ 19.300
X1 AREPA R2%20 %24 19.300

    1 Unidad(es)  $ 19.300 
    +1 BLANDITA 
X1 AREPA COSTEÑO + BEBIDA  $ 20.800
X1 IMPERDIBLE 1 + BEBIDA  $ 20.800
X1 AREPA 3 INGRDIENTES  $ 17.000
    1 Unidad(es)  $ 17.000 
    +1 ARTESANA 
    +1 QUESO FRITO 
    +1 MORTADELA 
X1 AREPA DE POLLO + CARNE  $ 15.300
X1 AREPA DE CHICHARRON  $ 11.900
    1 Unidad(es)  $ 0 
    +1 SENCILLA $ 11.900
X1 BUTIFARRA  $ 4.400
X1 PORCION DE FRANCESA  $ 5.000

Subtotal: $ 114.500
Entrega: $ 0
Total: $ 114.500

💲 Pago
Estado del pago: No pagado
Total a pagar: $ 114.500
Efectivo 114500 (monto recibido 120000, vuelto 5500) 


👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.
*/
?>