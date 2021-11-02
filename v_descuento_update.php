<?php
    session_start();
    include("db.php");

    $str = $_POST["str"];
    $id_producto_inv = $_POST["id_producto_inv"];

    $result = $conexion->query("Call update_prod_inv($str, $id_producto_inv)");
    while ($row = $result->fetch_assoc())
    {
        var_dump($row);
    }
    
    // if($str == -1){
    //     $_SESSION['mensaje'] = "No hay productos en inventario"; //"Orden Facturada y descontada de inventario"
    //     $_SESSION['tipo_mensaje'] = "danger";
    //     header("Location: verOrden.php");
    // }
    // else{
        // mysqli_autocommit($conexion, FALSE);
        /*$consUpdate = "UPDATE producto_inventario SET u_disp_prod_inv = '$str'
                WHERE id_producto_inv = $id_producto_inv;";
        $resUpdate = mysqli_query($conexion, $consUpdate);
        mysqli_commit($conexion);*/
        // if (!mysqli_commit($conexion)) {
        //     print("Falló la consignación de la transacción\n");
        //     exit();
        // }
        // $mysql_close($conexion);
    // }
?>