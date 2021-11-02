<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
    session_start(); 
    include("db.php");
    include("inv_descuneto.php");
    include("inv_aumento.php");

    $carrito_mio = $_SESSION['carrito'];
    $no_mesa = $_SESSION['numero_m'];
    $id_det_orden = 0;

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

            $conmesanum = "SELECT * FROM mesa ORDER BY numero";
            $resmesaid = mysqli_query($conexion,$conmesanum);

            while($rowmesa=mysqli_fetch_assoc($resmesaid)){
                $num_mesa = $rowmesa["numero"];
                if($num_mesa == $no_mesa){
                    $id_mesa = $rowmesa["id_mesa"];
                    $consagregar = "INSERT INTO detalle_orden(id_mesa) 
                        VALUES ('$id_mesa')";
                        $resagregar = mysqli_query($conexion,$consagregar);
                }
            }

            if ($resagregar){

                //insertar cada producto en una orden
                for($i=0;$i<=count($carrito_mio)-1;$i ++){
                    if($carrito_mio[$i]!=NULL){

                        $cantidad = $carrito_mio[$i]['cantida'];
                        $idprodm = $carrito_mio[$i]['idprodm'];
                        $nomprodm = $carrito_mio[$i]['nomprodm']; //nombre del producto para agregar a la toma de orden -------------------------
                        $precio = $carrito_mio[$i]['precio'];

                        
                        $cons_det_orden = "SELECT MAX(id_det_orden) AS id_det_orden FROM detalle_orden";
                        $result_id_del_orden = mysqli_query($conexion,$cons_det_orden);
                        $row1=mysqli_fetch_array($result_id_del_orden);
                        $id_det_orden = $row1['id_det_orden'];

                        $consDuplicado = "SELECT dor.id_det_orden, tor.id_producto_m, tor.nombre_prod_m, tor.cantidad
                                    FROM detalle_orden AS dor
                                    INNER JOIN toma_orden AS tor ON tor.id_det_orden = dor.id_det_orden
                                    WHERE dor.id_det_orden = $id_det_orden AND tor.id_producto_m = $idprodm;";
                        $resDuplicado = mysqli_query($conexion, $consDuplicado);
                        $rowDuplicado = mysqli_fetch_array($resDuplicado);

                        $whilevar = TRUE;
                        $dipli = 0;
                        // while($whilevar){
                            if($rowDuplicado['id_producto_m'] == $idprodm){
                                $sumaDuplicado = $rowDuplicado['cantidad'] + $cantidad;
                                $consActzrProd = "UPDATE toma_orden AS tor
                                                SET cantidad = $sumaDuplicado
                                                WHERE tor.id_det_orden = $id_det_orden AND tor.id_producto_m = $idprodm;";
                                $resActzrProd = mysqli_query($conexion, $consActzrProd);
                                // $whilevar = FALSE;
                                // $dipli = 1;
                            }
                            else{
                                $consagregarorden = "INSERT INTO toma_orden
                                        (cantidad, precio, id_producto_m, nombre_prod_m, id_det_orden) 
                                        VALUES('$cantidad', '$precio', '$idprodm', '$nomprodm', '$id_det_orden')"; //idprodm
                                $resultorden = mysqli_query($conexion,$consagregarorden);
                                // $whilevar = FALSE;
                                // $dipli = -1;
                            }
                        // }

                    }
                }
                if($resultorden || $resActzrProd){
                    $consmesaest = "UPDATE mesa SET estado = 0 WHERE id_mesa = '$id_mesa'";
                    $resmesaest = mysqli_query($conexion,$consmesaest);

                    // descuento de inventario
                    // $consprod1 = "SELECT tmo.nombre_prod_m, tmo.id_producto_m, tmo.cantidad, tmo.id_orden FROM `detalle_orden` AS deto
                    // INNER JOIN toma_orden AS tmo ON tmo.id_det_orden = deto.id_det_orden
                    // WHERE deto.id_det_orden = $id_det_orden;";
                    // $resprod1 = mysqli_query($conexion, $consprod1);

                    $suma_ingr[0] = [0,'', 0, 0, '', '', ''];
                    $cont_ing = 1;
                    // while($rowprod1=mysqli_fetch_assoc($resprod1)){
                    //     $id_orden = $rowprod1['id_orden'];

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
                                descuento($ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni);
                            }
                        }

                    //     descuento($resprod);
                    // }

                }

                //redireccionar a toma de ordenes
                $_SESSION['mensaje'] = "Detalle de orden guardado";
                $_SESSION['tipo_mensaje'] = "primary";
                unset($_SESSION['carrito']);
                $_SESSION['carrito'] = NULL;
                $total=0;
                ?>
                <script> 
                    window.location.replace('tomaOrden.php'); 
                </script>
                <?php
            }
            else {
                
                $_SESSION['mensaje'] = "¡Ups ha ocurrido un error!";
                $_SESSION['tipo_mensaje'] = "danger";
                header("Location: tomaOrden.php");
                unset($_SESSION['carrito']);
                $_SESSION['carrito'] = NULL;
                $total=0;
            }
        }
        else{
            $_SESSION['mensaje'] = "Orden Omitida :)";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: tomaOrden.php");
            unset($_SESSION['carrito']);
            $_SESSION['carrito'] = NULL;
            $total=0;
        }
    }
    else{
        $_SESSION['mensaje'] = "¡Ups ha ocurrido un error! No se puede registrar una orden vacia";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: tomaOrden.php");
        unset($_SESSION['carrito']);
        $_SESSION['carrito'] = NULL;
        $total=0;
    }
?>