<?php
require_once 'AsignaturaModel.php';
require_once 'LaboratorioModel.php';
require_once 'DirectoraModel.php';
require_once 'DocenteModel.php';
require_once 'EstudianteModel.php';

include('../db.php');
Class IncidenteAUModel{
private $IdIncidenteAU; 
Private $NombreIncidente;
Private $DetalleIncidente;
Private $FechaIncidente;
Private $Urgencia;
Private $TipoIncidente;
Private $Solucion;
private $IdEstudiante;
private $IdDocente;


public function __construct($IdIncidenteAU = null, $NombreIncidente = null, $DetalleIncidente = null, $FechaIncidente = null, $Urgencia = null, $TipoIncidente = null, $Solucion = null, $IdEstudiante = null, $IdDocente = null) {
  $this->IdIncidenteAU = $IdIncidenteAU;
  $this->NombreIncidente = $NombreIncidente;
  $this->DetalleIncidente = $DetalleIncidente;
  $this->FechaIncidente = $FechaIncidente;
  $this->Urgencia = $Urgencia;
  $this->TipoIncidente = $TipoIncidente;
  $this->Solucion = $Solucion;
  $this->IdEstudiante = $IdEstudiante;
  $this->IdDocente = $IdDocente;

}

//constructor Y metodos get/setter

//seter y getter del IDINCIDENTE
public function getIdIncidente() {
  return $this->IdIncidente;
}

public function setIdIncidente($IdIncidente) {
  $this->IdIncidente = $IdIncidente;
}
//seter y getter del NOMBREINCIDNETE
public function getNombreIncidente(){
  return $this ->NombreIncidente;
}

public function setNombreIncidente($NombreIncidente){
  $this -> NombreIncidente = $NombreIncidente;
}
//seter y getter del dETALLERiNCIDNETE
public function getDetalleIncidente(){
  return $this ->DetalleIncidente;
}

public function setDetalleIncidente($DetalleIncidente){
  $this -> DetalleIncidente = $DetalleIncidente;
}
//seter y getter del FECHA
public function getFechaIncidente(){
  return $this ->FechaIncidente;
}

public function setFechaIncidente($FechaIncidente){
  $this -> FechaIncidente = $FechaIncidente;
}
//seter y getter del URGENCIA
public function getUrgencia(){
  return $this ->Urgencia;
}

public function setUrgencia($Urgencia){
  $this -> Urgencia = $Urgencia;
}
//seter y getter del TIPOPiNCIDNETE
public function getTipoIncidente(){
  return $this ->TipoIncidente;
}

public function setTipoIncidente($TipoIncidente){
  $this -> TipoIncidente = $TipoIncidente;
}
//seter y getter del sOLUCION
public function getSolucion(){
  return $this ->Solucion;
}

public function setSolucion($Solucion){
  $this -> Solucion = $Solucion;
}

public function getIdEstudiante(){
  return $this ->IdEstudiante;
}

public function setIdEstudiante($IdEstudiante){
  $this -> IdEstudiante = $IdEstudiante;
}

//seter y getter del IDOCENTE
public function getIdDocente(){
  return $this ->IdDocente;
}

public function setIdDocente($IdDocente){
  $this -> IdDocente = $IdDocente;
}



public function ingresarIncidenteAU($conn) {
  $NombreIncidente = mysqli_real_escape_string($conn, $this->NombreIncidente);
  $DetalleIncidente = mysqli_real_escape_string($conn, $this->DetalleIncidente);
  $FechaIncidente = mysqli_real_escape_string($conn, $this->FechaIncidente);
  $Urgencia = mysqli_real_escape_string($conn, $this->Urgencia);
  $TipoIncidente = mysqli_real_escape_string($conn, $this->TipoIncidente);
  $Solucion = mysqli_real_escape_string($conn, $this->Solucion);
  $IdDocente = mysqli_real_escape_string($conn, $this->IdDocente);
  $IdEstudiante = null;
  $sql = "INSERT INTO incidenteau (NombreIncidente, DetalleIncidente, FechaIncidente, Urgencia, TipoIncidente, Solucion,IdEstudiante,IdDocente) VALUES (?, ?, ?, ?, ?, ?,?,?)";
  
  // Verificar los valores de las variables
  var_dump($NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion);
  
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssssssis", $NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion,$IdEstudiante,$IdDocente);
    if (!$stmt->execute()) {
      throw new Exception("Error al insertar el incidenteAU: " . $stmt->error);
    }
    $stmt->close();
  } else {
    throw new Exception("Error al preparar la consultaAU: " . $conn->error);
  }
}

public function ingresarIncidenteAUEstudiante($conn) {
  $NombreIncidente = mysqli_real_escape_string($conn, $this->NombreIncidente);
  $DetalleIncidente = mysqli_real_escape_string($conn, $this->DetalleIncidente);
  $FechaIncidente = mysqli_real_escape_string($conn, $this->FechaIncidente);
  $Urgencia = mysqli_real_escape_string($conn, $this->Urgencia);
  $TipoIncidente = mysqli_real_escape_string($conn, $this->TipoIncidente);
  $Solucion = mysqli_real_escape_string($conn, $this->Solucion);
  $IdEstudiante = mysqli_real_escape_string($conn, $this->IdEstudiante);
  $IdDocente = null;
  $sql = "INSERT INTO incidenteau (NombreIncidente, DetalleIncidente, FechaIncidente, Urgencia, TipoIncidente, Solucion,IdEstudiante,IdDocente) VALUES (?, ?, ?, ?, ?, ?,?,?)";
  
  // Verificar los valores de las variables
  var_dump($NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion);
  
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssssssis", $NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion,$IdEstudiante,$IdDocente);
    if (!$stmt->execute()) {
      throw new Exception("Error al insertar el incidenteAU: " . $stmt->error);
    }
    $stmt->close();
  } else {
    throw new Exception("Error al preparar la consultaAU: " . $conn->error);
  }
}










}
?>