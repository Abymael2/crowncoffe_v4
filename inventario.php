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
        <title>Crown Coffe</title>
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
          <!--
      Buscador de la pagina
  
  <br>
  <div class="container">
    <div class="row align-items-start">
    <div class="col align-self-center">
  <div class="input-group">
    <div class="form-outline">
      <input type="search" id="form1" class="form-control" />
    </div>
    <button type="button" class="btn btn-primary">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>
</div>
</div>
-->
<br>




<!--
    botones de la pagina
-->
<!-- <div class="btn-group-vertical btn-group-lg">
    <button type="button" class="btn btn-primary">  Almacén<a href="almacen.php"> <br> <img src="./img/almacen.png" width="100" height="100"></a></button>
    <button type="button" class="btn btn-primary"> Recetas <a href="inv-recetasprincipal.php"><br> <img src="./img/recetas.png" width="100" height="100"></a></button>
    <button type="button" class="btn btn-primary">Compras <br> <a href="inv-compra.php"><img src="./img/compra.png" width="100" height="100"></a></button>
    <button type="button" class="btn btn-primary">Eliminar <br> Unidades <a href="inv-eliminarunidad.php"> <br> <img src="./img/eliminar.png" width="100" height="100"></a></button>
    <button type="button" class="btn btn-primary">Reportes <br> <a href="reportes-prod.php"><img src="./img/reporte.png" width="100" height="100"></button>
  </div> -->


<div class="container p-2">
  <div class="row row-cols-1 row-cols-md-3 g-4 px-5">
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="almacen.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/almacen.png" class="" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Almacén</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="inv-recetasprincipal.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/recetas.png" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Recetas</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="inv-compra.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/compra.png" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Compras</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="inv-eliminarunidad.php" class="text-decoration-none"> 
          <div class="p-2">
            <img src="./img/eliminar.png" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Eliminar</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="reportes-prod.php" class="text-decoration-none">
        <div class="p-2">
          <img src="./img/reporte.png" alt="..." style="height:16vh;">
        </div>
        <div class="card-body text-secondary">
            <p>Reportes</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>


        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
