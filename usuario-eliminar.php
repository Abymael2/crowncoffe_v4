<!-- Ventana modal para eliminar -->
<div class="modal fade text-dark" id="modal_eliminar<?php echo $row["id_usuario"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> ¿Realmente deseas eliminar este Usuario ? </h4>
            </div>

            <div class="modal-body">
                <label for="recipient-name" class="col-form-label" name="nombre">Datos del Usuario:</label>
                <strong style="text-align: center !important"> 
                    <?php echo $row["nombre"]; ?>
                </strong>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
                    <a href="usuario-eliminar-ok.php?id=<?php echo $row["id_usuario"] ?>" role="button" class="btn btn-outline-danger">Eliminar</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
