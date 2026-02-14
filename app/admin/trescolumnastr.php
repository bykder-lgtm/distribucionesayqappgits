<?php
$datos = ['Dato 1', 'Dato 2', 'Dato 3', 'Dato 4', 'Dato 5', 'Dato 6', 'Dato 7', 'Dato 8', 'Dato 9'];
$columnas_por_fila = 3;
$total_sticker = count($datos);

echo "<table>";
echo "<tr>"; // Inicia la primera fila

for ($contador_triple = 0; $contador_triple < $total_sticker; $contador_triple++) {
    // Imprime la celda actual
    echo "<td>" . $datos[$contador_triple] . "</td>";

    // Si es la última celda de la fila, o si es la última celda de todos los datos
    if (($contador_triple + 1) % $columnas_por_fila == 0) {
        echo "</tr>"; // Cierra la fila actual
        // Abre una nueva fila, pero solo si no es la última iteración
        if ($contador_triple < $total_sticker - 1) {
            echo "<tr>";
        }
    }
}
echo "</table>";
?>