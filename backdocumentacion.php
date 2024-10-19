<?php
session_start();
require(__DIR__.'/bd/config.php');

header('Content-Type: application/json'); // Asegura que la respuesta esté en formato JSON

$response = array(); // Inicializa un array para la respuesta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input'); // Lee el cuerpo de la solicitud
    $data = json_decode($input, true); // Decodifica el JSON en un array asociativo

    if (json_last_error() === JSON_ERROR_NONE) { // Verifica si la decodificación fue exitosa
        if (isset($data['acciontipo'])) {
            switch($data['acciontipo']){
                case 'guardaProposito':
                    // Aquí iría la lógica para guardar los datos
                    $bimestre = $data["datos_ocultos"]["bimestre"];
                    $course_id = $data["datos_ocultos"]["courseid"];
                    $user_id = $data["datos_ocultos"]["userid"];
                    $seccion = $data["datos_ocultos"]["seccion"];
                    $nsesiones = $data["nsesiones"];
                    $fecha_inicio_sesion = $data["fecha_inicio"];
                    $fecha_final_sesion = $data["fecha_fin"];
                    $competencias_id_1 = $data['competencias'][1]['competencia'];
                    $competencias_id_2 = $data['competencias'][2]['competencia'];
                    $competencias_id_3 = $data['competencias'][3]['competencia'];
                    $capacidad_id_1 = $data['competencias'][1]['capacidad'];
                    $capacidad_id_2 = $data['competencias'][2]['capacidad'];
                    $capacidad_id_3 = $data['competencias'][3]['capacidad'];
                    $desempeno_1 = $data['competencias'][1]['desempeno'];
                    $desempeno_2 = $data['competencias'][2]['desempeno'];
                    $desempeno_3 = $data['competencias'][3]['desempeno'];
                    $enfoque_id = $data["enfoque"];
                    $valor_id = $data["valor"];
                    $accion_id = $data["acciones"];
                    $evidencia = $data["evidencia_aprendizaje"];
                    $actitudes = $data["actitud_observable"];
                    $proposito = $data["proposito"];
                    $estado = guardarSesion($bimestre, $course_id, $user_id, $seccion, $nsesiones, $fecha_inicio_sesion, $fecha_final_sesion, $competencias_id_1, $competencias_id_2, $competencias_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_1, $desempeno_2, $desempeno_3, $enfoque_id, $valor_id, $accion_id, $evidencia, $actitudes, $proposito);
                    $response['message'] = $respuesta_json;
                    
                    $response['status'] = 'success';
                    if ($estado){
                        $response['message'] =  "SESION guardada de forma CORRECTA";
                    }else{
                        $response['message'] =  "Revise que todos los campos esten completos de forma correcta";
                    }
                break;
                case 'updateProposito':
                    $bimestre = $data["datos_ocultos"]["bimestre"];
                    $course_id = $data["datos_ocultos"]["courseid"];
                    $user_id = $data["datos_ocultos"]["userid"];
                    $sesion = $data["datos_ocultos"]["seccion"];
                    $nsesion = $data["nsesiones"];
                    $fecha_inicio_sesion = $data["fecha_inicio"];
                    $fecha_final_sesion = $data["fecha_fin"];
                    $competencias_id_1 = $data['competencias'][1]['competencia'];
                    $competencias_id_2 = $data['competencias'][2]['competencia'];
                    $competencias_id_3 = $data['competencias'][3]['competencia'];
                    $capacidad_id_1 = $data['competencias'][1]['capacidad'];
                    $capacidad_id_2 = $data['competencias'][2]['capacidad'];
                    $capacidad_id_3 = $data['competencias'][3]['capacidad'];
                    $desempeno_1 = $data['competencias'][1]['desempeno'];
                    $desempeno_2 = $data['competencias'][2]['desempeno'];
                    $desempeno_3 = $data['competencias'][3]['desempeno'];
                    $enfoque_id = $data["enfoque"];
                    $valor_id = $data["valor"];
                    $accion_id = $data["acciones"];
                    $evidencia = $data["evidencia_aprendizaje"];
                    $actitudes = null;
                    $proposito = $data["proposito"];
                    
                    $estado = actualizarSesion($bimestre, $course_id, $user_id, $sesion, $nsesion, $fecha_inicio_sesion, $fecha_final_sesion, $competencias_id_1, $competencias_id_2, $competencias_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_1, $desempeno_2, $desempeno_3, $enfoque_id, $valor_id, $accion_id, $evidencia, $actitudes, $proposito);

                    if($estado){
                        $response['status'] = 'success';
                        $response['message'] = 'Datos actualizados CORRECTAMENTE';
                        //$response['message'] = 'La actualizacion de los datos fueron hechos de forma CORRECTA';
                    }else{
                        $response['status'] = 'Error';
                        $response['message'] = 'No se guardaron los cambios, revise que los datos sean correctos';
                    }
                break;
                case 'guardaEvaluacion':
                        $evaluaciones = $data['evaluaciones'];
                        $alumnos = $data['alumnoid'];
                        $bimestre = $data['bimestre'];
                        $cursoid = $data['cursoid'];
                        $docente_id = $data['docente_id'];
                        $sesion = $data['sesion'];
                        //Competencias
                        $competencia_id_1 = $evaluaciones[1]['competencia'];
                        $capacidad_id_1 = $evaluaciones[1]['capacidad'];
                        $desempeno_id_1 = $evaluaciones[1]['desempeno'];
                        $competencia_id_2 = $evaluaciones[2]['competencia'];
                        $capacidad_id_2 = $evaluaciones[2]['capacidad'];
                        $desempeno_id_2 = $evaluaciones[2]['desempeno'];
                        $competencia_id_3 = $evaluaciones[3]['competencia'];
                        $capacidad_id_3 = $evaluaciones[3]['capacidad'];
                        $desempeno_id_3 = $evaluaciones[3]['desempeno'];

                        foreach($alumnos as $alumno=>$alumnoid ){
                            $ver = guardarNotasAlumnos($bimestre, $cursoid, $sesion, $docente_id, $competencia_id_1, $competencia_id_2, $competencia_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_id_1, $desempeno_id_2 , $desempeno_id_3, $alumnoid['alumnoid'], $alumnoid['valoraciones'], $alumnoid['comentarios']);
                            if ($ver){
                                $response['status'] = 'Success';
                                $response['message'] = "Notas subidas correctamente";
                            }else{
                                $response['status'] = 'Error';
                                $response['message'] = "Revise los parametros ingresados";
                            }
                        }
                break;
                case 'updateEvaluacion':
                    $evaluaciones = $data['evaluaciones'];
                    $alumnos = $data['alumnoid'];
                    $bimestre = $data['bimestre'];
                    $cursoid = $data['cursoid'];
                    $docente_id = $data['docente_id'];
                    $sesion = $data['sesion'];
                    //Competencias
                    $competencia_id_1 = $evaluaciones[1]['competencia'];
                    $capacidad_id_1 = $evaluaciones[1]['capacidad'];
                    $desempeno_id_1 = $evaluaciones[1]['desempeno'];
                    $competencia_id_2 = $evaluaciones[2]['competencia'];
                    $capacidad_id_2 = $evaluaciones[2]['capacidad'];
                    $desempeno_id_2 = $evaluaciones[2]['desempeno'];
                    $competencia_id_3 = $evaluaciones[3]['competencia'];
                    $capacidad_id_3 = $evaluaciones[3]['capacidad'];
                    $desempeno_id_3 = $evaluaciones[3]['desempeno'];

                    $ver = [$bimestre, $cursoid, $sesion, $docente_id, $competencia_id_1, $competencia_id_2, $competencia_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_id_1, $desempeno_id_2, $desempeno_id_3, 'alumnoid', 'valoraciones', 'comentarios'];

                    /*
                    foreach($alumnos as $alumno=>$alumnoid ){
                        $ver =  updateNotasAlumnos($bimestre, $cursoid, $sesion, $docente_id, $competencia_id_1, $competencia_id_2, $competencia_id_3, $capacidad_id_1, $capacidad_id_2, $capacidad_id_3, $desempeno_id_1, $desempeno_id_2, $desempeno_id_3, $alumnoid['alumnoid'], $alumnoid['valoraciones'], $alumnoid['comentarios']);                        
                        if ($ver){
                            $response['status'] = 'Success';
                            $response['message'] = "Notas subidas correctamente";
                        }else{
                            $response['status'] = 'Error';
                            $response['message'] = "Revise los parametros ingresados";
                        }
                    }
                    */
                    $response['status'] = 'test';
                    $response['message'] = $ver;
                break;
                default:
                    $response['status'] = 'error';
                    $response['message'] = 'Acción no válida';
                    break;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No hay datos válidos';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la decodificación JSON';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Método de solicitud no permitido';
}

// Envía la respuesta como JSON
echo json_encode($response);
?>
