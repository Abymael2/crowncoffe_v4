<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
    include('db.php');
    include("inv_descuneto.php");
    include("inv_aumento.php");
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
        $suma_ingr[0] = [0,'', 0, 0, '', '', ''];
        $cont_ing = 1;

        $consprod = "SELECT pinv.id_producto_inv, pinv.nombre_prod_inv, tor.cantidad AS orden_cant, pri.cantidad AS inv_cant, uni.simbolo_uni, uni.tipo_uni, prm.nombre_prod_m 
        FROM producto_ingrediente AS pri 
        INNER JOIN unidad_medida AS uni ON uni.id_uni_m = pri.id_uni_m 
        INNER JOIN producto_menu AS prm ON prm.id_producto_m = pri.id_producto 
        INNER JOIN producto_inventario AS pinv ON pinv.id_producto_inv = pri.id_ingrediente 
        INNER JOIN toma_orden AS tor ON tor.id_producto_m = prm.id_producto_m 
        INNER JOIN detalle_orden AS dor ON dor.id_det_orden = tor.id_det_orden 
        WHERE dor.id_det_orden = $id_det_orden;";
        $resprod = mysqli_query($conexion, $consprod);
        while($rowprod=mysqli_fetch_assoc($resprod)){
            $bd_id_producto_inv = $rowprod['id_producto_inv'];
            $bd_nombre_prod_inv = $rowprod['nombre_prod_inv'];
            $bd_orden_cant = $rowprod['orden_cant'];
            $bd_inv_cant = $rowprod['inv_cant'];
            $bd_simbolo_uni = $rowprod['simbolo_uni'];
            $bd_tipo_uni = $rowprod['tipo_uni'];

            $no_row = 0; //numero de array
            $salir = 0;
            foreach($suma_ingr as [$ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni]){
                // if($ary_id_producto_inv == 0){}
                if($bd_id_producto_inv == $ary_id_producto_inv){
                    //sumatoria
                    $val_1 = $ary_orden_cant * $ary_inv_cant;

                    $val_2 = $bd_orden_cant * $bd_inv_cant;

                    $sumatoria = aumento($bd_id_producto_inv, $val_1, $ary_simbolo_uni, $val_2, $bd_simbolo_uni, $ary_tipo_uni);

                    if($sumatoria || $sumatoria == 1){
                        $auentooooo =  $_SESSION['inv_aumento_resultado'];
                        $suma_ingr[$no_row] = [$bd_id_producto_inv, "$bd_nombre_prod_inv", 1,  $auentooooo, "$ary_simbolo_uni", "$bd_tipo_uni"];
                        $ary_new = 0;
                        echo "<br>**********<br>";
                        echo " resultado sumatoria =>>>>> ".$_SESSION['inv_aumento_resultado'];
                        echo "<br>**********<br>";
                    }
                    $ary_new = 0;
                    $salir = 1;
                    //echo "funcion = ".$sumatoria." analizando = ".$bd_id_producto_inv. " ";
                    //$no_row++;
                }
                elseif($salir == 0) {
                    echo "<br> analizando = ".$bd_id_producto_inv." bd_".gettype($bd_id_producto_inv)." ".$ary_id_producto_inv." ary_".gettype($bd_id_producto_inv)." fila_ary = ".$no_row." <br>";
                    $ary_new = 1;
                    $no_row++;
                }
            }

            if($ary_new == 1){
                $suma_ingr[$cont_ing] = [$bd_id_producto_inv, "$bd_nombre_prod_inv", $bd_orden_cant, $bd_inv_cant, "$bd_simbolo_uni", "$bd_tipo_uni"];
                $cont_ing++;
            }
            else {
                // insertar sumarotia
                echo "duplicado en array";
            }
        }


        echo "<br><br>";
        echo "--------------------------------------------- aaaaaaaaaaaaaaaaaaaaaaa ---------------------------";
        var_dump($suma_ingr);

        foreach($suma_ingr as [$ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni]){
            if($ary_id_producto_inv == 0){}
            else {
                aumento_inv($ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni);
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