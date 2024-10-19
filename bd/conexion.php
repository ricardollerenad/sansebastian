<?php
// Parámetros de conexión
$host = 'localhost';  // Cambia esto por tu host
$dbname = 'ss2024';  // Cambia esto por tu nombre de base de datos
$username = 'rllerena_ss';  // Cambia esto por tu nombre de usuario
$password = 'rllerena_ss@2024';  // Cambia esto por tu contraseña

// Establecer la conexión a la base de datos
function get_db_connection() {
    global $host, $dbname, $username, $password;
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
/*
// Prueba de conexión
$pdo = get_db_connection();
if ($pdo) {
    echo "Conexión establecida correctamente.<br>";
    
    // Ejecutar una consulta de prueba
    try {
        $stmt = $pdo->query("SELECT VERSION() AS version");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Versión de MySQL: " . $row['version'];
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
} else {
    echo "No se pudo establecer la conexión.";
}
*/
?>
