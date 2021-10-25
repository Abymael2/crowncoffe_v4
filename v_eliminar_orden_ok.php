<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
    include('db.php');
    session_start();
    $id_det_orden = $_GET['id'];
    $filasTomOrd = 0;
    // echo  $orden;
    // echo "  <----->  ";

    //Tabla detalle de orden
    $consDetOrd = "SELECT * FROM detalle_orden WHERE id_det_orden = '$id_det_orden'";
    $resDetOrd = mysqli_query($conexion, $consDetOrd);
    while($rowDetOrd=mysqli_fetch_assoc($resDetOrd)){
        $id_mesa = $rowDetOrd['id_mesa'];
    }

    //Tabla Toma de orden
    $consTomOrd = "SELECT * FROM toma_orden WHERE id_det_orden = '$id_det_orden'";
    $resTomOrd = mysqli_query($conexion, $consTomOrd);
    while($rowTomOrd=mysqli_fetch_assoc($resTomOrd)){
        $filasTomOrd++;
    }
    
    
    if($filasTomOrd == 0){ //detalle de orden sin productos 
        echo "<-- Numero de filas obtenidas SIIII -->";
        echo $filasTomOrd;
        echo "    eliminar detalle de orden";

        //eliminar detalle_orden
        $consElimDetOrd = "DELETE FROM detalle_orden WHERE id_det_orden = '$id_det_orden'";
        $resElimDetOrd = mysqli_query($conexion, $consElimDetOrd);

        if($resElimDetOrd){
            //activar el estado de la mesa
            $consmesaest = "UPDATE mesa SET estado = 1 WHERE id_mesa = '$id_mesa'";
            $resmesaest = mysqli_query($conexion,$consmesaest);
            if($resmesaest){ 
                $_SESSION['mensaje'] = "¡Mesa Activada!";
                $_SESSION['tipo_mensaje'] = "primary";
                header("Location: verOrden.php");
            }
        }
    }
    else{ //detalle de orden con productos
        echo "<-- Numero de filas obtenidas ELSEEEE -->";
        echo $filasTomOrd;
        echo "    eliminar toma de orden luego detalle de orden";

        //INICIO DEL DESCUENTO DE INVENTARIO
        $consprod = "SELECT tmo.nombre_prod_m, tmo.id_producto_m, tmo.cantidad FROM detalle_orden AS deto
        INNER JOIN toma_orden AS tmo ON tmo.id_det_orden = deto.id_det_orden
        WHERE deto.id_det_orden = $id_det_orden;";
        $resprod = mysqli_query($conexion, $consprod);

        while($rowprod=mysqli_fetch_assoc($resprod)){
            $id_prod = $rowprod['id_producto_m'];
            $cantidadmultiplicar = $rowprod['cantidad'];
            
            $cons_desc = "SELECT pri.cantidad, uni.simbolo_uni, pinv.nombre_prod_inv,pinv.id_producto_inv, uni.tipo_uni,pinv.u_disp_prod_inv,pinv.u_medida_prod_inv 
            FROM producto_ingrediente AS pri
            INNER JOIN unidad_medida AS uni ON uni.id_uni_m = pri.id_uni_m
            INNER JOIN producto_menu AS prm ON prm.id_producto_m = pri.id_producto
            INNER JOIN producto_inventario AS pinv ON pinv.id_producto_inv = pri.id_ingrediente
            WHERE prm.id_producto_m = $id_prod;";


            $resdesc = mysqli_query($conexion, $cons_desc);
            $cont = 0;//contador para el erreglo que siempre insetre en la fila 0

            while($rowdesc=mysqli_fetch_assoc($resdesc)){
                $cant_desc = $rowdesc['cantidad'] * $cantidadmultiplicar;  //--------------
                $simb_desc = $rowdesc['simbolo_uni']; //--------------
                $id_producto_inv = $rowdesc['id_producto_inv']; //--------------
                $tipo_uni = $rowdesc['tipo_uni']; //--------------
                $u_disp_prod_inv = $rowdesc['u_disp_prod_inv']; //--------------
                $id_u_medida_prod_inv = $rowdesc['u_medida_prod_inv'];

                $conUniMed = "SELECT simbolo_uni FROM unidad_medida WHERE id_uni_m = $id_u_medida_prod_inv;";
                $resUniMed = mysqli_query($conexion, $conUniMed);
                $rowUniMed =mysqli_fetch_assoc($resUniMed);
                $sumb_uni = $rowUniMed['simbolo_uni'];  //--------------

                $_SESSION["id_producto_inv"] = $id_producto_inv;
                $arreglo[$cont]=array(      //arreglo de cantidades a descontar
                    "unidad"=>$tipo_uni,
                    "pCant"=>$u_disp_prod_inv,
                    "pMedida"=>$sumb_uni,
                    "resCant"=>$cant_desc,
                    "resMedida"=>$simb_desc
                );

                $lista = json_encode($arreglo);    //encriptiar a un JSON el arreglo
                ?>

                <!-- llamar al archivo js de conversion -->
                <script type="text/javascript" src=".\js\conversorUnidades_sumar.js"></script>

                <!-- ejecutar ka funcion del archivo -->
                <script type="text/javascript">
                    var lista = '<?php echo $lista; ?>'; 
                    var mydata = JSON.parse(lista);
                    var conv = conv(mydata);
                    // document.getElementById("conv<?php //echo $input; ?>").value = conv;
                    showHint(conv);
                    
                    function showHint(str) {
                        var parametros = 
                        {
                            "str" : str,
                            "id_producto_inv" :<?php echo $id_producto_inv; ?>
                        };

                        $.ajax({
                            data: parametros,
                            url: 'v_descuento_update.php',
                            type: 'POST'
                        });
                    }
                </script>
<?php 
            }
        }
        //FIN DEL DESCUENTO DE INVENTARIO



        //eliminar toma_orden de detalle_orden 
        $consElimTomOrd = "DELETE FROM toma_orden WHERE id_det_orden = '$id_det_orden'";
        $resElimTomOrd = mysqli_query($conexion, $consElimTomOrd);

        if($resElimTomOrd){
            //eliminar detalle_orden 
            $consElimDetOrd = "DELETE FROM detalle_orden WHERE id_det_orden = '$id_det_orden'";
            $resElimDetOrd = mysqli_query($conexion, $consElimDetOrd);

            if($resElimDetOrd){
                //activar el estado de la mesa
                $consmesaest = "UPDATE mesa SET estado = 1 WHERE id_mesa = '$id_mesa'";
                $resmesaest = mysqli_query($conexion,$consmesaest);
                if($resmesaest){ 
                    //redireccionar a toma de ordenes
                    $_SESSION['mensaje'] = "¡Mesa Activada!";
                    $_SESSION['tipo_mensaje'] = "primary";
                    ?>
                    <script> 
                        window.location.replace('verOrden.php'); 
                    </script>
                    <?php

                }
            }
        }
    }

?>