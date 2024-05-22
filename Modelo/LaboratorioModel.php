<?php
include('../db.php');
class LaboratorioModel {
     private $IdLaboratorio;
    private $NombreLaboratorio;
    private $Salon;

    public function __construct($IdLaboratorio = null,$NombreLaboratorio = null, $Salon = null) {
      $this -> IdLaboratorio = $IdLaboratorio;
        $this->NombreLaboratorio = $NombreLaboratorio;
        $this->Salon = $Salon;
    }


public function getIdLaboratorio(){
  return $this ->IdLaboratorio;
}

public function setIdLaboratorio($IdLaboratorio){
  $this->IdLaboratorio = $IdLaboratorio;
}


    // Getters y setters
    public function getNombreLaboratorio() {
        return $this->NombreLaboratorio;
    }

    public function setNombreLaboratorio($NombreLaboratorio) {
        $this->NombreLaboratorio = $NombreLaboratorio;
    }

    public function getSalon() {
        return $this->Salon;
    }

    public function setSalon($Salon) {
        $this->Salon = $Salon;
    }





    Public function IngresarLaboratorio($conn){
      $NombreLaboratorio = mysqli_real_escape_string($conn, $this->NombreLaboratorio);
    $Salon = mysqli_real_escape_string($conn, $this->Salon);

    $sql = "INSERT INTO laboratorio (NombreLaboratorio, Salon) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $NombreLaboratorio, $Salon);
    $stmt->execute();

    // Obtén el ID del laboratorio recién insertado
    $this->IdLaboratorio = $stmt->insert_id;

    $stmt->close();

    // Devuelve el ID recién insertado
    return $this->IdLaboratorio;
    
    }

    public function actualizarLaboratorio($conn) {
      $IdLaboratorio = mysqli_real_escape_string($conn, $this->IdLaboratorio);
      $NombreLaboratorio = mysqli_real_escape_string($conn, $this->NombreLaboratorio);
      $Salon = mysqli_real_escape_string($conn, $this->Salon);
    
      $sql = "UPDATE laboratorio SET NombreLaboratorio = ?, Salon = ? WHERE IdLaboratorio = ?";
      
      // Verificar los valores de las variables
      var_dump($NombreLaboratorio, $Salon, $IdLaboratorio);
      
      if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $NombreLaboratorio, $Salon, $IdLaboratorio);
        if (!$stmt->execute()) {
          throw new Exception("Error al actualizar el laboratorio: " . $stmt->error);
        }
        $stmt->close();
      } else {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
      }
    }
    

    public function obtenerLaboratorio($conn) {
      $sql = "SELECT * FROM laboratorio";
      $result = $conn->query($sql);
  
      if (!$result) {
          throw new Exception("Error al obtener los laboratorios: " . $conn->error);
      }
  
      $laboratorios = [];
      while ($row = $result->fetch_assoc()) {
          $laboratorios[] = $row;
      }
  
      return $laboratorios;
  }




}


?>


