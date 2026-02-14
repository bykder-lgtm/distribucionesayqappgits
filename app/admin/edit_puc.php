<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
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
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_puc';
$tipo                        = 'eliminar';
$campo                       = 'cod_puc';
//$fecha_dmy                   = date("Y-m-d");
$origen                      = 'PARACLINICOS';

if (isset($_GET['cod_puc'])) {
    $cod_puc                          = intval($_GET['cod_puc']);

    $sql_info_factura = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    $info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

    $codigo_puc                          = $info_info_factura['codigo_puc'];
    $nombre_puc                          = $info_info_factura['nombre_puc'];
    $tipo_puc                            = $info_info_factura['tipo_puc'];
    $saldo_inicial_puc                   = $info_info_factura['saldo_inicial_puc'];
    $subtotal_puc                        = $info_info_factura['subtotal_puc'];
    $saldo_actual_puc                    = $info_info_factura['saldo_actual_puc'];
    $cod_estado                          = $info_info_factura['cod_estado'];
?>
    <table class="table table-striped">
        <tr>
            <th style="text-align:left"><a href="../admin/lista_puc.php"><font size='+2'>EDITAR PUC</font></a></th>
        </tr>
    </table>

    <div class="table-responsive">
    <form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_puc_reg.php">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center">CODIGO PUC</th>
                <th style="text-align:center">CUENTA PUC</th>
                <th style="text-align:center">TIPO</th>
                <th style="text-align:center">SALDO INICIAL</th>
                <th style="text-align:center">SALDO ACTUAL</th>
                <th style="text-align:center">ESTADO</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="codigo_puc" type="text" value="<?php echo $codigo_puc ?>" /></td>
            <td style="text-align:center"><input class="input-block-level" name="nombre_puc" type="text" value="<?php echo $nombre_puc ?>" /></td>
            <td style="text-align:center"><input class="input-block-level" name="tipo_puc" type="text" value="<?php echo $tipo_puc ?>" /></td>
            <td style="text-align:center"><input class="input-block-level" name="saldo_inicial_puc" type="text" value="<?php echo $saldo_inicial_puc ?>" /></td>
            <td style="text-align:center"><input class="input-block-level" name="saldo_actual_puc" type="text" value="<?php echo $saldo_actual_puc ?>" /></td>

            <td style="text-align:center">
                <select name="cod_estado" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($cod_estado)) { echo ""; } else { echo  ""; }
                $consulta2_sql = ("SELECT * FROM tbl15_estado ORDER BY cod_estado DESC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_estado'];
                $nombre = $datos2['nombre_estado'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            </td>
        </tr>
    </tbody>
    </table>

    <hr>
    <input type="hidden" name="cod_puc" value="<?php echo $cod_puc ?>">
    <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
    <input type="hidden" name="insersion" value="formulario_de_insersion">
    <div class="actions">
    <input type="submit" value="Editar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
    </div>

    </form>
    </div>
<?php } ?>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>