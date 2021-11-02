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
        <title>Reportes de Cafeteria</title>
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

          <!-- menuu-->

<div class="container p-2">
  <div class="row row-cols-1 row-cols-md-3 g-4 px-5">
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="tbfecha.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/reporte.png" class="" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Reporte de cajas</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="inv-alm-producto.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/reporte.png" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Reporte de menu</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card  text-center bg-primary fw-bold fs-3">
        <a href="inv-alm-ingrediente.php" class="text-decoration-none">
          <div class="p-2">
            <img src="./img/reporte.png" alt="..." style="height:16vh;">
          </div>
          <div class="card-body text-secondary">
            <p>Reporte de ingredientes</p>
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
