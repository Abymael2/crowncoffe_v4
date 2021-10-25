<?php 
    session_start();
    $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grupo</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/tabla.css">
    </head>
   
    <body>
        
    <header>
            <h1 class="site text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">Cafeteria</span>
                <span class="site-heading-lower">Crown Coffee</span>
            </h1>
        </header>

<!-- ventana emergente-->
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Grupo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Producto</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
              </div>
              Tipo de Grupo
              <select class="form-select" aria-label="Default select example">
                  <option selected>Seleccionar grupo</option>
                  <option value="1">Individual</option>
                  <option value="2">Grupal</option>
               
                </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Nuevo</button>
        </div>
      </div>
    </div>
  </div>

        <!-- Navigation-->
        <?php 
            if($_SESSION['permiso']== 'Administrador'){
                include 'headerAdmin.php';
            }else{
                include 'headerAux.php';
            }
            
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Nuevo
          </button>
          
<!--
    tabla de ingresar productos
-->
<div id="main-container">

    <table>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Tipo</th><th>Acción</th>
            </tr>
        </thead>

        <tr>
            <td>-</td><td>Café</td><td>Individual</td><td><a href="modal"></a><img src="btnEditar.png" width="20" height="20" data-bs-toggle="modal" data-bs-target="#staticBackdrop">  <img src="btncerrar.png" width="20" height="20">   </td>
        </tr>
        <tr>
            <td>-</td><td>Hamburguesa</td><td>grupo</td><td><img src="btnEditar.png" width="20" height="20">  <img src="btncerrar.png" width="20" height="20">   </td>
        </td>
        </tr>
      
    </table>
</div>

<!--
    ventana emergente
-->


       <br>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
