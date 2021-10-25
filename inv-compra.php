<?php 
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>
<!-- navegacion -->
<?php include("includes/nav.php"); ?>
        
<!-- alerta de agregar categoria -->
<div class="container">
<?php if(isset($_SESSION['mensaje'])){  ?>
        <div class="alert bg-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['mensaje']); 
            unset($_SESSION['tipo_mensaje']); 
    } ?>
</div>
    <!-- tabla de datos -->
    <div class="col-6 col-md-11">
        <div class="container text-primary">
            <!--Buscar y agregar-->
            <div class="row g-3 justify-content">
                <div class="d-grid gap-1 col-3">
                    <a href="inv-alm-ingrediente.php" class="btn btn-outline-primary btn-md"> <i class='bx bx-plus-medical'></i> AGREGAR PRODUCTO </a>
                </div>
            </div>
            <table class="table table-striped text-center align-middle" id="datatable"> <!--cta color amarillo-->
                <thead class="cta">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Unidad de medida</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Unidades Disponibles</th>
                        <th scope="col">Unidades Compradas</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody class="bg-faded">
                    <?php 
                        $categoria = "SELECT * FROM producto_inventario";
                        $resultado = mysqli_query($conexion, $categoria);

                        while($row=mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row["id_producto_inv"] ?></th>
                        <td><?php echo $row["nombre_prod_inv"] ?></td>
                        <td><?php echo $row["costo_prod_inv"] ?></td>
                        <td>
                            <?php 
                                $idd = $row["u_medida_prod_inv"];
                                $cons_uni_med_id = "SELECT * FROM unidad_medida WHERE id_uni_m = '$idd'";
                                $res_cons_uni_id =mysqli_query($conexion, $cons_uni_med_id);
                                while($row1=mysqli_fetch_array($res_cons_uni_id)){
                                    $nombr_uni_sel = $row1['nombre_uni'];
                                    echo $nombr_uni_sel; //mostrar unidad
                                }
                            ?>
                        </td>
                        <td><?php echo $row["descrip_prod_inv"] ?></td>
                        <td><?php echo $row["u_disp_prod_inv"] + 0 ?></td>
                        <td><?php echo $row["u_comp_prod_inv"] + 0?></td>
                        <td> 
                            <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_producto_inv"]; ?>" data-bs-whatever="@mdo">
                                <i class='bx bxs-shopping-bag text-secondary' ></i>
                            </a>
                        </td>
                    </tr>

                    <?php 
                        include("inv-compra-agregar.php"); 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->
    <script>
        new CampoNumerico('#costoin');
        new CampoNumerico('#precioin');
        new CampoNumerico('#cantidacmpr');
    </script>
    <?php include("includes/footer.php"); ?>
