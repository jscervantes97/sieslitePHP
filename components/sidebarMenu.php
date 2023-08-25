<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <?php 
            if($_SESSION['rol']== 'ADMIN'){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="inventario.php">
                <span data-feather="shopping-cart"></span>
                Inventario de productos 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reportes.php">
                <span data-feather="bar-chart-2"></span>
                Reporte de ventas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="configuracion.php">
                <span data-feather="settings"></span>
                Configuracion de usuarios 
                </a>
            </li>
            <?PHP
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="puntoVenta.php">
                <span data-feather="home"></span>
                Punto de venta
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="gastos.php">
                <span data-feather="home"></span>
                Gastos y Entradas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="corteCaja.php">
                <span data-feather="home"></span>
                Corte Caja
                </a>
            </li>
        </ul>
    </div>
</nav>