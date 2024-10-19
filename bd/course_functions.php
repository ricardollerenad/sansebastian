<?php
require_once(__DIR__ . '/conexion.php');
require_once(__DIR__ . '/consultas.php');

function listar_usuarios() {
    $db = get_db_connection();
    $query = get_listar_usuarios();
    $stmt = $db->query($query);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function get_courses_with_categories() {
    $db = get_db_connection();
    $query = get_courses_with_categories_query();
    $stmt = $db->query($query);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "Ejecuto get_courses_with_categories()";
}

function nombreCurso ($courseid){
    // Obtener conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT 
            c.fullname AS course_name,
            cc.name AS category_name
        FROM 
            ss_course c
        JOIN 
            ss_course_categories cc ON c.category = cc.id
        WHERE 
            c.id = :courseid;
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindParam(':courseid', $courseid, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function alumnosMatriculados($courseid) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT u.id AS id, u.firstname AS nombre, u.lastname AS apellido
        FROM ss_user u
        JOIN ss_user_enrolments ue ON u.id = ue.userid
        JOIN ss_enrol e ON ue.enrolid = e.id
        WHERE e.courseid = :courseid
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':courseid', $courseid, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function competenciasCusrsos($courseid) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT * 
        FROM competencias 
        WHERE id IN (SELECT competencias_id 
        FROM competencias_categoria_cursos 
        WHERE categoria_id IN ( 
            SELECT cur.categoria_id 
            FROM cursos cur 
            INNER JOIN categoria_cursos cat ON cur.categoria_id = cat.id 
            WHERE cur.moodle_course = :courseid
        ))
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':courseid', $courseid, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function capacidadesCompetencias($competencia) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT id, capacidad
        FROM capacidades 
        WHERE competencias_id = :competencia
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':competencia', $competencia, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function enfoqueValores($enfoque) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM valores 
        WHERE enfoque_id = :enfoque
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':enfoque', $enfoque, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function valorAcciones($valor) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM actitudes_acciones 
        WHERE valores_id = :valor
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function getNivel($courseid) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT nivel_id
        FROM cursos
        WHERE moodle_course = :course_id
        LIMIT 1;
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro
    $stmt->bindParam(':course_id', $courseid, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el primer resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['nivel_id'] : null; // Devuelve el nivel_id o null si no se encuentra
}

function guardarNotas($user_id, $nivel_id, $moodle_course, $competencia_id, $bimestre, $nota, $comentario) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        INSERT INTO notas_bimestre (user_id, nivel_id, moodle_course, competencia_id, bimestre, nota, comentario, created_at, updated_at)
        VALUES (:user_id, :nivel_id, :moodle_course, :competencia_id, :bimestre, :nota, :comentario, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        ON DUPLICATE KEY UPDATE 
        nota = VALUES(nota), 
        comentario = VALUES(comentario), 
        updated_at = CURRENT_TIMESTAMP
    ";

    try {
        // Preparar la consulta
        $stmt = $db->prepare($query);

        // Asociar los parámetros
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':nivel_id', $nivel_id, PDO::PARAM_INT);
        $stmt->bindParam(':moodle_course', $moodle_course, PDO::PARAM_INT);
        $stmt->bindParam(':competencia_id', $competencia_id, PDO::PARAM_INT);
        $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_STR); 
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR); 

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar el número de filas afectadas (para confirmar que la operación fue exitosa)
        return $stmt->rowCount() > 0;

    } catch (PDOException $e) {
        // Manejo de errores
        error_log('Error en guardarNotas: ' . $e->getMessage());
        return false;
    }
}

function actualizarRegistro($userid, $bimestre, $courseid, $competenciaid, $nota, $comentario) {
    // Obtener una conexión a la base de datos
    $db = get_db_connection();
    
    // Definir la consulta SQL para actualizar las notas y comentarios del usuario
    $query = "
        UPDATE notas
        SET nota = :nota, comentario = :comentario, updated_at = NOW()
        WHERE user_id = :userid
        AND moodle_course = :courseid
        AND competencia_id = :competenciaid
        AND bimestre = :bimestre
    ";
    
    try {
        // Preparar y ejecutar la consulta
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT); 
        $stmt->bindValue(':courseid', $courseid, PDO::PARAM_INT); 
        $stmt->bindValue(':competenciaid', $competenciaid, PDO::PARAM_INT); 
        $stmt->bindValue(':bimestre', $bimestre, PDO::PARAM_INT); 
        $stmt->bindValue(':nota', $nota, PDO::PARAM_STR); 
        $stmt->bindValue(':comentario', $comentario, PDO::PARAM_STR); 
        $stmt->execute();
        
        // Verificar el número de filas afectadas
        if ($stmt->rowCount() > 0) {
            return true; // Actualización exitosa
        } else {
            return false; // Ninguna fila fue actualizada
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        error_log('Error en la actualización: ' . $e->getMessage());
        return false;
    }
}

