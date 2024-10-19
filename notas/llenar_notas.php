<?php
// Iniciar la sesión
require(dirname(__DIR__,1).'/bd/config.php');
session_start();

if (!empty($_GET)) {
    // Guardar los parámetros en la sesión
    $_SESSION['datos_cuenta'] = $_GET;
    $_SESSION['userid'] = $_SESSION["datos_cuenta"]["userid"];
    $_SESSION['courseid'] = $_SESSION["datos_cuenta"]["courseid"];
    $_SESSION['estado'] = $_SESSION["datos_cuenta"]["estado"];

    $userid = $_SESSION['userid'];
    $nombreUsuario = nombreUsuario($userid);
    $courseid = $_SESSION['courseid'];
    $nombreCurso = nombreCurso($courseid);
    // Datos de la pagina 
    $usuario = $nombreUsuario->firstname." ".$nombreUsuario->lastname;
    $curso = $nombreCurso->course_name;
    $puedeLlenarNotas = "Si";
    $puedeCompletarDocumentacion = "Si";
} 

if (!empty($_SESSION['userid'])) {
    // Guardar los parámetros en la sesión
        $bimestre= 3;
        $courseid = $_SESSION['courseid'];
        $nombreCurso = $curso = nombreCurso($courseid);
        $nombreCurso = $nombreCurso->course_name;
        
    // Listado de Alumnos del curso 
        $competencias = competenciasCusrsos($courseid);
        $competencias_ids = array_column($competencias, 'id');
        $nivel_id = getNivel($courseid);
        $usuarios = alumnosMatriculados($courseid);

        $usuarios = array_filter($usuarios, function($value) {
                return $value !== null;
            });

        $usuarios_ids = array_column($usuarios, 'id');
       
        //Comprueba si hay o no registros
        $contador=0;
        foreach($usuarios_ids as $usuario_id){
            $contador = $contador + hayNotas($usuario_id,$courseid);
            }
        //echo "<h1 style='color:white'>".$contador."</h1>";
    
    //Accion si no hay registros
        if($contador){
            echo "Entro al contador";
            // Guarda las notas 
            /*
            echo var_dump($usuarios_ids);
            foreach ($usuarios_ids as $usuario_id){
                foreach ($competencias_ids as $competencia_id) {
                    $result = guardarNotas(
                        $usuario_id,
                        $nivel_id,
                        $moodle_course,
                        $competencia_id,
                        $capacidad_id,
                        $desempeno_id,
                        $bimestre,
                        $courseid,
                        $sesion,
                        $nota,
                        $comentario

                        --
                        $courseid, 
                        $competencia_id, 
                        $bimestre, 
                        '--', 
                        '--'
                    );
                    if ($result) {
                        // echo "Datos guardados para usuario ID: {$usuario['id']}, competencia ID: $competencia_id\n";
                    } else {
                        echo "Error al guardar datos para usuario ID: {$usuario['id']}, competencia ID: $competencia_id\n";
                    }
                }
            }
            */
        }
    // Accion si hay registros
        else{
            //echo "NO Entro al contador";
        }
    
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
    <title>Reporte de Notas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/notas.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 sticky-header">Notas del Curso: <span style="color:blue"><?php echo $nombreCurso?> </span></h1>

        <!-- Tabla de Reporte de Notas -->
        <form id="notasForm" action="https://academico.sansebastian.edu.pe/docentes/backdoor.php" method="post">
            <table class="table table-bordered" style="2px border red">
                <thead>
                    <tr>
                        <th>#</th> 
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <?php foreach ($competencias as $competencia): ?>
                            <th><?php echo htmlspecialchars($competencia['competencia']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $rowNumber = 1; // Variable para la numeración de filas ?>
                    <?php 
                        //echo var_dump($usuarios_ids);
                        foreach ($usuarios_ids as $usuario): 
                        $temp = nombreUsuario($usuario);
                    ?>
                        <tr name="notas[<?php echo htmlspecialchars($usuario); ?>]">
                            <td><?php echo $rowNumber++; ?></td> 
                            <td><?php echo htmlspecialchars($temp->firstname); ?></td>
                            <td><?php echo htmlspecialchars($temp->lastname); ?></td>
                            <?php 
                                
                                foreach ($competencias as $competencia): 
                                    /*
                                    $valores = obtenerRegistro($usuario,$courseid,$competencia['id'],$bimestre);
                                    $selectedOption = $valores->nota;
                                    $comentario = $valores->comentario;
                                    echo "<h1>$valores->id</h1>";
                                    echo "<br>";
                                    */
                            ?>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" name="notas[<?php echo htmlspecialchars($usuario); ?>][<?php echo htmlspecialchars($competencia['id']); ?>][nota]">
                                            <option value="">Seleccionar</option>
                                            <option value="AD" <?php echo $selectedOption === 'AD' ? 'selected' : ''; ?>>AD</option>
                                            <option value="A" <?php echo $selectedOption === 'A' ? 'selected' : ''; ?>>A</option>
                                            <option value="B" <?php echo $selectedOption === 'B' ? 'selected' : ''; ?>>B</option>
                                            <option value="C" <?php echo $selectedOption === 'C' ? 'selected' : ''; ?>>C</option>
                                        </select>
                                        <textarea class="form-control mt-2" rows="2"   name="notas[<?php echo htmlspecialchars($usuario); ?>][<?php echo htmlspecialchars($competencia['id']); ?>][comentario]"><?php echo htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        <input type="hidden" name="notas[<?php echo htmlspecialchars($usuario); ?>][<?php echo htmlspecialchars($competencia['id']); ?>][courseid]" value="<?php echo htmlspecialchars($courseid); ?>">
                                        <input type="hidden" name="notas[<?php echo htmlspecialchars($usuario); ?>][<?php echo htmlspecialchars($competencia['id']); ?>][bimestre]" value="<?php echo htmlspecialchars($bimestre); ?>">
                                    </div>
                                </td>   
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="<?php echo count($competencias) + 2; ?>" class="text-center">
                            <button type="submit" name="action" value="save" class="btn btn-success">Guardar</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="../assets/js/scripts.js"></script>
</body>
</html>

