<?php
 session_start();
 $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        die();
    }

    session_destroy();
    header("Location: index.php")
?>
