<?php

include('../Modelo/LoginModel.php');
include('../Controlador/ReporteDocenteContoller.php');
include('../vendor/autoload.php');



$cuentaPerdidaHardware = 0;
$cuentaFaltaSoftware = 0;
$cuentaOtros = 0;
$controller = new ReporteDocenteController();
$reportes = $controller->mostrarReporte($conn);
$incidentes = $controller->mostrarIncidentes($conn);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice De la Jefa de carrera</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css.css"/>



<style>

table.dataTable thead tr {
  background: linear-gradient(to right, black, red, black) !important;
  /*0575e6, #00f260*/
  color: white;
}

table.dataTable tr {
  background: linear-gradient(to right, rgb(182, 101, 115)) !important;
  /*0575e6, #00f260*/
  color: black;
}

.btnnExcel{
    background: linear-gradient(#928C9B , #020005) !important; 
    color:white;
    
  }


  </style>
    
</head>
<body>

<div id="navegacion" class="container-fluid">
<?php 
if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'directora') {
  header('Location:../Vistas/Login.php');
  exit();
}

?>

<nav class="navbar navbar-expand-lg contenedor1 pb-0 mb-2">
  <div class="row container-fluid p-0 m-0">
	<div class="row col-4 text-center pb-0 pe-0 me-0">
		<div class="col-6 mb-0 pb-0 pe-0 me-0">
			<a class="pe-0 me-0" href="#"><img class="pe-0 me-0" src="../img/logo.png" width="120" height="30"></a>
		</div>
		
	</div>
    
	
    <div class="col-4 container-fluid text-center" id="navbarSupportedContent">
      
	  <div class="pt-0 mt-0">
        
		
        <li class="row nav-item text-center mt-0 pt-0 mb-0 pb-0">
		<p class="col-12 pt-0 mt-0 pb-0 mb-0 text-center">Control de Incidentes</p>
		<h5 class="col-12 text-center pb-0">Lista de Reportes</h5>
          
        </li>
		
        
      </div>
	  
	  
       
    </div>
	
	<div class="row col-4 text-center mb-0 pb-0">
		<div class="col-3 mb-0 pb-0"> </div>
		<!-- <div class="col-4 mb-0 pb-0"> </div> -->
    <div class="col-3 mb-0 pb-0"> </div>
		<div class="col-3 mb-0 pb-0">
			<a class="navbar-brand text-light mb-0 pb-0" href="#"><?php echo'Directora: '. $_SESSION['userName']; ?></a>
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






<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminarReporte'])) {
  $idReporte = $_POST['IdReporte'];
  $error = $controller->eliminarReporte($idReporte, $conn);
  if ($error !== '') {
      $errorMsg = '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  } else {
      header("Location: " . $_SERVER['PHP_SELF']); 
      exit;
  }
}


?>





</nav>

<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

use PhpOffice\PhpSpreadsheet\Style\Border;




if (isset($_POST['exportarExcel'])) {

  // Crear un objeto Spreadsheet

  $spreadsheet = new Spreadsheet();

 

  // Obtener la hoja activa del archivo

  $sheet = $spreadsheet->getActiveSheet();

 

  // Escribir el encabezado de las columnas

  $columnas = array('ID', 'NombreReporte', 'FechaReporte', 'DetalleReporte', 'Derivar', 'Estado', 'TipoIncidentes', 'Urgencia','Solucion');

  $sheet->fromArray($columnas, null, 'A1');

 

  // Aplicar estilos al encabezado de la tabla

  $headerStyle = [

    'font' => ['bold' => true],

    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],

    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],

    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EFEFEF']]

  ];

  $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

 

  // Escribir los datos de la tabla

  $fila = 2;

  foreach ($reportes as $reporte) {

    $sheet->setCellValue('A' . $fila, $reporte['IdReporte']);

    $sheet->setCellValue('B' . $fila, $reporte['NombreReporte']);

    $sheet->setCellValue('C' . $fila, $reporte['FechaReporte']);

    $sheet->setCellValue('D' . $fila, $reporte['DetalleReporte']);

    $sheet->setCellValue('E' . $fila, $reporte['Derivar']);

    $sheet->setCellValue('F' . $fila, $reporte['Estado']);

   

    // Obtener los datos de TipoIncidentes y Urgencia

    $tipoIncidente = '';

    $urgencia = '';
    
    $solucion = '';
    foreach ($incidentes as $incidente) {

      if ($incidente['IdIncidente'] == $reporte['IdIncidente']) {

        $tipoIncidente = $incidente['TipoIncidente'];

        $urgencia = $incidente['Urgencia'];
        $solucion = $incidente['Solucion'];
        break;

      }

    }

   

    $sheet->setCellValue('G' . $fila, $tipoIncidente);

    $sheet->setCellValue('H' . $fila, $urgencia);

    $sheet->setCellValue('I' . $fila, $solucion);

    $fila++;

  }

 

  // Aplicar estilos a los datos de la tabla

  $dataStyle = [

    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],

    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]

  ];

  $sheet->getStyle('A2:I' . ($fila - 1))->applyFromArray($dataStyle);

 

  // Autoajustar el ancho de las columnas

  foreach (range('A', 'I') as $column) {

    $sheet->getColumnDimension($column)->setAutoSize(true);

  }

 

  // Crear un objeto Writer para guardar el archivo de Excel

  $writer = new Xlsx($spreadsheet);

 

  // Establecer las cabeceras para descargar el archivo

  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

  header('Content-Disposition: attachment;filename="tabla.xlsx"');

  header('Cache-Control: max-age=0');

 

  // Guardar el archivo en la salida (output)

  $writer->save('php://output');

 

  exit;

}

