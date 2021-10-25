<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['nombre']) >= 1) 
        {
            $id_cat = $_GET['id'];
            $nombre = trim($_POST['nombre']);
            $costo = trim($_POST['costo']);
            $unimedida = trim($_POST['unimedida']);
            $descripcion = trim($_POST['descripcion']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "UPDATE producto_inventario 
                SET nombre_prod_inv = '$nombre', costo_prod_inv = '$costo', u_medida_prod_inv = '$unimedida', descrip_prod_inv = '$descripcion' 
                WHERE id_producto_inv = $id_cat";
            mysqli_query($conexion,$consultaagregar);

            $_SESSION['mensaje'] = "Producto Actualizado";
            $_SESSION['tipo_mensaje'] = "primary ";
            header("Location: inv-alm-ingrediente.php");
        }
    }
?>