<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">Empresa Contratante</th>
<th bgcolor="#FAC090">Empresa a Laborar</th>
<th bgcolor="#FAC090">Actividad Economica de la Empresa</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center"><select name="nombre_empresa_contratante" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa_contratante)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa_contratante, nombre_empresa_contratante FROM tbl15_empresa_contratante ORDER BY nombre_empresa_contratante ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa_contratante) and $nombre_empresa_contratante == $datos2['nombre_empresa_contratante']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa_contratante'];
$nombre = $datos2['nombre_empresa_contratante'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td style="text-align:center"><select id="nombre_empresa" name="nombre_empresa" class="selectpicker" onChange="conocer_empresa_laborar();" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td style="text-align:center"><select name="nombre_actividad_ecoemp" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_actividad_ecoemp)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_actividad_ecoemp, nombre_actividad_ecoemp FROM tbl15_actividad_ecoemp ORDER BY nombre_actividad_ecoemp ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_actividad_ecoemp) and $nombre_actividad_ecoemp == $datos2['nombre_actividad_ecoemp']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_actividad_ecoemp'];
$nombre = $datos2['nombre_actividad_ecoemp'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>
</tr></tbody>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">Cargo</th>
<th bgcolor="#FAC090">Area a Laborar</th>
<th bgcolor="#FAC090">Ciudad</th>
</tr></thead>
<tbody><tr>
<!--<td align="center"><?php echo $cargo_empresa ?></td>-->
<td style="text-align:center">GRUPO<select name="cod_grupo_area" id="tbl15_grupo_area" class="form-control" required>
 <?php if (isset($cod_grupo_area)) { echo "<option value='0' >Selecione</option>";
 } else { echo  "<option value='0' selected >Seleccione</option>"; }
 $consulta2_sql = ("SELECT cod_grupo_area, nombre_grupo_area FROM tbl15_grupo_area ORDER BY nombre_grupo_area ASC");
 $consulta2 = mysqli_query($conectar, $consulta2_sql);
 while ($datos2 = mysqli_fetch_assoc($consulta2)) {
 if(isset($cod_grupo_area) AND $cod_grupo_area == $datos2['cod_grupo_area']) {
 $seleccionado = "selected"; } else { $seleccionado = ""; }
 $codigo = $datos2['cod_grupo_area'];
 $nombre = $datos2['nombre_grupo_area'];
 echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
 </select>
CARGO<select name="cod_grupo_area_cargo" id="tbl15_grupo_area_cargo" class="form-control" onChange="conocer_cargo();">
 <?php if (isset($cod_grupo_area_cargo)) { echo "<option value='0' >Selecione</option>";
 } else { echo  "<option value='0' selected >Seleccione</option>"; }
 $consulta2_sql = ("SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area.nombre_grupo, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, 
 tbl15_grupo_area_cargo.cod_grupo_area_cargo, tbl15_grupo_area.cod_grupo_area 
 FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area
WHERE (((tbl15_grupo_area.cod_grupo_area)='$cod_grupo_area')) ORDER BY nombre_grupo_area_cargo ASC");
 $consulta2 = mysqli_query($conectar, $consulta2_sql);
 while ($datos2 = mysqli_fetch_assoc($consulta2)) {
 if(isset($cod_grupo_area_cargo) AND ($cod_grupo_area_cargo == $datos2['cod_grupo_area_cargo']) AND ($cod_grupo_area == $datos2['cod_grupo_area'])) {
 $seleccionado = "selected"; } else { $seleccionado = ""; }
 $codigo = $datos2['cod_grupo_area_cargo'];
 $nombre = $datos2['nombre_grupo_area_cargo'];
 $nombre2 = $datos2['nombre_grupo_area'];
 echo "<option value='".$codigo."' $seleccionado >".$nombre.' - '.$nombre2."</option>"; } ?>
 </select>
</td>
<td><input style="text-align:center" class="input-block-level" name="area_empresa" type="text" value="<?php echo $area_empresa ?>"/></td>
<td><input style="text-align:center" class="input-block-level" name="ciudad_empresa" type="text" value="<?php echo $ciudad_empresa ?>"/></td>
</tr></tbody>
</table>
<script>
function conocer_cargo(){
tbl15_grupo_area_cargo = document.getElementById("tbl15_grupo_area_cargo").value;
document.getElementById("dat_ocupa_carg1").value = tbl15_grupo_area_cargo;
}
function conocer_empresa_laborar(){
nombre_empresa = document.getElementById("nombre_empresa").value;
document.getElementById("dat_ocupa_emp1").value = nombre_empresa;
}
</script>