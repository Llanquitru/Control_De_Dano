<!DOCTYPE html>
<html>
<head>
	<title>Exito</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css.css"/>
  <style>
		.fondoExito{
			background: linear-gradient(to top, black 20%, red, black 20%) !important;
  			color: white;
		}
	</style>

</head>
<body>
	
<div id="navegacion" class="container-fluid">
<?php 

session_start();
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'docente') {
  header('Location:../Vistas/Login.php');
  exit();
}


// echo 'Bienvenido ' . $_SESSION['userName'] . '!';
?>

<nav class="navbar navbar-expand-lg contenedor1 pb-0 mb-3">
  <div class="row container-fluid p-0 m-0">
	<div class="row col-4 text-center pb-0 pe-0 me-0">
		<div class="col-6 mb-0 pb-0 pe-0 me-0">
			<a class="pe-0 me-0" href="../index.php"><img class="pe-0 me-0" src="../img/logo.png" width="120" height="30"></a>
		</div>
		
	</div>
    
	
    <div class="col-4 container-fluid text-center" id="navbarSupportedContent">
      
	  <div class="pt-0 mt-0">
        
		
        <li class="row nav-item text-center mt-0 pt-0 mb-0 pb-0">
		<p class="col-12 pt-0 mt-0 pb-0 mb-0 text-center">Control de Incidentes</p>
		<h5 class="col-12 text-center pb-0">Exito</h5>
          
        </li>
		
        
      </div>
	  
	  
       
    </div>
	
	<div class="row col-4 text-center mb-0 pb-0">
		<div class="col-3 mb-0 pb-0"> </div>
		<!-- <div class="col-4 mb-0 pb-0"> </div> -->
    <div class="col-3 mb-0 pb-0"> </div>
		<div class="col-3 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="#"><?php echo $_SESSION['userName'] . ''; ?></a>
		</div>
    
	</div>
  </div>
</div><!--cierra el container-fluid-->

  



</nav>

<div class="container border border-dark p-3 pt-4 rounded-2 text-center bg-success">
		<div class="text-center">
			<img src="../img/logo.png">
		</div>
    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
		<div class="mb-5">
			<h1>Exito</h1>
			<p>Los datos se han ingresado correctamente.</p>
		</div>
		


		<a class="navbar-brand text-light pb-0 mb-0" href="../Salir.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="200" height="90" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
</svg></a>
				
			
			
        <div class="">
            <a href="InicioDocente.php" class="btn btn-dark border-dark border-2 btn w-20 px-5 mx-5">Volver</a>
		</div>              
</div>
</body>
</html>