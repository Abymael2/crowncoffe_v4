<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 

    function descuento($ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni){
        include("db.php");
        //INICIO DEL DESCUENTO DE INVENTARIO
        // $consprod = "SELECT tmo.nombre_prod_m, tmo.id_producto_m, tmo.cantidad FROM detalle_orden AS deto
        // INNER JOIN toma_orden AS tmo ON tmo.id_det_orden = deto.id_det_orden
        // WHERE tmo.id_orden = $id_orden AND deto.id_det_orden = $id_det_orden;";
        // $resprod = mysqli_query($conexion, $consprod);

        // while($rowprod=mysqli_fetch_assoc($resprod)){
        //     $id_prod = $rowprod['id_producto_m'];
        //     $cantidadmultiplicar = $rowprod['cantidad'];
            
            $cons_desc = "SELECT pin.u_disp_prod_inv, uni.simbolo_uni 
            FROM producto_inventario AS pin
            INNER JOIN unidad_medida AS uni ON uni.id_uni_m = pin.u_medida_prod_inv
            WHERE pin.id_producto_inv = $ary_id_producto_inv;";


            $resdesc = mysqli_query($conexion, $cons_desc);
            $cont = 0;//contador para el erreglo que siempre insetre en la fila 0

            //limpiar variables
            $tipo_uni = "";
            $u_disp_prod_inv = 0;
            $sumb_uni = "";
            $cant_desc = 0;
            $simb_desc = "";
            while($rowdesc=mysqli_fetch_assoc($resdesc)){
                $cant_desc = $ary_inv_cant * $ary_orden_cant;  //--------------
                $simb_desc = $ary_simbolo_uni; //--------------
                $id_producto_inv = $ary_id_producto_inv; //--------------
                $tipo_uni = $ary_tipo_uni; //--------------
                $u_disp_prod_inv = $rowdesc['u_disp_prod_inv']; //--------------
                $sumb_uni = $rowdesc['simbolo_uni'];  //--------------

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
                            "id_producto_inv" :<?php echo $ary_id_producto_inv; ?>
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
        // }
        //FIN DEL DESCUENTO DE INVENTARIO

        return TRUE;
    }


    function aumento_inv($ary_id_producto_inv, $ary_nombre_prod_inv, $ary_orden_cant, $ary_inv_cant, $ary_simbolo_uni, $ary_tipo_uni){
        include("db.php");
        $cons_desc = "SELECT pin.u_disp_prod_inv, uni.simbolo_uni 
            FROM producto_inventario AS pin
            INNER JOIN unidad_medida AS uni ON uni.id_uni_m = pin.u_medida_prod_inv
            WHERE pin.id_producto_inv = $ary_id_producto_inv;";


        $resdesc = mysqli_query($conexion, $cons_desc);
        $cont = 0;//contador para el erreglo que siempre insetre en la fila 0

        //limpiar variables
        $tipo_uni = "";
        $u_disp_prod_inv = 0;
        $sumb_uni = "";
        $cant_desc = 0;
        $simb_desc = "";
        while($rowdesc=mysqli_fetch_assoc($resdesc)){
            $cant_desc = $ary_inv_cant * $ary_orden_cant;  //--------------
            $simb_desc = $ary_simbolo_uni; //--------------
            $id_producto_inv = $ary_id_producto_inv; //--------------
            $tipo_uni = $ary_tipo_uni; //--------------
            $u_disp_prod_inv = $rowdesc['u_disp_prod_inv']; //--------------
            $sumb_uni = $rowdesc['simbolo_uni'];  //--------------

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
                        "id_producto_inv" :<?php echo $ary_id_producto_inv; ?>
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
        // }
        //FIN DEL DESCUENTO DE INVENTARIO

        return TRUE;
    }
?>