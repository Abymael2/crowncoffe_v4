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

<!--Buscar y agregar-->
    <div class="container-fluid px-4 py-2 text-center">
        <h2 class="text-light">Productos Inventario</h2>
        <button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal_agregar"> <i class='bx bx-plus-medical'></i> AGREGAR </button>
    </div>
    <!-- tabla de datos -->
    <div class="container-fluid p-4 table-responsive-lg text-primary">
        <table class="table table-striped text-center align-middle" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Unidad de medida</th>
                    <th scope="col">Unidades disponibles</th>
                    <th scope="col">Unidades vendidas</th>
                    <th scope="col">Unidades compradas</th>
                    <th scope="col">Unidades eliminadas</th>
                
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $categoria = "SELECT * FROM producto_inventario";
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr class="">
                    <th scope="row"><?php echo $row["id_producto_inv"] ?></th>
                    <td><?php echo $row["nombre_prod_inv"] ?></td>
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
                    <td><?php echo $row["u_disp_prod_inv"]+0 ?></td>
                    <td><?php echo $row["u_vend_prod_inv"]+0 ?></td>
                    <td><?php echo $row["u_comp_prod_inv"]+0 ?></td>
                    <td><?php echo $row["u_elim_prod_inv"]+0 ?></td>
                    
                
                </tr>

                <?php 
                    include("inv-alm-ingrediente-eliminar.php"); 
                    include("inv-alm-ingrediente-edit.php"); 
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal agregar-->
<div class="modal fade " id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-ingrediente-nuevo.php" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre Producto:</label>
                        <input class="form-control" type="text" name="nombre" >
                    </div>
                
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidad de Medida:</label>
                        <select class="form-select" aria-label="Default select example" name="unimedida">
                            <?php 
                                $cons_uni_medida = "SELECT * FROM unidad_medida ORDER BY id_uni_m";
                                $res_cons_uni =mysqli_query($conexion, $cons_uni_medida);

                                while($row=mysqli_fetch_array($res_cons_uni)){
                                    $id_uni = $row['id_uni_m'];
                                    $nombr_uni = $row['nombre_uni'];
                            ?>
                            <option value="<?php echo $id_uni; ?>"><?php echo $nombr_uni;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades disponibles:</label>
                        <input class="form-control" type="number" name="udipon" id="udispin" min="0">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades vendidas:</label>
                        <input class="form-control" type="number" name="uvendi" id="costoex" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades compradas:</label>
                        <input class="form-control" type="number" name="ucmpra" id="costoex" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades eliminadas:</label>
                        <input class="form-control" type="number" name="uelimin" id="costoex" min="0">
                    </div> -->
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->
    <script>
        new CampoNumerico('#costoin');
        new CampoNumerico('#precioin');
        new CampoNumerico('#udispin');
        new CampoNumerico('#costoex');
        new CampoNumerico('#precioex');
    </script>
    <?php include("includes/footer.php"); ?>
