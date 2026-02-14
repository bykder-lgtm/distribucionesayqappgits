<?php error_reporting(E_ALL ^ E_NOTICE);?>
<?php require_once('../conexiones/conexione.php'); 
require_once('../evitar_mensaje_error/error.php'); 
mysql_select_db($base_datos, $conectar); 
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);
include ("../seguridad/seguridad_diseno_plantillas.php");

$nivel_acceso = '3';
if ($seguridad_acceso['cod_seguridad'] <> $nivel_acceso) {
header("Location:../admin/acceso_denegado.php");
}
include ("../registro_movimientos/registro_movimientos.php");
//include ("../registro_movimientos/registro_cierre_caja.php");

$fecha_hoy_seg            = date("Y-m-d");
$fecha_mes_anterior       = date("m/Y",strtotime($fecha_hoy_seg."- 1 month")); 
$fecha_mes                = date("m/Y");
$fecha_mess               = date("m/Y");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"> 
<title>ALMACEN</title>
</head>
<body>
<center>
<br><br>

<table widht='80%'>
<tr>
<td align="center"><strong><font size='+1' color='yellow'>PRODUCTOS MAS VENDIDOS DEL MES (<?php echo $fecha_mes?>) - </font><a href="../admin/producto_mas_vendido_mes_anterior.php"><font size='+1' color='white'>PRODUCTOS MAS VENDIDOS MES ANTERIOR (<?php echo $fecha_mes_anterior?>)</a></font> - </font><a href="../admin/productos_mas_vendidos.php"><font size='+1' color='white'>PRODUCTOS MAS VENDIDOS</a></font></strong></td>
</tr>
<tr>
<td align="center"></td>
</tr>
<tr>
<td align="center"><a href="../admin/descargar_productos_mas_vendidos_csv.php?fecha_mes=<?php echo $fecha_mes?>"><img src=../imagenes/descargar.png alt="descargar"></a></td>
</tr>
</table>

<br><br>
<table widht='80%'>
<tr>
<td align="center"><strong>C&Oacute;DIGO</strong></td>
<td align="center"><strong>PRODUCTO</strong></td>
<td align="center"><strong>UND INVENTARIO</strong></td>
<td align="center"><strong>UND VENDIDAS</strong></td>
<td align="center"><strong>P.VENTA</strong></td>
<td align="center"><strong>TOTAL</strong></td>
<td align="center"><strong>FECHA - MES</strong></td>
<td align="center"><strong>OK</strong></td>
</tr>
<?php
$mostrar_datos_sql = "SELECT nombre_productos, Sum(unidades_vendidas) AS unidades_vendidas, vlr_total_venta, cod_productos,  
precio_venta, fecha_mes, chk2 FROM ventas WHERE fecha_mes = '$fecha_mes' GROUP BY  cod_productos ORDER BY unidades_vendidas DESC LIMIT 0,1000";
$consulta = mysql_query($mostrar_datos_sql, $conectar) or die(mysql_error());
while ($datos = mysql_fetch_assoc($consulta)) { 

$cod_productos           = $datos['cod_productos'];
$nombre_productos        = $datos['nombre_productos'];
$unidades_vendidas       = $datos['unidades_vendidas'];
$precio_venta            = $datos['precio_venta'];
$total                   = $unidades_vendidas * $precio_venta;
$fecha_mes               = $datos['fecha_mes'];
$chk2                    = $datos['chk2'];

$mostrar_und_invent = "SELECT unidades_faltantes FROM productos WHERE cod_productos_var = '$cod_productos'";
$consulta_und_inven = mysql_query($mostrar_und_invent, $conectar) or die(mysql_error());
$datos_und_inven = mysql_fetch_assoc($consulta_und_inven);

$unidades_faltantes      = $datos_und_inven['unidades_faltantes'];
?>
<tr>
<td ><font size='+1'><?php echo $cod_productos; ?></font></td>
<td ><font size='+1'><?php echo $nombre_productos; ?></font></td>
<td align="center"><font size='+1'><?php echo number_format($unidades_faltantes, 0, ",", "."); ?></font></td>
<td align="center"><font size='+1'><?php echo number_format($unidades_vendidas, 0, ",", "."); ?></font></td>
<td align="right"><font size='+1'><?php echo number_format($precio_venta, 0, ",", "."); ?></font></td>
<td align="right"><font size='+1'><?php echo number_format($total, 0, ",", "."); ?></font></td>
<td align="center"><font size='+1'><?php echo $fecha_mes; ?></font></td>
<td align='center'><input name='chk2' class="chk2" id="<?php echo $cod_productos;?>" type='checkbox' value='1' <?php if($chk2=='1'){ echo 'checked'; } ?>></td>
</tr>
<?php }  ?>
</table>

<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>

<script>  
 $(document).ready(function(){

$(".chk2").change(function(){ if( $(this).is(':checked') ){ $(".chk2").val("1"); } else {   $(".chk2").val("0"); } });

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("input");
$.ajax({  
    url:"marcar_chk2_productos_mas_vendidos_ajax.php",  
    method:"POST",  
    data:{id:id, campo:campo, valor:valor, fecha_mes: '<?php echo $fecha_mes; ?>'},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});


 });  
 </script>