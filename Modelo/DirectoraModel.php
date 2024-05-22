<?php
class DirectoraModel {
    private $IdDirectora;
    private $NombreDirectora;
    private $CorreoDirectora;
    private $ContrasenaDirectora;
    private $RutDirectora;

    // Constructor
    public function __construct($IdDirectora = null, $NombreDirectora = null, $CorreoDirectora = null, $ContrasenaDirectora = null, $RutDirectora = null) {
        $this->IdDirectora = $IdDirectora;
        $this->NombreDirectora = $NombreDirectora;
        $this->CorreoDirectora = $CorreoDirectora;
        $this->ContrasenaDirectora = $ContrasenaDirectora;
        $this->RutDirectora = $RutDirectora;
    }

    // Todos los getter y setter

    public function getIdDirectora() {
        return $this->IdDirectora;
    }

    public function setIdDirectora($IdDirectora) {
        $this->IdDirectora = $IdDirectora;
    }

    public function getNombreDirectora() {
        return $this->NombreDirectora;
    }

    public function setNombreDirectora($NombreDirectora) {
        $this->NombreDirectora = $NombreDirectora;
    }

    public function getCorreoDirectora() {
        return $this->CorreoDirectora;
    }

    public function setCorreoDirectora($CorreoDirectora) {
        $this->CorreoDirectora = $CorreoDirectora;
    }

    public function getContrasenaDirectora() {
        return $this->ContrasenaDirectora;
    }

    public function setContrasenaDirectora($ContrasenaDirectora) {
        $this->ContrasenaDirectora = $ContrasenaDirectora;
    }

    public function getRutDirectora() {
        return $this->RutDirectora;
    }

    public function setRutDirectora($RutDirectora) {
        $this->RutDirectora = $RutDirectora;
    }
}
?>
