<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/smtp_conf_correo.php');

echo "Host: " . (isset($Host) ? $Host : 'NOT SET') . "\n";
echo "Username: " . (isset($Username) ? $Username : 'NOT SET') . "\n";
echo "Port: " . (isset($Port) ? $Port : 'NOT SET') . "\n";
echo "SMTPSecure: " . (isset($SMTPSecure) ? $SMTPSecure : 'NOT SET') . "\n";

if ($conectar) {
    echo "DB Connected\n";
    $sql = "SELECT count(*) as total FROM tbl15_correo_smtp WHERE (cod_estado_correo_predeterminado = '1' AND cod_estado = '1')";
    $res = mysqli_query($conectar, $sql);
    $row = mysqli_fetch_assoc($res);
    echo "SMTP records found: " . $row['total'] . "\n";
} else {
    echo "DB NOT Connected\n";
}
?>
