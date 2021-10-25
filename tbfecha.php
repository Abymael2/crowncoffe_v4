<?php 
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>
<!-- navegacion -->
<?php include("includes/nav.php"); ?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Eliminar Unidades del inventario</title>
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
    
<div class="col-6 col-md-11">
<div class="container text-primary">
	<div class="col-md-6">
	<div class="col-md-6 well">
		<hr style="border-top:1px dotted #000;"/>
		<form class="form-inline" method="POST" action="">
			<label>Fecha Desde:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1"/>
			<label>Hasta</label>
			<input type="date" class="form-control" placeholder="End"  name="date2"/>
			<button class="btn btn-primary" name="search" >Buscar<span class="glyphicon glyphicon-search"></span></button> <a href="tbfecha.php" type="button" class="btn btn-success" style="height: 5vh;"><span class = "glyphicon glyphicon-refresh"><span>reiniciar</a>
</div>
</div>        </form>
       
		<div class="table-responsive">	
        <table class="table table-striped text-center align-middle" id="datatable"> <!--cta color amarillo-->
				<thead class="cta">
					<tr>
						<th scope="col">Producto</th>
						<th scope="col">Costo</th>
						<th scope="col">Unidades Eliminadas</th>
						<th scope="col">Fecha de Registro</th>
					</tr>
				</thead>
                <tbody class="bg-faded">
					<?php include 'range.php'?>	
				</tbody>
			</table>
		</div>	
	</div>

       <!-- Bootstrap core JS-->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
  
    <?php include("includes/footer.php"); ?>
</body>
</html>