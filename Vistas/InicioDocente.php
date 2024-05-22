<?php

include('../Modelo/LoginModel.php');
include('../Controlador/IncidenteDocenteController.php');



$controller = new IncidenteDocenteController();
$incidentes = $controller->mostrarIncidentes($conn);
$asignaturas = $controller->mostrarAsignatura($conn);
$laboratorios = $controller->mostrarLaboratorio($conn); 


ob_start();




$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarIncidente'])) {
    $idIncidente = $_POST['idIncidente'];
    $error = $controller->eliminarIncidente($idIncidente, $conn);
    if ($error !== '') {
        $errorMsg = '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    } else {
        header("Location: " . $_SERVER['PHP_SELF']); // Redirigir a la misma página
        exit;
    }
}

// Asegúrate de tener esta función en tu controlador



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice del docente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../css.css"/>


  <style>
  
  
  .nav-link.ml-auto {
    margin-left: auto;
  }

  table.dataTable thead tr{
            background: linear-gradient(to right, black, red, black) !important; /*0575e6, #00f260*/
            color: white;
        }

        table.dataTable tr{
            background: linear-gradient(to right, rgb(182, 101, 115)) !important; /*0575e6, #00f260*/
            color:black;
        }

  .contenedorBotones button{
            background: linear-gradient(to right, black, red, black) !important; /*0575e6, #00f260*/
            color: white;
  }

  .derivar{
    background: linear-gradient(to left, yellow, #008923) !important; /*0575e6, #00f260*/
    color: white !important;
  }

  #navegacion{
    background: linear-gradient(to right, black, red, black) !important; /*0575e6, #00f260*/
            color: white;
  }

  .nav-item a, .nav-item img{
    color:white;
  }

  .btnnEliminar{
    background: linear-gradient(60grad, white, red, white) !important; 
    color:white;
    
  }

  .btnnMostrar{
    background: linear-gradient(60grad, white, green, white) !important; 
    color:white;
    
  }

  .btnnActualizar{
    background: linear-gradient(60grad, white, #fac01fe7, white) !important; 
    color:black;
  }

  .btnnNIncidente{
    background: linear-gradient(#928C9B , #020005) !important; 
    color:white;
  }

  .btnnNReporte{
    background: linear-gradient(#91A6DC , #000B6C) !important; 
    color:white;
  }
  
</style>

    
</head>
<body>

<div id="navegacion" class="container-fluid">
<?php 

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'docente') {
  header('Location:../Vistas/Login.php');
  exit();
}


// echo 'Bienvenido ' . $_SESSION['userName'] . '!';
?>

<nav class="navbar navbar-expand-lg contenedor1 pb-0 mb-2">
  <div class="row container-fluid p-0 m-0">
	<div class="row col-4 text-center pb-0 pe-0 me-0">
		<div class="col-6 mb-0 pb-0 pe-0 me-0">
			<a class="pe-0 me-0" href="#"><img class="pe-0 me-0" src="../img/logo.png" width="120" height="30"></a>
		</div>
		<!-- <div class="col-12 mb-0 pb-0 pe-0 me-0">
			<a class="navbar-brand text-light pb-0 mb-0" href="#">
			<a class="navbar-brand text-light pb-0 mb-0" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
</svg>
			</a>
				
			<p class="mb-0 pb-2">Volver</p>
			</a>
			
		</div> -->
	</div>
    
	
    <div class="col-4 container-fluid text-center" id="navbarSupportedContent">
	    <div class="pt-0 mt-0">
        
        <li class="row nav-item text-center mt-0 pt-0 mb-0 pb-0">
		    <p class="col-12 pt-0 mt-0 pb-0 mb-0 text-center">Incidentes Area informatica</p>
		    <h5 class="col-12 text-center pb-0">Lista de Incidentes</h5>  
        </li>
		 
      </div>
    </div>

	
	<div class="row col-4 text-center mb-0 pb-0">
		<div class="col-3 mb-0 pb-0"> </div>
		<!-- <div class="col-4 mb-0 pb-0"> </div> -->
    <div class="col-3 mb-0 pb-0"> </div>
		<div class="col-3 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="#"><?php echo 'Docente : ' . $_SESSION['userName']; ?></a>
		</div>
    
		<div class="col-12 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="../Salir.php">
			<a class="navbar-brand text-light mb-0 pb-0" href="../Salir.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg>
			</a>
			<p class="mb-0 pb-2">Salir</p>
			</a>
		</div>
	</div>
  </div>
</div><!--cierra el container-fluid-->
  



</nav>

<div class="container ps-0 ms-0 pb-3">
  <div">
    <a href="IncidenteDocente.php" class="btn btn-dark border-dark border-2 col-2 btnnNIncidente">Nuevo Incidente</a>
    <a href="ReporteDocente.php" class="btn btn-primary border-dark border-2 col-2 btnnNReporte">Crear Reporte</a>
  </div>
    
</div>
<div class="table-responsive">
<table id="tablaIncidentes" class="table table-hover table-striped table-sm" style="font-size:12px">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Incidente</th>
      <th scope="col">Detalle del incidente</th>
      <th scope="col">Urgencia</th>
      <th scope="col">Tipo Incidente</th>
      <th scope="col">Solucion</th>
      <th scope="col">Asignatura</th>
      <th scope="col">Seccion</th>
      <th scope="col">Laboratorio</th>
      <th scope="col">Salon</th>
      <th scope="col">Usuario que ingreso</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($incidentes as $incidente): ?>
    <tr>


      <th scope="row"><?php echo $incidente['IdIncidente']; ?></th> 
      <td><?php echo $incidente['NombreIncidente']; ?></td>
      <td><?php echo $incidente['DetalleIncidente']; ?></td>
      <td><?php echo $incidente['Urgencia']; ?></td>
      <td><?php echo $incidente['TipoIncidente']; ?></td>
      <td><?php echo $incidente['Solucion']; ?></td>
      <td>
        <?php
          foreach ($asignaturas as $asignatura) {
            if ($asignatura['IdAsignatura'] == $incidente['IdAsignatura']) {
              echo $asignatura['NombreAsignatura'];
              break;
            }
          }
        ?>
      </td>
      <td>
        <?php
          foreach ($asignaturas as $asignatura) {
            if ($asignatura['IdAsignatura'] == $incidente['IdAsignatura']) {
              echo $asignatura['Seccion'];
              break;
            }
          }
        ?>
      </td>
      <td>
        <?php
          foreach ($laboratorios as $laboratorio) {
            if ($laboratorio['IdLaboratorio'] == $incidente['IdLaboratorio']) {
              echo $laboratorio['NombreLaboratorio'];
              break;
            }
          }
        ?>
      </td>
      <td>
        <?php
          foreach ($laboratorios as $laboratorio) {
            if ($laboratorio['IdLaboratorio'] == $incidente['IdLaboratorio']) {
              echo $laboratorio['Salon'];
              break;
            }
          }
        ?>
      </td>
      <td >
  <?php  
    if (!is_null($incidente['NombreEstudiante'])) {
      // Si NombreEstudiante no es NULL, entonces un estudiante reportó el incidente
      echo htmlspecialchars($incidente['NombreEstudiante']) . ' (Estudiante)';
    } elseif (!is_null($incidente['NombreDocente'])) {
      // Si NombreDocente no es NULL, entonces un docente reportó el incidente
      echo htmlspecialchars($incidente['NombreDocente']) . ' (Docente)';
    } else {
      // Si ambos son NULL, entonces no sabemos quién reportó el incidente
      echo 'Desconocido';
    }
  ?>
</td>
</td>

<td> 

<div style="display: flex;">
    <!-- Formulario para eliminar -->
    <form method="post" style="margin-right: 10px;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este incidente?');">
    <input type="hidden" name="idIncidente" value="<?php echo $incidente['IdIncidente']; ?>">
    <button type="submit" class="btn btn-danger btnnEliminar" id="deleteForm" name="eliminarIncidente">Eliminar</button>
</form>

    <!-- Formulario para actualizar -->
    <form method="post" action="EditarDocente.php" style="margin-right: 10px;">
        <input type="hidden" name="idIncidente" value="<?php echo $incidente['IdIncidente']; ?>">
        <button type="submit" class="btn btn-warning btnnActualizar" id="actualizar" name="Actualizar">Editar</button>
    </form>

    <!-- Formulario para mostrar -->
    <form method="post" action="MostrarDocente.php" style="margin-right: 10px;">
        <input type="hidden" name="idIncidente" value="<?php echo $incidente['IdIncidente']; ?>">
        <button type="submit" class="btn btn-success btnnMostrar" id="Mostrar" name="Mostrar">Mostrar</button>
    </form>

  
</div>


</td>


    </tr>
  <?php endforeach; ?>
</tbody>
</table>

</div> 


<script>
document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    let searchSelect = document.getElementById('searchSelect');
    let searchValue = searchSelect.value.trim().toLowerCase();

    let rows = document.querySelectorAll('tbody tr');

    rows.forEach(function (row) {
        let seccion = row.querySelector('td:nth-child(8)').textContent.trim().toLowerCase();

        if (seccion === searchValue || searchValue === '') {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


document.getElementById('deleteForm').addEventListener('submit', function (event) {
    setTimeout(function () {
        location.reload();
    }, 500);
});


</script>

<?php
  if ($errorMsg !== '') {
      echo $errorMsg;
  }
  ?>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#tablaIncidentes').DataTable({
                "language":{
                    
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ incidentes",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 incidentes",
    "infoFiltered": "(filtrado de un total de _MAX_ incidentes)",
    "search": "Filtrar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStartsWith": "No empieza con",
                "notEndsWith": "No termina con"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ incidentes",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "name": "Nombre:",
            "order": "Clasificación",
            "paging": "Paginación",
            "search": "Busqueda",
            "select": "Seleccionar",
            "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
            },
            "title": "Crear Nuevo Estado",
            "toggleLabel": "Incluir:"
        },
        "emptyError": "El nombre no puede estar vacio",
        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
        "removeError": "Error al eliminar el registro",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "renameLabel": "Nuevo nombre para %s",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado"
    }
}
                
            });
        });
    </script>
</body>
</html>
