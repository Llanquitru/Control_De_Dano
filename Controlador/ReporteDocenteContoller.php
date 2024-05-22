<?php
//La sesion
session_start();
//las importaciones
include('../db.php');
include('../Modelo/ReporteModel.php');
include('../Modelo/ReporteModelAU.php');
include('../Modelo/IncidenteModel.php');
require_once '../Modelo/LoginModel.php';

class ReporteDocenteController {

    public function tieneReporte($conn, $idIncidente) {
        // Consulta SQL para verificar si un incidente tiene reporte
        $sql = "SELECT COUNT(*) as total FROM reporte WHERE IdIncidente = $idIncidente";
        
        // Ejecutar la consulta y obtener el resultado
        $result = $conn->query($sql);
        
        // Obtener el valor del contador total de reportes
        $row = $result->fetch_assoc();
        $totalReportes = $row['total'];
        
        // Verificar si el incidente tiene reporte
        return $totalReportes > 0;
    }
    
    public function mostrarIncidentesv2($conn) {
       // Sentencia sql
       $sql = "SELECT i.IdIncidente, i.NombreIncidente
      FROM incidente i
       LEFT JOIN reporte r ON i.IdIncidente = r.IdIncidente
      WHERE r.IdIncidente IS NULL";

       $result = $conn->query($sql);
        $this->idsIncidentes = [];
      while ($row = $result->fetch_assoc()) {
      $this->idsIncidentes[] = $row;
     }
      return $this->idsIncidentes;
    }
    
    //Esta funcion de aqui sirve para obtener la id del incidente
    public function obtenerReporteActual($idReporte, $conn) {
        $sql = "SELECT * FROM reporte WHERE IdReporte = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idReporte);
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result || $result->num_rows === 0) {
            throw new Exception("No se encontró ningún reporte con el ID proporcionado: $idReporte");
        }
    
        $reporte = $result->fetch_assoc();
        return $reporte;
    }
    //Esta funcion de aqui sirve para obtener los incidente indivuales para el actualizar
    public function obtenerTodosLosIdsReportes($conn) {
        $sql = "SELECT r.IdReporte, r.NombreReporte FROM reporte r ORDER BY r.IdReporte DESC";
        $result = $conn->query($sql);
    
        if (!$result || $result->num_rows === 0) {
            throw new Exception("No se encontraron IDs de reportes en la base de datos.");
        }
    
        $idsReportes = [];
        while($row = $result->fetch_assoc()){
            $idsReportes[] = ['IdReporte' => $row['IdReporte'], 'NombreReporte' => $row['NombreReporte']];
        }
        return $idsReportes;
    }
    
    // Esta funcion de aca sirve para validar los campos , es decir evitar campos vacios
    public function validarCampos($data) {
        // Lista de campos requeridos
        $camposRequeridos = [
            'NombreReporte', 'FechaReporte', 'DetalleReporte', 'Derivar', 'Estado', 'IdIncidente'
        ];

        // Verificar si cada campo requerido tiene un valor
        foreach ($camposRequeridos as $campo) {
            if (empty($data[$campo])) {
                return "El campo $campo es requerido.";
            }
        }


        return null;
    }

    
