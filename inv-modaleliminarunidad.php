<!-- Ventana modal para editar categoria -->
<div class="modal fade text-dark" id="modal_editar<?php echo $row["id_producto_inv"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar productos Inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-modaleliminrunidad-ok.php?id=<?php echo $row["id_producto_inv"] ?>" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="idc">Id:</label>
                        <input class="form-control" type="text" name="idc" value="<?php echo $row["id_producto_inv"] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre" >Nombre Categoria:</label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo $row["nombre_prod_inv"] ?>" readonly>
                    </div>
                   
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades disponibles:</label>
                        <input class="form-control" type="number" name="udipin"  id="udispin" value ="<?php echo $row ["u_disp_prod_inv"] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Unidades eliminadas:</label>
                        <input class="form-control" type="number" name="uelimin" id="costoex" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripcion:</label>
                        <input class="form-control" type="text" name="descripcion" value="<?php echo $row["descrip_prod_inv"] ?>" readonly>
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