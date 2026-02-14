<?php
$fecha_pago                     = "2023-01-29";
$numero_cuota                   = 6;
$mes                            = '';
$tipo_cobro                     = 'month';
$numero_alerta                  = 0;
$numero_alerta_correcion        = -1;


for ($contador=0; $contador < $numero_cuota ; $contador++) { 

	$numero_alerta++;
	$numero_alerta_correcion++;
	$dia_corte_pago                 = date("d", strtotime($fecha_pago));
	$mes_corte_pago                 = date("m", strtotime($fecha_pago));
	$anyo_corte_pago                = date("Y", strtotime($fecha_pago));
    $fecha_pago_modif               = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
    $fecha_mes_pago_modif           = $anyo_corte_pago.'-'.$mes_corte_pago;
    $fecha_mes_modif                = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
    $fecha_mes_real                 = date("Y-m", strtotime($fecha_mes_modif));

	$fecha_pago_alerta_datetime     = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
	$ultimo_del_dia	                = $fecha_pago_alerta_datetime->format('t');


	if ($dia_corte_pago > $ultimo_del_dia) { 
		$fecha_pago_alerta              = $fecha_mes_real.'-'.$ultimo_del_dia;
		$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
		$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
		echo "<br>fecha_pago_alerta = ".$fecha_pago_alerta;
		echo "<br>fecha_mes = ".$fecha_mes;
		echo "<br>anyo = ".$anyo;
	} else { 
		$fecha_pago_alerta              = $fecha_mes_real.'-'.$dia_corte_pago;
		$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
		$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
		echo "<br>fecha_pago_alerta = ".$fecha_pago_alerta;
		echo "<br>fecha_mes = ".$fecha_mes;
		echo "<br>anyo = ".$anyo;
	}
}
?>