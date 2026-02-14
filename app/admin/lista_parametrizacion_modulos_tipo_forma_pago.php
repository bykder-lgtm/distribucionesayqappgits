<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
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
<a href="#"><h4>Parametrización plan unico de cuentas (PUC)</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php $pagina = $_SERVER['PHP_SELF']; ?>

    <table class="table table-striped">
<?php
$sql_modulo_puc = "SELECT * FROM tbl15_modulo_puc WHERE (cod_estado = '1') ORDER BY cod_modulo_puc ASC";
$resultado_modulo_puc = mysqli_query($conectar, $sql_modulo_puc);
while ($info_modulo_puc = mysqli_fetch_assoc($resultado_modulo_puc)) {
                
    $cod_modulo_puc                             = $info_modulo_puc['cod_modulo_puc'];
    $nombre_modulo_puc                          = $info_modulo_puc['nombre_modulo_puc'];
    $descipcion_modulo_puc                      = $info_modulo_puc['descipcion_modulo_puc'];
?>
		<tr>
			<th style="text-align:left; background-color:#DBE0F3; color:#000;"><?php echo $nombre_modulo_puc ?></th>
		</tr>
    <?php
    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1')";
    $resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago);
    while ($info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago)) {
                    
        $cod_tipo_forma_pago                        = $info_tipo_forma_pago['cod_tipo_forma_pago'];
        $nombre_tipo_forma_pago                     = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
        $nombre_puc_concat                          = '';

        $sql_parametrizacion_puc_movimiento_contable = "SELECT * FROM tbl15_parametrizacion_puc_movimiento_contable WHERE (nombre_modulo_puc = '$nombre_modulo_puc' AND cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $resultado_parametrizacion_puc_movimiento_contable = mysqli_query($conectar, $sql_parametrizacion_puc_movimiento_contable);
        $total_reg = mysqli_num_rows($resultado_parametrizacion_puc_movimiento_contable);
        while ($info_parametrizacion_puc_movimiento_contable = mysqli_fetch_assoc($resultado_parametrizacion_puc_movimiento_contable)) {

            $codigo_puc                        = $info_parametrizacion_puc_movimiento_contable['codigo_puc'];
            $nombre_puc                        = $info_parametrizacion_puc_movimiento_contable['nombre_puc'];
            $nombre_puc_concat                 = $nombre_puc_concat.' | '.$nombre_puc.' - '.$codigo_puc;
        }
    ?>
        <tr>
            <th style="text-align:left;"><a href="../admin/reg_parametrizacion_puc_movimiento_contable.php?nombre_modulo_puc=<?php echo $nombre_modulo_puc?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&pagina=<?php echo $pagina ?>"><?php echo $nombre_tipo_forma_pago ?></a> | <?php echo $nombre_puc_concat ?></th>
        </tr>
    <?php } ?>

<?php } ?>
    </table>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script language="javascript">
$(document).ready(function(){
    $('select[name="cod_estado"]').change(function(){  
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_puc";
        var id = $(this).attr("id");
        var foco = '';

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_puc_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('select[name="nombre_modulo_puc"]').change(function(){  
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_puc";
        var id = $(this).attr("id");
        var foco = '';

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_puc_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>