?>

<div class="container">

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="hidden" name="exportarExcel" value="1">
  <button type="submit" class="btn btn-dark mb-2 btnnExcel">Convertir a Excel</button>
</form>
<div class="row table-responsive">
<table id = "tablaReportes" class="table table-striped table-hover table-sm" style="font-size:12px;">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Reporte</th>
      <th scope="col">Fecha Reporte</th>
      <th scope="col">Detalle Reporte</th>
      <th scope="col">Derivar</th>
      <th scope="col">Estado</th>
      <th scope="col">Tipo Incidentes</th>
      <th scope="col">Urgencia</th>
      <th scope="col">Solucion</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($reportes as $reporte): ?>
    <tr>


      <th scope="row"><?php echo $reporte['IdReporte']; ?></th> 
      <td><?php echo $reporte['NombreReporte']; ?></td>
      <td><?php echo $reporte['FechaReporte']; ?></td>
      <td><?php echo $reporte['DetalleReporte']; ?></td>
      <td><?php echo $reporte['Derivar']; ?></td>
      <td><?php echo $reporte['Estado']; ?></td>

      <td>
        <?php
          foreach ($incidentes as $incidente) {
            if ($reporte['IdIncidente'] == $incidente['IdIncidente']) {
              echo $incidente['TipoIncidente'];
              if($incidente['TipoIncidente'] == "Perdida de hadware"){
                $cuentaPerdidaHardware++;
              }elseif($incidente['TipoIncidente'] == "Falta de un software"){
                $cuentaFaltaSoftware++;
              }elseif($incidente['TipoIncidente'] == "Otros"){
                $cuentaOtros++;
              }
              break;
            }
          }
        ?>
      </td>

      <td>
        <?php
          foreach ($incidentes as $incidente) {
            if ($reporte['IdIncidente'] == $incidente['IdIncidente']) {
              echo $incidente['Urgencia'];
              break;
            }
          }
          
        ?>
      </td>
    
      <td>
        <?php
          foreach ($incidentes as $incidente) {
            if ($reporte['IdIncidente'] == $incidente['IdIncidente']) {
              echo $incidente['Solucion'];
              break;
            }
          }
          
        ?>
      </td>
</td>

<td> 

<div id="contenedorBotones" style="display: flex;">
    <!-- Formulario para eliminar -->
    <form method="post" style="margin-right: 10px; " onsubmit="return confirm('¿Estás seguro de que deseas eliminar este Reporte?');">
        <input type="hidden" name="IdReporte" value="<?php echo $reporte['IdReporte']; ?>">
        <!-- <button type="submit" class="btn btn-danger border-dark border-2 border-bottom shadow" id="deleteForm" name="eliminarReporte">Eliminar</button> -->
        <button type="submit" class="btn border border-dark" style="background: linear-gradient(60grad, white, red, white) !important; color:white;" id="deleteForm" name="eliminarReporte">Eliminar</button>
      </form>

    <!-- Formulario para actualizar -->
    <form method="post" action="EditarDirectoraRegistro.php" style="margin-right: 10px;">
        <input type="hidden" name="IdReporte" value="<?php echo $reporte['IdReporte'];?>">
        <!-- <button type="submit" class="btn btn-warning border-dark border-2 border-bottom shadow" id="ActualizarReporte" name="ActualizarReporte">Editar</button> -->
        <button type="submit" class="btn border border-dark" style="background: linear-gradient(60grad, white, #fac01fe7, white) !important; color:black;" id="ActualizarReporte" name="ActualizarReporte">Editar</button>
      </form>

    <!-- Formulario para mostrar -->
    <form method="post" action="MostrarDirectora.php" style="margin-right: 10px;">
        <input type="hidden" name="IdReporte" value="<?php echo $reporte['IdReporte']; ?>">
        <button type="submit" class="btn border border-dark" style="background: linear-gradient(60grad, white, green, white) !important; color:white;" id="Mostrar" name="Mostrar">Mostrar</button>
    </form>

  
</div>


</td>


    </tr>
  <?php endforeach; ?>


  

</tbody>

</table>

</div>

<?php 
      echo "<p class='btn btn-success'>Perdida de hardware: ".$cuentaPerdidaHardware." | Falta de software: ".$cuentaFaltaSoftware." | Otros: ".$cuentaOtros."</p>";

    ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#tablaReportes').DataTable({
                "language":{
                    
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ reportes",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ reportes)",
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
    "info": "Mostrando _START_ a _END_ de _TOTAL_ reportes",
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