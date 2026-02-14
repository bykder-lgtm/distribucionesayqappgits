<?php
header( 'Content-Type: application/json' );
require_once('../conexiones/conexione.php');

$sql_ultimo_anyo = "SELECT MAX(fecha_anyo_venta_producto) AS fecha_anyo_venta_producto FROM tbl15_venta_producto";
$consult_ultimo_anyo = mysqli_query($conectar, $sql_ultimo_anyo);
$datos_ultimo_anyo = mysqli_fetch_assoc($consult_ultimo_anyo);

//CALCULO PARA SABER CUAL ES EL ULTIMO AÑO Y AL QUE SE LE VA A HACER LA PROYECCION
$ultimo_anyo = $datos_ultimo_anyo['fecha_anyo_venta_producto'];
$proyeccion_anyo = $ultimo_anyo + 1;
//---------------------------------------------------------------------------//
//---------------------------------------------------------------------------//
//INICIACION DE VARIABLES PARA LOS CALCULOS
$contador = 0;
$smt_x = 0;
$smt_y = 0;
$smt_x2 = 0;
$smt_xy = 0;
$A = 0;
$B = 0;
$Y = 0;
$prefix1 = '';
//---------------------------------------------------------------------------//
//---------------------------------------------------------------------------//
//CONSULTA LA OBTENER LOS DATOS DE LA BASE DE DATOS
$sql_ventas_anyo = "SELECT fecha_anyo_venta_producto, SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto GROUP BY fecha_anyo_venta_producto ORDER BY fecha_anyo_venta_producto ASC";
$consult_ventas_anyo = mysqli_query($conectar, $sql_ventas_anyo);
$total_n = mysqli_num_rows($consult_ventas_anyo);

echo "[\n";
while ($datos_ventas_anyo = mysqli_fetch_assoc($consult_ventas_anyo) ) {
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//RECOLECION DE LOS DATOS DE LA BASE DE DAATOS Y VARIABLES ESTATICAS
	$fecha_anyo_venta_producto = $datos_ventas_anyo['fecha_anyo_venta_producto'];
	$total_venta_producto = intval($datos_ventas_anyo['total_venta_producto']);
	$longitud_linea = 1;
	$transparencia = 1;
	$adiccional = "(Proyeccion)";
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//CALCULOS PARA LAS SUMATORIAS
	$contador ++;
	$smt_x += $contador;
	$smt_y += $total_venta_producto;
	$smt_x2 += $contador * $contador;
	$smt_xy += $contador * $total_venta_producto;
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//FORMULA METODO DE LOS MINIMOS CUADRADOS (PRONOSTICAR VENTAS)
	//A = (SY * SX^2) - (SX * SXY) / N*(SX^2) - (SX * SX)
	//B = (N*SXY - SX*SY) / N*(SX^2) - (SX * SX)
	//Y = A+(B*X)
	//SIENDO (X) EL ULTIMO AÑO AUMENTADO EN UNO
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//CALCULOS PARA A
	$A_dividendo = ($smt_y * $smt_x2) - ($smt_x * $smt_xy);
	$A_divisor = ($total_n * $smt_x2) - ($smt_x * $smt_x);
	$A = intval($A_dividendo / $A_divisor);
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//CALCULOS PARA B
	$B_dividendo = ($total_n * $smt_xy) - ($smt_x * $smt_y);
	$B_divisor = ($total_n * $smt_x2) - ($smt_x * $smt_x);
	$B = intval($B_dividendo / $B_divisor);
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//CALCULOS PARA Y
	$Y = intval($A + ($B * ($total_n + 1)));
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//ESTO ES PARA LA LINEA QUE SIGUE LAS COLUMNAS, EN ESTE CASO PARA MOSTRAR UNA ESPECIE DE PROMEDIO DE VENTA
	$promed_venta_anterior = $total_venta_producto/2;
	$promed_venta_proyec = $Y/2;
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//MOSTRAR SI EL AÑO ACTUAL ES MENOR O IGUAL AL ULTIMO AÑO  
	if ($fecha_anyo_venta_producto <= $ultimo_anyo) {
		echo $prefix1 . "{";
		echo ' "fecha_anyo_venta_producto": '.$fecha_anyo_venta_producto.',';
		echo ' "total_venta_producto": '.$total_venta_producto.',';
		echo ' "promed_venta": '.$total_venta_producto.',';
		//---------------------------------------------------------------------------//
		//---------------------------------------------------------------------------//
		//MOSTRAR SI EL CONTADOR LLEGO AL ULTIMO REGISTRO
		// ESTO ES PARA QUE LA LINEA QUE BORDEA LA COLUMNA CAMBIE DE GROSOR CUANDO LLEGUE A ESTE REGISTRO
		if ($contador == $total_n) {
			$longitud_linea = 5;

			echo ' "longitud_linea": '.$longitud_linea.',';
			echo ' "transparencia": '.$transparencia.',';
			echo ' "adiccional": "'.''.'" }';
		} else {
			echo ' "longitud_linea": '.$longitud_linea.',';
			echo ' "transparencia": '.$transparencia.',';
			echo ' "adiccional": "'.''.'"';
		}
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	} // FIN DEL CONDICIONAL ($fecha_anyo_venta_producto <= $ultimo_anyo)
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	//CUANDO LLEGUE AL ULTIMO AÑO ADICIONE ESTE NUEVO REGISTRO QUE ES EL DE LA PROYECCION. SE HACE AUMENTADO UN VALOR AL ULTIMO AÑO
	//TAMBIEN SE CAMBIA LA TRANSPARENCIA (SE DISMUNUYE), Y SE LE APLICA UN BORDE DE COLUMNA COMO EL REG ANTERIOR
	if ($fecha_anyo_venta_producto == $ultimo_anyo) {
		$fecha_anyo_venta_producto = $proyeccion_anyo;
		$longitud_linea = 5;
		$transparencia = 0.2;

		echo $prefix1 . "{";
		echo ' "fecha_anyo_venta_producto": '.$proyeccion_anyo.',';
		echo ' "total_venta_producto": '.$Y.',';
		echo ' "promed_venta": '.$Y.',';
		echo ' "longitud_linea": '.$longitud_linea.',';
		echo ' "transparencia": '.$transparencia.',';
		echo ' "adiccional": "'.$adiccional.'"';
	}
	//---------------------------------------------------------------------------//
	//---------------------------------------------------------------------------//
	echo " }";
	$prefix1 = ",\n";
} // FIN DEL CICLO WHILE
echo "\n]";
?>