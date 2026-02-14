<?php
$cod_estado_cie10 = 1;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>www.desarrollohidrocalido.com - Diego Lira</title>

<link href="../estilo_css/bootstrap.min.css" rel="stylesheet">
<link href="../estilo_css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="../estilo_css/main_DarkSlateBlue.css" rel="stylesheet" type="text/css" />

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success openBtn">Open Modal</button>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Modal with Dynamic Content</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script>
$('.openBtn').on('click',function(){
    $('.modal-body').load('ventana_modal3_ajax.php?id=2',function(){
        $('#myModal').modal({show:true});
    });
});
</script>