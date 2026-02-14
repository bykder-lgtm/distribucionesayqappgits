<?php
$obtener_medicamento_formulado = "SELECT * FROM tbl15_medicamento_formulado WHERE cod_manipulacion_alimento = '".($cod_manipulacion_alimento)."'";
$consultar_medicamento_formulado = mysqli_query($conectar, $obtener_medicamento_formulado) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_medicamento_formulado);

$coluna_anidad = 3 + $total_datos;
?>
<div id="resultado">
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" rowspan="<?php echo $coluna_anidad ?>">5.4 </td>
    <td style="text-align:center" rowspan="<?php echo $coluna_anidad ?>">Medicamentos formulados: </td>
    <td style="text-align:center" rowspan="2">Nombre genérico</td>
    <td style="text-align:center" rowspan="2">Concentración</td>
    <td style="text-align:center" rowspan="2">Forma farmacéutica</td>
    <td style="text-align:center" rowspan="2">Dosis/vía de administración</td>
    <td style="text-align:center" colspan="2">Cantidad prescrita</td>
  </tr>
  <tr>
    <td>En Números</td>
    <td>En letras</td>
  </tr>
<?php while ($info_medicamento_formulado = mysqli_fetch_assoc($consultar_medicamento_formulado)) { 

$cod_medicamento_formulado       = $info_medicamento_formulado['cod_medicamento_formulado'];
$nombre_generico                 = $info_medicamento_formulado['nombre_generico'];
$concentracion                   = $info_medicamento_formulado['concentracion'];
$forma_farmaceutica              = $info_medicamento_formulado['forma_farmaceutica'];
$dosis                           = $info_medicamento_formulado['dosis'];
$cantidad_numero                 = $info_medicamento_formulado['cantidad_numero'];
$cantidad_letra                  = $info_medicamento_formulado['cantidad_letra'];
?>
  <tr>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'nombre_generico', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $nombre_generico;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'concentracion', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $concentracion;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'forma_farmaceutica', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $forma_farmaceutica;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'dosis', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $dosis;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cantidad_numero', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $cantidad_numero;?>"></td>
<td><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cantidad_letra', <?php echo $cod_medicamento_formulado;?>)" class="input-block-level" id="<?php echo $cod_medicamento_formulado;?>" value="<?php echo $cantidad_letra;?>"></td>
  </tr>
<?php } ?>
</table>
</div>