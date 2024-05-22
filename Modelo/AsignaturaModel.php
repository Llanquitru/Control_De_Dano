<?php
include('../db.php');

// la clase
class AsignaturaModel {
    private $IdAsignatura;
    private $NombreAsignatura;
    private $Seccion;

    // El constructor
    public function __construct($IdAsignatura = null,$NombreAsignatura = null, $Seccion = null) {
        $this ->IdAsignatura = $IdAsignatura;
        $this->NombreAsignatura = $NombreAsignatura;
        $this->Seccion = $Seccion;
    }
//Los GETTER Y SETTERS
    public function getIdAsignatura() {
      return $this->IdAsignatura;
  }

  public function setIdAsignatura($IdAsignatura) {
    $this->IdAsignatura = $IdAsignatura;
}

    public function getNombreAsignatura() {
        return $this->NombreAsignatura;
    }

    public function setNombreAsignatura($NombreAsignatura) {
        $this->NombreAsignatura = $NombreAsignatura;
    }

    // Getter y Setter para Seccion
    public function getSeccion() {
        return $this->Seccion;
    }

    public function setSeccion($Seccion) {
        $this->Seccion = $Seccion;
    }


// Esta funcion sirve para ingresar una asignatura en la tabla de asignatura
    public function ingresarAsignatura($conn) {
        $NombreAsignatura = mysqli_real_escape_string($conn, $this->NombreAsignatura);
        $Seccion = mysqli_real_escape_string($conn, $this->Seccion);
    
        $sql = "INSERT INTO asignatura (NombreAsignatura, Seccion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $NombreAsignatura, $Seccion);
        $stmt->execute();
    
        // Obtén el ID de la asignatura recién insertada
        $this->IdAsignatura = $stmt->insert_id;
    
        $stmt->close();
    
        
        return $this->IdAsignatura;
    }


//Para ver todas las asginatura
    public function obtenerAsignatura($conn) {
        $sql = "SELECT * FROM asignatura";
        $result = $conn->query($sql);
    
        if (!$result) {
            throw new Exception("Error al obtener los asignatura: " . $conn->error);
        }
    
        $asignatura = [];
        while ($row = $result->fetch_assoc()) {
            $asignatura[] = $row;
        }
    
        return $asignatura;
    }


  
      

//Para obtener la id de la asignatura
    public function obtenerIdAsignatura($conn, $nombreAsignatura, $seccion) {
      
        $sql = "SELECT IdAsignatura FROM asignatura WHERE NombreAsignatura = ? AND Seccion = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $nombreAsignatura, $seccion);
            $stmt->execute();
            $stmt->bind_result($idAsignatura);
            $stmt->fetch();
            $stmt->close();
            return $idAsignatura;
        } else {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }
    }
    
}





?>