function guardarSesion($bimestre, $course_id, $user_id, $sesion, $nsesion, $fecha_inicio_sesion, $fecha_final_sesion, $competencias_id_1, $competencias_id_2, $competencias_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_1, $desempeno_2, $desempeno_3, $enfoque_id, $valor_id, $accion_id, $evidencia, $actitudes, $proposito) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        INSERT INTO documentacion (
            bimestre, course_id, user_id, sesion, nsesion, fecha_inicio_sesion, fecha_final_sesion,
            competencias_id_1, competencias_id_2, competencias_id_3,
            capacidad_id_1, capacidad_id_2, capacidad_id_3,
            desempeno_1, desempeno_2, desempeno_3,
            enfoque_id, valor_id, accion_id, evidencia, actitudes, proposito
        ) VALUES (
            :bimestre, :course_id, :user_id, :sesion, :nsesion, :fecha_inicio_sesion, :fecha_final_sesion,
            :competencias_id_1, :competencias_id_2, :competencias_id_3,
            :capacidad_id_1, :capacidad_id_2, :capacidad_id_3,
            :desempeno_1, :desempeno_2, :desempeno_3,
            :enfoque_id, :valor_id, :accion_id, :evidencia, :actitudes, :proposito
        )
    ";

    try {
        // Preparar la consulta
        $stmt = $db->prepare($query);

        // Asociar los parámetros
        $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);
        $stmt->bindParam(':nsesion', $nsesion, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio_sesion', $fecha_inicio_sesion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_final_sesion', $fecha_final_sesion, PDO::PARAM_STR);

        // Si los valores de competencias_id, capacidad_id, y desempeno son nulos, se debe pasar null
        $stmt->bindValue(':competencias_id_1', $competencias_id_1, $competencias_id_1 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':competencias_id_2', $competencias_id_2, $competencias_id_2 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':competencias_id_3', $competencias_id_3, $competencias_id_3 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':capacidad_id_1', $capacidad_id_1, $capacidad_id_1 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':capacidad_id_2', $capacidad_id_2, $capacidad_id_2 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':capacidad_id_3', $capacidad_id_3, $capacidad_id_3 === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        // En caso de valores null para textos, se debe pasar null también
        $stmt->bindValue(':desempeno_1', $desempeno_1, $desempeno_1 === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':desempeno_2', $desempeno_2, $desempeno_2 === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':desempeno_3', $desempeno_3, $desempeno_3 === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->bindParam(':enfoque_id', $enfoque_id, PDO::PARAM_INT);
        $stmt->bindParam(':valor_id', $valor_id, PDO::PARAM_INT);
        $stmt->bindParam(':accion_id', $accion_id, PDO::PARAM_INT);

        // Los textos opcionales deben manejarse como nulos si no están definidos
        $stmt->bindValue(':evidencia', $evidencia, $evidencia === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':actitudes', $actitudes, $actitudes === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':proposito', $proposito, $proposito === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Confirmar que la operación fue exitosa
        return true;

    } catch (PDOException $e) {
        // Manejo de errores
        error_log('Error en guardar Documentación: ' . $e->getMessage());
        return false;
    }
}

function actualizarSesion($bimestre, $course_id, $user_id, $sesion, $nsesion, $fecha_inicio_sesion, $fecha_final_sesion, $competencias_id_1, $competencias_id_2, $competencias_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_1, $desempeno_2, $desempeno_3, $enfoque_id, $valor_id, $accion_id, $evidencia, $actitudes, $proposito) {

    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        UPDATE documentacion
        SET 
            nsesion = :nsesion,
            fecha_inicio_sesion = :fecha_inicio_sesion,
            fecha_final_sesion = :fecha_final_sesion,
            competencias_id_1 = :competencias_id_1,
            competencias_id_2 = :competencias_id_2,
            competencias_id_3 = :competencias_id_3,
            capacidad_id_1 = :capacidad_id_1,
            capacidad_id_2 = :capacidad_id_2,
            capacidad_id_3 = :capacidad_id_3,
            desempeno_1 = :desempeno_1,
            desempeno_2 = :desempeno_2,
            desempeno_3 = :desempeno_3,
            enfoque_id = :enfoque_id,
            valor_id = :valor_id,
            accion_id = :accion_id,
            evidencia = :evidencia,
            actitudes = :actitudes,
            proposito = :proposito
        WHERE bimestre = :bimestre
        AND course_id = :course_id
        AND user_id = :user_id
        AND sesion = :sesion
    ";

    try {
        // Preparar la consulta
        $stmt = $db->prepare($query);

        // Asociar los parámetros
        $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);
        $stmt->bindParam(':nsesion', $nsesion, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio_sesion', $fecha_inicio_sesion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_final_sesion', $fecha_final_sesion, PDO::PARAM_STR);

        // Manejar valores nulos o vacíos
        $stmt->bindValue(':competencias_id_1', !empty($competencias_id_1) ? $competencias_id_1 : null, !empty($competencias_id_1) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':competencias_id_2', !empty($competencias_id_2) ? $competencias_id_2 : null, !empty($competencias_id_2) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':competencias_id_3', !empty($competencias_id_3) ? $competencias_id_3 : null, !empty($competencias_id_3) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':capacidad_id_1', !empty($capacidad_id_1) ? $capacidad_id_1 : null, !empty($capacidad_id_1) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':capacidad_id_2', !empty($capacidad_id_2) ? $capacidad_id_2 : null, !empty($capacidad_id_2) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':capacidad_id_3', !empty($capacidad_id_3) ? $capacidad_id_3 : null, !empty($capacidad_id_3) ? PDO::PARAM_INT : PDO::PARAM_NULL);
        
        $stmt->bindValue(':desempeno_1', !empty($desempeno_1) ? $desempeno_1 : null, !empty($desempeno_1) ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':desempeno_2', !empty($desempeno_2) ? $desempeno_2 : null, !empty($desempeno_2) ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':desempeno_3', !empty($desempeno_3) ? $desempeno_3 : null, !empty($desempeno_3) ? PDO::PARAM_STR : PDO::PARAM_NULL);

        $stmt->bindParam(':enfoque_id', $enfoque_id, PDO::PARAM_INT);
        $stmt->bindParam(':valor_id', $valor_id, PDO::PARAM_INT);
        $stmt->bindParam(':accion_id', $accion_id, PDO::PARAM_INT);

        // Manejar valores nulos o vacíos para textos
        $stmt->bindValue(':evidencia', !empty($evidencia) ? $evidencia : null, !empty($evidencia) ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':actitudes', !empty($actitudes) ? $actitudes : null, !empty($actitudes) ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':proposito', !empty($proposito) ? $proposito : null, !empty($proposito) ? PDO::PARAM_STR : PDO::PARAM_NULL);

        // Ejecutar la consulta
        $stmt->execute();

        // Confirmar que la operación fue exitosa
        return true;
        
    } catch (PDOException $e) {
        // Manejo de errores
        error_log('Error en actualizar Documentación: ' . $e->getMessage());
        return false;
    }
}

