<?php
require_once(__DIR__ . '/conexion.php');
require_once(__DIR__ . '/consultas.php');

function get_users_in_course($courseid) {
    $db = get_db_connection();
    $query = get_users_in_course_query($courseid);
    $stmt = $db->prepare($query);
    $stmt->bindParam(':courseid', $courseid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function nombreUsuario($userid) {
    // Obtener una conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL para obtener el nombre y apellido del usuario
    $query = "
    SELECT firstname, lastname
    FROM ss_user
    WHERE id = :userid
    ";
    
    // Preparar y ejecutar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT); // Corregido aquí
    $stmt->execute();
    
    // Obtener el resultado
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    
    // Devolver el resultado
    return $user;    
}

function obtenerRegistro($userid,$courseid,$competenciaid,$bimestre) {
    // Obtener una conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL para obtener el nombre y apellido del usuario
    $query = "
        SELECT *
        FROM notas_bimestre
        WHERE user_id = :userid
        AND moodle_course = :courseid
        AND competencia_id = :competenciaid
        AND bimestre = :bimestre
    ";
    
    // Preparar y ejecutar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT); 
    $stmt->bindValue(':courseid', $courseid, PDO::PARAM_INT); 
    $stmt->bindValue(':competenciaid', $competenciaid, PDO::PARAM_INT); 
    $stmt->bindValue(':bimestre', $bimestre, PDO::PARAM_INT); 
    $stmt->execute();
    
    // Obtener el resultado
    $rpta = $stmt->fetch(PDO::FETCH_OBJ);
    
    // Devolver el resultado
    return $rpta;
}

function guardarNotasAlumnos($bimestre, $cursoid, $sesion, $docente_id,$competencia_id_1, $competencia_id_2, $competencia_id_3,$capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_id_1, $desempeno_id_2, $desempeno_id_3, $alumno_id, $nota, $comentario) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL
    $query = "
        INSERT INTO notas (
            moodle_course,
            competencia_id_1,
            competencia_id_2,
            competencia_id_3,
            capacidad_id_1,
            capacidad_id_2,
            capacidad_id_3,
            desempeno_id_1,
            desempeno_id_2,
            desempeno_id_3,
            alumno_id,
            docente_id,
            bimestre,
            sesion,
            nota,
            comentario,
            created_at,
            updated_at
        ) VALUES (
            :cursoid,
            :competencia_id_1,
            :competencia_id_2,
            :competencia_id_3,
            :capacidad_id_1,
            :capacidad_id_2,
            :capacidad_id_3,
            :desempeno_id_1,
            :desempeno_id_2,
            :desempeno_id_3,
            :alumno_id,
            :docente_id,
            :bimestre,
            :sesion,
            :nota,
            :comentario,
            current_timestamp(),
            current_timestamp()
        );
    ";

    try {
        // Preparar la consulta
        $stmt = $db->prepare($query);

        // Asociar los parámetros
        $stmt->bindParam(':cursoid', $cursoid, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id_1', $competencia_id_1, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id_2', $competencia_id_2, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id_3', $competencia_id_3, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_1', $capacidad_id_1, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_2', $capacidad_id_2, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_3', $capacidad_id_3, PDO::PARAM_INT);
        $stmt->bindParam(':desempeno_id_1', $desempeno_id_1, PDO::PARAM_STR);
        $stmt->bindParam(':desempeno_id_2', $desempeno_id_2, PDO::PARAM_STR);
        $stmt->bindParam(':desempeno_id_3', $desempeno_id_3, PDO::PARAM_STR);
        $stmt->bindParam(':alumno_id', $alumno_id, PDO::PARAM_INT);
        $stmt->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
        $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
        $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        return $stmt->rowCount() > 0;

    } catch (PDOException $e) {
        // Manejo de errores
        error_log('Error en guardarNotas: ' . $e->getMessage());
        return false;
    }
}

function updateNotasAlumnos($bimestre, $cursoid, $sesion, $docente_id, $competencia_id_1, $competencia_id_2, $competencia_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_id_1, $desempeno_id_2, $desempeno_id_3, $alumno_id, $nota, $comentario) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL
    $query = "
        UPDATE notas
        SET
            competencia_id_1 = :competencia_id_1,
            competencia_id_2 = :competencia_id_2,
            competencia_id_3 = :competencia_id_3,
            capacidad_id_1 = :capacidad_id_1,
            capacidad_id_2 = :capacidad_id_2,
            capacidad_id_3 = :capacidad_id_3,
            desempeno_id_1 = :desempeno_id_1,
            desempeno_id_2 = :desempeno_id_2,
            desempeno_id_3 = :desempeno_id_3,
            docente_id = :docente_id,
            nota = :nota,
            comentario = :comentario,
            updated_at = current_timestamp()
        WHERE
            alumno_id = :alumno_id
            AND bimestre = :bimestre
            AND moodle_course = :cursoid
            AND sesion = :sesion
    ";

    try {
        // Preparar la consulta
        $stmt = $db->prepare($query);

        // Asociar los parámetros
        $stmt->bindParam(':competencia_id_1', $competencia_id_1, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id_2', $competencia_id_2, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id_3', $competencia_id_3, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_1', $capacidad_id_1, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_2', $capacidad_id_2, PDO::PARAM_INT);
        $stmt->bindParam(':capacidad_id_3', $capacidad_id_3, PDO::PARAM_INT);
        $stmt->bindParam(':desempeno_id_1', $desempeno_id_1, PDO::PARAM_STR);
        $stmt->bindParam(':desempeno_id_2', $desempeno_id_2, PDO::PARAM_STR);
        $stmt->bindParam(':desempeno_id_3', $desempeno_id_3, PDO::PARAM_STR);
        $stmt->bindParam(':docente_id', $docente_id, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        $stmt->bindParam(':alumno_id', $alumno_id, PDO::PARAM_INT);
        $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
        $stmt->bindParam(':cursoid', $cursoid, PDO::PARAM_INT);
        $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si la actualización fue exitosa
        return $stmt->rowCount() > 0;

    } catch (PDOException $e) {
        // Manejo de errores
        error_log('Error en actualizarNotas: ' . $e->getMessage());
        return false;
    }
}


function obtenerRegistroNotas() {
    // Obtener una conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL para obtener el nombre y apellido del usuario
    $query = "
        SELECT *
        FROM notas_bimestre
        WHERE user_id = :userid
        AND moodle_course = :courseid
        AND competencia_id = :competenciaid
        AND bimestre = :bimestre
    ";
    return $query;

    /*
    // Preparar y ejecutar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT); 
    $stmt->bindValue(':courseid', $courseid, PDO::PARAM_INT); 
    $stmt->bindValue(':competenciaid', $competenciaid, PDO::PARAM_INT); 
    $stmt->bindValue(':bimestre', $bimestre, PDO::PARAM_INT); 
    $stmt->execute();
    
    // Obtener el resultado
    $rpta = $stmt->fetch(PDO::FETCH_OBJ);
    
    // Devolver el resultado
    return $rpta;
    */
}

function testUsuario() {
    return "funcion test";
}

?>
