<?php
//<div class="table-responsive">
//<table class="table table-bordered" style="font-family:mono; font-size:12pt">
//<tr><td style="text-align:left"><strong>4. RECOMENDACIONES </strong></td></tr>
//<tr><td style="text-align:left"><strong>4.1. RECOMENDACIONES GENERALES</strong></td></tr>
//<tr><td style="text-align:left">El área o las personas asignadas a la gestión de salud y tbl15_seguridaden el trabajo deben promover y facilitar la generación de entornos de trabajo saludables, mediante estrategias dirigidas a las condiciones específicas de la tbl15_empresa, según su distribución por tbl15_sexo, grupos etarios, tbl15_escolaridad, área de residencia y demás indicadores sociodemográficos.
//La promoción del autocuidado de la salud es costo-efectiva. La población trabajadora debe tener una creciente conciencia sobre la necesidad de proteger su salud , modificar los hábitos de vida no saludables como el consumo de cigarrillo y el sedentarismo y participar activamente en el control de riesgos ocupacionales, con mecanismos como el auto reporte de condiciones inseguras en àreas de trabajo, el uso permanente de elementos de protección personal durante la exposición, las prácticas seguras y la formalización de  procedimientos seguros en el trabajo diario. 
//</td></tr>
//</table>
//</div>

$cadena1 = '
<div class="table-responsive">
<table class="table table-bordered" style="font-family:mono; font-size:12pt">
<tr><td style="text-align:left"><strong>4. RECOMENDACIONES </strong></td></tr>
<tr><td style="text-align:left"><strong>4.1. RECOMENDACIONES GENERALES</strong></td></tr>
<tr><td style="text-align:left">El área o las personas asignadas a la gestión de salud y tbl15_seguridaden el trabajo deben promover y facilitar la generación de entornos de trabajo saludables, mediante estrategias dirigidas a las condiciones específicas de la tbl15_empresa, según su distribución por tbl15_sexo, grupos etarios, tbl15_escolaridad, área de residencia y demás indicadores sociodemográficos.
La promoción del autocuidado de la salud es costo-efectiva. La población trabajadora debe tener una creciente conciencia sobre la necesidad de proteger su salud , modificar los hábitos de vida no saludables como el consumo de cigarrillo y el sedentarismo y participar activamente en el control de riesgos ocupacionales, con mecanismos como el auto reporte de condiciones inseguras en àreas de trabajo, el uso permanente de elementos de protección personal durante la exposición, las prácticas seguras y la formalización de  procedimientos seguros en el trabajo diario. 
</td></tr>
</table>
</div>
';
echo $cadena1;

$resultado1 = str_replace('<div class="table-responsive">', "", $cadena1);
echo "<br><br>resultado1: " . $resultado1;

$cadena2 = $resultado1;

$resultado2 = str_replace('<table class="table table-bordered" style="font-family:mono; font-size:12pt">', "", $cadena2);
echo "<br><br>resultado2: " . $resultado2;

$cadena3 = $resultado2;

$resultado3 = str_replace('<tr><td style="text-align:left"><strong>4. RECOMENDACIONES </strong></td></tr>', "", $cadena3);
echo "<br><br>resultado3: " . $resultado3;

$cadena4 = $resultado3;

$resultado4 = str_replace('<tr><td style="text-align:left"><strong>4.1. RECOMENDACIONES GENERALES</strong></td></tr>', "", $cadena4);
echo "<br><br>resultado4: " . $resultado4;

$cadena5 = $resultado4;

$resultado5 = str_replace('<<tr><td style="text-align:left">', "", $cadena5);
echo "<br><br>resultado5: " . $resultado5;

$cadena6 = $resultado5;

$resultado6 = str_replace('</td></tr>', "", $cadena6);
echo "<br><br>resultado6: " . $resultado6;

$cadena7 = $resultado6;

$resultado7 = str_replace('</table>', "", $cadena7);
echo "<br><br>resultado7: " . $resultado7;

$cadena8 = $resultado7;

$resultado8 = str_replace('</div>', "", $cadena8);
echo "<br><br>resultado8: " . $resultado8;
?>