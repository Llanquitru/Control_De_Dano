<?php
class DocenteModel {
    private $IdDocente;
    private $NombreDocente;
    private $CorreoDocente;
    private $ContrasenaDocente;

    // Constructor
    public function __construct($IdDocente = null, $NombreDocente = null, $CorreoDocente = null, $ContrasenaDocente = null) {
        $this->IdDocente = $IdDocente;
        $this->NombreDocente = $NombreDocente;
        $this->CorreoDocente = $CorreoDocente;
        $this->ContrasenaDocente = $ContrasenaDocente;
    }

    // Todos los geter y setter mijo

    public function getIdDocente() {
        return $this->IdDocente;
    }

    public function setIdDocente($IdDocente) {
        $this->IdDocente = $IdDocente;
    }

    public function getNombreDocente() {
        return $this->NombreDocente;
    }

    public function setNombreDocente($NombreDocente) {
        $this->NombreDocente = $NombreDocente;
    }

    // Getter y Setter para Seccion
    public function getCorreoDocente() {
        return $this->CorreoDocente;
    }

    public function setCorreoDocente($CorreoDocente) {
        $this->CorreoDocente = $CorreoDocente;
    }

    public function getContrasenaDocente() {
        return $this->ContrasenaDocente;
    }

    public function setContrasenaDocente($ContrasenaDocente) {
        $this->ContrasenaDocente = $ContrasenaDocente;
    }
}
?>
