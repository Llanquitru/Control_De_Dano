<?php

require_once '../Modelo/LoginModel.php';

include('../Controlador/IncidenteDocenteController.php');



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

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'docente') {
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
			<a class="navbar-brand text-light pb-0 mb-0" href="InicioDocente.php">
			<a class="navbar-brand text-light pb-0 mb-0" href="InicioDocente.php">
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
		<h5 class="col-12 text-center pb-0">Editar Incidente</h5>
          
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
    $idIncidente = $_POST['idIncidente'];

    // Obtener los datos del incidente basado en el ID
    $incidenteDocenteController = new IncidenteDocenteController();
    $incidente = $incidenteDocenteController->obtenerIncidenteActual($idIncidente, $conn);

    // Resto del código para procesar la actualización del incidente
    // ...

} else {
    // En caso de que no se haya enviado el formulario, puedes mostrar un mensaje de error o redireccionar a otra página
    // ...
}
?>




<div class="container border border-dark p-3 pt-4 rounded-2 bg-light">
    <form method="POST" class="row" action ="../Controlador/IncidenteDocenteController.php">

      <div class="col-12 text-center">
        <div class="form-group">
            <label for="IdIncidente">ID del Incidente</label>
            <input type="text" class="form-control" id="IdIncidente" name="IdIncidente" value="<?php echo $incidente['IdIncidente']; ?>" readonly>
            <input type="hidden" name="IdLaboratorio" value="<?php echo $incidente['IdLaboratorio']; ?>">
            <input type="hidden" name="IdAsignatura" value="<?php echo $incidente['IdAsignatura']; ?>">
        </div>
      </div>

      <div class="col-6">
        <div class="row g-3">
          <div class="form-group">
            <label for="NombreIncidente">Nombre Del Incidente</label>
            <input type="text" class="form-control" id="NombreIncidente" name="NombreIncidente" 
           placeholder="Ingrese el nombre del incidente" value="<?php echo $incidente['NombreIncidente']; ?>">
          </div>

          <div class="form-group">
            <label for="FechaIncidente">Fecha</label>
            <input type="text" class="form-control" id="FechaIncidente" name="FechaIncidente" value="<?php echo date('Y-m-d'); ?>" readonly >
          </div>

          <div class="form-group">
            <label for="NombreAsignatura">Asignatura</label>
            <input type="text" class="form-control" id="NombreAsignatura" name="NombreAsignatura" 
           placeholder="Ingrese la asignatura" value="<?php echo $incidente['NombreAsignatura']; ?>">
          </div>

          <div class="form-group">
            <label for="Seccion">Seccion</label>
            <input type="text" class="form-control" id="Seccion" name="Seccion" placeholder="Ingrese la seccion de la asignatura" value="<?php echo $incidente['Seccion']; ?>">
          </div>

        </div>
      </div>


      <div class="col-6">
        <div class="row g-3">
          <div class="form-group">
              <label for="Urgencia">Nivel de Urgencia</label>
              <select class="form-select" id="Urgencia" name="Urgencia" aria-label="Seleccione un nivel de urgencia">
                <option value="Seleccione un nivel de urgencia"<?php if ($incidente['Urgencia'] === 'Seleccione un nivel de urgencia') echo ' selected'; ?>>Seleccione un nivel de urgencia</option>
                <option value="alta"<?php if ($incidente['Urgencia'] === 'alta') echo ' selected'; ?>>Alta</option>
                <option value="media"<?php if ($incidente['Urgencia'] === 'media') echo ' selected'; ?>>Media</option>
                <option value="baja"<?php if ($incidente['Urgencia'] === 'baja') echo ' selected'; ?>>Baja</option>
              </select>
          </div>

          <div class="form-group">
              <label for="TipoIncidente">Tipo de Incidente</label>
              <select class="form-select" id="TipoIncidente" name="TipoIncidente" aria-label="Ingrese el INCIDENTE">
                <option value="Seleccione un nivel de urgencia">Seleccione un nivel de urgencia</option>
                <option value="Perdida de hadware"<?php if ($incidente['TipoIncidente'] === 'Perdida de hadware') echo ' selected'; ?>>Perdida de Hadware</option>
                <option value="Falta de un software"<?php if ($incidente['TipoIncidente'] === 'Falta de un software') echo ' selected'; ?>>Falta de un software</option>
                <option value="Otros"<?php if ($incidente['TipoIncidente'] === 'Otros') echo ' selected'; ?>>Otros</option>
              </select>
          </div>

          <div class="form-group">
              <label for="Laboratorio">Laboratorio</label>
              <select class="form-select" id="Laboratorio" name="Laboratorio" aria-label="Ingrese el laboratorio" >
                <option selected value="Seleccione un laboratorio">Seleccione un laboratorio</option>
                <option value="Informatica"<?php if ($incidente['NombreLaboratorio'] === 'Informatica') echo ' selected'; ?>>Laboratorio de informatica</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Salon">Salon</label>
            <select class="form-select" id="Salon" name="Salon" aria-label="Salon">
                <option selected>Seleccione el salon</option>
                <option value="PC1" <?php if ($incidente['Salon'] === 'PC1') echo ' selected'; ?>>PC1</option>
                <option value="PC2" <?php if ($incidente['Salon'] === 'PC2') echo ' selected'; ?>>PC2</option>
                <option value="PC3" <?php if ($incidente['Salon'] === 'PC3') echo ' selected'; ?>>PC3</option>
                <option value="PC4" <?php if ($incidente['Salon'] === 'PC4') echo ' selected'; ?>>PC4</option>
                <option value="MAC" <?php if ($incidente['Salon'] === 'MAC') echo ' selected'; ?>>MAC</option>
                <option value="LNET" <?php if ($incidente['Salon'] === 'LNET') echo ' selected'; ?>>LNET</option>
            </select>
          </div>

        </div>
      </div>
            
      
      <div class="col-12 mt-3">
        <div class="row">
          <div class="form-group col-6">
            <label for="DetalleIncidente">Detalle del incidente</label>
            <textarea class="form-control" id="DetalleIncidente" name="DetalleIncidente" rows="3"><?php echo $incidente['DetalleIncidente']; ?></textarea>
          </div>

          <div class="form-group col-6">
            <label for="Solucion">Propuesta de solucion</label>
            <textarea class="form-control" id="Solucion" name="Solucion" rows="3"><?php echo $incidente['Solucion']; ?></textarea>
          </div>

        </div>
      </div>
            
    
      <div class="col-12 btn w-100">
            <button type="submit" name="Editar" class="btn btn-primary border-dark border-2 btn w-50" id="btnInicio">Editar</button>
                        
      </div>

        <!-- <button type="submit" name="Editar" class="btn btn-primary">Editar</button> -->
    </form>

</div><!--cierre div container-->

</body>
</html>