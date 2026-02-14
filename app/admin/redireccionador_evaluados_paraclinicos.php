<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');

if (($_GET["origen"]=='EVALUADOS')) {
if (isset($_GET['fecha']) <> '') { $fecha = addslashes($_GET['fecha']); } else { $fecha = ''; }
if (isset($_GET['origen']) <> '') { $origen = addslashes($_GET['origen']); } else { $origen = ''; }
if (isset($_GET['destino']) <> '') { $destino = addslashes($_GET['destino']); } else { $destino = ''; }
if (isset($_GET['cod_info_factura_venta']) <> '') { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_factura']) <> '') { $cod_factura = intval($_GET['cod_factura']); } else { $cod_factura = ''; }
if (isset($_GET['fecha_ini']) <> '') { $fecha_ini = addslashes($_GET['fecha_ini']); } else { $fecha_ini = ''; }
if (isset($_GET['fecha_fin']) <> '') { $fecha_fin = addslashes($_GET['fecha_fin']); } else { $fecha_fin = ''; }
if (isset($_GET['nombre_empresa']) <> '') { $nombre_empresa = addslashes($_GET['nombre_empresa']); } else { $nombre_empresa = ''; }
if (isset($_GET['total_muestra']) <> '') { $total_muestra = intval($_GET['total_muestra']); } else { $total_muestra = ''; }
if (isset($_GET['total_motivo']) <> '') { $total_motivo = intval($_GET['total_motivo']); } else { $total_motivo = ''; }
if (isset($_GET['cuenta']) <> '') { $cuenta = addslashes($_GET['cuenta']); } else { $cuenta = ''; }

$sql_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$data_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$motivo                     = $data_info_factura['motivo'];
$motivo2                    = $data_info_factura['motivo2'];
$motivo3                    = $data_info_factura['motivo3'];
$motivo4                    = $data_info_factura['motivo4'];
$motivo5                    = $data_info_factura['motivo5'];
$motivo6                    = $data_info_factura['motivo6'];
$motivo7                    = $data_info_factura['motivo7'];
$motivo8                    = $data_info_factura['motivo8'];
$motivo9                    = $data_info_factura['motivo9'];
$motivo10                   = $data_info_factura['motivo10'];
$motivo11                   = $data_info_factura['motivo11'];
$motivo12                   = $data_info_factura['motivo12'];
$motivo13                   = $data_info_factura['motivo13'];
$motivo14                   = $data_info_factura['motivo14'];
$motivo15                   = $data_info_factura['motivo15'];

if ($total_motivo==1) { $motivos = 'motivo='.$motivo; }
elseif ($total_motivo==2) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2; }
elseif ($total_motivo==3) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3; }
elseif ($total_motivo==4) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4; }
elseif ($total_motivo==5) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5; }
elseif ($total_motivo==6) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6; }
elseif ($total_motivo==7) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7; }
elseif ($total_motivo==8) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8; }
elseif ($total_motivo==9) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9; }
elseif ($total_motivo==10) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10; }
elseif ($total_motivo==11) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11; }
elseif ($total_motivo==12) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12; }
elseif ($total_motivo==13) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13; }
elseif ($total_motivo==14) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13.'&'.'motivo14='.$motivo14; }
elseif ($total_motivo==15) { $motivos = 'motivo='.$motivo.'&'.'motivo2='.$motivo2.'&'.'motivo3='.$motivo3.'&'.'motivo4='.$motivo4.'&'.'motivo5='.$motivo5.'&'.'motivo6='.$motivo6.'&'.'motivo7='.$motivo7.'&'.'motivo8='.$motivo8.'&'.'motivo9='.$motivo9.'&'.'motivo10='.$motivo10.'&'.'motivo11='.$motivo11.'&'.'motivo12='.$motivo12.'&'.'motivo13='.$motivo13.'&'.'motivo14='.$motivo14.'&'.'motivo15='.$motivo15; }
$url_redirect = "fecha=".$fecha."&origen=".$origen."&destino=".$destino."&cod_info_factura_venta=".$cod_info_factura_venta."&cod_factura=".$cod_factura."&fecha_ini=".$fecha_ini."&fecha_fin=".$fecha_fin."&nombre_empresa=".$nombre_empresa."&total_muestra=".$total_muestra."&total_motivo=".$total_motivo."&".$motivos."&cuenta=".$cuenta;

if ($destino=='EXCEL') { header("Location: ver_lista_por_empresa_fecharango_motivo_version_xlsx.php?".$url_redirect); }
if ($destino=='FACTURA') { header("Location: ver_facturacion_por_empresa_fecharango_motivo_opcion_solo_ver_version_pdf.php?".$url_redirect); }
if ($destino=='LISTA') { header("Location: ver_lista_por_empresa_fecharango_motivo_version_pdf.php?".$url_redirect); }
}
//**************************************************************************************************************//
//**************************************************************************************************************//
//**************************************************************************************************************//
if (($_GET["origen"]=='PARACLINICOS')) {
if (isset($_GET['fecha']) <> '') { $fecha = addslashes($_GET['fecha']); } else { $fecha = ''; }
if (isset($_GET['origen']) <> '') { $origen = addslashes($_GET['origen']); } else { $origen = ''; }
if (isset($_GET['destino']) <> '') { $destino = addslashes($_GET['destino']); } else { $destino = ''; }
if (isset($_GET['cod_info_factura_venta']) <> '') { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_factura']) <> '') { $cod_factura = intval($_GET['cod_factura']); } else { $cod_factura = ''; }
$url_redirect = "fecha=".$fecha."&origen=".$origen."&destino=".$destino."&cod_info_factura_venta=".$cod_info_factura_venta."&cod_factura=".$cod_factura;

if ($destino=='EXCEL') { header("Location: ver_lista_info_factura_venta_version_excel.php?".$url_redirect); }
if ($destino=='FACTURA') { header("Location: ver_factura_venta_pdf.php?".$url_redirect); }
if ($destino=='LISTA') { header("Location: ver_lista_medicamento_laboratorio_version_pdf.php?".$url_redirect); }
}
?>