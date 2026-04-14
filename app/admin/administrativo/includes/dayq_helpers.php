<?php

function dayq_e(mysqli $con, $s) {
	return mysqli_real_escape_string($con, (string) $s);
}

function dayq_post($key, $default = '') {
	return isset($_POST[$key]) ? trim((string) $_POST[$key]) : $default;
}

function dayq_get_int($key, $default = 0) {
	return isset($_GET[$key]) ? (int) $_GET[$key] : $default;
}
