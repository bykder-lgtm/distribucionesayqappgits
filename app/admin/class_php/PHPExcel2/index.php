<!DOCTYPE html>
<html>
<head>
	<title>Leer Archivo Excel usando PHP</title>
<link rel="stylesheet" href="../../..//estilo_css/bootstrap.min.css">
<link rel="stylesheet" href="../../..//estilo_css/bootstrap-theme.min.css">
<script src="../../../js/jquery.min.js"></script>
<script src="./../../js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">
            
<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
$nombre_archivo                     = "ListaPersonal.xlsx";
$tipo_De_aRchivo_de_entrada         = PHPExcel_IOFactory::identify($nombre_archivo);
$objReader                          = PHPExcel_IOFactory::createReader($tipo_De_aRchivo_de_entrada);
$objPHPExcel                        = $objReader->load($nombre_archivo);
$hoja_libro                         = $objPHPExcel->getSheet(0); 
$fila_mas_alta                      = $hoja_libro->getHighestRow(); 
$columna_mas_alta                   = $hoja_libro->getHighestColumn();?>

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
$contador=0;
for ($registros_del_archivo = 2; $registros_del_archivo <= $fila_mas_alta; $registros_del_archivo++){ $contador++;?>
       <tr>
          <th scope='row'><?php echo $contador;?></th>
          <td><?php echo $hoja_libro->getCell("A".$registros_del_archivo)->getValue();?></td>
          <td><?php echo $hoja_libro->getCell("B".$registros_del_archivo)->getValue();?></td>
          <td><?php echo $hoja_libro->getCell("C".$registros_del_archivo)->getValue();?></td>
          <td><?php echo $hoja_libro->getCell("D".$registros_del_archivo)->getValue();?></td>
        </tr>
    	
	<?php	
}
?>
          </tbody>
    </table>
  </div>	
 </div>	
</div>
</body>
</html>
