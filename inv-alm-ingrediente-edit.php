<!-- Ventana modal para editar categoria -->
<div class="modal fade text-dark" id="modal_editar<?php echo $row["id_producto_inv"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">editar productos Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-ingrediente-edit-ok.php?id=<?php echo $row["id_producto_inv"] ?>" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="idc">Id:</label>
                        <input class="form-control" type="text" name="idc" value="<?php echo $row["id_producto_inv"] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre Categoria:</label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo $row["nombre_prod_inv"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Costo:</label>
                        <input class="form-control" type="number" name="costo" id="costoex" min="0" value="<?php echo $row["costo_prod_inv"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidad de Medida:</label>
                        <select class="form-select" aria-label="Default select example" name="unimedida">
                            <?php 
                                $idd = $row["u_medida_prod_inv"];
                                $cons_uni_med_id = "SELECT * FROM unidad_medida WHERE id_uni_m = '$idd'";
                                $res_cons_uni_id =mysqli_query($conexion, $cons_uni_med_id);
                                while($row1=mysqli_fetch_array($res_cons_uni_id)){
                                    $id_uni_sel = $row1['id_uni_m'];
                                    $nombr_uni_sel = $row1['nombre_uni'];
                            ?>
                            <option value="<?php echo $id_uni_sel; ?>" selected><?php echo $nombr_uni_sel;?></option>
                            <?php
                                }
                            ?>

                            <?php 
                                $cons_uni_medida = "SELECT * FROM unidad_medida ORDER BY id_uni_m";
                                $res_cons_uni =mysqli_query($conexion, $cons_uni_medida);

                                while($row2=mysqli_fetch_array($res_cons_uni)){
                                    $id_uni = $row2['id_uni_m'];
                                    $nombr_uni = $row2['nombre_uni'];
                            ?>
                            <option value="<?php echo $id_uni; ?>"><?php echo $nombr_uni;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripcion:</label>
                        <input class="form-control" type="text" name="descripcion" value="<?php echo $row["descrip_prod_inv"] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input class="btn btn-primary" type="submit" name="btnactualizar" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>