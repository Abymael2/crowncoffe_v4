<!-- Ventana modal para eliminar -->
<div class="modal fade text-dark" id="modal_eliminar<?php echo $row["id_producto_inv"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> ¿Realmente deseas eliminar este producto ? </h4>
            </div>

            <div class="modal-body">
                <label for="recipient-name" class="col-form-label" name="nombre">Nombre Producto:</label>
                <strong style="text-align: center !important"> 
                    <?php echo $row["nombre_prod_inv"]; ?>
                </strong>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
                    <a href="inv-alm-ingrediente-eliminar-ok.php?id=<?php echo $row["id_producto_inv"] ?>" role="button" class="btn btn-outline-danger">Elimianr</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
