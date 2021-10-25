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
    }
    
    
    $idd = $_GET["var"];
    $consul = "SELECT * FROM producto_menu WHERE id_producto_m = '$idd'";
    $res_cons_uni_id =mysqli_query($conexion, $consul);
    while($row1=mysqli_fetch_array($res_cons_uni_id)){
        $nombr_uni_sel = $row1['nombre_prod_m'];
        $idp = $row1['id_producto_m'];
    }



    $categoria = "SELECT producto_ingrediente.cantidad, producto_inventario.nombre_prod_inv, unidad_medida.nombre_uni, producto_ingrediente.exclusion FROM producto_ingrediente 
                    INNER JOIN producto_inventario ON producto_inventario.id_producto_inv = producto_ingrediente.id_ingrediente 
                    INNER JOIN unidad_medida ON unidad_medida.id_uni_m = producto_ingrediente.id_uni_m
                    WHERE id_producto = $idd";
?>






</div>
    <!----------------------------------->
    <form class="login-form" action="receta_agregar.php?var=<?php echo $idp ?>" method="post">
          <section class="page-section clearfix">
            <div class="container">
                <div class="container">
                    <div class="row align-items-start">
                         <div class="col fs-5 text-white">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label ">Producto</label>
                                <input name="producto" type="text" class="form-control" value="<?php echo $nombr_uni_sel ?>" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label ">Ingrediente </label>
                                <select  class="form-select" onchange="busc(value);" aria-label="Default select example" name="ingrediente">
                                    <option id="cat_todo"  value="todo" hidden onclick="busc('1');"></option>   
                                    <?php 
                                        
                                    $cons1 = "SELECT * FROM producto_inventario";
                                        $res1 =mysqli_query($conexion, $cons1);
                                        while($row11=mysqli_fetch_array($res1)){
                                            $id1 = $row11['id_producto_inv'];
                                            $nombre1 = $row11['nombre_prod_inv'];
                                            $uni1 = $row11['u_medida_prod_inv'];
                                    ?>
                                    <option value="<?php echo $id1; ?>" ><?php echo $nombre1; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="col fs-3 text-white">
                    </div>
                    <div class="col fs-3 text-white">    
                        <div class="col fs-5 text-white">
                            <label for="formGroupExampleInput" class="form-label ">Unidad de medida</label>
                            <!-- listar productos unidades -->
                            <select class="form-select" aria-label="Default select example" id="mostrar_mensaje" name="unimedida">
                            </select>
                            <div class="container" ></div>
                        </div>
                         <div class="row align-items-center">
                              <div class="col fs-5 text-white">
                                <label for="formGroupExampleInput" class="form-label ">Cantidad</label>
                                <input name = "efectivo" type="text" class="form-control" id=" ">
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col fs-5 text-white">
                              <label for="formGroupExampleInput" class="form-label ">Excluir</label>   
                              <select class="form-select" aria-label="Default select example" name="excluir">
                             <option selected>Seleccionar</option>
                             <option value="Si">Si, Permitir que se quite este ingrediente</option>
                             <option value="No">No permitir que se quite este ingrediente</option>
                              </select>
                              </div>
                            </div>
                 </div>
                </div>
            </div>   
        </section>   
        <center> <button type="sumbit" class="btn btn-primary">AGREGAR</button></center>
    </form>
     <br>
    <!-- tabla de datos -->
    <div class="container-xxl text-primary">
    <!--Buscar y agregar-->
    <h2 class="site text-center text-faded d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">Listado de Ingredientes</span>
            </h2>
        <table class="table table-striped compact" id="datatable"> <!--cta color amarillo-->                    
            <thead class="cta">
                <tr>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Ingrediente</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Exclusion</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row["cantidad"] ?></th>
                    <td><?php echo $row["nombre_prod_inv"] ?></td>
                    <td><?php echo $row["nombre_uni"] ?></td>
                    <td><?php echo $row["exclusion"] ?></td>
                    <td> 
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

                <center>
            <button type="button" class="btn btn-danger" style="height: 5vh;"> Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
            </center>


    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->

    <script>
    // seleccionar categoria "Todo"
    $(document).ready(function(){
      // despues del código
        $('#cat_todo').click();
});

// Funcion para buscar por categoria
	function busc(catp)
    { 
        var parametros = 
        {
            "nombre" : catp
        };

        $.ajax({
            data: parametros,
            url: 'inv-rec-modal-list.php',
            type: 'POST',
            
            beforesend: function()
            {
            $('#mostrar_mensaje').html("Mensaje antes de Enviar");
            },

            success: function(mensaje)
            {
            $('#mostrar_mensaje').html(mensaje);
            }
        });
    }
</script>  

    <script>
        new CampoNumerico('#costopr');
        new CampoNumerico('#preciopr');
        new CampoNumerico('#costoex');
        new CampoNumerico('#precioex');
    </script>
    
<?php include("includes/footer.php"); ?>
    
