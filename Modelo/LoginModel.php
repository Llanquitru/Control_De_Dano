
<?php
include('../db.php');

class LoginModel {
  private $db;

  public function __construct() {
    global $conn;
    $this->db = $conn;
  }

  public function authenticateUser($username, $password) {
    // Lógica para autenticar al usuario y determinar su tipo de usuario
    // En este ejemplo, supondremos que el tipo de usuario es 'directora', 'docente' o 'estudiante'

    // Buscar al usuario en las tablas correspondientes según su tipo
    $userType = '';
    $query = '';
    if ($this->userExistsInTable($username, 'directora')) {
      $userType = 'directora';
      $query = "SELECT * FROM directora WHERE NombreDirectora = ? AND ContrasenaDirectora = ?";
    } else if ($this->userExistsInTable($username, 'docente')) {
      $userType = 'docente';
      $query = "SELECT * FROM docente WHERE NombreDocente = ? AND ContrasenaDocente = ?";
    } else if ($this->userExistsInTable($username, 'estudiante')) {
      $userType = 'estudiante';
      $query = "SELECT * FROM estudiante WHERE NombreEstudiante = ? AND ContrasenaEstudiante = ?";
    }

    // Si se encontró al usuario, verificar que la contraseña sea correcta
    if ($userType != '') {
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ss', $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $userInfo = $result->fetch_assoc();
        if ($userType === 'estudiante') {
            $_SESSION['IdEstudiante'] = $userInfo['IdEstudiante']; // Establecer el ID del estudiante en la variable de sesión
        } elseif ($userType === 'docente') {
            $_SESSION['IdDocente'] = $userInfo['IdDocente']; // Establecer el ID del docente en la variable de sesión
        }
        return $userType;
    }
    }

    // Si la autenticación falló, devolver false
    return false;
  }

  private function userExistsInTable($username, $tableName) {
    $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM $tableName WHERE Nombre${tableName} = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
  }

  public function getUserInfo($username, $userType) {
    // Lógica para buscar la información de usuario en su respectiva tabla en la base de datos
    // Devolver la información de usuario como un array asociativo
    $stmt = $this->db->prepare("SELECT * FROM $userType WHERE Nombre${userType} = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }
}
?>