<!--Edit Sidebar Content here-->
<div class="span4 sidebar">

<div class="sidebox">
<!--<h3 class="sidebox-title">Eventos</h3>-->
<h4 class="sidebox-title">Eventos</h4>
<img src="../imagenes/logo_original.png" class="img-polaroid" alt="">
<ul>
<?php
$sql_evento = "SELECT * FROM tbl15_evento ORDER BY fecha_ymd ASC";
$exec_evento = mysqli_query($conectar, $sql_evento) or die(mysqli_error($conectar));

while ($datos_evento = mysqli_fetch_assoc($exec_evento)) {
$cod_evento = $datos_evento['cod_evento'];
$nombre_evento = $datos_evento['nombre_evento'];
$descripcion_evento = $datos_evento['descripcion_evento'];
$url_img = $datos_evento['url_img'];
$fecha_ymd = $datos_evento['fecha_ymd'];
$fecha_hora = $datos_evento['fecha_hora'];
$cod_estado = $datos_evento['cod_estado'];
?>
<li><a href="#"><?php echo $nombre_evento ?></a></li>
<?php } ?>
</ul>					
<!--
<h5>Web Design ( 40% )</h5>
<div class="progress progress-info">
<div class="bar" style="width: 20%"></div>
</div>			          	

<h5>Wordpress ( 80% )</h5>
<div class="progress progress-success">
<div class="bar" style="width: 40%"></div>
</div>				          	

<h5>Branding ( 100% )</h5>
<div class="progress progress-warning">
<div class="bar" style="width: 60%"></div>
</div>				          	

<h5>SEO Optmization ( 60% )</h5>
<div class="progress progress-danger">
<div class="bar" style="width: 80%"></div>
</div>
-->
</div>
</div>
<!--End Sidebar Content here-->