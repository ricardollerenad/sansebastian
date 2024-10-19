<?php
session_start();
require(__DIR__.'/bd/config.php');

$estado = false; // Inicializar estado
$course_id = null; // Inicializar course_id

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notas'])) {
    $notas = $_POST['notas'];

    foreach ($notas as $usuario_id => $competencias) {
        foreach ($competencias as $competencia_id => $valores) {
            $nota = $valores['nota'];
            $comentario = $valores['comentario'];
            $courseid = $valores['courseid'];
            $bimestre = $valores['bimestre'];

            // Corregir la llamada a la función y el nombre de las variables
            $estado = actualizarRegistro($usuario_id, $bimestre, $courseid, $competencia_id, $nota, $comentario);
            $course_id = $courseid; // Actualizar course_id
        }
    }
} 
else {
    echo "<h1>NO PUEDES ENTRAR AQUÍ</h1>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3;url=https://academico.sansebastian.edu.pe/course/view.php?id=<?php echo htmlspecialchars($course_id); ?>">
    <title>Redirección en 3 segundos</title>
</head>
<body>
    <?php if($estado): ?>
        <h1>Actualizó todo de manera correcta</h1>
    <?php else: ?>
        <h1>Revisar y volver a cargar</h1>
    <?php endif; ?>
    
    <h1>Espere mientras guarda y actualiza los datos...</h1>
    <p>Si no eres redirigido automáticamente, <a href="https://academico.sansebastian.edu.pe/course/view.php?id=<?php echo htmlspecialchars($course_id); ?>">haz clic aquí</a>.</p>
</body>
</html>
