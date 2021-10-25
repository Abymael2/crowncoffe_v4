        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <?php 
    session_start();
    include("db.php");

    if(isset($_GET['id_det_orden'])){
        $id_det_orden = $_GET['id_det_orden'];
        //echo $id_det_orden; 

        //obtener numero de mesa para detalle_orden
        $detalleorden = "SELECT m.numero 
                        FROM detalle_orden AS do1
                        INNER JOIN mesa AS m
                        ON do1.id_mesa = m.id_mesa
                        WHERE do1.id_det_orden = '$id_det_orden'";
            $resm = mysqli_query($conexion, $detalleorden);
            while($row=mysqli_fetch_assoc($resm)){
                $nomesa = $row["numero"];
            }

        if($resm){
            //cambiar estado de detalle_orden
            $consordesta = "UPDATE detalle_orden SET estado_orden = 0 WHERE id_det_orden = '$id_det_orden'";
            $resordesta = mysqli_query($conexion,$consordesta);
            if($resordesta){
                //cambiar estado de la mesa
                $consmesaest = "UPDATE mesa SET estado = 1 WHERE numero = '$nomesa'";
                $resmesaest = mysqli_query($conexion,$consmesaest);

                if($resmesaest){
                    $considcaja = "SELECT * FROM tbcajaefectivo WHERE estado=1 ";
                    $residcaja = mysqli_query($conexion, $considcaja);

                    if($considcaja){
                        $caja = mysqli_fetch_array($residcaja);
                        $idcaja = $caja['id'];

                        $consfa = "INSERT INTO factura(id_detalle_orden, id_caja) VALUES ('$id_det_orden', '$idcaja')";
                        $resconsfact = mysqli_query($conexion, $consfa);

                        if($resconsfact){


                            // aqui va el descuento de inventario 

                            $_SESSION['mensaje'] = "Facturado con exito";
                            $_SESSION['tipo_mensaje'] = "primary";
                            $_SESSION['id_det_orden'] = $id_det_orden;
                            //INICIO DEL DESCUENTO DE INVENTARIO
                            $consprod = "SELECT tmo.nombre_prod_m, tmo.id_producto_m, tmo.cantidad FROM `detalle_orden` AS deto
                            INNER JOIN toma_orden AS tmo ON tmo.id_det_orden = deto.id_det_orden
                            WHERE deto.id_det_orden = $id_det_orden;";
                            $resprod = mysqli_query($conexion, $consprod);
                            while($rowprod=mysqli_fetch_assoc($resprod)){
                                $id_prod = $rowprod['id_producto_m'];
                                $cantidadmultiplicar = $rowprod['cantidad'];
                                // echo "id producto: ",$id_prod," cantidad:",$cantidadmultiplicar,"<br><br>";
                                //descuento de inventario----------------------------------------------------------------------------------------------

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

                                    // echo "/ ", $cant_desc,"   /",$simb_desc,"     /",$id_producto_inv,"    / ",$tipo_uni," / ",$u_disp_prod_inv,"   / ",$sumb_uni,"<hr><br>";

                                    // javascript y php

                                    $_SESSION["id_producto_inv"] = $id_producto_inv;
                                    $arreglo[$cont]=array(      //arreglo de cantidades a descontar
                                        "unidad"=>$tipo_uni,
                                        "pCant"=>$u_disp_prod_inv,
                                        "pMedida"=>$sumb_uni,
                                        "resCant"=>$cant_desc,
                                        "resMedida"=>$simb_desc
                                    );

                                    $lista = json_encode($arreglo);    //encriptiar a un JSON el arreglo

                                    // $numero = $_POST['numero'];
                                    //inprimir en consola el JSON
                                    // echo ' <script> console.log("lista ", '.$lista.'); </script> '; 

                                    // echo $cont , ' cont ';
                                    //$cont ++;
                                    ?>

                                    <!-- llamar al archivo js de conversion -->
                                    <script type="text/javascript" src=".\js\conversorUnidad.js"></script>
                                    <script type="text/javascript"></script>

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
                                                "id_producto_inv" : <?php echo $id_producto_inv; ?>
                                            };

                                            $.ajax({
                                                data: parametros,
                                                url: 'v_descuento_update.php',
                                                type: 'POST'
                                            });
                                        }
                                    </script>
                                    
                                    
                                    <?php 
                                        $conv = '<script> document.write(conv); </script>'; 

                                        $conv1 = floatval($conv);
                                        $convfloat = gettype($conv);
                                        

                                        //echo "<br>", "conv = ", $conv, " convfloat = ", $convfloat, " <---> ", $conv1;
                                        // consult para actualizar
                                        

                                        // if($resUpdate){
                                        //     $_SESSION['mensaje'] = "$conv"; //"Orden Facturada y descontada de inventario"
                                        //     $_SESSION['tipo_mensaje'] = "primary";
                                        //     $_SESSION['id_det_orden'] = $id_det_orden;
                                        //     header("Location: ver_factura.php?id_det_orden='$id_det_orden'");
                                        // }
                                        // else{
                                        //     die("no se desconto de inventario");
                                        // }
                                    ?> 
                                    <?php //echo $conv;
                                }
                            }
                            //header("Location: ver_factura.php?id_det_orden='$id_det_orden'");
                            echo "<script> window.location='ver_factura.php'; </script>";
                        }
                        else{
                            die("No sin registrar factura");
                        }
                    }
                    
                }
                else{
                    die("mesa sin activar");
                }
                
            }
            else{
                die("Orden sin desactivar");
            }
        }
        else{
            die("Sin mesa asignada");
        }
        // $_SESSION['mensaje'] = "Producto eliminado de la orden";
        // $_SESSION['tipo_mensaje'] = "primary";
        // header("Location: verOrden.php");
    }

?>

