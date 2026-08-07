<?php
require_once(__DIR__ . '/../session/funciones_admin_administrativo.php');
if (!verificar_usuario_portal_administrativo()) {
	header('Location: ../../../login_administrativo.php');
	exit;
}