// esta funcion separa los datos enviado por el html y lo va clasificando ya sea para la tabla de incidente , laboratorio y asignatura
    public function crearReporte($data, $conn) {
        
        
        $error = $this->validarCampos($data);
        if ($error) {
            echo "Error en la validación: " . $error;
            exit();
        }

        $reporte = new ReporteModel();
        $reporteAU = new ReporteModelAU();
        // Establecer los datos de cada model
        
        $reporte->setNombreReporte($data['NombreReporte']);
        $reporte->setFechaReporte($data['FechaReporte']);
        $reporte->setDetalleReporte($data['DetalleReporte']);
        $reporte->setDerivar($data['Derivar']);
        $reporte->setEstado($data['Estado']);
        $reporte->setIdIncidente($data['IdIncidente']);
        
        $reporteAU->setNombreReporte($data['NombreReporte']);
        $reporteAU->setFechaReporte($data['FechaReporte']);
        $reporteAU->setDetalleReporte($data['DetalleReporte']);
        $reporteAU->setDerivar($data['Derivar']);
        $reporteAU->setEstado($data['Estado']);
       

        // Verificar si la variable de sesión 'IdDocente' está configurada y no está vacía
        if (isset($_SESSION['IdDocente']) && !empty($_SESSION['IdDocente'])) {
            $IdDocente = $_SESSION['IdDocente'];
          
            $reporte->setIdDocente($IdDocente); 
            
            $reporteAU->setIdDocente($IdDocente); 
            // Insertar datos en las tablas correspondientes
            try {
              
                $reporte->ingresarReporte($conn);
                $reporteAU->ingresarReporteAU($conn);
            } catch (Exception $e) {
                // Manejar el error
                echo "Error al insertar el Reporte: " . $e->getMessage();
                exit();
            }
        } else {
            echo "La variable de sesión 'IdDOCENTE' no está configurada o está vacía.";
        }
    }

    

    public function mostrarReporte($conn)
    {
        $ReporteModel= new ReporteModel();
        $reporte = $ReporteModel->obtenerTodosLosReportes($conn);
        return $reporte;
    }
    

    public function mostrarIncidentes($conn)
    {
        $incidenteModel = new IncidenteModel();
        $incidentes = $incidenteModel->obtenerIncidentes($conn);
        return $incidentes;
    }
    

    public function eliminarReporte($idReporte, $conn) {
        $ReporteModel = new ReporteModel();
        try {
            $ReporteModel->eliminarReporte($idReporte, $conn);
            return '';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function editarReporte($idReporte, $nuevosDatos, $conn) {
        // Comenzar la transacción
        $conn->begin_transaction();
    
        try {
            // Actualizar la tabla de Incidente
            $sql = "UPDATE reporte SET NombreReporte=?, FechaReporte=?,  DetalleReporte=?, Derivar=?,  Estado=? WHERE IdReporte=?";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bind_param("sssssi",
            $nuevosDatos['NombreReporte'],
            $nuevosDatos['FechaReporte'],
            $nuevosDatos['DetalleReporte'],
            $nuevosDatos['Derivar'],
            $nuevosDatos['Estado'],
            $idReporte);
        
            $stmt->execute();
    
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
// Procesar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['IngresarReporte']))
{
    // Verificar si la variable de sesión está configurada y contiene el ID del estudiante
    if (isset($_SESSION['IdDocente']) && !empty($_SESSION['IdDocente'])) {
        $data = [
            'NombreReporte' => $_POST['NombreReporte'],
            'FechaReporte' => $_POST['FechaReporte'],
            'DetalleReporte' => $_POST['DetalleReporte'],
            'Derivar' => $_POST['Derivar'],
            'Estado' => $_POST['Estado'],
            'IdIncidente' => $_POST['IdIncidente'],
           
        ];
        $controller = new ReporteDocenteController();
        $controller->crearReporte($data, $conn);

        // Redireccionar a la página de éxito (Reemplaza con la página deseada)
        header('Location: ../Vistas/exitoDocente.php');
        exit();
    } else {
        echo "La variable de sesión 'IdDocente' no está configurada o está vacía.";
    }
}



// Procesar la solicitud Actrualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EditarReporte'])) {
    $idReporte = $_POST['IdReporte'];

    $nuevosDatos = array(
            'NombreReporte' => $_POST['NombreReporte'],
            'FechaReporte' => $_POST['FechaReporte'],
            'DetalleReporte' => $_POST['DetalleReporte'],
            'Derivar' => $_POST['Derivar'],
            'Estado' => $_POST['Estado'],
            
        
    );

    $docenteDocenteController = new ReporteDocenteController();
    $docenteDocenteController->editarReporte($idReporte, $nuevosDatos, $conn);

    header('Location: ../Vistas/exitoDirectora.php');
    exit();
}


?>
