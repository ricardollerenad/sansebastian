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
    $nombreCurso = $curso = nombreCurso($courseid);
    // Datos de la pagina 
    $usuario = $nombreUsuario->firstname." ".$nombreUsuario->lastname;
    $curso = $nombreCurso->course_name;
    $bimestre = "III";
    $puedeLlenarNotas = "Si";
    $puedeCompletarDocumentacion = "Si";
}


if (!empty($_SESSION['userid'])) {
    
    $bimestre= 3;
    $courseid = $_SESSION['courseid'];
    $userid = $_SESSION['userid'];
    $nombreCurso = $curso = nombreCurso($courseid);
    $nombreCurso = $nombreCurso->course_name;
    $usuario_id = $_SESSION['userid'];
    $n_sesiones=36;

    $competencias =competenciasCusrsos($courseid);

} else {
    // Mensaje si no se pasan parámetros
    require(__DIR__.'/config.php');
    echo '<h1>No tiene derechos para ingresar aqui</h1>';
}

/*
$nombreCurso = nombreCurso($courseid);
$nombreCurso = $nombreCurso->course_name;
*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación para el curso</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/documentacion.css">
    <!-- Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 sticky-header">CUR: <span style="color:blue"><?php echo $nombreCurso ?> </span> BIMESTRE - <span style="color:blue"><?php echo $bimestre ?> </span></h1>

        <!-- Secciones con Toggle -->
        <div id="accordion">
            <?php for ($i = 1; $i <= $n_sesiones; $i++): ?>
                <div class="card">
                    <!-- CABECERA DIV DE SECCION -->
                    <div class="card-header" id="heading<?php echo $i; ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                Sección <?php echo $i; ?>
                            </button>
                        </h5>
                    </div>
                    <!-- AREA DENTRO DEL DIV DE SECCION -->
                    <div id="collapse<?php echo $i; ?>" class="collapse" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
                        <div class="card-body">
                            <!-- INICIA EL FORM -->
                            <form action="#" method="post" enctype="multipart/form-data" id="sesiones<?php echo $n_sesiones?>">
                                <div id="accordion<?php echo $i; ?>">
                                    <!-- Propósitos de Aprendizaje -->
                                        <!-- Consulta a la base de datos -->
                                            <?php
                                                $datoSesion = haySesion($bimestre, $courseid, $i);
                                                if(isset($datoSesion['id'])){
                                            ?>
                                        <!-- Tabla con datos -->
                                            <div class="card bg-crema-bajo">
                                                <div class="card-header" id="heading<?php echo $i; ?>-1">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>-1" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>-1">
                                                            Propósitos de Aprendizaje
                                                        </button>
                                                    </h5>
                                                </div>
                                                <!-- Datos de la Sesion -->
                                                <?php ?>
                                                <div id="collapse<?php echo $i; ?>-1" class="collapse" aria-labelledby="heading<?php echo $i; ?>-1" data-parent="#accordion<?php echo $i; ?>">
                                                    <div class="card-body">
                                                        <!-- Datos ocultos -->
                                                        <div class="form-row d-none">
                                                            <input type="hidden" id="courseid<?php echo $i; ?>" name="courseid" value="<?php echo $courseid; ?>">
                                                            <input type="hidden" id="userid<?php echo $i; ?>" name="userid" value="<?php echo $userid; ?>">
                                                            <input type="hidden" id="bimestre<?php echo $i; ?>" name="bimestre" value="<?php echo $bimestre; ?>">
                                                            <input type="hidden" id="seccion<?php echo $i; ?>" name="seccion" value="<?php echo $i; ?>">
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Rango de Fechas -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="nsesiones<?php echo $i; ?>">Cantidad de Horas</label>
                                                                <input 
                                                                    type="number" 
                                                                    id="nsesiones<?php echo $i; ?>" 
                                                                    name="nsesiones" 
                                                                    class="form-control" 
                                                                    placeholder="Seleccionar fecha de fin" 
                                                                    step="1" 
                                                                    min="1"  
                                                                    value="<?php echo $datoSesion["nsesion"]  ?>" 
                                                                >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="startDate<?php echo $i; ?>">Fecha de Inicio</label>
                                                                <input type="text" id="startDate<?php echo $i; ?>" name="startDate" class="form-control datepicker" placeholder="Seleccionar fecha de inicio" value="<?php echo $datoSesion["fecha_inicio_sesion"]  ?>" >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="endDate<?php echo $i; ?>">Fecha de Fin</label>
                                                                <input type="text" id="endDate<?php echo $i; ?>" name="endDate" class="form-control datepicker" placeholder="Seleccionar fecha de fin" value="<?php echo $datoSesion["fecha_final_sesion"]  ?>" >
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Competencia, Capacidad, Desempeño -->
                                                        <div class="form-row" data-id="<?php echo $i; ?>">
                                                            <!-- Bloque 1 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>1">COMPETENCIA N°1</label>
                                                                <select id="competencia<?php echo $i; ?>1" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id_1']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>1">CAPACIDAD N°1</label>
                                                                <select id="capacidad<?php echo $i; ?>1" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id_1']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id_1']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>1">DESEMPEÑO N°1</label>
                                                                <textarea id="desempeno<?php echo $i; ?>1" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno_1'] ?></textarea>
                                                            </div>

                                                            <!-- Bloque 2 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>2">COMPETENCIA N°2</label>
                                                                <select id="competencia<?php echo $i; ?>2" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id_2']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>2">CAPACIDAD N°2</label>
                                                                <select id="capacidad<?php echo $i; ?>2" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id_2']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id_2']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>2">DESEMPEÑO N°2</label>
                                                                <textarea id="desempeno<?php echo $i; ?>2" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno_2'] ?></textarea>
                                                            </div>

                                                            <!-- Bloque 3 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>3">COMPETENCIA N°3</label>
                                                                <select id="competencia<?php echo $i; ?>3" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id_3']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>3">CAPACIDAD N°3</label>
                                                                <select id="capacidad<?php echo $i; ?>3" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id_3']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id_3']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>3">DESEMPEÑO N°3</label>
                                                                <textarea id="desempeno<?php echo $i; ?>3" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno_3'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Enfoques, Valores y Actitudes y acciones -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="enfoque<?php echo $i; ?>">ENFOQUE</label>
                                                                <select id="enfoque<?php echo $i; ?>" name="enfoque<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php 
                                                                        $enfoques = muestraEnfoques();
                                                                        foreach ($enfoques as $enfoque) : 
                                                                            $selected = ($enfoque['id'] === $datoSesion['enfoque_id']) ? 'selected' : '';
                                                                            echo "<option value=\"{$enfoque['id']}\" $selected>{$enfoque['enfoque']}</option>"; 
                                                                        endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="valor<?php echo $i; ?>">VALOR</label>
                                                                <select id="valor<?php echo $i; ?>" name="valor<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php 
                                                                        $valores = muestraValores($datoSesion['enfoque_id']);
                                                                        foreach ($valores as $valor) : 
                                                                            $selected = ($valor['id'] === $datoSesion['valor_id']) ? 'selected' : '';
                                                                            echo "<option value=\"{$valor['id']}\" $selected>{$valor['valor']}</option>"; 
                                                                        endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="acciones<?php echo $i; ?>">ACTITUDES Y ACCIONES</label>
                                                                <select id="acciones<?php echo $i; ?>" name="acciones<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php 
                                                                        $acciones = muestraActitud($datoSesion['valor_id']);
                                                                        foreach ($acciones as $accion) : 
                                                                            $selected = ($accion['id'] === $datoSesion['accion_id']) ? 'selected' : '';
                                                                            echo "<option value=\"{$accion['id']}\" $selected>{$accion['accion']}</option>"; 
                                                                        endforeach;
                                                                     ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Propósito -->
                                                        <div class="form-group">
                                                            <label class="text-light bg-info pl-5 pr-5" for="proposito<?php echo $i; ?>">PROPÓSITO</label>
                                                            <textarea id="proposito<?php echo $i; ?>" name="proposito" class="form-control" rows="3" placeholder="Ingrese propósito"><?php echo htmlspecialchars($datoSesion['proposito']); ?></textarea>
                                                        </div>
                                                        <hr class="custom-hr">


                                                        <!-- Evidencia de Aprendizaje -->
                                                        <div class="form-group">
                                                            <label class="text-light bg-info pl-5 pr-5" for="evidencia<?php echo $i; ?>">EVIDENCIA DE APRENDIZAJE</label>
                                                            <textarea id="evidencia<?php echo $i; ?>" name="evidencia" class="form-control" rows="3" placeholder="Ingrese evidencia de aprendizaje"><?php echo htmlspecialchars($datoSesion['evidencia']); ?></textarea>
                                                        </div>
                                                        <hr class="custom-hr">

                                                    </div>
                                                    <!-- Botones de Envio -->
                                                    <div class="form-group mt-3" style="text-align:center">
                                                        <button type="button" class="btn btn-success btn-update-proposito" data-id="<?php echo $i; ?>">Actualizar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }else{ ?>
                                        <!-- Tabla Vacio -->
                                            <div class="card bg-crema-bajo">
                                                <div class="card-header" id="heading<?php echo $i; ?>-1">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>-1" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>-1">
                                                            Propósitos de Aprendizaje
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse<?php echo $i; ?>-1" class="collapse" aria-labelledby="heading<?php echo $i; ?>-1" data-parent="#accordion<?php echo $i; ?>">
                                                    <div class="card-body">
                                                        <!-- Datos ocultos -->
                                                        <div class="form-row d-none">
                                                            <input type="hidden" id="courseid<?php echo $i; ?>" name="courseid" value="<?php echo $courseid; ?>">
                                                            <input type="hidden" id="userid<?php echo $i; ?>" name="userid" value="<?php echo $userid; ?>">
                                                            <input type="hidden" id="bimestre<?php echo $i; ?>" name="bimestre" value="<?php echo $bimestre; ?>">
                                                            <input type="hidden" id="seccion<?php echo $i; ?>" name="seccion" value="<?php echo $i; ?>">
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Rango de Fechas -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="nsesiones<?php echo $i; ?>">Cantidad de Horas</label>
                                                                <input 
                                                                    type="number" 
                                                                    id="nsesiones<?php echo $i; ?>" 
                                                                    name="nsesiones" 
                                                                    class="form-control" 
                                                                    placeholder="Seleccionar fecha de fin" 
                                                                    step="1" 
                                                                    min="1"  
                                                                    value="1" 
                                                                >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="startDate<?php echo $i; ?>">Fecha de Inicio</label>
                                                                <input type="text" id="startDate<?php echo $i; ?>" name="startDate" class="form-control datepicker" placeholder="Seleccionar fecha de inicio">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-danger pl-5 pr-5" for="endDate<?php echo $i; ?>">Fecha de Fin</label>
                                                                <input type="text" id="endDate<?php echo $i; ?>" name="endDate" class="form-control datepicker" placeholder="Seleccionar fecha de fin">
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Competencia, Capacidad, Desempeño -->
                                                        <div class="form-row" data-id="<?php echo $i; ?>">
                                                            <!-- Bloque 1 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>1">COMPETENCIA N°1</label>
                                                                <select id="competencia<?php echo $i; ?>1" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>1">CAPACIDAD N°1</label>
                                                                <select id="capacidad<?php echo $i; ?>1" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>1">DESEMPEÑO N°1</label>
                                                                <textarea id="desempeno<?php echo $i; ?>1" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno'] ?></textarea>
                                                            </div>

                                                            <!-- Bloque 2 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>2">COMPETENCIA N°2</label>
                                                                <select id="competencia<?php echo $i; ?>2" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>2">CAPACIDAD N°2</label>
                                                                <select id="capacidad<?php echo $i; ?>2" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>2">DESEMPEÑO N°2</label>
                                                                <textarea id="desempeno<?php echo $i; ?>2" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno'] ?></textarea>
                                                            </div>

                                                            <!-- Bloque 3 -->
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="competencia<?php echo $i; ?>3">COMPETENCIA N°3</label>
                                                                <select id="competencia<?php echo $i; ?>3" name="competencia<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php foreach ($competencias as $competencia) : 
                                                                        $selected = ($competencia['id'] === $datoSesion['competencias_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="capacidad<?php echo $i; ?>3">CAPACIDAD N°3</label>
                                                                <select id="capacidad<?php echo $i; ?>3" name="capacidad<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de capacidad -->
                                                                    <?php 
                                                                    $capacidades = capacidadesCompetencias($datoSesion['competencias_id']);
                                                                    foreach ($capacidades as $capacidad) : 
                                                                        $selected = ($capacidad['id'] === $datoSesion['capacidad_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-primary pl-5 pr-5" for="desempeno<?php echo $i; ?>3">DESEMPEÑO N°3</label>
                                                                <textarea id="desempeno<?php echo $i; ?>3" name="desempeno<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoSesion['desempeno'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Enfoques, Valores y Actitudes y acciones -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="enfoque<?php echo $i; ?>">ENFOQUE</label>
                                                                <select id="enfoque<?php echo $i; ?>" name="enfoque<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php 
                                                                        $enfoques = muestraEnfoques();
                                                                        foreach ($enfoques as $enfoque) : 
                                                                            $selected = ($enfoque['id'] === $datoSesion['enfoque_id']) ? 'selected' : '';
                                                                            echo "<option value=\"{$enfoque['id']}\" $selected>{$enfoque['enfoque']}</option>"; 
                                                                        endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="valor<?php echo $i; ?>">VALOR</label>
                                                                <select id="valor<?php echo $i; ?>" name="valor<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php /*foreach ($valores as $valor) : 
                                                                        $selected = ($valor['id'] === $datoSesion['valor_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$valor['id']}\" $selected>{$valor['valor']}</option>"; 
                                                                    endforeach;*/ ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="text-light bg-warning pl-5 pr-5 text-dark" for="acciones<?php echo $i; ?>">ACTITUDES Y ACCIONES</label>
                                                                <select id="acciones<?php echo $i; ?>" name="acciones<?php echo $i; ?>[]" class="form-control">
                                                                    <option value="">Seleccionar</option>
                                                                    <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                    <?php /*foreach ($acciones as $accion) : 
                                                                        $selected = ($accion['id'] === $datoSesion['accion_id']) ? 'selected' : '';
                                                                        echo "<option value=\"{$accion['id']}\" $selected>{$accion['accion']}</option>"; 
                                                                    endforeach;*/ ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Propósito -->
                                                        <div class="form-group">
                                                            <label class="text-light bg-info pl-5 pr-5" for="proposito<?php echo $i; ?>">PROPÓSITO</label>
                                                            <textarea id="proposito<?php echo $i; ?>" name="proposito" class="form-control" rows="3" placeholder="Ingrese propósito"></textarea>
                                                        </div>
                                                        <hr class="custom-hr">

                                                        <!-- Evidencia de Aprendizaje -->
                                                        <div class="form-group">
                                                            <label class="text-light bg-info pl-5 pr-5" for="evidencia<?php echo $i; ?>">EVIDENCIA DE APRENDIZAJE</label>
                                                            <textarea id="evidencia<?php echo $i; ?>" name="evidencia" class="form-control" rows="3" placeholder="Ingrese evidencia de aprendizaje"></textarea>
                                                        </div>
                                                        <hr class="custom-hr">


                                                    </div>
                                                    <!-- Botones de Envio -->
                                                    <div class="form-group mt-3" style="text-align:center">
                                                        <button type="button" class="btn btn-danger btn-save-proposito" data-id="<?php echo $i; ?>">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }; ?>
                                    <!-- Evaluación -->
                                    <!-- Consulta a la base de datos -->
                                        <?php
                                            $datoEvaluacion = hayEvaluacion($bimestre, $courseid, $i);
                                            echo "<pre>";
                                            //echo var_dump($datoEvaluacion);
                                            echo "</pre>";
                                            if(isset($datoEvaluacion[0]['id'])){
                                        ?>
                                        <!-- Evaluacion con datos -->  
                                            <div class="card bg-rojo-bajo">
                                                <div class="card-header" id="heading<?php echo $i; ?>-2">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>-2" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>-2">
                                                            Evaluación
                                                        </button>
                                                    </h5>
                                                <!-- Datos ocultos -->
                                                    <div class="form-row d-none">
                                                        <input type="hidden" id="courseid<?php echo $i; ?>" name="courseid" value="<?php echo $courseid; ?>">
                                                        <input type="hidden" id="userid<?php echo $i; ?>" name="userid" value="<?php echo $userid; ?>">
                                                        <input type="hidden" id="bimestre<?php echo $i; ?>" name="bimestre" value="<?php echo $bimestre; ?>">
                                                        <input type="hidden" id="seccion<?php echo $i; ?>" name="seccion" value="<?php echo $i; ?>">
                                                    </div>
                                                    <div id="collapse<?php echo $i; ?>-2" class="collapse" aria-labelledby="heading<?php echo $i; ?>-2" data-parent="#accordion<?php echo $i; ?>">
                                                        <div class="card-body">
                                                            <!-- Datos ocultos -->
                                                            <div class="form-row d-none">
                                                                <input type="hidden" id="courseid<?php echo $i; ?>" name="courseid" value="<?php echo $courseid; ?>">
                                                                <input type="hidden" id="userid<?php echo $i; ?>" name="userid" value="<?php echo $userid; ?>">
                                                                <input type="hidden" id="bimestre<?php echo $i; ?>" name="bimestre" value="<?php echo $bimestre; ?>">
                                                                <input type="hidden" id="seccion<?php echo $i; ?>" name="seccion" value="<?php echo $i; ?>">
                                                            </div>
                                                            <!-- Lista de Cotejos -->
                                                            <h2 class="text-center">LISTA DE COTEJOS</h2>
                                                            
                                                            <!-- Fila de Competencias, Competencias, Desempeño -->
                                                            <div class="form-row mb-3" data-id="<?php echo $i; ?>">
                                                                <!-- Bloque 1 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion_1<?php echo $i; ?>1">Competencia N°1</label>
                                                                        <select id="competencia_evaluacion_1<?php echo $i; ?>1" name="competencia_evaluacion_1<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion[0]['competencia_id_1']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion_1<?php echo $i; ?>1">Capacidad N°1</label>
                                                                        <select id="capacidades_evaluacion_1<?php echo $i; ?>1" name="capacidades_evaluacion_1<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion[0]['competencia_id_1']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion[0]['capacidad_id_1']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion_1<?php echo $i; ?>1">Desempeño N°1</label>
                                                                        <textarea id="desempeno_evaluacion_1<?php echo $i; ?>1" name="desempeno_evaluacion_1<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion[0]['desempeno_id_1'] ?></textarea>
                                                                    </div>

                                                                <!-- Bloque 2 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion_2<?php echo $i; ?>2">Competencia N°2</label>
                                                                        <select id="competencia_evaluacion_2<?php echo $i; ?>2" name="competencia_evaluacion_2<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion[0]['competencia_id_2']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion_2<?php echo $i; ?>2">Capacidad N°2</label>
                                                                        <select id="capacidades_evaluacion_2<?php echo $i; ?>2" name="capacidades_evaluacion_2<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion[0]['competencia_id_2']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion[0]['capacidad_id_2']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion_2<?php echo $i; ?>2">Desempeño N°2</label>
                                                                        <textarea id="desempeno_evaluacion_2<?php echo $i; ?>2" name="desempeno_evaluacion_2<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion[0]['desempeno_id_2'] ?></textarea>
                                                                    </div>

                                                                <!-- Bloque 3 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion_2<?php echo $i; ?>3">Competencia N°3</label>
                                                                        <select id="competencia_evaluacion_2<?php echo $i; ?>3" name="competencia_evaluacion_2<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion[0]['competencia_id_3']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion_3<?php echo $i; ?>3">Capacidad N°3</label>
                                                                        <select id="capacidades_evaluacion_3<?php echo $i; ?>3" name="capacidades_evaluacion_3<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion[0]['competencia_id_3']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion[0]['capacidad_id_3']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion_3<?php echo $i; ?>3">Desempeño N°3</label>
                                                                        <textarea id="desempeno_evaluacion_3<?php echo $i; ?>3" name="desempeno_evaluacion_3<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion[0]['desempeno_id_3'] ?></textarea>
                                                                    </div>
                                                            </div>

                                                            <!-- Tabla de Evaluación -->
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>N°</th>
                                                                        <th>Nombre y Apellidos</th>
                                                                        <th>Escala de Valoración</th>
                                                                        <th>Comentarios</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Consulta listado de alumno -->
                                                                    <?php 
                                                                        //$alumnosMatriculados= alumnosMatriculados($courseid);
                                                                        $contador=1;
                                                                    ?>
                                                                    <?php foreach($datoEvaluacion as $alumno => $data): ?>
                                                                            <tr>
                                                                                <?php 
                                                                                    $rptaNombre = nombreUsuario($data['alumno_id']);
                                                                                    $nombre = $rptaNombre->firstname;
                                                                                    $apellido = $rptaNombre->lastname;
                                                                                    $alumno = [
                                                                                        "nombre" => $nombre,
                                                                                        "apellido" => $apellido
                                                                                    ];
                                                                                    /*
                                                                                    echo "<pre>";
                                                                                    echo $data['nota'] == "2" ? 'checked' : '';
                                                                                    echo "</pre>";
                                                                                    */
                                                                                ?>
                                                                                <td><?php echo $contador ?></td>
                                                                                <td>
                                                                                    <p><?php echo $alumno['nombre']." ".$alumno['apellido'] ?></p>
                                                                                    <input type="hidden" id="seccion<?php echo $data['sesion']; ?>" name="seccion" value="<?php echo $data['sesion']; ?>">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion1_<?php echo $contador; ?>" value="3" <?php echo $data['nota'] == "3" ? 'checked' : ''; ?>>
                                                                                        <label class="form-check-label" for="valoracion1_<?php echo $contador; ?>">Siempre</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion2_<?php echo $contador; ?>" value="2" <?php echo $data['nota'] == "2" ? 'checked' : ''; ?>>
                                                                                        <label class="form-check-label" for="valoracion2_<?php echo $contador; ?>">A veces</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion3_<?php echo $contador; ?>" value="1" <?php echo $data['nota'] == "1" ? 'checked' : ''; ?>>
                                                                                        <label class="form-check-label" for="valoracion3_<?php echo $contador; ?>">Con ayuda o dificultad</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion4_<?php echo $contador; ?>" value="0" <?php echo $data['nota'] == "0" ? 'checked' : ''; ?>>
                                                                                        <label class="form-check-label" for="valoracion4_<?php echo $contador; ?>">No lo hace</label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <textarea id="comentarios<?php echo $i; ?>" name="comentarios<?php echo $contador; ?>" class="form-control" rows="4" maxlength="300"><?php echo htmlspecialchars($data['comentario']); ?></textarea>
                                                                                </td>
                                                                            </tr>
                                                                        <?php $contador++; endforeach;?>
                                                                    
                                                                    <!-- Agregar más filas según sea necesario -->
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <!-- Botones de Envio -->
                                                        <div class="form-group mt-3" style="text-align:center">
                                                            <button type="button" class="btn btn-success btn-update-evaluacion" data-id="<?php echo $i; ?>">Actualizar</button>
                                                        </div>
                                                    </div>
                                                </div>      
                                            </div> 
                                        <?php  }else{ ?>
                                        <!-- Evaluacion SIN datos -->   
                                            <div class="card bg-rojo-bajo">
                                                <div class="card-header" id="heading<?php echo $i; ?>-2">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>-2" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>-2">
                                                            Evaluación
                                                        </button>
                                                    </h5>
                                                    <div id="collapse<?php echo $i; ?>-2" class="collapse" aria-labelledby="heading<?php echo $i; ?>-2" data-parent="#accordion<?php echo $i; ?>">
                                                        <!-- Datos ocultos -->
                                                            <div class="form-row d-none">
                                                                <input type="hidden" id="courseid<?php echo $i; ?>" name="courseid" value="<?php echo $courseid; ?>">
                                                                <input type="hidden" id="userid<?php echo $i; ?>" name="userid" value="<?php echo $userid; ?>">
                                                                <input type="hidden" id="bimestre<?php echo $i; ?>" name="bimestre" value="<?php echo $bimestre; ?>">
                                                                <input type="hidden" id="seccion<?php echo $i; ?>" name="seccion" value="<?php echo $i; ?>">
                                                            </div>
                                                        <div class="card-body">
                                                            <!-- Lista de Cotejos -->
                                                            <h2 class="text-center">LISTA DE COTEJOS</h2>
                                                            
                                                            <!-- Fila de Competencias, Competencias, Desempeño -->
                                                            <div class="form-row mb-3" data-id="<?php echo $i; ?>">
                                                                <!-- Bloque 1 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion<?php echo $i; ?>1">Competencia N°1</label>
                                                                        <select id="competencia_evaluacion<?php echo $i; ?>1" name="competencia_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion['competencias_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion<?php echo $i; ?>1">Capacidad N°1</label>
                                                                        <select id="capacidades_evaluacion<?php echo $i; ?>1" name="capacidades_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion['competencias_id']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion['capacidad_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion<?php echo $i; ?>1">Desempeño N°1</label>
                                                                        <textarea id="desempeno_evaluacion<?php echo $i; ?>1" name="desempeno_evaluacion<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion['desempeno'] ?></textarea>
                                                                    </div>

                                                                <!-- Bloque 2 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion<?php echo $i; ?>2">Competencia N°2</label>
                                                                        <select id="competencia_evaluacion<?php echo $i; ?>2" name="competencia_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion['competencias_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion<?php echo $i; ?>2">Capacidad N°2</label>
                                                                        <select id="capacidades_evaluacion<?php echo $i; ?>2" name="capacidades_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion['competencias_id']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion['capacidad_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion<?php echo $i; ?>2">Desempeño N°2</label>
                                                                        <textarea id="desempeno_evaluacion<?php echo $i; ?>2" name="desempeno_evaluacion<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion['desempeno'] ?></textarea>
                                                                    </div>

                                                                <!-- Bloque 3 -->
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="competencia_evaluacion<?php echo $i; ?>3">Competencia N°3</label>
                                                                        <select id="competencia_evaluacion<?php echo $i; ?>3" name="competencia_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de competencias cargadas desde la base de datos -->
                                                                            <?php foreach ($competencias as $competencia) : 
                                                                                $selected = ($competencia['id'] === $datoEvaluacion['competencias_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$competencia['id']}\" $selected>{$competencia['competencia']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="capacidades_evaluacion<?php echo $i; ?>3">Capacidad N°3</label>
                                                                        <select id="capacidades_evaluacion<?php echo $i; ?>3" name="capacidades_evaluacion<?php echo $i; ?>[]" class="form-control">
                                                                            <option value="">Seleccionar</option>
                                                                            <!-- Opciones de capacidades cargadas desde la base de datos -->
                                                                            <?php 
                                                                            $capacidades = capacidadesCompetencias($datoEvaluacion['competencias_id']);
                                                                            foreach ($capacidades as $capacidad) : 
                                                                                $selected = ($capacidad['id'] === $datoEvaluacion['capacidad_id']) ? 'selected' : '';
                                                                                echo "<option value=\"{$capacidad['id']}\" $selected>{$capacidad['capacidad']}</option>"; 
                                                                            endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label class="text-light bg-primary pl-5 pr-5" for="desempeno_evaluacion<?php echo $i; ?>3">Desempeño N°3</label>
                                                                        <textarea id="desempeno_evaluacion<?php echo $i; ?>3" name="desempeno_evaluacion<?php echo $i; ?>[]" class="form-control" rows="4" maxlength="600"><?php echo $datoEvaluacion['desempeno'] ?></textarea>
                                                                    </div>
                                                            </div>

                                                            <!-- Tabla de Evaluación -->
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>N°</th>
                                                                        <th>Nombre y Apellidos</th>
                                                                        <th>Escala de Valoración</th>
                                                                        <th>Comentarios</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Consulta listado de alumno -->
                                                                    <?php 
                                                                        $alumnosMatriculados= alumnosMatriculados($courseid);
                                                                        $contador=1;
                                                                    ?>
                                                                    <?php foreach($alumnosMatriculados as $alumno): ?>
                                                                            <tr>
                                                                                <td><?php echo $contador ?></td>
                                                                                <td>
                                                                                    <!-- <input type="text" name="nombre_apellidos" class="form-control" placeholder="Nombre y Apellidos"> -->
                                                                                    <p><?php echo $alumno['nombre']." ".$alumno['apellido']?></p>
                                                                                    <input type="hidden" id="alumnoid<?php echo $contador; ?>" name="alumnoid<?php echo $contador; ?>" value="<?php echo $alumno['id']; ?>">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion1_<?php echo $contador; ?>" value="3">
                                                                                        <label class="form-check-label" for="valoracion1_<?php echo $contador; ?>">Siempre</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion2_<?php echo $contador; ?>" value="2" checked>
                                                                                        <label class="form-check-label" for="valoracion2_<?php echo $contador; ?>">A veces</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion3_<?php echo $contador; ?>" value="1">
                                                                                        <label class="form-check-label" for="valoracion3_<?php echo $contador; ?>">Con ayuda o dificultad</label>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="radio" name="valoracion<?php echo $contador; ?>" id="valoracion4_<?php echo $contador; ?>" value="0">
                                                                                        <label class="form-check-label" for="valoracion4_<?php echo $contador; ?>">No lo hace</label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <textarea id="comentarios<?php echo $i; ?>" name="comentarios<?php echo $contador; ?>" class="form-control" rows="4" maxlength="300"></textarea>
                                                                                </td>
                                                                            </tr>
                                                                        <?php $contador++; endforeach;?>
                                                                    
                                                                    <!-- Agregar más filas según sea necesario -->
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <!-- Botones de Envio -->
                                                        <div class="form-group mt-3" style="text-align:center">
                                                            <button type="button" class="btn btn-danger btn-save-evaluacion" data-id="<?php echo $i; ?>">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>      
                                            </div>    
                                        <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Custom JS -->
    <script src="js/documentacion.js"></script>
</body>
</html>

