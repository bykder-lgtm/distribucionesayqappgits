﻿            <nav class="navbar bg-secondary navbar-dark">
                <a href="#" class="navbar-brand mx-4 mb-3">
                   <h3 class="text-primary">App Tv</h3>
                    <div class="ms-3">
                        <h3 class="mb-0"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></h3>
                    </div>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0">HOLA <?php echo $nombres_des.' '.$apellidos_des; ?></h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../admin/lista_caja_virtual_cocina.php" class="nav-item nav-link"><h6 class="mb-0"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h6></a>
                    <a href="../admin/lista_caja_virtual_cocina_atendido.php" class="nav-item nav-link"><h6 class="mb-0"><?php echo $nombre_concepto_multi_virtual; ?>S ATENDIDAS</h6></a>
                    <a href="../session/salir.php?token=<?php echo $token ?>" class="nav-item nav-link"><h6 class="mb-0">SALIR</h6></a>
                </div>
            </nav>