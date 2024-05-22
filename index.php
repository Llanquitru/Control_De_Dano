<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css.css"/>
    <style>
       #navegacion{
            background: linear-gradient(to bottom, #0c0303, #FE0000) !important; /*0575e6, #00f260*/
            color: white;
            padding: 20px 10px;
            margin-bottom: 30px;
        }

       li .nav-link{
            color:white;
       }

       #login{
        /* background: radial-gradient(#FE0000,#0c0303) !important; 0575e6, #00f260 */
            background: linear-gradient(to bottom, #0c0303, #FE0000) !important;
            color: white;
       }

       #logoIn{
        width:50%;
        height:200%;
        padding-left: 2px;
        margin-right: 20px;
       }

    </style>
</head>
<body>
    


<?php


class LoginView {
  public function render($errorMessage = null) {
    $error = '';
    if ($errorMessage) {
      $error = "<p style='color: red;'>$errorMessage</p>";
    }

    echo '<div class="container">
       <div class="row">
            <div class="col-4"></div>

            <div class="row col-4">
            <div id="login" class="col-12 p-5 mt-5 border border-primary boder-3 rounded-4 shadow-lg">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <div class="col-12 text-center mb-3 pt-0">
                        <img id="logoIn" src="img/logo.png" >
                    </div>
                    <h2>Incidentes</h2>
                    <h2>Área Informática</h2>
                </div>
                <div class="col-12">
                    <form class="col-12 row g-4 p-10" method="post" action="Controlador/LoginController.php">
                        <div class="col-12 Usuario">
                            <label for="usuario" class="form-label ">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="col-12 Contrasena">
                            <label for="pass" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                        <div class="col-12 btn w-100 mt-3">
                            <button type="submit" class="btn btn-primary border-dark border-2 btn w-100"> Ingresar </button>
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
        <div class="row col-12 text-center">
                    <div class="col-12 pb-2"></div>
                    <div class="col-12">
                    
                        <a href="Registro.php" class="btn btn-dark border-dark border-2 btnnNReporte">Registrarse</a>
                    </div>
            </div>
            

            <div class="col-4 mt-2 mr-0">
                
                </div>
                
            </div>


        </div>

    </div>

    ';
    
  }
}

$view = new LoginView();
$view->render();

?>









</body>
</html>
