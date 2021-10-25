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
    <div class="container-xxl text-primary">
    <!--Buscar y agregar-->
        
        <table class="table table-striped compact" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $categoria = "SELECT * FROM producto_menu";
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row["id_producto_m"] ?></th>
                    <td><?php echo $row["nombre_prod_m"] ?></td>
                    <td><?php echo $row["precio_prod_m"] ?></td>
                    <td>
                    <?php 
                            $id_catt = $row["id_cat_prod_menu"];
                            $cons_categoria_sl = "SELECT * FROM categoria_prod_menu WHERE id_cat_prod_menu = '$id_catt'";
                            $res_cons_cat_sl =mysqli_query($conexion, $cons_categoria_sl);

                            while($row3=mysqli_fetch_array($res_cons_cat_sl)){
                                $nombr_cat_m_sl = $row3['nombre_cat'];
                                echo $nombr_cat_m_sl; //mostrar la categoria
                            }
                        ?>
                    </td>
                    <td> 
                        <a class="btn btn-outline-warning" href="inv-receta-modal.php?var=<?php echo $row["id_producto_m"]; ?>">
                            <img class="d-line" src="img/pencil-square.svg" alt=""  href="inv-receta-modal.php?var=<?php echo $row["id_producto_m"]; ?>">
                        </a> 
                        <a class="btn btn-outline-danger" href="" data-bs-toggle="modal" data-bs-target="#modal_eliminar<?php echo $row["id_producto_m"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-inline" src="img/trash.svg" alt="">
                        </a> 
                    </td>
                </tr>

                <?php 
                    include("inv-alm-producto-eliminar.php"); 
                    
                    }
                ?>
            </tbody>
            <!--otra tabla-->
        </table>
      
    </div>

    <!-- Modal agregar-->
<div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">RECETA EDITAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-producto-nuevo.php" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre producto:</label>
                        <input class="form-control" type="text" name="nombre" >
                    </div>
                    <!--nombre ingrediente llamar tabla aun-->
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre Ingrediente:</label>
                        <input class="form-control" type="text" name="ingrediente" >
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
                    <!--cantidad llamar tabla aun-->
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="cantidad">Cantidad:</label>
                        <input class="form-control" type="number" name="cantidad" >
                    </div>
                    Permitir Excluir
                     <select class="form-select" aria-label="Default select example" name="excluir">
                    <option selected>Seleccionar</option>
                    <option value="1">Si, Permitir que se quite este ingrediente</option>
                   <option value="2">No permitir que se quite este ingrediente</option>
                   </select>
                    
                </form>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       
                        
                    </div>
              
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->

       

    <script>
        new CampoNumerico('#costopr');
        new CampoNumerico('#preciopr');
        new CampoNumerico('#costoex');
        new CampoNumerico('#precioex');
    </script>
    <?php include("includes/footer.php"); ?>
    
