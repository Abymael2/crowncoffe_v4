<?php 
    session_start();
    include("db.php");

    if(isset($_GET['id'])){
        $id_cat = $_GET['id'];
        $consultaeliminar = "DELETE FROM producto_inventario
        WHERE id_producto_inv =  $id_cat";
        $res_elim_cat = mysqli_query($conexion,$consultaeliminar);

        if(!$res_elim_cat){
            die("error");
        }

        $_SESSION['mensaje'] = "Producto eliminado";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: inv-alm-ingrediente.php");
    }

?>