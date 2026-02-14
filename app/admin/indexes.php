<?php
$pagina_complt            = $_SERVER['PHP_SELF'];
$fragm                    = explode("/", $pagina_complt);
$ultimo                   = end($fragm);
$total_elementos          = count($fragm) - 1;

$concatenador             = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }

$pagina = "localhost/".$concatenador."lista_paciente.php";

echo $pagina;
?>