<?php 
    include("db.php");
    //==================================insercion de datos====================================
    if(isset($_POST['btnguardargast'])) 
    {
        if (strlen($_POST['cantidad']) >= 1 && strlen($_POST['Descripcion']) >= 1) 
        {
            $cantigast = trim($_POST['cantidad']);
            $descripgast = trim($_POST['Descripcion']);
            $tipogast = trim($_POST['TipoTransaccion']);
            $totalgast = trim($_POST['totalgast']);
            $consulta = "INSERT INTO tbgastos(Cantidad, Descripcion, Tipo_Transaccion, Total) VALUES ('$cantigast', '$descripgast', '$tipogast', '$totalgast')";
            $resultado2 = mysqli_query($conexion,$consulta);
            if ($resultado2) {
                $consulta2="SELECT * FROM tbcajaefectivo WHERE estado=1 ";
                $registro2=mysqli_query($conexion, $consulta2) or die("Problemas en la consulta: ".mysqli_error($conexion));

                if ($datos2=mysqli_fetch_array($registro2)) {
                    $idga=$datos2['id'];
                    
                }


                $id_gasto = "SELECT MAX(id) as id FROM tbgastos";
                $result2_id_gasto = mysqli_query($conexion,$id_gasto);
                while($row1=mysqli_fetch_array($result2_id_gasto)){
                        $idga1 = $row1['id'];
                
                }

                //==============================insert================================================================
                $consulta5 = "INSERT INTO caja_gasto(id_caja,id_gasto) VALUES ('$idga', '$idga1')";
                $resultado2 = mysqli_query($conexion,$consulta5);
                header("caja.php");
                ?> 
                <div class="alert alert-primary" role="alert"> agregado correcto</div>
                <?php
            } else {
                ?> 
                <div class="alert alert-danger" role="alert">¡Ups ha ocurrido un error!</div>
                <?php
            }
        }else 
        {
                ?> 
                <div class="alert alert-danger" role="alert">¡Por favor complete los campos!</div>
                <?php
        }
    }

//======================================consultas==========================================================
    
?>