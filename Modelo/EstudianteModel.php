<?php
include('../db.php');
class EstudianteModel {
    private $IdEstudiante;
    private $RutEstudiante;
    private $NombreEstudiante;
    private $CorreoEstudiante;
    private $ContrasenaEstudiante;

    // Constructor
    public function __construct($IdEstudiante = null,$RutEstudiante = null, $NombreEstudiante = null,$CorreoEstudiante = null,$ContrasenaEstudiante = null ) {
        $this ->IdEstudiante = $IdEstudiante;
        $this->RutEstudiante = $RutEstudiante;
        $this->NombreEstudiante = $NombreEstudiante;
        $this -> CorreoEstudiante = $CorreoEstudiante;
        $this -> ContrasenaEstudiante = $ContrasenaEstudiante;
    }


    // Todos los geter y setter mijo

    public function getIdEstudiante() {
      return $this->IdEstudiante;
  }

  public function setIdEstudiante($IdEstudiante) {
    $this->IdEstudiante = $IdEstudiante;
}

    public function getRutEstudiante() {
        return $this->RutEstudiante;
    }

    public function setRutEstudiante($RutEstudiante) {
        $this->RutEstudiante = $RutEstudiante;
    }

    public function getNombreEstudiante() {
        return $this->NombreEstudiante;
    }

    public function setNombreEstudiante($NombreEstudiante) {
        $this->NombreEstudiante = $NombreEstudiante;
    }

    public function getCorreoEstudiante(){
        return $this -> $CorreoEstudiante;
    }

    public function setCorreoEstudiante($CorreoEstudiante){
         $this -> CorreoEstudiante = $CorreoEstudiante;
    }

    public function getContrasenaEstudiante(){
        return $this -> ContrasenaEstudiante;

    }
    public function setContrasenaEstudiante($ContrasenaEstudiante){

        $this -> ContrasenaEstudiante = $ContrasenaEstudiante;
    }





    public function IngresarEstudiante($conn){
        $RutEstudiante = mysqli_real_escape_string($conn, $this->RutEstudiante);
        $NombreEstudiante = mysqli_real_escape_string($conn, $this->NombreEstudiante);
        $CorreoEstudiante = mysqli_real_escape_string($conn, $this->CorreoEstudiante);
        $ContrasenaEstudiante = mysqli_real_escape_string($conn, $this->ContrasenaEstudiante);




        $sql = "INSERT INTO estudiante (RutEstudiante,NombreEstudiante,CorreoEstudiante,ContrasenaEstudiante) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $RutEstudiante, $NombreEstudiante, $CorreoEstudiante, $ContrasenaEstudiante);
            if (!$stmt->execute()) {
              throw new Exception("Error al insertar el estudiante: " . $stmt->error);
            }
            $stmt->close();
          } else {
            throw new Exception("Error al preparar la consulta para el estudiante: " . $conn->error);
          }
    }



}
?>