<?php 
 session_start();
 $varsesion = $_SESSION['usuario'];
 if($varsesion == null || $varsesion = '' || $_SESSION['permiso'] == 'Auxiliar'){
     echo 'Sin Autorizacion => ';
     echo $_SESSION['permiso'];
     die();
 }

    include("db.php");
    $usuario = "SELECT * FROM usuarios"
?>
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
 <!-- Archivos usados
usuario-eliminar
usuario-eliminar-ok
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Business Casual - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">Cafeteria</span>
                <span class="site-heading-lower">Crown Coffee</span>
            </h1>
        </header>
        <!-- Navigation-->
        <?php 
            if($_SESSION['permiso']== 'Administrador'){
                include 'headerAdmin.php';
            }else{
                include 'headerAux.php';
            }
            
        ?>
        <br>
      

        
        <div class="container text-center">
            <button name="agregar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">AGREGAR</button>
        </div>
            <br>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Permiso de usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" name="nombre">Nombre:</label>
                                <input class="form-control" type="text" name="nombre" >
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" name="contraseña">Contraseña:</label>
                                <input class="form-control" type="password" name="contraseña" >
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" name="permiso">Permiso:</label>
                                <select id="Select" class="form-select" name="permiso">
                                    <option>Administrador</option>
                                    <option>Auxiliar </option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input class="btn btn-primary" type="submit" name="btnregistrar" >
                                <?php 
                                include("userregistrar.php"); 
                                ?>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript; choose one of the two! -->
    
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    



        <div class="container-sm ">
            <table class="table table-striped" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Permiso</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $resultado = mysqli_query($conexion, $usuario);
                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row["id_usuario"] ?></th>
                    <td><?php echo $row["nombre"] ?></td>
                    <td><?php echo $row["contraseña"] ?></td>
                    <td><?php echo $row["permiso"] ?></td>
                    <td>    
                        
                    <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_usuario"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/pencil-square.svg" alt="">
                        </a> 
                        <a class="btn btn-outline-danger" href="" data-bs-toggle="modal" data-bs-target="#modal_eliminar<?php echo $row["id_usuario"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-inline" src="img/trash.svg" alt="">
                        </a>             </tr>
                <?php 
                include("usuario-eliminar.php"); 
                include("usuario-edit.php"); 
                    }
                ?>
            </tbody>
        </table>
        </div>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/form.js" > </script>
    </body>
</html>
