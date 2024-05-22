<?php
require_once 'AsignaturaModel.php';
require_once 'LaboratorioModel.php';
require_once 'DirectoraModel.php';
require_once 'DocenteModel.php';
require_once 'EstudianteModel.php';

include('../db.php');
Class IncidenteModel{
private $IdIncidente; 
Private $NombreIncidente;
Private $DetalleIncidente;
Private $FechaIncidente;
Private $Urgencia;
Private $TipoIncidente;
Private $Solucion;
private $IdAsignatura;
private $IdLaboratorio;
private $IdEstudiante;
private $IdDocente;


public function __construct($IdIncidente = null, $NombreIncidente = null, $DetalleIncidente = null, $FechaIncidente = null, $Urgencia = null, $TipoIncidente = null, $Solucion = null, $IdAsignatura = null, $IdLaboratorio = null, $IdEstudiante = null, $IdDocente = null) {
  $this->IdIncidente = $IdIncidente;
  $this->NombreIncidente = $NombreIncidente;
  $this->DetalleIncidente = $DetalleIncidente;
  $this->FechaIncidente = $FechaIncidente;
  $this->Urgencia = $Urgencia;
  $this->TipoIncidente = $TipoIncidente;
  $this->Solucion = $Solucion;
  $this->IdAsignatura = $IdAsignatura;
  $this->IdLaboratorio = $IdLaboratorio;
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


//seter y getter del iDaSIGANTURA
public function getIdAsignatura(){
  return $this ->IdAsignatura;
}

public function setIdAsignatura($IdAsignatura){
  $this -> IdAsignatura = $IdAsignatura;
}

//seter y getter del IDLABORATORIO
public function getIdLaboratorio(){
  return $this ->IdLaboratorio;
}

public function setIdLaboratorio($IdLaboratorio){
  $this -> IdLaboratorio = $IdLaboratorio;
}


//seter y getter del eSTUDIANTE
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


public function ingresarIncidente($conn) {
  $NombreIncidente = mysqli_real_escape_string($conn, $this->NombreIncidente);
  $DetalleIncidente = mysqli_real_escape_string($conn, $this->DetalleIncidente);
  $FechaIncidente = mysqli_real_escape_string($conn, $this->FechaIncidente);
  $Urgencia = mysqli_real_escape_string($conn, $this->Urgencia);
  $TipoIncidente = mysqli_real_escape_string($conn, $this->TipoIncidente);
  $Solucion = mysqli_real_escape_string($conn, $this->Solucion);
  $IdAsignatura = mysqli_real_escape_string($conn, $this->IdAsignatura);
  $IdLaboratorio = mysqli_real_escape_string($conn, $this->IdLaboratorio);
  $IdEstudiante = mysqli_real_escape_string($conn, $this->IdEstudiante);
  $IdDocente = null;

  $sql = "INSERT INTO incidente (NombreIncidente, DetalleIncidente, FechaIncidente, Urgencia, TipoIncidente, Solucion, IdAsignatura, IdLaboratorio, IdEstudiante, IdDocente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
  // Verificar los valores de las variables
  var_dump($NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion, $IdAsignatura, $IdLaboratorio, $IdEstudiante, $IdDocente);
  
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssssssiiis", $NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion, $IdAsignatura, $IdLaboratorio, $IdEstudiante, $IdDocente);
    if (!$stmt->execute()) {
      throw new Exception("Error al insertar el incidente: " . $stmt->error);
    }
    $stmt->close();
  } else {
    throw new Exception("Error al preparar la consulta: " . $conn->error);
  }
}


public function ingresarIncidenteDocente($conn) {
  $NombreIncidente = mysqli_real_escape_string($conn, $this->NombreIncidente);
  $DetalleIncidente = mysqli_real_escape_string($conn, $this->DetalleIncidente);
  $FechaIncidente = mysqli_real_escape_string($conn, $this->FechaIncidente);
  $Urgencia = mysqli_real_escape_string($conn, $this->Urgencia);
  $TipoIncidente = mysqli_real_escape_string($conn, $this->TipoIncidente);
  $Solucion = mysqli_real_escape_string($conn, $this->Solucion);
  $IdAsignatura = mysqli_real_escape_string($conn, $this->IdAsignatura);
  $IdLaboratorio = mysqli_real_escape_string($conn, $this->IdLaboratorio);
  $IdDocente = mysqli_real_escape_string($conn, $this->IdDocente);
  $IdEstudiante = null;

  $sql = "INSERT INTO incidente (NombreIncidente, DetalleIncidente, FechaIncidente, Urgencia, TipoIncidente, Solucion, IdAsignatura, IdLaboratorio, IdEstudiante, IdDocente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
  // Verificar los valores de las variables
  var_dump($NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion, $IdAsignatura, $IdLaboratorio, $IdEstudiante, $IdDocente);
 
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssssssiiis", $NombreIncidente, $DetalleIncidente, $FechaIncidente, $Urgencia, $TipoIncidente, $Solucion, $IdAsignatura, $IdLaboratorio, $IdEstudiante, $IdDocente);
    

    if (!$stmt->execute()) {
      throw new Exception("Error al insertar el incidente: " . $stmt->error);
    }
    $stmt->close();
  } else {
    throw new Exception("Error al preparar la consulta: " . $conn->error);
  }
}




public function obtenerIncidentes($conn) {
  $sql = "SELECT incidente.*, estudiante.NombreEstudiante, docente.NombreDocente 
          FROM incidente 
          LEFT JOIN estudiante ON incidente.IdEstudiante= estudiante.IdEstudiante
          LEFT JOIN docente ON incidente.IdDocente = docente.IdDocente";
          
  $result = $conn->query($sql);

  if (!$result) {
      throw new Exception("Error al obtener los incidentes: " . $conn->error);
  }

  $incidentes = [];
  while ($row = $result->fetch_assoc()) {
      $incidentes[] = $row;
  }

  return $incidentes;
}

public function eliminarIncidente($idIncidente, $conn) {
  // Comenzar la transacción
  $conn->begin_transaction();

  try {
      // Obtener los ID de las tablas relacionadas
      $sql = "SELECT IdLaboratorio, IdAsignatura FROM incidente WHERE IdIncidente = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $idIncidente);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if ($row !== null) {
          $idLaboratorio = $row['IdLaboratorio'];
          $idAsignatura = $row['IdAsignatura'];
      } else {
          throw new Exception("El incidente con ID $idIncidente no se encontró en la base de datos.");
      }

      // Eliminar el incidente
      $sql = "DELETE FROM incidente WHERE IdIncidente = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $idIncidente);
      $stmt->execute();

      // Eliminar la entrada en la tabla laboratorio
      $sql = "DELETE FROM laboratorio WHERE IdLaboratorio = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $idLaboratorio);
      $stmt->execute();

      // Eliminar la entrada en la tabla asignatura
      $sql = "DELETE FROM asignatura WHERE IdAsignatura = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $idAsignatura);
      $stmt->execute();

      // Confirmar la transacción
      $conn->commit();
      return true;
  } catch (Exception $e) {
      // Revertir la transacción si hay un error
      $conn->rollback();
      throw new Exception("Error al eliminar el incidente: " . $e->getMessage());
  }
}





}
?>