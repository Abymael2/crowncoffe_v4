<!-- Ventana modal para editar usuario -->
<div class="modal fade text-dark" id="modal_editar<?php echo $row["id_usuario"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos de Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="usuario-editar-ok.php?id=<?php echo $row["id_usuario"] ?>" method="post" id="form-cat">
                        <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="idc">Id:</label>
                        <input class="form-control" type="text" name="idc" value="<?php echo $row["id_usuario"] ?>" disabled>
                    </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" name="nombre">Nombre:</label>
                                <input class="form-control" type="text" name="nombre" value="<?php echo $row["nombre"] ?>" >
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" name="contraseña">Contraseña:</label>
                                <input class="form-control" type="password" name="contraseña" value="<?php echo $row["contraseña"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" name="permiso">Permiso:</label>
                                <select id="Select" class="form-select" name="permiso" value="<?php echo $row["permiso"] ?>">
                                    <option>Administrador</option>
                                    <option>Auxiliar </option>
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