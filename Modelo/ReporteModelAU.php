<?php


include('../db.php');
class ReporteModelAU {
    private $IdReporte;
    private $NombreReporte;
    private $FechaReporte;
    private $DetalleReporte;
    private $Derivar;
    private $Estado;
    private $IdDocente;
    private $IdIncidente;
    // Constructor
    public function __construct($IdReporte = null, $NombreReporte = null, $FechaReporte = null, $DetalleReporte = null, $Derivar = null , $Estado = null , $IdDocente = null ,$IdIncidente = null  ) {
        $this->IdReporte = $IdReporte;
        $this->NombreReporte = $NombreReporte;
        $this->FechaReporte = $FechaReporte;
        $this->DetalleReporte = $DetalleReporte;
        $this->Derivar = $Derivar;
        $this->Estado = $Estado;
        $this->IdDocente = $IdDocente;
        $this->IdIncidente = $IdIncidente;
    }

    // Todos los getter y setter

    // IdReporte geter y setter

    public function getIdReporte() {
        return $this->IdReporte;
    }

    public function setIdReporte($IdReporte) {
        $this->IdReporte = $IdReporte;
    }


    //NombreReporte getter y setter
    public function getNombreReporte() {
        return $this->NombreReporte;
    }

    public function setNombreReporte($NombreReporte) {
        $this->NombreReporte = $NombreReporte;
    }

    // fecha reporte
    public function getFechaReporte() {
        return $this->FechaReporte;
    }

    public function setFechaReporte($FechaReporte) {
        $this->FechaReporte = $FechaReporte;
    }

//DetalleReporte
    public function getDetalleReporte() {
        return $this->DetalleReporte;
    }

    public function setDetalleReporte($DetalleReporte) {
        $this->DetalleReporte = $DetalleReporte;
    }

//Derivar 


public function getDerivar() {
    return $this->Derivar;
}

public function setDerivar($Derivar) {
    $this->Derivar = $Derivar;
}

//Estado Estado


public function getEstado() {
    return $this->Estado;
}

public function setEstado($Estado) {
    $this->Estado = $Estado;
}

// IdDocente 


public function getIdDocente() {
    return $this->IdDocente;
}

public function setIdDocente($IdDocente) {
    $this->IdDocente = $IdDocente;
}

//IdIncidente 

public function getIdIncidente() {
    return $this->IdIncidente;
}

public function setIdIncidente($IdIncidente) {
    $this->IdIncidente = $IdIncidente;
}


public function obtenerTodosLosReportes($conn) {
    $sql = "SELECT * FROM reporte";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error al ejecutar la consulta: " . $conn->error);
    }

    $reportes = $result->fetch_all(MYSQLI_ASSOC);

    return $reportes;
}

public function ingresarReporteAU($conn) {
    $NombreReporte = mysqli_real_escape_string($conn, $this->NombreReporte);
    $FechaReporte = mysqli_real_escape_string($conn, $this->FechaReporte);
    $DetalleReporte = mysqli_real_escape_string($conn, $this->DetalleReporte);
    $Derivar = mysqli_real_escape_string($conn, $this->Derivar);
    $Estado = mysqli_real_escape_string($conn, $this->Estado);
    $IdDocente = mysqli_real_escape_string($conn, $this->IdDocente);
   
 
 
  
    $sql = "INSERT INTO reporteau (NombreReporte, FechaReporte, DetalleReporte, Derivar, Estado, IdDocente ) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Verificar los valores de las variables
    var_dump($NombreReporte, $FechaReporte, $DetalleReporte, $Derivar, $Estado, $IdDocente );
    
    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("sssssi", $NombreReporte, $FechaReporte, $DetalleReporte, $Derivar, $Estado, $IdDocente );
      if (!$stmt->execute()) {
        throw new Exception("Error al insertar un reporte: " . $stmt->error);
      }
      $stmt->close();
    } else {
      throw new Exception("Error al preparar la consulta: " . $conn->error);
    }
  }


 


}





?>