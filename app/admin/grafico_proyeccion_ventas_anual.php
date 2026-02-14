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
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6></h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
include_once("menu_estadisticas.php");
include ("menu_grafico_extras.php");

$nombre = 'Empresa';
?>
<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}   
</style>
<!-- Resources -->
<script src="../js/amcharts_graf/amcharts.js" type="text/javascript"></script>
<script src="../js/amcharts_graf/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/amcharts_graf/dataloader.min.js"></script>

<script src="../js/amcharts_graf/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="../js/amcharts_graf/plugins/export/export.css" type="text/css" media="all" />
<script src="../js/amcharts_graf/themes/black.js"></script>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "titles": [ {
    "text": "Proyeccion de Venta",
    "color": "#000",
    "size": 16
  },
{
    "text": "<?php echo $nombre ?>",
    "color": "#000"
    //"url": "http://yahoo.com"
  }
  ],
  "addClassNames": true,
  "theme": "dark",
  "autoMargins": false,
  "marginLeft": 30,
  "marginRight": 8,
  "marginTop": 10,
  "marginBottom": 26,
  "balloon": {
    "adjustBorderColor": false,
    "horizontalPadding": 10,
    "verticalPadding": 8,
    "color": "#ffffff"
  },
dataLoader: { "url": "datos_proyeccion_ventas_anual_json.php" },
  "valueAxes": [ {
    "axisAlpha": 0,
    "position": "left"
  } ],
  "startDuration": 1,
  "graphs": [ {
    "alphaField": "transparencia",
    "balloonText": "<span style='font-size:12px;'>[[title]] En [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[adiccional]]</span>",
    "fillAlphas": 1,
    "title": "Total Venta",
    "type": "column",
    "valueField": "total_venta_producto",
    "dashLengthField": "longitud_linea"
  }, {
    "id": "graph2",
    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[adiccional]]</span>",
    "bullet": "round",
    "lineThickness": 3,
    "bulletSize": 7,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
    "title": "Total Compra",
    "valueField": "promed_venta",
    "dashLengthField": "longitud_linea"
  } ],
  "categoryField": "anyo",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }
} );
</script>

<!-- HTML -->
<div id="chartdiv"></div>

</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>