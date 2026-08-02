<?php
/**
 * dayq_helpers.php - Funciones helper de uso general para el módulo administrativo
 *
 * Funcionalidades:
 * - Escape seguro de strings para MySQL (dayq_e)
 * - Captura segura de variables POST (dayq_post)
 * - Captura segura de variables GET como entero (dayq_get_int)
 * - Captura segura de variables GET como string (dayq_get_str)
 *
 * @see changelog/CAMBIOS_20260724.md
 */

function dayq_e(mysqli $con, $s) {
	return mysqli_real_escape_string($con, (string) $s);
}

function dayq_post($key, $default = '') {
	return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
}

function dayq_get_int($key, $default = 0) {
	return isset($_GET[$key]) ? (int) $_GET[$key] : $default;
}

function dayq_get_str($key, $default = '') {
	return isset($_GET[$key]) ? trim((string) $_GET[$key]) : $default;
}
