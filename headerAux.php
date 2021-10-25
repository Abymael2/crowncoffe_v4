<?php 
    echo '<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">';
    echo '<div class="container-fluid">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="inicio.php">Crown Cofee</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="inicio.php">Inicio</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="tomaOrden.php">Toma de orden</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="verOrden.php">Ver Orden</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="inventario.php">Inventario</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="caja.php">Caja</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase">';echo $_SESSION['usuario']; echo '</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="cerrar.php">Cerrar secion</a></li>
            </ul>
        </div>
    </div>
</nav>';

?>