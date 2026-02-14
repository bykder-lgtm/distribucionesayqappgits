<?php
$plazo      = 12;
$mes        = 0;
$dia        = 28;
                    
 for ($contador=1; $contador < $plazo ; $contador++) { 

    if ($dia == 31 || $dia == 30 || $dia==29 || $dia==28  ) {

             echo date("Y-m-d", strtotime("last day of +".$mes." month")); 
             echo "<br>";
   }
   else
   {
             echo date("Y-m-d", strtotime("+".$mes." month")); 
             echo "<br>";
   }
$mes++;
}
?>