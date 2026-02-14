<link href="../estilo_css/bootstrap.min.css" rel="stylesheet">
<link href="../estilo_css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="../estilo_css/main_DarkSlateBlue.css" rel="stylesheet" type="text/css" />

<a href="#" class="btn-link openBtn" data-toggle="modal" data-target="#listado_cie10_modal">Listado Cie - 10</a>
<!-- Modal -->
<div class="modal fade" id="ventana_modal_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Listado Cie - 10</h4>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$('.openBtn').on('click',function(){
$('.modal-body').load('cie10_ventana_modal_buscador.php?id=2',function(){
$('#ventana_modal_id').modal({show:true});
});
});
</script>

<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>