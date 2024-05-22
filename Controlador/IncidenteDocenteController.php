<?php
//La sesion
session_start();
//las importaciones
include('../db.php');
include('../Modelo/IncidenteModel.php');
include('../Modelo/IndienteAUModel.php');
require_once '../Modelo/LoginModel.php';

class IncidenteDocenteController {


    //Esta funcion de aqui sirve para obtener la id del incidente actual que se esta viendo
    public function obtenerIncidenteActual($idIncidente, $conn) {
        $sql = "SELECT i.*, a.NombreAsignatura, a.Seccion, l.Salon, l.NombreLaboratorio
                FROM incidente i
                JOIN asignatura a ON i.IdAsignatura = a.IdAsignatura
                JOIN laboratorio l ON i.IdLaboratorio = l.IdLaboratorio
                WHERE i.IdIncidente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idIncidente);

        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result || $result->num_rows === 0) {
            throw new Exception("No se encontró ningún incidente con el ID proporcionado: $idIncidente");
        }
    
        $incidente = $result->fetch_assoc();
        return $incidente;
    }
    //Esta funcion de aqui sirve para obtener los incidente indivuales para el actualizar
    public function obtenerTodosLosIdsIncidentes($conn) {
        $sql = "SELECT i.IdIncidente FROM incidente i ORDER BY i.IdIncidente DESC";
        $result = $conn->query($sql);
    
        if (!$result || $result->num_rows === 0) {
            throw new Exception("No se encontraron IDs de incidentes en la base de datos.");
        }
    
        $idsIncidentes = [];
        while($row = $result->fetch_assoc()){
            $idsIncidentes[] = $row['IdIncidente'];
        }
        return $idsIncidentes;
    }
    
    
    // Esta funcion de aca sirve para validar los campos , es decir evitar campos vacios
    public function validarCampos($data) {
        // Lista de campos requeridos
        $camposRequeridos = [
            'Laboratorio', 'Salon', 'NombreIncidente', 'FechaIncidente', 'Urgencia', 'TipoIncidente', 'DetalleIncidente', 'NombreAsignatura', 'Seccion'
        ];

        // Verificar si cada campo requerido tiene un valor
        foreach ($camposRequeridos as $campo) {
            if (empty($data[$campo])) {
                return "El campo $campo es requerido.";
            }
        }


        return null;
    }

    

    public function crearIncidente($data, $conn) {
        
        
        $error = $this->validarCampos($data);
        if ($error) {
            echo "Error en la validación: " . $error;
            exit();
        }

        $incidente = new IncidenteModel();
        $asignatura = new AsignaturaModel();
        $laboratorio = new LaboratorioModel();
        $incidenteAU = new IncidenteAUModel();
        // Establecer los datos de cada modelo
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

        // Verificar si la variable de sesión 'IdDocente' está configurada y no está vacía
        if (isset($_SESSION['IdDocente']) && !empty($_SESSION['IdDocente'])) {
            $IdDocente = $_SESSION['IdDocente'];
            // Insertar datos en las tablas correspondientes
            try {
                $idAsignatura = $asignatura->ingresarAsignatura($conn);
                $idLaboratorio = $laboratorio->IngresarLaboratorio($conn);

                // Establecer los ID de asignatura, laboratorio y IdDocente  en el objeto incidente
                $incidente->setIdAsignatura($idAsignatura);
                $incidente->setIdLaboratorio($idLaboratorio);
                $incidente->setIdDocente($IdDocente); // Establecer el ID del Docente
                $incidenteAU->setIdDocente($IdDocente);
                // Insertar el incidente
                $incidente->ingresarIncidenteDocente($conn);
              
                $incidenteAU->ingresarIncidenteAU($conn);
            } catch (Exception $e) {
                // Manejar el error
                echo "Error al insertar el incidente: " . $e->getMessage();
                exit();
            }
        } else {
            echo "La variable de sesión 'IdDOCENTE' no está configurada o está vacía.";
        }
    }

    

    public function mostrarIncidentes($conn){
        $incidenteModel = new IncidenteModel();
        $incidentes = $incidenteModel->obtenerIncidentes($conn);
        return $incidentes;
    }
    

    public function mostrarAsignatura($conn) {
        $sql = "SELECT DISTINCT a.* FROM asignatura a JOIN incidente i ON a.IdAsignatura = i.IdAsignatura";
        $result = $conn->query($sql);
    
        if ($result === false) {
            // Error en la consulta SQL
            $errorMsg = "Error en la consulta: " . $conn->error;
            // Puedes imprimir el mensaje de error o manejarlo de otra manera
            echo $errorMsg;
            return array(); // Devolver un array vacío en caso de error
        }
    
        $asignaturas = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $asignaturas[] = $row;
            }
        }
        return $asignaturas;
    }
    
    public function mostrarLaboratorio($conn) {
        $laboratorio = new LaboratorioModel();
        try {
            $laboratorio = $laboratorio->obtenerLaboratorio($conn);
            return $laboratorio;
        } catch (Exception $e) {
            echo "Error al obtener los asignatura: " . $e->getMessage();
        }
    }

    public function eliminarIncidente($idIncidente, $conn) {
        $incidenteModel = new IncidenteModel();
        try {
            $incidenteModel->eliminarIncidente($idIncidente, $conn);
            return '';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


  

    public function editarIncidente($idIncidente, $nuevosDatos, $conn) {
        // Comenzar la transacción
        $conn->begin_transaction();
    
        try {
            // Actualizar la tabla de Incidente
            $sql = "UPDATE incidente SET NombreIncidente=?, FechaIncidente=?,  Urgencia=?, TipoIncidente=?,  DetalleIncidente=?, Solucion=? WHERE IdIncidente=?";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bind_param("ssssssi",
            $nuevosDatos['NombreIncidente'],
            $nuevosDatos['FechaIncidente'],
            $nuevosDatos['Urgencia'],
            $nuevosDatos['TipoIncidente'],
            $nuevosDatos['DetalleIncidente'],
            $nuevosDatos['Solucion'],
            $idIncidente);
        
            $stmt->execute();
    
            // Actualizar la tabla de Asignatura
            // (Asumiendo que tienes IdAsignatura y IdLaboratorio en $nuevosDatos)
            $sql = "UPDATE asignatura SET NombreAsignatura=? , Seccion=? WHERE IdAsignatura=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nuevosDatos['NombreAsignatura'], $nuevosDatos['Seccion'], $nuevosDatos['IdAsignatura']);

            $stmt->execute();
    
            // Actualizar la tabla de Laboratorio
            $sql = "UPDATE laboratorio SET NombreLaboratorio=? ,Salon=? WHERE IdLaboratorio=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nuevosDatos['Laboratorio'],$nuevosDatos['Salon'], $nuevosDatos['IdLaboratorio']);
            $stmt->execute();
    
            // Comprometer la transacción
            $conn->commit();
            echo "Registro actualizado con éxito.";
        } catch(Exception $e) {
            // En caso de error, revertir la transacción
            $conn->rollback();
            echo "Error actualizando registro: " . $e->getMessage();
        }
    
        $stmt->close();
        $conn->close();
    }
    


}
//Capturamos los datos enviado del formulario de la vista
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Ingresar']))
{
    
    if (isset($_SESSION['IdDocente']) && !empty($_SESSION['IdDocente'])) {
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
        $controller = new IncidenteDocenteController();
        $controller->crearIncidente($data, $conn);

        // Redireccionar a la página de éxito (Reemplaza con la página deseada)
        header('Location: ../Vistas/exitoDocente.php');
        exit();
    } else {
        echo "La variable de sesión 'IdDocente' no está configurada o está vacía.";
    }
}




// Lo mismo pero para el editar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Editar'])) {
    $idIncidente = $_POST['IdIncidente'];

    $nuevosDatos = array(
        'NombreIncidente' => $_POST['NombreIncidente'],
        'FechaIncidente' => $_POST['FechaIncidente'],
        'NombreAsignatura' => $_POST['NombreAsignatura'],
        'Seccion' => $_POST['Seccion'],
        'Urgencia' => $_POST['Urgencia'],
        'TipoIncidente' => $_POST['TipoIncidente'],
        'Laboratorio' => $_POST['Laboratorio'],
        'Salon' => $_POST['Salon'],
        'DetalleIncidente' => $_POST['DetalleIncidente'],
        'Solucion' => $_POST['Solucion'],
        'IdAsignatura' => $_POST['IdAsignatura'], // Nueva línea
        'IdLaboratorio' => $_POST['IdLaboratorio'] 
    );

    $incidenteDocenteController = new IncidenteDocenteController();
    $incidenteDocenteController->editarIncidente($idIncidente, $nuevosDatos, $conn);

    header('Location: ../Vistas/exitoDocente.php');
    exit();
}



?>
