<?php

require_once '../Modelo/LoginModel.php';

include('../Controlador/ReporteDocenteContoller.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css.css"/>
    <title>Editar Incidente</title>
</head>
<body>
  
<div id="navegacion" class="container-fluid">
<?php 

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'directora') {
  header('Location:../Vistas/Login.php');
  exit();
}


// echo 'Bienvenido ' . $_SESSION['userName'] . '!';
?>

<nav class="navbar navbar-expand-lg contenedor1 pb-0 mb-2">
  <div class="row container-fluid p-0 m-0">
	<div class="row col-4 text-center pb-0 pe-0 me-0">
		<div class="col-6 mb-0 pb-0 pe-0 me-0">
			<a class="pe-0 me-0" href="#"><img class="pe-0 me-0" src="../img/logo.png" width="120" height="30"></a>
		</div>
		<div class="col-12 mb-0 pb-0 pe-0 me-0">
			<a class="navbar-brand text-light pb-0 mb-0" href="InicioDirectora.php">
			<a class="navbar-brand text-light pb-0 mb-0" href="InicioDirectora.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
</svg>
			</a>
				
			<p class="mb-0 pb-2">Volver</p>
			</a>
			
		</div>
	</div>
    
	
    <div class="col-4 container-fluid text-center" id="navbarSupportedContent">
      
	  <div class="pt-0 mt-0">
        <li class="row nav-item text-center mt-0 pt-0 mb-0 pb-0">
		<p class="col-12 pt-0 mt-0 pb-0 mb-0 text-center">Control de Incidentes</p>
		<h5 class="col-12 text-center pb-0">Mostrar Reporte</h5>  
        </li>
      </div>
  
    </div>
	
	<div class="row col-4 text-center mb-0 pb-0">
		<div class="col-3 mb-0 pb-0"> </div>
		<!-- <div class="col-4 mb-0 pb-0"> </div> -->
    <div class="col-3 mb-0 pb-0"> </div>
		<div class="col-3 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="#"><?php echo $_SESSION['userName']; ?></a>
		</div>
    

		<div class="col-12 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="../Salir.php">
			<a class="navbar-brand text-light mb-0 pb-0" href="../Salir.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg>
			</a>
			<p class="mb-0 pb-2">Salir</p>
			</a>
		</div>
	</div>
  </div>
</div><!--cierra el container-fluid-->
  
</nav>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del incidente del campo oculto
    $idReporte = $_POST['IdReporte'];

  
    $reporteDocenteController = new ReporteDocenteController();
    $reporte = $reporteDocenteController->obtenerReporteActual($idReporte, $conn);

    
} else {
 

}
?>





    <form method="POST" class="Formulario row g-3 border border-dark rounded-2" action ="../Controlador/ReporteDocenteContoller.php">


    <div class="form-group">
    <label for="IdReporte">ID del reporte</label>
    <input type="text" class="form-control" id="IdReporte" name="IdReporte" value="<?php echo $reporte['IdReporte']; ?>" readonly>
</div>

    <div class="form-group">
    
    <label for="NombreReporte">Nombre Del Reporte</label>
    <input type="text" class="form-control" id="NombreReporte" name="NombreReporte" 
           placeholder="Ingrese el nombre del reporte" value="<?php echo $reporte['NombreReporte']; ?>" readonly>
</div>
        
        <div class="form-group">
            <label for="FechaReporte">Fecha del reporte</label>
            <input type="text" class="form-control" id="FechaReporte" name="FechaReporte"  value="<?php echo date('Y-m-d'); ?>" readonly >
        </div>

        
     

        <div class="form-group">
            <label for="DetalleReporte">Detalle del Reporte</label>
            <input type="text" class="form-control" id="DetalleReporte" name="DetalleReporte" placeholder="Ingrese el detalle del reporte" value="<?php echo $reporte['DetalleReporte']; ?>" readonly>
        </div>


       

        <div class="form-group">
    <label for="Derivar">Derivar</label>
    <select class="form-select" id="Derivar" name="Derivar" aria-label="Derivar el incidente" disabled>
        <option value="Seleccione un nivel de urgencia"<?php if ($reporte['Derivar'] === 'Seleccione un nivel de urgencia') echo ' selected'; ?>>Pendiente</option >
        <option value="ARL"<?php if ($reporte['Derivar'] === 'ARL') echo ' selected'; ?>>ARL</option >
        <option value="JefeOperaciones"<?php if ($reporte['Derivar'] === 'JefeOperaciones') echo ' selected'; ?>>JefeOperaciones</option >
        <option value="GestionDocente"<?php if ($reporte['Derivar'] === 'GestionDocente') echo ' selected'; ?>>GestionDocente</option >
        <option value="Otros"<?php if ($reporte['Derivar'] === 'Otros') echo ' selected'; ?>>Otros</option >
    </select>
</div>

  
<div class="form-group">
    <label for="Estado">Estado</label>
    <select class="form-select" id="Estado" name="Estado" aria-label="Estado del incidente / reporte" disabled>
        <option value="Seleccione el estado"<?php if ($reporte['Estado'] === 'Estado del incidente / reporte') echo ' selected'; ?>>Elija si esta completo o no</option>
        <option value="NoTerminado"<?php if ($reporte['Estado'] === 'NoTerminado') echo ' selected'; ?>>No terminado</option>
        <option value="Terminado"<?php if ($reporte['Estado'] === 'Terminado') echo ' selected'; ?>>Terminado</option>
      
    </select>
</div>


    </form>



</body>
</html>