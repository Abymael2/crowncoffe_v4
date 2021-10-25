<?php
    session_start();

    $_SESSION['mensaje'] = "La orden no fue registrada";
    $_SESSION['tipo_mensaje'] = "info";
    header("Location: tomaOrden.php");
    unset($_SESSION['carrito']);
    $_SESSION['carrito'] = NULL;
    $total=0;
?>