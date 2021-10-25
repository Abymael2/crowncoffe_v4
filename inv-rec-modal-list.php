
    <?php 
    include("db.php");
    session_start();
?>

<!-- listar todos los productos -->

            
                <?php 
                $idingred = $_POST['nombre'];

                    $cons1 = "SELECT * FROM producto_inventario WHERE id_producto_inv = $idingred";
                    $res1 =mysqli_query($conexion, $cons1);
                    while($row11=mysqli_fetch_array($res1)){
                                $id1 = $row11['id_producto_inv'];
                                $nombre1 = $row11['nombre_prod_inv'];
                                $uni1 = $row11['u_medida_prod_inv'];
                    }

                    $categoria = "SELECT * FROM unidad_medida WHERE id_uni_m = $uni1";
                    $resultado = mysqli_query($conexion, $categoria);
                    $row=mysqli_fetch_assoc($resultado);
                        $id_uni_sel = $row['id_uni_m'];
                        $tipo_uni = $row['tipo_uni'];


                    $cat = "SELECT * FROM unidad_medida WHERE tipo_uni = '$tipo_uni'";
                    $resul = mysqli_query($conexion, $cat);
                    while($row5=mysqli_fetch_assoc($resul)){
                        $nomcateg = $row5['nombre_uni'];
                        $id = $row5['id_uni_m'];
                        
                ?>
                    <option value="<?php echo $id; ?>"><?php echo $nomcateg;?></option>
                <?php 
                
                    }
                ?>

