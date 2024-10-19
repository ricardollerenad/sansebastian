<?php
require(__DIR__.'/bd/config.php');
// Iniciar la sesión
session_start();

// Verificar si se han pasado parámetros por GET
if (!empty($_GET)) {
    // Guardar los parámetros en la sesión
    $_SESSION['datos_cuenta'] = $_GET;
    $_SESSION['userid'] = $_SESSION["datos_cuenta"]["userid"];
    $_SESSION['courseid'] = $_SESSION["datos_cuenta"]["courseid"];
    $_SESSION['estado'] = $_SESSION["datos_cuenta"]["estado"];

    $userid = $_SESSION['userid'];
    $nombreUsuario = nombreUsuario($userid);

    $courseid = $_SESSION['courseid'];
    $nombreCurso = $curso = nombreCurso($courseid);
    // Datos de la pagina 
    $usuario = $nombreUsuario->firstname." ".$nombreUsuario->lastname;
    $curso = $nombreCurso->course_name;
    $bimestre = "III";
    $puedeLlenarNotas = "Si";
    $puedeCompletarDocumentacion = "Si";
} else {
    // Mensaje si no se pasan parámetros
    echo '<h1>No tiene derechos para ingresar aqui</h1>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Logo -->
        <img width="10%" src="assest/logo_ss.png" alt="Logo de la empresa" class="logo" style="margin-right:30px">
        

        <!-- Resto del contenido -->
        <h1>Bienvenido, <?php echo $usuario ?></h1>
        <p>Curso actual: <?php echo $curso ?></p>
        <p>Bimestre: <?php echo $bimestre ?></p>

        <!-- Menú interactivo -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Opciones</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php if ($puedeLlenarNotas): ?>
                                <li class="list-group-item"><a href="notas/llenar_notas.php">Llenar Notas</a></li>
                            <?php endif; ?>
                            <?php if ($puedeCompletarDocumentacion): ?>
                                <li class="list-group-item"><a href="documentacion/documentacion.php">Completar Documentación</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