function haySesion($bimestre, $course_id, $sesion) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM documentacion
        WHERE bimestre = :bimestre
        AND course_id = :course_id
        AND sesion = :sesion
    ";

    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro con el valor correspondiente
    $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
    $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el primer resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function hayEvaluacion($bimestre, $courseid, $sesion) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM notas
        WHERE bimestre = :bimestre
        AND moodle_course = :courseid
        AND sesion = :sesion
    ";
    // Preparar la consulta
    $stmt = $db->prepare($query);

    // Asociar el parámetro con el valor correspondiente
    $stmt->bindParam(':bimestre', $bimestre, PDO::PARAM_INT);
    $stmt->bindParam(':courseid', $courseid, PDO::PARAM_INT); 
    $stmt->bindParam(':sesion', $sesion, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el primer resultado
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    
}

function muestraEnfoques() {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM enfoque
    ";
    // Preparar la consulta
    $stmt = $db->prepare($query);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el primer resultado
    $result = $stmt->fetchall(PDO::FETCH_NAMED);

    return $result;
}

function muestraValores($enfoque) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM valores
        WHERE enfoque_id = :enfoque
    ";
    // Preparar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enfoque', $enfoque, PDO::PARAM_INT);
    
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el primer resultado
    $result = $stmt->fetchall(PDO::FETCH_NAMED);

    return $result;
}

function muestraActitud($valor) {
    // Obtener la conexión a la base de datos
    $db = get_db_connection();

    // Definir la consulta SQL
    $query = "
        SELECT *
        FROM actitudes_acciones
        WHERE valores_id = :valor
    ";
    // Preparar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);
    
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el primer resultado
    $result = $stmt->fetchall(PDO::FETCH_NAMED);

    return $result;
}

function testCurso() {
    return "Hola es un Ricardo";
}

?>
