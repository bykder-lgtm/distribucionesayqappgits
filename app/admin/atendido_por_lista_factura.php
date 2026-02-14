<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
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
<a class="btn btn-primary" href="#"><h6>Lista de Paciente Atendidos Por Empresa</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>

<br>
<div class="table-responsive">

<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><tbl15_font size='+2'>Lista Facturas Evaluados</tbl15_font></a></th>
    </tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Factura</th>-->
<th style="text-align:center">Cod Factura</th>
<th style="text-align:center">Empresa</th>
<th style="text-align:center">Concepto</th>
<!--<th style="text-align:center">Cantidad</th>
<th style="text-align:center">Total Costo</th>-->
<th style="text-align:center">Fecha Ini</th>
<th style="text-align:center">Fecha Fin</th>
<th style="text-align:center">Tipo</th>
<th style="text-align:center">Excel</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Lista</th>
</tr>
</thead>
<tbody>
<?php
$fecha                      = date("Y/m/d");
$motivos                    = "";
$total_muestra              = 0;
$origen                     = 'EVALUADOS';

$sql_cliente = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_estado_factura = '0') AND (nombre_tipo_producto = '' OR (nombre_tipo_producto = 'EVALUADOS')) ORDER BY cod_factura DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_info_factura_venta           = $info_cliente['cod_info_factura_venta'];
$cod_factura                = $info_cliente['cod_factura'];
$fecha_ini                  = $info_cliente['fecha_ini'];
$fecha_fin                  = $info_cliente['fecha_fin'];
$nombre_empresa             = $info_cliente['nombre_empresa'];
$razonsocial_empresa        = $info_cliente['razonsocial_empresa'];
$total_motivo               = $info_cliente['total_motivo'];
$motivo                     = $info_cliente['motivo'];
$motivo2                    = $info_cliente['motivo2'];
$motivo3                    = $info_cliente['motivo3'];
$motivo4                    = $info_cliente['motivo4'];
$motivo5                    = $info_cliente['motivo5'];
$motivo6                    = $info_cliente['motivo6'];
$motivo7                    = $info_cliente['motivo7'];
$motivo8                    = $info_cliente['motivo8'];
$motivo9                    = $info_cliente['motivo9'];
$motivo10                   = $info_cliente['motivo10'];
$motivo11                   = $info_cliente['motivo11'];
$motivo12                   = $info_cliente['motivo12'];
$motivo13                   = $info_cliente['motivo13'];
$motivo14                   = $info_cliente['motivo14'];
$motivo15                   = $info_cliente['motivo15'];

if ($total_motivo==1) { 
$motivos = 'motivo='.$motivo; 
$motivos_txt = $motivo; 
}
elseif ($total_motivo==2) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2;
$motivos_txt = $motivo.' | '.$motivo2; 
}
elseif ($total_motivo==3) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3;
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3;
}
elseif ($total_motivo==4) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4;
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4;
}
elseif ($total_motivo==5) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5;
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5;
}
elseif ($total_motivo==6) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6;
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6;
}
elseif ($total_motivo==7) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7;
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7;
}
elseif ($total_motivo==8) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8;
}
elseif ($total_motivo==9) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9;
}
elseif ($total_motivo==10) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10;
}
elseif ($total_motivo==11) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11;
}
elseif ($total_motivo==12) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12;
}
elseif ($total_motivo==13) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13;
}
elseif ($total_motivo==14) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13.'&'.'motivo14='.$motivo14; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13.' | '.$motivo14;
}
elseif ($total_motivo==15) { 
$motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13.'&'.'motivo14='.$motivo14.'&'.'motivo15='.$motivo15; 
$motivos_txt = $motivo.' | '.$motivo2.' | '.$motivo3.' | '.$motivo4.' | '.$motivo5.' | '.$motivo6.' | '.$motivo7.' | '.$motivo8.' | '.$motivo9.' | '.$motivo10.' | '.$motivo11.' | '.$motivo12.' | '.$motivo13.' | '.$motivo14.' | '.$motivo15;
}
else { $motivos = ''; }
$fecha_ymdhis               = $info_cliente['fecha_ymdhis'];
$cuenta                     = $info_cliente['cuenta'];
$cod_estado_factura         = $info_cliente['cod_estado_factura'];
$descuento_ptj              = $info_cliente['descuento_ptj'];
$iva_ptj                    = $info_cliente['iva_ptj'];
$flete_ptj                  = $info_cliente['flete_ptj'];
$cod_cliente                = $info_cliente['cod_cliente'];
$nombre_tipo_producto       = $info_cliente['nombre_tipo_producto'];
$cod_administrador          = $info_cliente['cod_administrador'];
$frag_fecha                 = explode(' ', $fecha_ymdhis);
$fecha_reg                  = $frag_fecha[0];
?>
<tr>
<!--<td style="text-align:center"><?php echo $cod_factura?></td>-->
<td style="text-align:center"><?php echo $cod_factura ?></td>
<td style="text-align:left"><?php echo $nombre_empresa ?></td>
<td style="text-align:left"><?php echo $motivos_txt ?></td>
<td style="text-align:center"><?php echo $fecha_ini ?></td>
<td style="text-align:center"><?php echo $fecha_fin ?></td>
<td style="text-align:center"><?php echo $nombre_tipo_producto ?></td>
<th style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_reg ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_factura=<?php echo $cod_factura ?>&nombre_empresa=<?php echo $nombre_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $motivos ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid"></a></th>
<td style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_reg?>&origen=<?php echo $origen ?>&destino=FACTURA&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>A&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_factura=<?php echo $cod_factura ?>&nombre_empresa=<?php echo $nombre_empresa ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $motivos ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura_peq.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_reg?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&cod_factura=<?php echo $cod_factura ?>&nombre_empresa=<?php echo $nombre_empresa ?>&total_motivo=<?php echo $total_motivo ?>&<?php echo $motivos ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php } ?>
</tbody>
</table>
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