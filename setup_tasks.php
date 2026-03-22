<?php
include("app/conexiones/conexione_sesion.php");
$sql = "CREATE TABLE IF NOT EXISTS `tbl15_tarea` (
  `cod_tarea` int(9) NOT NULL AUTO_INCREMENT,
  `nombre_tarea` varchar(100) NOT NULL,
  `descripcion_tarea` varchar(200) NOT NULL,
  `nombre_estado_tarea` enum('BACKLOG','POR HACER','EN PROGRESO','EN REVISION','TERMINADO') NOT NULL DEFAULT 'POR HACER',
  `nombre_tipo_tarea` enum('HISTORIA DE USUARIO','TAREA','BUG','EPICA') NOT NULL DEFAULT 'TAREA',
  `nombre_prioridad_tarea` enum('BAJA','MEDIA','ALTA','CRITICA') NOT NULL DEFAULT 'BAJA',
  `nombre_tipo_asignacion_tarea` enum('PROPIA','EXTERNO') NOT NULL DEFAULT 'PROPIA',
  `cod_estado_tarea` int(1) NOT NULL,
  `cod_tipo_tarea` int(1) NOT NULL,
  `cod_prioridad_tarea` int(1) NOT NULL,
  `cod_administrador_asignado` int(9) NOT NULL,
  `cod_administrador_creador` int(9) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cod_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`cod_tarea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

if (mysqli_query($conectar, $sql)) {
    echo "Table updated successfully";
} else {
    echo "Error: " . mysqli_error($conectar);
}
?>
