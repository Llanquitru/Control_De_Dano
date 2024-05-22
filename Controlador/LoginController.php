<?php
include('../index.php');
require_once '../Modelo/LoginModel.php';

class LoginController {
  private $model;
  private $view;

  public function __construct() {
    $this->model = new LoginModel();
    $this->view = new LoginView();
  }

  public function handleRequest() {

    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Se recibieron datos por POST, intentar autenticar al usuario
      $username = $_POST['usuario'] ?? '';
      $password = $_POST['pass'] ?? '';
      $userType = $this->model->authenticateUser($username, $password);


      if (!empty($username) && !empty($userType)) {
        // Si se recibieron los parámetros correctamente, obtener la información del usuario
        $userInfo = $this->model->getUserInfo($username, $userType);
        $_SESSION['userInfo'] = $userInfo;

        // Resto del código para autenticar al usuario


      
      
      if ($userType === 'estudiante') {
        $_SESSION['userName'] = $userInfo['NombreEstudiante'];
      }

      if ($userType === 'docente') {
        $_SESSION['userName'] = $userInfo['NombreDocente'];
      }

      if ($userType === 'directora') {
        $_SESSION['userName'] = $userInfo['NombreDirectora'];
      }


        if ($userType) {
            // Si la autenticación fue exitosa, obtener la información del usuario
            $userInfo = $this->model->getUserInfo($username, $userType);
    
            // Redirigir al usuario a la página correspondiente según su tipo de usuario
            switch ($userType) {
              case 'directora':
                $_SESSION['userType'] = 'directora';
                header('Location:../Vistas/InicioDirectora.php');
                break;
              case 'docente':
                $_SESSION['userType'] = 'docente';
                header('Location:../Vistas/InicioDocente.php');
                break;
              case 'estudiante':
                $_SESSION['userType'] = 'estudiante';
                header('Location:../Vistas/IncidenteEstudiante.php');
                break;
            }
    
            // Finalizar el script para evitar que se siga ejecutando después de la redirección
            exit();
          } else {
            // Si la autenticación falló, mostrar un mensaje de error en la vista
            header("Location: ../error.php");
            exit();
          }


      }else{
       // $errorMessage = 'Debe ingresar un nombre de usuario y una contraseña.';
       // $this->view->render($errorMessage);
      
        header("Location: ../error.php");
        exit();
        
      }
      


      
  

     

     
    } else {
      // Se recibió una solicitud GET, mostrar la página de login
      $this->view->render();
     
    }
  }
}

$controller = new LoginController();
$controller->handleRequest();

?>
