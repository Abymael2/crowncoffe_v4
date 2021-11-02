<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
// if (isset($_GET["w1"])) {
//     $_SESSION['inv_aumento_resultado'] = $_GET["w1"];
// }
include("js\conversorUnidades_sumar.php");

    function aumento($bd_id_producto_inv, $val_1, $ary_simbolo_uni, $val_2, $bd_simbolo_uni, $bd_tipo_uni){
        include("db.php");

                $arreglo[0]=array(      //arreglo de cantidades a descontar
                    "unidad"=>$bd_tipo_uni,
                    "pCant"=>$val_1,
                    "pMedida"=>$ary_simbolo_uni,
                    "resCant"=>$val_2,
                    "resMedida"=>$bd_simbolo_uni
                );

                echo "<br><br>";
                var_dump($arreglo);
                echo "<br><br>";
                echo "********** "."<br>".$bd_id_producto_inv."<br>". $val_1."<br>".$ary_simbolo_uni."<br>".$val_2."<br>".$bd_simbolo_uni."<br>".$bd_tipo_uni ."<br> *********";
                echo "<br><br>";
                $lista = json_encode($arreglo);    //encriptiar a un JSON el arreglo
                
                $sssum = suma_fn($bd_tipo_uni, $val_1, $ary_simbolo_uni, $val_2, $bd_simbolo_uni);

                $_SESSION['inv_aumento_resultado'] = $sssum;
                echo "<br>++++++++<br>".$sssum."<br>++++++++<br>";
        //FIN DEL AUMENTO DE INVENTARIO
        return TRUE;
    }
?>