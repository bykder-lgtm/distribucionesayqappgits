<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php
$pagina                         = $_SERVER['PHP_SELF'];
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'nombre1_tercero'; }
?>
<script type="text/javascript">
function hacer_busqueda() {
    var xmlhttp;

    var valor_buscar = document.getElementById('busqueda').value;
    var pagina = "<?php echo $pagina?>";
    var nombre_tipo_moneda = "COP";
    var nombre_tipo_factura = "POS";
    var cod_estado_vacuna = "0";
    var tipo_busqueda = "parcial";
    var buscar_por = $("#buscar_por").val();
    var cuenta = "";
    var cod_caja_virtual = "";
    var cod_info_factura_venta = "";
    var modo_venta_por_defecto = "";

    if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
    }
    xmlhttp.open("POST","../admin/busqueda_info_factura_compra_nota_debito_ajax.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&cod_info_factura_venta="+cod_info_factura_venta+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&modo_venta_por_defecto="+modo_venta_por_defecto+"&pagina="+pagina);
}
</script>
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
<!--<a class="btn btn-primary" href="../imagenes/tabla_comprativa_causacion_puc_movimiento_contable.jpg" target="_blank"><h6>Lista de Movimientos Contables</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><font size='+1'><a href="../admin/lista_info_nota_debito.php">Buscar Factura Para Nota Debito (Devolución Factura Compra)</a></font></th>
    </tr>
</table>

<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->              
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '2') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
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

<script>
$(document).ready(function(){
    load(1);
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var tabla = $("#tabla").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/busqueda_info_factura_compra_nota_debito_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&tabla='+tabla,
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>