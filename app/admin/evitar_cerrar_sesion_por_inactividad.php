<!--
<script type="text/javascript">
    var keep_alive = false;
    $(document).bind("click keydown keyup mousemove", function() {
        keep_alive = true;
    });
    setInterval(function() {
        if ( keep_alive ) {
            pingServer();
            keep_alive = true;
        }
    }, 90000 );
    function pingServer() {
        $.ajax('../admin/evitar_cerrar_sesion_por_inactividad_ajax.php');
    }
</script>
-->