<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Estadistico Ingresos y Egresos Por Mes</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
require_once("menu_estadisticas.php");
include ("menu_grafico_ventas.php");
?>
<style type="text/css">
/* #container_grafico_estadistico { height: 400px; min-width: 10%; max-width: 100%; margin: 0 auto; } */
</style>

<script type="text/javascript">
$(function () {
    $('#container_grafico_estadistico').highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'INGRESOS Y EGRESOS POR MES'
        },
        subtitle: {
            text: '<?php echo $nombre_emp ?>'
        },
        xAxis: [{
            categories: [
<?php
$mostrar_datos_sql = "SELECT fecha_mes FROM tbl15_movimiento_contable_cuenta_personal_concepto GROUP BY fecha_mes ORDER BY fecha_anyo ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) { 
?>
    '<?php echo $datos["fecha_mes"] ?>',
<?php
}
?>
            ],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Egresos',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Ingresos',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'TOTAL INGRESO',
            type: 'column',
            yAxis: 1,
            data: [
<?php
$mostrar_datos_sql = "SELECT SUM(costo_movimiento_contable) AS total_ingreso FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (tipo_puc = 'INGRESOS') GROUP BY fecha_mes ORDER BY fecha_anyo ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) { 

    $total_ingreso = intval($datos["total_ingreso"]);
?>
    <?php echo $total_ingreso ?>,
<?php
}
?>
            ],
            tooltip: {
                valueSuffix: ''
            }

        }, {
            name: 'TOTAL EGRESO',
            type: 'spline',
            yAxis: 1,
            data: [
<?php
$mostrar_datos_sql = "SELECT SUM(costo_movimiento_contable) AS total_egreso FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (tipo_puc = 'EGRESOS') GROUP BY fecha_mes ORDER BY fecha_anyo ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) { 

    $total_egreso = intval($datos["total_egreso"]);
?>
    <?php echo $total_egreso ?>,
<?php
}
?>
            ],
            tooltip: {
                valueSuffix: ''
            }
        }]
    });
});
</script>
	</head>
	<body>
<script src="../js/highcharts/highcharts_viejo.js"></script>
<script src="../js/highcharts/exporting_viejo.js"></script>
<div id="container_grafico_estadistico" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>