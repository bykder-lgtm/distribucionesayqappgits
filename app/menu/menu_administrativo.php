<?php
$base = 'modulo.php';
?>
<nav class="dayq-adm-sidebar">
	<strong style="display:block;padding:0 1.25rem 0.75rem;color:#94a3b8;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.04em;">Menú</strong>
	<a href="index.php"><i class="fa-solid fa-chart-line fa-fw" aria-hidden="true"></i><span>Panel de control</span></a>
	<a href="<?= $base ?>?m=medio_pago"><i class="fa-solid fa-credit-card fa-fw" aria-hidden="true"></i><span>Medio de pago</span></a>
	<a href="<?= $base ?>?m=cuenta"><i class="fa-solid fa-wallet fa-fw" aria-hidden="true"></i><span>Cuenta</span></a>
	<a href="<?= $base ?>?m=movimiento_cuenta"><i class="fa-solid fa-right-left fa-fw" aria-hidden="true"></i><span>Movimiento de cuenta</span></a>
	<a href="<?= $base ?>?m=gasto"><i class="fa-solid fa-file-invoice-dollar fa-fw" aria-hidden="true"></i><span>Gasto</span></a>
	<a href="<?= $base ?>?m=proveedor"><i class="fa-solid fa-truck-field fa-fw" aria-hidden="true"></i><span>Proveedor</span></a>
	<a href="<?= $base ?>?m=cliente"><i class="fa-solid fa-users fa-fw" aria-hidden="true"></i><span>Cliente</span></a>
	<a href="<?= $base ?>?m=compra"><i class="fa-solid fa-cart-shopping fa-fw" aria-hidden="true"></i><span>Compra</span></a>
	<a href="<?= $base ?>?m=obligacion_financiera"><i class="fa-solid fa-hand-holding-dollar fa-fw" aria-hidden="true"></i><span>Obligación financiera</span></a>
	<hr style="border-color:rgba(255,255,255,0.1);margin:1rem 0;">
	<a href="../../session/salir_administrativo.php"><i class="fa-solid fa-right-from-bracket fa-fw" aria-hidden="true"></i><span>Cerrar sesión</span></a>
</nav>
