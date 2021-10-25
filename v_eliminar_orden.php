<!-- Ventana modal para eliminar -->
<div class="modal fade text-dark" id="modal_eliminar<?php echo $row["id_det_orden"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> ¿Realmente desea eliminar esta orden ? </h4>
            </div>

            <div class="modal-body">
                <label for="recipient-name" class="col-form-label" name="nombre">Orden No. #</label>
                <strong style="text-align: center !important"> 
                <?php echo $row["id_det_orden"]; ?>
                </strong>
                <br>
                <label for="recipient-name" class="col-form-label" name="nombre"> <b>Norta:</b> Si elimina esta orden no podra ser recuperada</label>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cerrar</button>
                    <a href="v_eliminar_orden_ok.php?id=<?php echo $row["id_det_orden"]; ?>" role="button" class="btn btn-outline-danger">Eliminar</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
