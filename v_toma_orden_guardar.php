<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
    session_start(); 
    include("db.php");

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


                    $whilevar = TRUE;
                    $dipli = 0;
                    while($whilevar){
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
                    }
                    
                }
            }
            if($resultorden || $resActzrProd){
                //INICIO DEL DESCUENTO DE INVENTARIO
                $consprod = "SELECT tmo.nombre_prod_m, tmo.id_producto_m, tmo.cantidad FROM `detalle_orden` AS deto
                INNER JOIN toma_orden AS tmo ON tmo.id_det_orden = deto.id_det_orden
                WHERE deto.id_det_orden = $id_detalle_orden;";
                $resprod = mysqli_query($conexion, $consprod);

                while($rowprod=mysqli_fetch_assoc($resprod)){
                    $id_prod = $rowprod['id_producto_m'];
                    $cantidadmultiplicar = $rowprod['cantidad'];
                    
                    $cons_desc = "SELECT pri.cantidad, uni.simbolo_uni, pinv.nombre_prod_inv,pinv.id_producto_inv, uni.tipo_uni,pinv.u_disp_prod_inv,pinv.u_medida_prod_inv FROM producto_ingrediente AS pri
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
                        <script type="text/javascript" src=".\js\conversorUnidad.js"></script>

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
            }

            //redireccionar a toma de ordenes
            $_SESSION['mensaje'] = "Detalle de orden guardado";
            $_SESSION['tipo_mensaje'] = "primary";
            unset($_SESSION['carrito']);
            $_SESSION['carrito'] = NULL;
            $total=0;
            ?>
            <script> 
                //window.location.replace('verOrden.php'); 
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