<?php
session_start(); // Inicia la sesión

require(__DIR__.'/bd/config.php');

// Verifica si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si 'competencia' está presente en la solicitud POST
    if (isset($_POST['competencia'])) {
        $competencia = $_POST['competencia'];
        $competencia = htmlspecialchars(trim($competencia));
        $capacidades = capacidadesCompetencias($competencia);
        echo json_encode($capacidades);
        exit(); 
    }
    
    // Verifica si 'enfoque' está presente en la solicitud POST
    if (isset($_POST['enfoque'])) {
        $enfoque = $_POST['enfoque'];
        $enfoque = htmlspecialchars(trim($enfoque));
        $valores = enfoqueValores($enfoque);
        echo json_encode($valores);
        exit(); 
    }

    // Verifica si 'valor' está presente en la solicitud POST
    if (isset($_POST['valor'])) {
        $valor = $_POST['valor'];
        $valor = htmlspecialchars(trim($valor));
        $valores = valorAcciones($valor);
        echo json_encode($valores);
        exit(); 
    }

    echo json_encode(["error" => "No se especificó el parámetro esperado."]);
    exit(); 
} else {
    echo "NO PUEDES ENTRAR AQUÍ";
    exit(); 
}
?>
