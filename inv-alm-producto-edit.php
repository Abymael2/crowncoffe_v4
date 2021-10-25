<!-- Ventana modal para editar categoria -->
<div class="modal fade text-dark" id="modal_editar<?php echo $row["id_producto_m"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">editar productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-producto-edit-ok.php?id=<?php echo $row["id_producto_m"] ?>" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="idc">Id:</label>
                        <input class="form-control" type="text" name="idc" value="<?php echo $row["id_producto_m"] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre Producto:</label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo $row["nombre_prod_m"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Precio:</label>
                        <input class="form-control" type="text" name="precio" id="precioex" value="<?php echo $row["precio_prod_m"] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">estado:</label>
                        <select class="form-select" aria-label="Default select example" name="estado">
                            <?php 
                            if($row["estado_prod_m"] == 1){
                                ?>
                                <option value="1" selected>Activo</option>
                                <option value="0">Deshabilitado</option>
                                <?php
                            }else{
                                ?>
                                <option value="0" selected>Deshabilitado</option>
                                <option value="1">Activo</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Visible:</label>
                        <select class="form-select" aria-label="Default select example" name="visible">
                            <?php 
                                if($row["visible_prod_m"] == 1){
                                    ?>
                                    <option value="1" selected>Visible</option>
                                    <option value="0">Oculto</option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="0" selected>Oculto</option>
                                    <option value="1">Visible</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Tiempo Preparacion:</label>
                        <input class="form-control" type="text" name="tprepa" min="0" value="<?php echo $row["tmprepa_prod_m"]?>">
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripcion:</label>
                        <input class="form-control" type="text" name="descripcion" value="<?php echo $row["descrip_prod_m"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Categoria:</label>
                        <select class="form-select" aria-label="Default select example" name="categoria">
                            <?php 
                                $id_catt = $row["id_cat_prod_menu"];
                                $cons_categoria_sl = "SELECT * FROM categoria_prod_menu WHERE id_cat_prod_menu = '$id_catt'";
                                $res_cons_cat_sl =mysqli_query($conexion, $cons_categoria_sl);

                                while($row3=mysqli_fetch_array($res_cons_cat_sl)){
                                    $id_cat_m_sl = $row3['id_cat_prod_menu'];
                                    $nombr_cat_m_sl = $row3['nombre_cat'];
                            ?>
                            <option value="<?php echo $id_cat_m_sl; ?>" selected><?php echo $nombr_cat_m_sl;?></option>
                            <?php
                                }
                            ?>

                            <?php 
                                $cons_categoria = "SELECT * FROM categoria_prod_menu ORDER BY id_cat_prod_menu";
                                $res_cons_cat =mysqli_query($conexion, $cons_categoria);

                                while($row4=mysqli_fetch_array($res_cons_cat)){
                                    $id_cat_m = $row4['id_cat_prod_menu'];
                                    $nombr_cat_m = $row4['nombre_cat'];
                            ?>
                            <option value="<?php echo $id_cat_m; ?>"><?php echo $nombr_cat_m;?></option>
                            <?php
                                }
                            ?>
                        </select>
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