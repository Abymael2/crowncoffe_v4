<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['uelimin']) >= 1) 
        {
            $id_cat = $_GET['id'];
            $unidisponible=trim($_POST ['udipin']);
            $unieliminado=trim($_POST ['uelimin']);

            if ($unieliminado <= $unidisponible){
                $consultaagregar = " UPDATE producto_inventario 
                SET u_disp_prod_inv = u_disp_prod_inv - '$unieliminado', u_elim_prod_inv = u_elim_prod_inv + '$unieliminado'
                WHERE id_producto_inv = $id_cat";
            mysqli_query($conexion,$consultaagregar);

            $_SESSION['mensaje'] = "Producto Actualizado";
            $_SESSION['tipo_mensaje'] = "primary";
            header("Location: inv-eliminarunidad.php");
            }
           else {
            $_SESSION['mensaje'] = "Error de eliminar productos '$unidisponible'";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: inv-eliminarunidad.php");
           }
           
        }
    }
?>