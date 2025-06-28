<?php
require_once '../Capa_Datos/conexion.php';

try {
    // Obtener la instancia singleton
    $conexion = conexion::getInstancia();

    // Obtener la conexión PDO
    $pdo = $conexion->getConexion();

    if ($pdo) {
        echo "<h3 style='color:green;'>✅ Conexión exitosa a la base de datos tecnomovil.</h3>";
    }
} catch (Exception $e) {
    echo "<h3 style='color:red;'>❌ Error: " . $e->getMessage() . "</h3>";
}
?>