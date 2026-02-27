<?php
include_once('../conexiones/conexione.php');

$check = mysqli_query($conectar, "SHOW COLUMNS FROM tbl15_administrador LIKE 'cod_estado_usuario_prueba'");
if (mysqli_num_rows($check) == 0) {
    if (mysqli_query($conectar, "ALTER TABLE tbl15_administrador ADD COLUMN cod_estado_usuario_prueba INT(1) DEFAULT 0 AFTER cod_estado_activacion_usuario")) {
        echo "Columna cod_estado_usuario_prueba agregada correctamente.";
    } else {
        echo "Error al agregar columna: " . mysqli_error($conectar);
    }
} else {
    echo "La columna ya existe.";
}
?>
