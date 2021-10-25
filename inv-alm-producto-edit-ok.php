<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['nombre']) >= 1) 
        {
            $id_prod = $_GET['id'];
            $nombre = trim($_POST['nombre']);
            $precio = trim($_POST['precio']);
            $estado = trim($_POST['estado']);
            $visible = trim($_POST['visible']);
            $tprepa = trim($_POST['tprepa']);
            $descripcion = trim($_POST['descripcion']);
            $categoria = trim($_POST['categoria']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "UPDATE producto_menu 
                SET nombre_prod_m = '$nombre', precio_prod_m = '$precio', estado_prod_m = '$estado', visible_prod_m = '$visible', 
                tmprepa_prod_m = '$tprepa', descrip_prod_m = '$descripcion', id_cat_prod_menu = '$categoria' 
                WHERE id_producto_m = $id_prod";
            mysqli_query($conexion,$consultaagregar);

            $_SESSION['mensaje'] = "Producto Actualizado";
            $_SESSION['tipo_mensaje'] = "primary ";
            header("Location: inv-alm-producto.php");
        }
    }
?>