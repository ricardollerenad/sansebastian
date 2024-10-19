<?php

// Lista todo los usuarios
function get_listar_usuarios() {
    return "
        SELECT * FROM ss_user
        ";
}

function hayNotas($usuario, $courseid){
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT * 
        FROM notas_bimestre
        WHERE user_id = :usuario
        AND moodle_course = :course_id
        LIMIT 1
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
    $stmt->bindParam(':course_id', $courseid, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el primer resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? 1 : 0; // Devuelve el nivel_id o null si no se encuentra
}

function diHola(){
    return "Hola Mundo";
}

?>
