<?php
    session_start();

    $_SESSION['mensaje'] = "La orden no fue modificada";
    $_SESSION['tipo_mensaje'] = "info";
    header("Location: verOrden.php");
    unset($_SESSION['carrito']);
    $_SESSION['carrito'] = NULL;
    $total=0;
?>