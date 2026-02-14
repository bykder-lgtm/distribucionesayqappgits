<!DOCTYPE html>
<html>
<head>
	<title>Leer Archivo Excel usando PHP</title>
<link rel="stylesheet" href="../estilo_css/bootstrap.min.css">
<link rel="stylesheet" href="../estilo_css/bootstrap-theme.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading"><h3 class="panel-title">Resultados de archivo de Excel.</h3></div>
      <div class="panel-body">
        <div class="col-lg-12">
<?php
require_once '../admin/class_php/PHPExcel/PHPExcel/Classes/PHPExcel.php';
$ruta_nombre_archivo                = "../archivador_office/ListaPersonal.xlsx";
$tipo_De_aRchivo_de_entrada         = PHPExcel_IOFactory::identify($ruta_nombre_archivo);
$objReader                          = PHPExcel_IOFactory::createReader($tipo_De_aRchivo_de_entrada);
$objPHPExcel                        = $objReader->load($ruta_nombre_archivo);
$hoja_libro                         = $objPHPExcel->getSheet(0); 
$fila_mas_alta                      = $hoja_libro->getHighestRow(); 
$columna_mas_alta                   = $hoja_libro->getHighestColumn();
?>
<table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Cargo</th>
          <th>Sede</th>
        </tr>
      </thead>
      <tbody>
<?php
$contador = 0;
for ($registro_fila_de_inicio = 2; $registro_fila_de_inicio <= $fila_mas_alta; $registro_fila_de_inicio++) { 
$contador++;
?>
       <tr>
          <th scope='row'><?php echo $contador;?></th>
          <td><?php echo $hoja_libro->getCell("A".$registro_fila_de_inicio)->getValue(); ?></td>
          <td><?php echo $hoja_libro->getCell("B".$registro_fila_de_inicio)->getValue(); ?></td>
          <td><?php echo $hoja_libro->getCell("C".$registro_fila_de_inicio)->getValue(); ?></td>
          <td><?php echo $hoja_libro->getCell("D".$registro_fila_de_inicio)->getValue(); ?></td>
        </tr>
<?php	} ?>
          </tbody>
    </table>
  </div>	
 </div>	
</div>
</body>
</html>
