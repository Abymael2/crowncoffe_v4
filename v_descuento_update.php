<?php
    session_start();
    include("db.php");

    $str = $_POST["str"];
    $id_producto_inv = $_POST["id_producto_inv"];

    
    if($str == -1){
        $_SESSION['mensaje'] = "No hay productos en inventario"; //"Orden Facturada y descontada de inventario"
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: verOrden.php");
    }
    else{
        $consUpdate = "UPDATE producto_inventario SET u_disp_prod_inv = '$str'
                WHERE id_producto_inv = $id_producto_inv;";
        $resUpdate = mysqli_query($conexion, $consUpdate);
    }

    unset($_SESSION["id_producto_inv"]);
?>