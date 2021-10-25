<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['dinero']) >= 1) 
        {
            $id_usuario = $_SESSION['iduser'];
            $id_caja = $_SESSION['id_caja'];

            $id_prod = $_GET['id'];
            $costo = trim($_POST['costo']);
            $prov = trim($_POST['prov']);
            $cod = trim($_POST['cod']);
            $dinero = trim($_POST['dinero']);
            $descripcion = trim($_POST['descripcion']);
            $cantidacmpr = trim($_POST['cant']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "INSERT INTO detalle_compra
                    (proveedor, codigo, descripcion, origen_dinero, id_usuario, id_caja) 
            VALUES('$prov', '$cod', '$descripcion', '$dinero', '$id_usuario', '$id_caja')";
            $result1 = mysqli_query($conexion,$consultaagregar);

            if($result1){
                $id_compra = "SELECT MAX(id_compra) AS id_compra FROM detalle_compra";
                $result2_id_compr = mysqli_query($conexion,$id_compra);
                while($row1=mysqli_fetch_array($result2_id_compr)){
                        $id_comp = $row1['id_compra'];
                        $consultaagregarcompra = "INSERT INTO compra_producto
                        (cantidad, costo, id_producto_inv, id_compra) 
                        VALUES('$cantidacmpr', '$costo', '$id_prod', '$id_comp')";
                        $result2 = mysqli_query($conexion,$consultaagregarcompra);

                        $cons_act_exi = "UPDATE producto_inventario SET u_comp_prod_inv = u_comp_prod_inv + '$cantidacmpr', u_disp_prod_inv = u_disp_prod_inv + '$cantidacmpr'
                                        WHERE id_producto_inv  = '$id_prod'";
                        mysqli_query($conexion,$cons_act_exi);
                    }

                $_SESSION['mensaje'] = "Producto Actualizado";
                $_SESSION['tipo_mensaje'] = "primary ";
                header("Location: inv-compra.php");
            }
            else{
                $_SESSION['mensaje'] = "Producto Noooooooooooooooooooo Actualizado";
                $_SESSION['tipo_mensaje'] = "danger ";
                header("Location: inv-compra.php");
            }
            
        }
    }
?>