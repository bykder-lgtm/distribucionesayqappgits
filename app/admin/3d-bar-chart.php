<?php $fecha_mes = "09/2018"; ?>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",

dataLoader: { "url": "data_3d-bar-chart_mes_cargo.php?fecha_mes=<?php echo $fecha_mes ?>" },
    "valueAxes": [{
        "title": "Income in millions, USD"
    }],
    "graphs": [{
        "balloonText": "Income in [[category]]:[[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "Income",
        "type": "column",
        "valueField": "conteo_dat_ocupa_carg1"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "dat_ocupa_carg1",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }
});
</script>

<!-- HTML -->
<div id="chartdiv"></div>