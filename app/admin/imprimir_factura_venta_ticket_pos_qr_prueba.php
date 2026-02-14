<?php 
require_once('../conexiones/conexione.php'); 

require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\CapabilityProfiles\EposTepCapabilityProfile;
/* 	Este ejemplo imprime un Ticket de venta desde una impresora térmica */
/* Aquí, en lugar de "POS" (que es el nombre de mi impresora) 	escribe el nombre de la tuya. Recuerda que debes compartirla 	desde el panel de control */

$nombre_maquina                   = 'LENOVO-PC';
$nombre_impresora                 = 'THERMAL Receipt Printer';

$connector = new WindowsPrintConnector("smb://".$nombre_maquina."/".$nombre_impresora);
$printer = new Printer($connector);

$url_qr = "www.editaxe.xyz/experienciacompra";    

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Califica tu experiencia de compra en:\n");
$printer -> text("www.editaxe.xyz/experienciacompra\n");
$printer -> qrCode($url_qr, Printer::QR_ECLEVEL_L, 5);
$printer -> text("ESCANEAME\n");

$printer -> feed();
// Cut & close
$printer -> cut();
$printer -> close();
 