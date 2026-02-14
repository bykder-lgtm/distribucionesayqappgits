<script language="JavaScript" type="text/javascript">

    window.onunload = function(){
        $.ajax({
            type: "POST",
            url: "../admin/copia_seguridad_automatica_cierre_de_pestana_o_navegador.php",
            dataType:"json",
            data: {},
            async : false,
            success : function(){
            }
        });
    }
</script>