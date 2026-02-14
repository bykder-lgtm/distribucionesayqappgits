<?php
require_once 'class_php/class.textPainter.php';

$posicion_x         = 85;
$posicion_y         = 53;

$R                  = 0;
$G                  = 0;
$B                  = 0;
$tamano_letra       = 33;

$tel1 = $_GET["tel1"];

$img = new textPainter('../imagenes/btn_tel_telefono_dinamic.jpg', $tel1, '../fonts/Docker_One.ttf', $tamano_letra);

if(!empty($posicion_x) && !empty($posicion_y)){
    $img->setPosition($posicion_x, $posicion_y);
}

if(!empty($R) && !empty($G) && !empty($B)){
    $img->setTextColor($R,$G,$B);
}

$img->show();
?>
