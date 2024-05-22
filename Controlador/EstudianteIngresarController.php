<?php
include('../db.php');
include('../Modelo/EstudianteModel.php');
require_once '../Modelo/LoginModel.php';

class EstudianteIngresarController {


   
   
    
    //Validar campos
    public function validarCampos($data) {
        // Lista de campos requeridos
        $camposRequeridos = [
            'RutEstudiante', 'NombreEstudiante', 'CorreoEstudiante', 'ContrasenaEstudiante'
        ];

        // Verificar si cada campo requerido tiene un valor
        foreach ($camposRequeridos as $campo) {
            if (empty($data[$campo])) {
                return "El campo $campo es requerido.";
            }
        }


        return null;
    }

    

    public function crearEstudiante($data, $conn) {
        
        
        $error = $this->validarCampos($data);
        if ($error) {
            echo "Error en la validación: " . $error;
            exit();
        }

      $estudiante = new EstudianteModel();
        // Establecer los datos de cada modelo

        $estudiante-> setRutEstudiante($data['RutEstudiante']);
        $estudiante->setNombreEstudiante($data['NombreEstudiante']);
        $estudiante->setCorreoEstudiante($data['CorreoEstudiante']);
        $estudiante-> setContrasenaEstudiante($data['ContrasenaEstudiante']);



        $estudiante->IngresarEstudiante($conn);
        // Verificar si la variable de sesión 'IdDocente' está configurada y no está vacía
       
    }

}

//Capturamos los datos ingresado en el formulario para crear un estudiante y lo ponemos en un array

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar']))
{
    
    $data = [

        'RutEstudiante' => $_POST['RutEstudiante'],
        'NombreEstudiante' => $_POST['NombreEstudiante'],
        'CorreoEstudiante' => $_POST['CorreoEstudiante'],
        'ContrasenaEstudiante' => $_POST['ContrasenaEstudiante'],
       
    ];

    $controller = new EstudianteIngresarController();
    $controller->crearEstudiante($data, $conn);
    header('Location: ../index.php');
}







?>