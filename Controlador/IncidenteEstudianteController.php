<?php
session_start();
include('../db.php');
include('../Modelo/IncidenteModel.php');
include('../Modelo/IndienteAUModel.php');
require_once '../Modelo/LoginModel.php';
class IncidenteEstudianteController {
    
    


    // Es funcion sirve para validar los campo , es decir que entren vacio
    public function validarCampos($data) {
      
        $camposRequeridos = [
            'Laboratorio', 'Salon', 'NombreIncidente', 'FechaIncidente', 'Urgencia', 'TipoIncidente', 'DetalleIncidente', 'NombreAsignatura', 'Seccion'
        ];

        
        foreach ($camposRequeridos as $campo) {
            if (empty($data[$campo])) {
                return "El campo $campo es requerido.";
            }
        }

        return null;
    }

    //Con esta funcion , asigno los valores capurado en el formulario y lo redirigo a las funciones que corresponda
    public function crearIncidente($data, $conn) {
        
   
        $error = $this->validarCampos($data);
        if ($error) {
            echo "Error en la validación: " . $error;
            exit();
        }

        //Los objetos de direferentes clases, de incidente model , asignatura , laboratorio , y el de auditoria
        $incidente = new IncidenteModel();
        $asignatura = new AsignaturaModel();
        $laboratorio = new LaboratorioModel();
        $incidenteAU = new IncidenteAUModel();
   

        $laboratorio->setNombreLaboratorio($data['Laboratorio']);
        $laboratorio->setSalon($data['Salon']);
        
        $incidente->setNombreIncidente($data['NombreIncidente']);
        $incidente->setFechaIncidente($data['FechaIncidente']);
        $incidente->setUrgencia($data['Urgencia']);
        $incidente->setTipoIncidente($data['TipoIncidente']);
        $incidente->setSolucion($data['Solucion']);
        $incidente->setDetalleIncidente($data['DetalleIncidente']);
        
        $incidenteAU->setNombreIncidente($data['NombreIncidente']);
        $incidenteAU->setFechaIncidente($data['FechaIncidente']);
        $incidenteAU->setUrgencia($data['Urgencia']);
        $incidenteAU->setTipoIncidente($data['TipoIncidente']);
        $incidenteAU->setSolucion($data['Solucion']);
        $incidenteAU->setDetalleIncidente($data['DetalleIncidente']);
        
            

        $asignatura->setNombreAsignatura($data['NombreAsignatura']);
        $asignatura->setSeccion($data['Seccion']);

        // Con este if verifico que las variables IdEstudante se envie desde el formulario
        if (isset($_SESSION['IdEstudiante']) && !empty($_SESSION['IdEstudiante'])) {
            $idEstudiante = $_SESSION['IdEstudiante'];
            // Insertar datos en las tablas correspondientes
            try {
                $idAsignatura = $asignatura->ingresarAsignatura($conn);
                $idLaboratorio = $laboratorio->IngresarLaboratorio($conn);

                // Establecer los ID de asignatura, laboratorio y estudiante en el objeto incidente
                $incidente->setIdAsignatura($idAsignatura);
                $incidente->setIdLaboratorio($idLaboratorio);
                $incidente->setIdEstudiante($idEstudiante); // Establecer el ID del estudiante
               
                $incidenteAU->setIdEstudiante($idEstudiante);

                
                // Insertar el incidente
                $incidente->ingresarIncidente($conn);
                $incidenteAU->ingresarIncidenteAUEstudiante($conn);

            } catch (Exception $e) {
                // Manejar el error
                echo "Error al insertar el incidente: " . $e->getMessage();
                exit();
            }
        } else {
            echo "La variable de sesión 'IdEstudiante' no está configurada o está vacía.";
        }
    }
}

// En este if , capturo los valores ingresado por el usuario y se lo mando al que redirige a las demas funciones
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar']))
{
   
    if (isset($_SESSION['IdEstudiante']) && !empty($_SESSION['IdEstudiante'])) {
        $data = [
            'Laboratorio' => $_POST['Laboratorio'],
            'Salon' => $_POST['Salon'],
            'NombreIncidente' => $_POST['NombreIncidente'],
            'FechaIncidente' => $_POST['FechaIncidente'],
            'Urgencia' => $_POST['Urgencia'],
            'TipoIncidente' => $_POST['TipoIncidente'],
            'Solucion' => $_POST['Solucion'],
            'DetalleIncidente' => $_POST['DetalleIncidente'],
            'NombreAsignatura' => $_POST['NombreAsignatura'],
            'Seccion' => $_POST['Seccion'],
        ];
        $controller = new IncidenteEstudianteController();
        $controller->crearIncidente($data, $conn);

        // Redireccionar a la página de éxito (Reemplaza con la página deseada)
        header('Location: ../Vistas/exitoEstudiante.php');
        exit();
    } else {
        echo "La variable de sesión 'IdEstudiante' no está configurada o está vacía.";
    }
}





?>
