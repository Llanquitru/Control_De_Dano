<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css.css"/>
    <title>Nuevo Incidente</title>
</head>
<body>
 
<div id="navegacion" class="container-fluid">


<nav class="navbar navbar-expand-lg contenedor1 pb-0 mb-2">
  <div class="row container-fluid p-0 m-0">
	<div class="row col-4 text-center pb-0 pe-0 me-0">
		<div class="col-6 mb-0 pb-0 pe-0 me-0">
			<a class="pe-0 me-0" href="#"><img class="pe-0 me-0" src="img/logo.png" width="120" height="30"></a>
		</div>
		
	</div>
    
	
    <div class="col-4 container-fluid text-center" id="navbarSupportedContent">
      
	  <div class="pt-0 mt-0">
        
		
        <li class="row nav-item text-center mt-0 pt-0 mb-0 pb-0">
		<p class="col-12 pt-0 mt-0 pb-0 mb-0 text-center">Control de Incidentes</p>
		<h5 class="col-12 text-center pb-0">Registrate </h5>
          
        </li>
		
        
      </div>
	  
	  
       
    </div>
	
	<div class="row col-4 text-center mb-0 pb-0">
		<div class="col-3 mb-0 pb-0"> </div>
		<!-- <div class="col-4 mb-0 pb-0"> </div> -->
    <div class="col-3 mb-0 pb-0"> </div>
		
    

		<div class="col-12 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="index.php">
			<a class="navbar-brand text-light mb-0 pb-0" href="index.php">
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




<div id="formulario" class="container border border-dark p-3 pt-4 mt-4 rounded-2 bg-light">
    <form method="POST" class="row mt-3" action ="Controlador/EstudianteIngresarController.php">
        <div class="col-3"></div>
        <div class="col-6 text-center">
            <div class="row g-3">
                <div class="form-group">
                    <label for="NombreEstudiante">Nombre</label>
                    <input type="text" class="form-control" id="NombreEstudiante" name="NombreEstudiante" placeholder="Ingrese su nombre de Usuario" required>
                </div>

                <div class="form-group">
                    <label for="RutEstudiante">Rut</label>
                    <input type="text" class="form-control" id="RutEstudiante" name="RutEstudiante" placeholder="Ingrese el Rut del Usuario" required>
                </div>
                <div class="form-group">
                    <label for="CorreoEstudiante">Correo</label>
                    <input type="text" class="form-control" id="CorreoEstudiante" name="CorreoEstudiante" placeholder="Ingrese su correo electronico" required>
                </div>

                <div class="form-group">
                    <label for="ContrasenaEstudiante">Contraseña</label>
                    <input type="text" class="form-control" id="ContrasenaEstudiante" name="ContrasenaEstudiante" placeholder="Ingrese la contraseña para su cuenta" required>
                </div>

               
            </div>
        </div>
        <div class="col-3"></div>

    

           

      


      
        
            <!-- <button type="submit" name="Ingresar" class="btn btn-primary">Enviar</button> -->
       

        <div class="col-12 btn pt-4">
            <button type="submit" name="Ingresar" class="btn btn-primary border-dark border-2 btn px-5" id="btnInicio">Ingresar</button>
                        
        </div>
        
    </form>
</div>

    



</body>
</html>