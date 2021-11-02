<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
    session_start(); 
    include("db.php");
    include("inv_descuneto.php");
    include("inv_aumento.php");


    $carrito_mio = $_SESSION['carrito'];
    $no_mesa = $_SESSION['numero_m'];
    $id_detalle_orden = $_SESSION['id_det_orden'];

    if(count($carrito_mio)<=0){
        unset($carrito_mio);
        $carrito_mio=NULL;
    }

    //verificar que exista un registro en la lista
    for($ii=0;$ii<=count($carrito_mio)-1;$ii ++){
        if($carrito_mio[$ii]==NULL){
            //unset($carrito_mio);
            $carrito_mio[$ii]=NULL;
        }
        else{ $rw = 1;}
    }

    if(isset($_SESSION['carrito'])){

        if($carrito_mio!=NULL && $rw != 0){

            // juntar productos duplicados
            for ($vi=0;$vi<count($carrito_mio);$vi++)
            {
                for ($j=$vi+1; $j<count($carrito_mio);$j++)
                {
                    if ($carrito_mio[$vi]['idprodm'] == $carrito_mio[$j]['idprodm'])
                    {
                        $carrito_mio[$vi]['cantida'] = $carrito_mio[$vi]['cantida'] + $carrito_mio[$j]['cantida'];
                        $carrito_mio[$j]['cantida'] = 0;
                    }
                }
            }
            //insertar cada producto en una orden
            //array de ingredientes
            $suma_ingr[0] = [0,'', 0, 0, '', '', ''];
            $cont_ing = 1;
            for($i=0;$i<=count($carrito_mio)-1;$i ++){
                if($carrito_mio[$i] != NULL && $carrito_mio[$i]['cantida'] != 0){

                    $cantidad = $carrito_mio[$i]['cantida'];
                    $idprodm = $carrito_mio[$i]['idprodm'];
                    $nomprodm = $carrito_mio[$i]['nomprodm']; //nombre del producto para agregar a la toma de orden -------------------------
                    $precio = $carrito_mio[$i]['precio'];


                    $consDuplicado = "SELECT dor.id_det_orden, tor.id_producto_m, tor.nombre_prod_m, tor.cantidad
                                FROM detalle_orden AS dor
                                INNER JOIN toma_orden AS tor ON tor.id_det_orden = dor.id_det_orden
                                WHERE dor.id_det_orden = $id_detalle_orden AND tor.id_producto_m = $idprodm;";
                    $resDuplicado = mysqli_query($conexion, $consDuplicado);
                    $rowDuplicado = mysqli_fetch_array($resDuplicado);


                    //INICIO DE DESCUENTO DE INVENTARIO
                    

                    $consprod = "SELECT pinv.id_producto_inv, pinv.nombre_prod_inv, ping.cantidad AS inv_cant, uni.simbolo_uni, uni.tipo_uni, pm.id_producto_m, pm.nombre_prod_m 
                    FROM producto_ingrediente AS ping
                    INNER JOIN producto_menu AS pm ON ping.id_producto = pm.id_producto_m
                    INNER JOIN producto_inventario AS pinv ON ping.id_ingrediente = pinv.id_producto_inv
                    INNER JOIN unidad_medida AS uni ON ping.id_uni_m = uni.id_uni_m
                    INNER JOIN unidad_medida as uni2 ON pinv.u_medida_prod_inv = uni2.id_uni_m
                    where pm.id_producto_m = $idprodm;";
                    $resprod = mysqli_query($conexion, $consprod);
                    while($rowprod=mysqli_fetch_assoc($resprod)){
                        $bd_id_producto_inv = $rowprod['id_producto_inv'];
                        $bd_nombre_prod_inv = $rowprod['nombre_prod_inv'];
                        $bd_orden_cant = $cantidad;
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
                    //FIN DE DESCUENTO DE INVENTARIO

                    $whilevar = TRUE;
                    $dipli = 0;
                    // while($whilevar){
                        if($rowDuplicado['id_producto_m'] == $idprodm){
                            $bdCantidad = $rowDuplicado['cantidad'];
                            $sumaDuplicado = $rowDuplicado['cantidad'] + $cantidad;
                            $consActzrProd = "UPDATE toma_orden AS tor
                                            SET cantidad = $sumaDuplicado
                                            WHERE tor.id_det_orden = $id_detalle_orden AND tor.id_producto_m = $idprodm;";
                            $resActzrProd = mysqli_query($conexion, $consActzrProd);
                            $resultorden = TRUE;
                            $whilevar = FALSE;
                            $dipli = 1;
                        }
                        else{
                            $consagregarorden = "INSERT INTO toma_orden
                                    (cantidad, precio, id_producto_m, nombre_prod_m, id_det_orden) 
                                    VALUES('$cantidad', '$precio', '$idprodm', '$nomprodm', '$id_detalle_orden')"; //idprodm
                            $resultorden = mysqli_query($conexion,$consagregarorden);
                            $whilevar = FALSE;
                            $dipli = -1;
                        }
                    // }
                    
                }
            }
            if($resultorden || $resActzrProd){
                echo "<br><br>";
                    echo "--------------------------------------------- aaaaaaaaaaaaaaaaaaaaaaa ---------------------------";
                    var_dump($suma_ingr);

                    foreach($suma_ingr as [$ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni]){
                        if($ary_id_producto_inv == 0){}
                        else {
                            descuento($ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni);
                        }
                    }
            }

            //redireccionar a toma de ordenes
            $_SESSION['mensaje'] = "Detalle de orden guardado";
            $_SESSION['tipo_mensaje'] = "primary";
            unset($_SESSION['carrito']);
            $_SESSION['carrito'] = NULL;
            $total=0;
            ?>
            <script> 
                window.location.replace('verOrden.php'); 
            </script>
            <?php
        }
        else{
            $_SESSION['mensaje'] = "Orden Omitida :)";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: verOrden.php");
            unset($_SESSION['carrito']);
            $_SESSION['carrito'] = NULL;
            $total=0;
        }
    }//
    else{
        $_SESSION['mensaje'] = "¡Ups ha ocurrido un error! No existe un producto para agregar a la orden";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: verOrden.php");
        unset($_SESSION['carrito']);
        $_SESSION['carrito'] = NULL;
        $total=0;
    }
?>